<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Products::all();
        return view('product.index', compact('product'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([ 
            'product_name' => 'required|string|max:255|unique:products', 
            'price' => 'required|numeric|min:0.01',
            'description' => 'required|string', 
        ]);        

        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $imagePath = 'uploads/products/' . $filename;
        } else {
            $imagePath = null;
        }

        Products::create([
            'pic' => $imagePath,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('product.index')->with('success', 'Product Created Successfully!');
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);
        return view('product.show', compact('product'));
    }


    public function edit(string $id)
    {
        $product = Products::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_name' => 'sometimes|required|string|max:255|unique:products,product_name,' . $id,
            'price' => 'sometimes|required|numeric|min:0.01',
            'description' => 'sometimes|required|string|max:255',
        ]);

        $product = Products::findOrFail($id);

        if ($request->hasFile('pic')) {
            if ($product->pic && file_exists(public_path($product->pic))) {
                unlink(public_path($product->pic));
            }

            $file = $request->file('pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $imagePath = 'uploads/products/' . $filename;
        } else {
            $imagePath = $product->pic;
        }

        $product->update([
            'pic' => $imagePath,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('product.index')->with('success', 'Product Updated Successfully!');
    }

    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product Deleted Successfully!');
    }
}