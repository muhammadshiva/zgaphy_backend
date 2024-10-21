<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve all products from the database
        // $products = Product::paginate(10);
        $products = DB::table('products')->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Pass the products to the view
        return view('pages.product.index', compact('products'));
    }

    public function create()
    {
        // Return the view for creating a new product
        return view('pages.product.create');
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $filename = time() . '.' . $request->images->extension();
            $request->images->move(public_path('images'), $filename);
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = (int) $request->price;
            $product->category = $request->category;
            $product->images = 'images/' . $filename;
            $product->save();

            toastr()->success('Product created successfully.');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->route('product.create');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('pages.product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            // Check if a new image has been uploaded
            if ($request->hasFile('images')) {
                // Delete the old image if it exists
                if (file_exists(public_path($product->images))) {
                    unlink(public_path($product->images));
                }

                // Upload the new image
                $filename = time() . '.' . $request->images->extension();
                $request->images->move(public_path('images'), $filename);
                $product->images = 'images/' . $filename;
            }

            // Update the other fields
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = (int) $request->price;
            $product->category = $request->category;

            // Save the changes
            $product->save();

            toastr()->success('Product updated successfully.');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->route('product.edit', $product->id);
        }
    }

    public function destroy(Product $product)
    {
        try {
            // Check if the product has an image and delete it
            if (file_exists(public_path($product->images))) {
                unlink(public_path($product->images));
            }

            // Delete the product from the database
            $product->delete();

            toastr()->success('Product deleted successfully.');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->route('product.index');
        }
    }
}

   // Validate the input data
    // $request->validate([
    //     'name' => ['required', 'string', 'max:255'],
    //     'description' => ['required', 'string'],
    //     'price' => ['required', 'numeric'],
    //     'category' => ['required', 'string'],
    //     'images' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    // ]);

    // Upload the product image
    // $imageName = time() . '.' . $request->images->getClientOriginalExtension();
    // $request->images->move(public_path('images'), $imageName);

    // // Create a new product in the database
    // $product = new Product();
    // $product->name = $request->name;
    // $product->description = $request->description;
    // $product->price = $request->price;
    // $product->category = $request->category;
    // $product->images = 'images/' . $imageName;

    // $product->save();
    // toastr()->success('Product created successfully.');
    // return redirect()->route('product.index');
