@extends('layouts.report')

@section('content')


    <div class="panel">
      <div class="panel-heading">
       <h3>

         Report Transaksi Dari Tanggal {{ $data['from_date'] }} sampai tanggal {{ $data['to_date'] }}
       </h3>
       <br>
       <br>


       
      <div style="clear:both"></div>

    </br>

    <div class="panel-body">
      <table class="table table-condensed" id="tborder">
            <thead>
            <tr>
              <th>NO TRANSAKSI</th>
              <th>NAMA PRODUK</th>
              <th>STOK KELUAR</th>
              @hasrole('admin')
              <th>KEUNTUNGAN</th>
              @endhasrole
              
            </tr>
            </thead>
            <tbody id="orderFilter">
              @foreach( $stok as $s)
              <tr>
                <td>{{$s->order->no_order}}</td>
                <td>{{$s->product->nama}}</td>
                <td class="tdout">{{$s->luas}}</td>
                @hasrole('admin')
                <td class="tduntung">{{ number_format($s->keuntungan) }}</td>
                @endhasrole
                
              </tr>
              @endforeach
              <td colspan="2" class="text-center">Total Pemasukan</td>
              <td class="out">{{ $data['out'] }}</td>
              <td class="total">{{ $data['total'] }}</td>
            </tbody>
          </table>
     
    </div>
  </div>
</div>


@stop




