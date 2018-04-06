<?php

namespace App\Http\Controllers;

use App\Report;
use App\Order;
use App\OrderDetail;
use App\Customer;
use App\StokKeluar;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{

     public function __construct() {
        $this->middleware(['auth','clearance']);
   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $order = Order::with('customer')->orderBy('created_at','desc')->whereDay('created_at', '=', date('d'))->whereMonth('created_at','=', date('m'))->whereYear('created_at', '=', date('Y'))->paginate($perPage);
        return view('admin.report.index',compact('order'));
    }

    public function getTanggal(Request $request)
    {
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        $order = Order::whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->orderBy('created_at','desc')->get();

        return view('admin.report.datafilter',compact('order'));
    } 
    public function postStok(Request $request)
    {
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        $stok = OrderDetail::whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->orderBy('created_at','desc')->get();

        return view('admin.report.filterstok',compact('stok'));
    }

    public function getPdf(Request $request)
    {
        
        $data=[
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'total' => $request->get('total'),
            'piutang' => $request->get('piutang'),
            'untung' => $request->get('untung')
        ];
        $from_date = request('from_date');
        $to_date = request('to_date');

        $order = Order::whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->orderBy('created_at','desc')->get();

         $pdf = PDF::loadView('admin.report.report-pdf',compact('order','data'));
        
        return $pdf->download('report.pdf');
    }
    public function pdfStok(Request $request)
    {
        
        $data=[
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'total' => $request->get('total'),
            'out' => $request->get('out')
           
        ];
        $from_date = request('from_date');
        $to_date = request('to_date');

        $stok = OrderDetail::whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->orderBy('created_at','desc')->get();

         $pdf = PDF::loadView('admin.report.report-stok',compact('stok','data'));
        
        return $pdf->download('report-stok.pdf');
    }

    public function stok()
    {
        $perPage = 25;
        $stok = OrderDetail::with('product')->orderBy('created_at','desc')->whereDay('created_at', '=', date('d'))->whereMonth('created_at','=', date('m'))->whereYear('created_at', '=', date('Y'))->paginate($perPage);

        return view('admin.report.stok',compact('stok'));
    }

   
}
