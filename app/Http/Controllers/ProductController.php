<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        
        return Inertia::render('Product/Index', [
            'products' => Product::all(),
            'status' => session('status'),
            'canEdit' => (auth()->user()->role_id == 3) ? false : true,  
            'canDelete' => (auth()->user()->role_id == 1) ? true : false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createProduct()
    {
        if ((auth()->user()->role_id == 1)) {
            # code...
            return Inertia::render('Product/CreateProduct', [
                
            ]);
        }else {
            # code...
            return Redirect::route('products.list')->with('status', 'Permission Restricted');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeProduct(ProductCreateRequest $request)
    {
        try {
            Product::create([
                'name' => $request->name,
                'sku' => $request->sku,
                'quantity' => $request->quantity,
                'image' => "https://source.unsplash.com/random",
            ]);

            return Redirect::route('products.list')->with('status', 'Product Created Successfully.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editProduct(Request $request, $id)
    {
        if ((auth()->user()->role_id == 1) || (auth()->user()->role_id == 2)) {
            $product = Product::whereId($id)->first();

            return Inertia::render('Product/UpdateProduct', [
                'product' => $product
            ]);
        }else {
            return Redirect::route('products.list')->with('status', 'Permission Restricted');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProduct(ProductUpdateRequest $request, $id)
    {
        $product = Product::whereId($id)->first();

        if ($product) {
            $product->update([
                'name' => $request->name,
                'sku' => $request->sku,
                'quantity' => $request->quantity,
            ]);

            return Redirect::route('products.list')->with('status', 'Product Updated Successfully.');
        }else {
            return back()->withErrors('Invalid Product');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteProduct(Request $request)
    {
        if ((auth()->user()->role_id == 1)) {
            $product = Product::whereId($request->id)->first();

            if ($product) {
                $product->delete();

                return Redirect::route('products.list')->with('status', 'Product Deleted Successfully.');
            }else {
                return back()->withErrors('Invalid Product');
            }
        }else {
            return Redirect::route('products.list')->with('status', 'Permission Restricted');
        }
    }
}
