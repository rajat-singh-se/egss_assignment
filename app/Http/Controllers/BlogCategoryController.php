<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;


class BlogCategoryController extends Controller
{
    //
    public function report(Request $request){
        if ($request->ajax()) {
            $data = BlogCategory::get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $edit=route('category.edit',[$row->id]);
                    $delete=route('category.delete',[$row->id]);
                    $btn = "<a href='$edit' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='$delete' class='btn btn-danger btn-sm'>Delete</a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.category.report');
    }

    public function create(){
        return view('pages.category.create');
    }

    public function save(Request $request){
        $val=$request->validate(['category_name'=>'required']);
        try{

            DB::beginTransaction();
        $cat=new BlogCategory();
        $cat->category_name=$request->category_name;
        $cat->slug='pending';
       $cat->save();
        $cat->slug=Str::slug($request->category_name , "-").$cat->id;
        if($cat->save()){
            DB::commit();

        return redirect()->route('category.report');
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
        $cat=BlogCategory::find($id);
        return view('pages.category.edit',compact('cat'));
    }

    public function update(Request $request){
        $val=$request->validate(['category_name'=>'required']);
        $cat=BlogCategory::find($request->id);
        $cat->category_name=$request->category_name;
       if($cat->save()){
        return redirect()->route('category.report');
       }
       else{
        return back();
       }

    }

    public function delete($id){
        $cat=BlogCategory::find($id);
        $cat->delete();
        return redirect()->route('category.report');
    }





}
