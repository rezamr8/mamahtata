<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Produk;
use App\Order;
use App\OrderDetail;
use App\StokKeluar;
use Session;
use Yajra\Datatables\Datatables;
use Auth;

use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class OrderController extends Controller
{

    public function __construct() {
        $this->middleware(['auth','clearance'])->except(['getMasterData','getDetailsData']);
        //$this->middleware(['auth','kasir']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

   
    public function index()
    {    	

        return view('admin.orders.index');
         // $lastOrder = \App\Order::orderBy('created_at', 'desc')->first();
         // return $lastOrder->order_id;        
    }


    public function create()
    {
        $customers = Customer::pluck('nama','id')->toArray();

        $products = Produk::pluck('nama','id')->toArray();        

        return view('admin.orders.create')->with(['customers'=>$customers,'products'=>$products]);
    }


    public function nohp(Request $request){

    	$id = $request->id;
    	
    	return Customer::find($id);

    }

    public function namabarang(Request $request){

    	$id = $request->id;
    	
    	return Produk::find($id);

    }

    public function store(Request $request)
    {
        
        //dd($request->all());

        //save table order 
        $ordernumber = OrderController::orderNumber();
        $order = new \App\Order;

        $order->customer_id  = $request->input('customer'); //customerid
        $order->no_order = $ordernumber."/".date('ymd'); 
        $order->uang_muka = 0;
        $order->grand_total  = $request->input('grandtotal');
        $order->piutang = $request->input('grandtotal');
        $order->total_produk = request('totalproduk');
        $order->total_biaya_setting = request('totalbiayasetting');
        $order->save();

        //save table order detail
        $count = count( $request->input('produkid') );
        
        for ($i=0; $i < $count ; $i++) {

            $orderDetail = new \App\OrderDetail;
                       
            
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $request->input('produkid')[$i];
            $orderDetail->panjang = request('tdpanjang')[$i];
            $orderDetail->lebar = request('tdlebar')[$i];
            $orderDetail->luas = request('tdluas')[$i];       
            $orderDetail->harga = $request->input('tdharga')[$i];
            $orderDetail->discount = request('tddisc')[$i];
            $orderDetail->sub_total = $request->input('tdtotharga')[$i];
            $orderDetail->jumlah = $request->input('tdjumlah')[$i];
            $orderDetail->keterangan = $request->input('tdketerangan')[$i]; 
            $orderDetail->biaya_setting = request('tdbiayasetting')[$i];
            $orderDetail->keuntungan = request('tduntung')[$i];
            $orderDetail->save();   

        }

        //save table stok_keluar dan update(kurangi stok produk) table produk

        for ($i = 0; $i < $count; $i++){
            
            StokKeluar::create([
                'order_id' => $order->id,
                'produk_id' => request('produkid')[$i],
                'jumlah' => request('tdluas')[$i]
            ]);

            $produk = Produk::findOrFail(request('produkid')[$i]);
            $kurang = ($produk->stok) - request('tdluas')[$i];
            $produk->stok = $kurang;
            $produk->update();

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
                                //'orders'=>Order::find($id)->with(['orderdetail','stokkeluar']),
                                'orders'=>Order::find($id),
                                'customers'=>$customers,
                                'products' => Produk::pluck('nama','id')->toArray()
                                ]);
    }

    public function bayar($id)
    {
        $customers = Customer::all();
       
        
        return view('admin.orders.bayar')->with([
                                
                                'orders'=>Order::find($id),
                                'customers'=>$customers,
                                'products' => Produk::pluck('nama','id')->toArray()
                                ]);
    }

    public function printbayar($id)
    {

        $ip = 'localhost'; // IP Komputer kita atau printer lain yang masih satu jaringan
        $printer = 'EPSON TM-U220 Receipt'; // Nama Printer yang di sharing
        $connector = new WindowsPrintConnector("smb://" . $ip . "/" . $printer);

        $printer = new Printer($connector);
        $orders = Order::find($id);
        $discount = 0;
        $justification = array(
            Printer::JUSTIFY_LEFT,
            Printer::JUSTIFY_CENTER,
            Printer::JUSTIFY_RIGHT);
        $printer->setJustification($justification[1]);
        //$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text("NAJMA PRINTING Telp 0892312312\n");
        //$printer -> setUnderline();
        $printer -> feed(1);
        $printer -> text("JL SOREANG NO 999\n"); 
        $printer->text(str_pad("", 39, "="));
        $printer -> feed(1);
       // $printer -> selectPrintMode();
        $printer->setJustification($justification[0]);
        $printer->text($orders->no_order);
        $printer->text(str_pad(" ", 15, " "));
        $printer->text(Auth::user()->name ."\n");
        //$printer->text(date('D j M Y H:i:s') ."\n");
        $printer->text(date('D j M Y H:i:s') ."\n");
         $printer -> feed(1);
        foreach ($orders->orderdetail as $order) {
           $printer->setJustification($justification[0]);
           $printer->text(strtoupper($order->product->nama) ."\n");            
           $printer->text("$order->panjang M");
           $printer->text(" X ");
           $printer->text("$order->lebar M ");
           $printer->text("*$order->jumlah");
           $printer->text(str_pad(" ", 17, " "));//9
           $printer ->setEmphasis(true);
           $total = ($order->sub_total) + ($order->discount);

           $discount += $order->discount;
           $printer->text("Rp ". number_format($total). "\n");

            // $printer->text("SUB TOTAL Rp ". number_format($order->sub_total) ."\n");
            // $printer->text("DISC Rp ". number_format($order->discount) ."\n");
           $printer ->setEmphasis(false);

         }

      
         $printer ->setEmphasis(true);
         $printer -> feed(1);
         $printer->text(str_pad("DISCOUNT Rp ". number_format($discount) ."\n",39," ",STR_PAD_LEFT));
         $printer->text(str_pad("SETTING Rp ". number_format($orders->total_biaya_setting) ."\n",39," ",STR_PAD_LEFT));
         $printer->text(str_pad("  TOTAL Rp ". number_format($orders->grand_total) ."\n",39," ",STR_PAD_LEFT));
         $printer->text(str_pad("     DP Rp ". number_format($orders->uang_muka) ."\n",39," ",STR_PAD_LEFT));
         $printer->text(str_pad("   SISA Rp ". number_format($orders->piutang) ."\n",39," ",STR_PAD_LEFT));
         $printer -> cut();
         /* Close printer */
         $printer -> close();
         return response()->json('Cetak Berhasil');
      
    }

    
    
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $order = Order::findOrFail($id);
        $order->total_produk = $request->input('totalproduk');
        $order->piutang = $request->input('grandtotal');
        $order->uang_muka = $request->input('uangmuka');
        $order->total_biaya_setting = request('totbiayasetting');
        $order->grand_total = $request->input('grandtotal');

        $order->update();
        Session::flash('success', 'data Telah di Update' );
        return redirect()->route('orders.index');

    }


    public function updateBayar(Request $request, $id)
    {
        //dd($request->all());
        $order = Order::findOrFail($id);
        $order->total_produk = $request->input('totalproduk');
        $order->piutang = $request->input('piutang');
        $order->uang_muka = $request->input('uangmuka');
        $order->total_biaya_setting = request('totbiayasetting');
        $order->grand_total = $request->input('grandtotal');

        $order->update();
        Session::flash('success', 'Transaksi Pembayaran Sukses' );
        return redirect()->route('orders.index');
       

    }

    public function updateOrder(Request $request, $id)
    {
        
        //dd($request->all());
        $order = Order::findOrFail($id);
        $order->total_produk = $request->input('totalproduk');
        $order->total_biaya_setting = request('totbiayasetting');
        $order->uang_muka = $request->input('uangmuka');
        $order->piutang = $request->input('piutang');
        
        
        $order->grand_total = request('grandtotal');
        $order->update();
        return response()->json('sukses update order');
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
            ->filterColumn('customer', function($query, $keyword) {
                $query->whereRaw("CONCAT(customer.nama,'-',customer.nama) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('details_url', function($order) {
                return url('admin/orders/datadetail/' . $order->id);
               // return route('orders.detail'). $order->id;
            })
            ->addColumn('action', 'layouts.action')
            ->addColumn('piutang', function($order){
                if($order->piutang == 0)
                {
                    return '<span class="btn btn-xs btn-success"><i class="fa fa-money"></i>lunas</span>';
                }
                return $order->piutang;
            })
            ->rawColumns(['action','piutang'])
            
            ->make(true);
    }

    public function getDetailsData($id)
    {
        $orders = \App\Order::find($id)->orderdetail()->with('product');

        return Datatables::of($orders)->make(true);
    }
      
    public function hapusProduk(Request $request, $id, $idproduk)
    {
        $idstokkeluar = request('id');
        OrderDetail::where('order_id',$id)->where('id',$idproduk)->delete();
        StokKeluar::where('id',$idstokkeluar)->delete();
        // update tambah stok produk karena di edit delete
        $produk = Produk::find(request('produkid'));
        $tambah = ($produk->stok) + request('jumlah');
        $produk->stok = $tambah;
        $produk->update();


        return response()->json(['success' => 'Produk Berhasil Di Delete']);
    }

    public function tambahProduk(Request $request, $idProduk)
    {
       
        $order = Order::find($request->input('orderid'));

        $order->orderdetail()->create([
            'order_id' => $request->input('orderid'),
            'product_id' => $request->input('product_id'),
            'panjang' => request('panjang'),
            'lebar' => request('lebar'),
            'luas' => request('luas'),       
            'harga' => $request->input('harga'),            
            'jumlah' => $request->input('jumlah'),
            'sub_total' => $request->input('sub_total'),
            'biaya_setting' => $request->input('biaya_setting'),
            'keterangan' => $request->input('keterangan'),
            'keuntungan' => request('keuntungan'),
            'discount' => request('disc'),
            
        ]);

        StokKeluar::create([
            'order_id' => $request->input('orderid'),
            'produk_id' => request('product_id'),
            'jumlah' => request('luas')
        ]);

        $produk = Produk::findOrFail(request('product_id'));
        $kurang = ($produk->stok) - request('luas');
        $produk->stok = $kurang;
        $produk->update();

        
        
        return response()->json(['success'=>'Order Produk Telah di Tambahkan',$order->orderdetail()->get()->last()]);
    }

    public function destroy($id)
    {
        Order::destroy($id);



        return response()->json(['success'=>'Sukses Delete']);
    }



}
