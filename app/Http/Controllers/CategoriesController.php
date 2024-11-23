<?php

namespace App\Http\Controllers;
use App\Models\Categories;

class CategoriesController
{
    public function category(){
        $Categories = Categories::all();

        return view('categories/categories', [
            'titlepage' => "Categories page",
            'Categories' => $Categories
        ]);
    }

    public function create_category(){
        if (isset($_POST['category'])){
            $Categories = Categories::create([
                'category' => $_POST['category'],
            ]);
        }

        return redirect('/categories');
    }

    public function edit_category(){
        $category_id = "";

        if (isset($_POST['category_id'])){
            $category_id = $_POST['category_id'];
        }

        $category = Categories::find($category_id);
        #check if this functino is accesed by navigating from authorpage or not
        if(isset($_POST["edit_done"])){
            $category->category = $_POST['category'];
            $category->save();

            return redirect('/categories');
        }else{
            return view('categories/edit_category',[
                'titlepage' => "Edit category",
                'category' => $category,
            ]);
        }
    }

    public function delete_category(){
        $category_id = "";

        if (isset($_POST['category_id'])){
            $category_id = request('category_id');
        }

        $category = Categories::find($category_id);

        $category->delete();
        
        return redirect('/categories');
    }
}
