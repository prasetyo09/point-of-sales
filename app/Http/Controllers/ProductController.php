<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Cloudinary;
use Illuminate\Support\Str;

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
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'products',
                    'public_id' => 'prodct_' . $product->id . '_' . Str::uuid(),
                    'resource_type' => 'image',
                ]
            );

            $data['photo'] = $upload['secure_url'];
            $data['product_photo_public_id'] = $upload['public_id'];

            $newPublicId = $upload['public_id'];
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

        $cloudinary = new Cloudinary();
        $newPublicId = null;

        if ($request->hasFile('photo'))
        {
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'products',
                    'public_id' => 'product_' . $product->id . '_' . Str::uuid(),
                    'resource_type' => 'image',
                ]
            );

            $data['photo'] = $upload['secure_url'];
            $data['product_photo_public_id'] = $upload['public_id'];

            $newPublicId = $upload['public_id'];
        }

        $oldPublicId = $product->product_photo_public_id;

        try {
            $product->update($data);

        } catch (\Throwable $e) {

            // Jika update database gagal, hapus foto baru
            if ($newPublicId) {
                $cloudinary->uploadApi()->destroy($newPublicId);
            }

            throw $e;
        }

        // Hapus foto lama setelah database berhasil diperbarui
        if ($newPublicId && $oldPublicId) {
            $cloudinary->uploadApi()->destroy($oldPublicId);
        }
        return redirect()->to('product')->with('success', 'Update Product Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(Product $product)
    {
        if ($product->product_photo_public_id) {
            $cloudinary = new \Cloudinary\Cloudinary();

            $cloudinary->uploadApi()->destroy(
                $product->product_photo_public_id
            );
        }

        $product->delete();

        return redirect()->to('product')->with('success', 'Delete Product Success');
    }
}
