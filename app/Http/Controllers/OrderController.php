<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Order;
use Session;
use Yajra\Datatables\Datatables;


class OrderController extends Controller
{
   
    public function index()
    {    	

        return view('admin.orders.index');
         // $lastOrder = \App\Order::orderBy('created_at', 'desc')->first();
         // return $lastOrder->order_id;        
    }


    public function create()
    {
        $customers = Customer::pluck('nama','id')->toArray();

        $products = Product::pluck('nama','id')->toArray();        

        return view('admin.orders.create')->with(['customers'=>$customers,'products'=>$products]);
    }


    public function nohp(Request $request){

    	$id = $request->id;
    	
    	return Customer::find($id);

    }

    public function namabarang(Request $request){

    	$id = $request->id;
    	
    	return Product::find($id);

    }

    public function store(Request $request)
    {
        //return $count = count( $request->input('produkid') );
        //dd($request->all());

        //save table order 
        $ordernumber = OrderController::orderNumber();
        $order = new \App\Order;

        $order->customer_id  = $request->input('customer'); //customerid
        $order->no_order = $ordernumber."/".date('ymd');   
        $order->total  = $request->input('total');
        $order->uang_muka  = $request->input('uangmuka');
        $order->grand_total  = $request->input('grandtotal');

        $order->save();

        //save table order detail
        $count = count( $request->input('produkid') );
        
        for ($i=0; $i < $count ; $i++) {

            $orderDetail = new \App\OrderDetail;
                       
            //$orderDetail->order_id = $request->input('order_id');
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $request->input('produkid')[$i];       
            $orderDetail->harga = $request->input('tdharga')[$i];
            $orderDetail->sub_total = $request->input('totharga')[$i];
            $orderDetail->jumlah = $request->input('tdjumlah')[$i];
            //$orderDetail-> = $request->input('tdketerangan')[$i]; 
            $orderDetail->save();   

        }
        
        Session::flash('success', 'data anda telah di simpan' );
        return redirect()->route('orders.index');      
    }

    public function edit($id)
    {
        $customers = Customer::all();
        //dd(Order::find($id)->orderdetail);
        
        return view('admin.orders.edit')->with([
                                            //'orders'=>Order::find($id)->orderdetail()->with('product')->get(),
                                            'orders'=>Order::find($id),
                                            'customers'=>$customers,
                                            'products' => Product::pluck('nama','id')->toArray()
                                        ]);
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public static function orderNumber()
    {
        // Get the last created order
        $lastOrder = \App\Order::orderBy('created_at', 'desc')->first();

        if ( ! $lastOrder )
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.

            $number = 0;
        else 
            $number = substr($lastOrder->no_order, 4,-7);
            echo $number;

        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.
     
        return 'ORD/' . sprintf('%04d', intval($number) + 1);
    }


    public function getMasterData()
    {
        //$orders = \App\Order::select();
        $orders = \App\Order::with(['customer'])->select('orders.*');

        return Datatables::of($orders)
            ->addColumn('details_url', function($order) {
                return url('admin/orders/datadetail/' . $order->id);
               // return route('orders.detail'). $order->id;
            })->addColumn('action', function($order){
                return '<a href="orders/'.$order->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })

            ->make(true);
    }

    public function getDetailsData($id)
    {
        $orders = \App\Order::find($id)->orderdetail()->with('product');

        return Datatables::of($orders)->make(true);
    }
      



}
