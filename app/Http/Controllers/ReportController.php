<?php

namespace App\Http\Controllers;

use App\Report;
use App\Order;
use App\Customer;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $order = Order::with('customer')->orderBy('created_at','desc')->paginate($perPage);
        return view('admin.report.index',compact('order'));
    }

    public function getTanggal(Request $request)
    {
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        $order = Order::whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->get();

        return view('admin.report.datafilter',compact('order'));
    }

    public function getPdf(Request $request)
    {
        
        $data=[
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'total' => $request->get('total'),
            'piutang' => $request->get('piutang')
        ];
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        $order = Order::whereBetween('created_at',[$from_date." 00:00:00",$to_date." 23:59:59"])->get();

         $pdf = PDF::loadView('admin.report.report-pdf',compact('order','data'));
        
        return $pdf->download('invoice.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
