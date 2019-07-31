<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Product;
use App\Filters\ProductFilters;
use App\Search\ProductSearch;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.index', compact('products'));
    } */
    public function index(Request $request)
    {
        $products = ProductSearch::apply($request);
        return view('products.index', compact('products'));
    }
    /* public function index(Request $request, ProductFilters $filters)
    {
        $products = Product::filter($filters)->paginate(5);
        //print_r($products);
        //die();
        return view('products.index', compact('products'));
    } */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|alpha_num',
            'price' => 'required|numeric',
        ]);
        $product = Product::create($validatedData);
   
        return redirect('/products')->with('success', 'Product is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|alpha_num',
            'price' => 'required|numeric',
        ]);
        Product::whereId($id)->update($validatedData);

        return redirect('/products')->with('success', 'Product is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Product is successfully deleted');
    }
}
