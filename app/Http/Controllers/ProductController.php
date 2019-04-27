<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use \Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('Product/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Product/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        try {
            //Validate
            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|min:1|max:50|unique:products,name',
                'quantity' => 'required|numeric|min:1|max:999',
                'price' => 'required|numeric|min:1|max:9999',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            Product::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total' => $request->quantity * $request->price,
            ]);

            return redirect()->route('product.index');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('Product/edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|min:1|max:50',
                'quantity' => 'required|numeric|min:1|max:999',
                'price' => 'required|numeric|min:1|max:9999',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $product->update([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total' => $request->quantity * $request->price,
            ]);

            return redirect()->route('product.index');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with(['info'=>'Product removed.']);
    }
}
