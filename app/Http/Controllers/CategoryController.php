<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home(Category $category)
    {

        $cat = $category->products;

        return response()->json($cat);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    //for admin
    public function indexCategory()
    {
        $categories = Category::with('products')->get();
        // dd($categories);
        return view('layouts.AdminPanel.categoryAdmin.index', ['categories' => $categories]);
    }
    public function createCategory(Category $category)
    {
        // $attributeOfCategory = $category->attributes;
        // $attributes = Attribute::with('categoryAttribute')->get();
        return view('layouts.AdminPanel.categoryAdmin.create');
    }

    public function addCategoryAdmin(Request $request)
    {

        $category = Category::create([
            'name' => $request->category,

        ]);
        $category = $category->id;
        return redirect()->route('category.indexCategory')->with('confirm', 'category has already added');
    }


    public function editCategory(Category $category)
    {
        $productsOfCategory = $category->products;
        $products = Product::with('category')->get();
        return view('layouts.AdminPanel.categoryAdmin.edit', [
            'category' => $category,
            'productsOfCategory' => $productsOfCategory,
            'products' => $products
        ]);
    }

    public function productindex()
    {
        return view('layouts.AdminPanel.categoryAdmin.productIndex');
    }
    public function updateCategory(Request $request, Category $category)
    {




        if ($request->has("category")) {
            $category->name = $request->input('category');
            $category->save();
        }



        if ($request->has("product")) {
            foreach ($request->input('product') as $product) {
                Product::updateOrInsert(
                    ['id' => $product],
                    ['category_id' => $category->id]
                );
            }
            // $products= Product::whereIn('id', $request->input('product'))->get();
            // $category->products()->saveMany($products);
        }

        return redirect()->route('category.indexCategory')->with('confirm', 'category has already updated');
    }



    public function deleteCategory($id)
    {
        $category = Category::find($id)->delete();
        return redirect()->route('category.indexCategory')->with('confirm', 'category has deleted successfully');
    }
}
