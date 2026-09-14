<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $btnTitle = "Add New Product";
        $btnUrl = route('product.create');
        $subtitle = "information regarding products";
        $title = "Product";
        $products = Product::orderBy('id', 'ASC')->get();
        return view('product.index', compact('products', 'title', 'btnTitle', 'btnUrl', 'subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $title = "Add Product";
        $subtitle = "Add the product in accordance with the rules.";
        return view('product.create', compact('title', 'subtitle', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(
        //     $request->all(),
        //     $request->hasFile('photo'),
        //     $request->file('photo')
        // );

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->to('product')->with('success', 'Create Product Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::get();
        $products = Product::find($id);
        $title = "Detail Product";
        $subtitle = "information regarding product details";
        return view('product.detail', compact('title', 'subtitle', 'categories', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::get();
        $products = Product::find($id);
        $title = "Edit Product";
        return view('product.edit', compact('title', 'products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data =[
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description
        ];

        if($request->hasFile('photo'))
        {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->to('product')->with('success', 'Update Product Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }
        $product->delete();

        return redirect()->to('product')->with('success', 'Delete Product Success');
    }
}
