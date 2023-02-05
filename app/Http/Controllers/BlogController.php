<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use DataTables;



class BlogController extends Controller
{
    public function report(Request $request){
        if ($request->ajax()) {
            $data = Blog::with('category')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $edit=route('blog.edit',[$row->id]);
                    $delete=route('blog.delete',[$row->id]);
                    $btn = "<a href='$edit' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='$delete' class='btn btn-danger btn-sm'>Delete</a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.blog.report');
    }

    public function create(){
        $cat=BlogCategory::all();
        return view('pages.blog.create',compact('cat'));
    }

    public function save(Request $request){
        $val=$request->validate(['title'=>'required','category_id'=>'required','image'=>'required','description'=>'required']);
        try{

            DB::beginTransaction();
        $blog=new Blog();
        $blog->title=$request->title;
        $blog->description=$request->description;
        $blog->category_id=$request->category_id;
        $blog->status=$request->status=='on'?1:0;
        $blog->slug='Pending';
        $blog->image='Pending';
       if($blog->save()){

        $file=$request->file('image');

        if($file){
            $filename='blog-'.$blog->id.'.'.$file->getClientOriginalExtension();
            $path='images/blog/';
            $file->move($path,$filename);
            $blog->image=$path.$filename;
            $blog->save();
        }

        $blog->slug=Str::slug($request->title , "-").$blog->id;
        if($blog->save()){

            DB::commit();

        return redirect()->route('blog.report');
       }
       else{
        DB::rollback();
        return redirect()->back();

       }
    }
    else{
        DB::rollback();
        return redirect()->back();

       }

    }
    catch(Exception $e){
        DB::rollback();
        return redirect()->back();

    }

    }

    public function edit($id){
        $cat=BlogCategory::all();
        $blog=Blog::find($id);
        return view('pages.blog.edit',compact('blog','cat'));
    }

    public function update(Request $request){

        $val=$request->validate(['title'=>'required','category_id'=>'required','description'=>'required']);

        $blog=Blog::find($request->id);
        $blog->title=$request->title;
        $blog->description=$request->description;
        $blog->category_id=$request->category_id;
        $blog->status=$request->status=='on'?1:0;

        $file=$request->file('image');

        if($file){
            if (File::exists($blog->image)) {
                File::delete($blog->image);
            }
            $filename='blog-'.$blog->id.'.'.$file->getClientOriginalExtension();
            $path='images/blog/';
            $file->move($path,$filename);
            $blog->image=$path.$filename;
            $blog->save();
        }



       if($blog->save()){
        return redirect()->route('blog.report');
       }
       else{
        return redirect()->back();
       }


    }

    public function delete($id){
        $blog=Blog::find($id);



        if(empty($blog))
        return redirect()->back();

        if (File::exists($blog->image)) {
            File::delete($blog->image);
        }
        if($blog->delete()){
            return redirect()->route('blog.report');

        }
    }

            public function getBlogs($slug=null){
                $blogs=Blog::whereHas('category',function($q)use($slug){

                    if($slug!=null)
                    $q->where('slug',$slug);
                })->get();
                $cat = BlogCategory::get();

                return view('pages.blogs',compact('blogs','cat'));
            }

            public function blogDetails($slug){

               $blog= Blog::where('slug',$slug)->with('category')->first();
               return view('pages.blogdetails',compact('blog'));

            }


}
