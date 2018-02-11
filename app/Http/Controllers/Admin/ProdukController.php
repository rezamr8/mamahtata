<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','isAdmin']);
        //$this->middleware(['auth','kasir']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $produk = Produk::where('nama', 'LIKE', "%$keyword%")
                ->orWhere('harga_beli', 'LIKE', "%$keyword%")
                ->orWhere('harga_jual', 'LIKE', "%$keyword%")
                ->orWhere('stok', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $produk = Produk::paginate($perPage);
        }

        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $this->validate(request(),[

            'nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required'

        ]);

        $requestData = $request->all();
        
        Produk::create($requestData);

        return redirect('admin/produk')->with('flash_message', 'Produk added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);

        return view('admin.produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view('admin.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $produk = Produk::findOrFail($id);
        $produk->update($requestData);

        return redirect('admin/produk')->with('flash_message', 'Produk updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Produk::destroy($id);

        return redirect('admin/produk')->with('flash_message', 'Produk deleted!');
    }
}
