<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{

    public function __construct() {
        $this->middleware(['auth','isAdmin']);
        //$this->middleware(['auth','kasir']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    
    public function index()
    {

    	$products = Product::all();


    	return view('product.index',compact('products'));
    }


    public function create()
    {

    	return view('product.create');

    }


    public function store()
    {
    	$this->validate(request(),[

    		'nama' => 'required|max:30',
    		'harga' => 'required'

    	]);

    	$product = new Product;
    	$product->nama = request('nama');
    	$product->harga = request('harga');
    	$product->save();

    	return redirect('products');

    }

    public function show($id)
    {
    	$product = Product::find($id);
    	return view('product.show',compact('product','id'));
    }


    public function update(Request $request, $id)
    {
    	//dd(request()->all());
    	$product = Product::find($id);

    	$product->nama = request('nama');
    	$product->harga = request('harga');
    	$product->save();

    	return redirect('products');
    }
}
