<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductSection;

class CategoryController extends Controller
{
    
    public function index()
    {
        $title = "Category List";

        $parentCategoryParam = @$_GET['parentCategory'];
        $parentCategoryList = Category::all();

        if($parentCategoryParam){
            $categories = DB::table('categories as tab1')
                ->select('tab1.*','tab2.categoryName as parentName')
                ->leftjoin('categories as tab2','tab2.id','=','tab1.parent')
                ->where('tab1.parent',$parentCategoryParam)
                ->orWhere('tab1.id',$parentCategoryParam)
                ->orderBy('parentName','asc')
                ->orderBy('orderBy','asc')
                ->get();
        }else{ 
            $nullCategories = Category::select('categories.*','parent as parentName')
            ->whereNull('parent');

            $categories = DB::table('categories as tab1')
                ->select('tab1.*','tab2.categoryName as parentName')
                ->leftjoin('categories as tab2','tab2.id','=','tab1.parent')
                ->union($nullCategories)
                ->orderBy('parentName','asc')
                ->orderBy('orderBy','asc')
                ->get();
        }

        return view('admin.categories.index')->with(compact('title','parentCategoryParam','parentCategoryList','categories'));
    }

    public function changecategoryStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = Category::find($request->category_id);
            $data->categoryStatus = $data->categoryStatus ^ 1;
            $data->update();
            print_r(1);       
            return;
        }
        return redirect(route('categories.index')) -> with( 'message', 'Wrong move!');
    }
    
    public function addcategory()
    {
        $title = "Add New Category";
        $categories = Category::all();
        $product_section_list = ProductSection::orderBy('order_by','ASC')->where('status',1)->get();
        return view('admin.categories.addcategory')->with(compact('title','categories','product_section_list'));
    }

     public function savecategory(Request $request){
        $this->validation($request);

        $this->validate(request(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',       
            'headerImage' => 'image'       
        ]);

        
        if($request->image){
            $width = '100%';
            $height = '100%';
            $originalImage = \App\HelperClass::UploadImage($request->image,'categories','images/categories/original_image/',@$width,@$height);
        }
        if($request->headerImage){
            $width = '850';
            $height = '360';
            $headerImage = \App\HelperClass::UploadImage($request->headerImage,'categories','images/categories/header_image/',@$width,@$height);
        }

        if($request->image){
            $width = '325';
            $height = '225';
            $image = \App\HelperClass::UploadImage($request->image,'categories','images/categories/image/',@$width,@$height);
        }

        if($request->productSection){
            $request->productSection = implode(',', $request->productSection);
        }

        $category = Category::create( [  
            'parent' => $request->parent,    
            'categoryName' => $request->categoryName,          
            'headerImage' => @$headerImage, 
            'originalImage' => @$originalImage, 
            'image' => @$image,           
            'icon' => $request->icon,        
            'showInMainMenu' => $request->showInMainMenu,    
            'showInSidebarCategory' => $request->showInSidebarCategory,    
            'productSection' => $request->productSection,         
            'showInHomepage' => $request->showInHomepage,    
            'showInHomeCategoryProduct' => $request->showInHomeCategoryProduct,           
            'showInHomeCategoryProductWithSubcategory' => $request->showInHomeCategoryProductWithSubcategory,           
            'showInHomeCategoryProductWithProduct' => $request->showInHomeCategoryProductWithProduct,           
            'orderBy' => $request->orderBy,    
            'categoryStatus' => $request->categoryStatus,
            'metaTitle' => $request->metaTitle,            
            'metaKeyword' => $request->metaKeyword,            
            'metaDescription' => $request->metaDescription,            
        ]);

        return redirect(route('categories.index',['parentCategory'=>$request->parent]))->with('msg','Category Added Successfully');     
    }
  
    public function editCategory($id){
        $title = "Edit Category";
        $parentCategory = Category::all();
        $categories = Category::where('id',$id)->first();
        $product_section_list = ProductSection::orderBy('order_by','ASC')->where('status',1)->get();
        return view('admin.categories.updatecategory')->with(compact('title','categories','parentCategory','product_section_list'));
    }


    public function updateCategory(Request $request){
        $this->validation($request);
        $categoryId = $request->categoryId;

        $category = Category::find($categoryId);
        if($request->image){
            $width = '100%';
            $height = '100%';
            @unlink($category->originalImage);
            $originalImage = \App\HelperClass::UploadImage($request->image,'categories','images/categories/original_image/',@$width,@$height);
             $category->update( [
                'originalImage' => $originalImage,          
            ]);
        }
        if($request->headerImage){
            $width = '850';
            $height = '360';
            @unlink($category->headerImage);
            $headerImage = \App\HelperClass::UploadImage($request->headerImage,'categories','images/categories/header_image/',@$width,@$height);
            $category->update( [
                 'headerImage' => @$headerImage,               
            ]);
        }
        if($request->image){
            @unlink($category->image);
            $width = '325';
            $height = '225';
            $image = \App\HelperClass::UploadImage($request->image,'categories','images/categories/image/',@$width,@$height);
            $category->update( [
                'image' => $image,          
            ]);
        }

        if($request->productSection){
            $request->productSection = implode(',', $request->productSection);
        }
        
        $category->update( [
            'parent' => $request->parent,    
            'categoryName' => $request->categoryName,           
            'icon' => $request->icon,        
            'showInMainMenu' => $request->showInMainMenu,    
            'showInSidebarCategory' => $request->showInSidebarCategory,    
            'productSection' => $request->productSection,    
            'showInHomepage' => $request->showInHomepage,    
            'showInHomeCategoryProduct' => $request->showInHomeCategoryProduct,           
            'showInHomeCategoryProductWithSubcategory' => $request->showInHomeCategoryProductWithSubcategory,          
            'showInHomeCategoryProductWithProduct' => $request->showInHomeCategoryProductWithProduct,           
            'orderBy' => $request->orderBy,    
            'categoryStatus' => $request->categoryStatus,
            'metaTitle' => $request->metaTitle,            
            'metaKeyword' => $request->metaKeyword,            
            'metaDescription' => $request->metaDescription,          
        ]);

        return redirect(route('categories.index',['parentCategory'=>$request->parent]))->with('msg','Category Updated Successfully');     
    }


   public function delete(Request $request,$id = NULL)
    {   
        if($request->categoryId){
            $categoryId = $request->categoryId; 
        }else{
            $categoryId = $id;
        }

        $category = Category::find($categoryId);
        @unlink($category->headerImage);
        @unlink($category->originalImage);
        @unlink($category->image);
        Category::where('id',$categoryId)->delete(); 
        if($request){
            return response()->json(true);
        }else{
          return redirect(route('category.index'))->with('msg','Category Deleted Successfully');  
        }
        
    }

    //View Category

     public function edit(Category $category, Request $request)
    {
        $category = Category::find($request->category_id);
        if($request->ajax())
            {
                return response()->json([
                    'category'=>$category
                ]);
            }
        return view('admin.categories.edit')->with(compact('category'));
    }


    public function validation(Request $request)
    {
        $this->validate(request(), [
            'categoryName' => 'required|string'
            
        ]);
    }
}
