@extends('layouts.app') 
@section('content')

<div class="container">
  @include('admin.sidebar')
  <form action="{{ route('report.pdf') }}" method="POST">
    {{ csrf_field() }}
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="col-md-3">
           Report Transaksi
         </div>
         
         <div class="col-md-3">
          <input type="text" name="from_date" id="from_date" class="form-control">
        </div>
        <div class="col-md-3">
          <input type="text" name="to_date" id="to_date" class="form-control">
        </div>
        <div class="col-md-3">
          <input type="button" value="FILTER" name="filter" id="filter" class="btn  btn-primary">

          <button class="btn btn-warning" id="exportPDF" name="exportPDF">PDF</button>
          
          
        </div>
        
        <div style="clear:both"></div>

      </br>

      <div class="panel-body">
        <table class="table table-condensed" id="tborder">
          <tr>
            <th>Customer</th>
            <th>No Transaksi</th>
            <th>Uang Muka</th>
            <th>Jasa</th>
            <th>Total Pembayaran</th>
            <th>Sisa Piutang</th>
            <th>Tanggal</th>
          </tr>
          <tbody id="orderFilter">
            
            @foreach ($order as $o)
            <tr>
              <td>{{$o->customer->nama}}</td>
              <td>{{$o->no_order}}</td>
              <td>{{$o->uang_muka}}</td>
              <td>{{$o->total_biaya_setting}}</td>
              <td class="tdtotal">{{$o->total_produk}}</td>
              <td class="tdpiutang">{{$o->grand_total}}</td>
              <td>{{ $o->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
            <tr>
              <td colspan="6"></td>
            </tr>
            <tr>
              <td colspan="3" class="text-center">Total Pemasukan</td>
              <td></td>
              <td class="total"></td>
              <td class="piutang"></td>
            </tr>
            
          </tbody>
        </table>
        <div class="pull-right">
          {{ $order->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
</form>
</div>


@stop


@section('footer')
<script type="text/javascript">
  $(document).ready(function(){
    function hitung()
    {
      var total = 0;
      var piutang = 0;
      $('#tborder tbody .tdtotal').each(function() {
        total += parseInt($(this).text());
      })
      $('.total').html(total+'<input type="hidden" name="total" id="total" value="'+total+'">');

      $('#tborder tbody .tdpiutang').each(function() {
        piutang += parseInt($(this).text());
      })
      $('.piutang').html(piutang+'<input type="hidden" name="piutang" id="piutang" value="'+piutang+'">');
    }

    hitung();
    /// datepicker
    $.datepicker.setDefaults({
      dateFormat:'yy-mm-dd'
    })
    $(function(){
     $('#from_date').datepicker();
     $('#to_date').datepicker();
   });
    
    $('#filter').click(function(){
     console.log('click filter');
     var from_date = $('#from_date').val();
     var to_date = $('#to_date').val();

     if( from_date != '' && to_date != ''){

       $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
     });

       $.ajax({
         url:"{{ route('report.tanggal') }}",
         method:"POST",
         data:{from_date:from_date,to_date:to_date},
         success:function(data)
         {
           console.log(data);
           $('#orderFilter').empty().html(data);
           hitung();
         }
       });

       

     }else{
       alert('isi dahulu tanggal nya');
     }
   });

   // $('#exportPDF').click(function(){
   //   console.log('click pdf');
   //   var from_date = $('#from_date').val();
   //   var to_date = $('#to_date').val();

   //   if( from_date != '' && to_date != ''){

   //     $.ajaxSetup({
   //      headers: {
   //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   //     }
   //   });

   //     $.ajax({
   //       url:"{{ route('report.pdf') }}",
   //       method:"POST",
   //       data:{from_date:from_date,to_date:to_date},
   //       success:function(data)
   //       {
   //         console.log(data);
   //         // $('#orderFilter').empty().html(data);
   //         // hitung();
   //       }
   //     });



   //   }else{
   //     alert('isi dahulu tanggal nya');
   //   }
   // })



 })

</script>

@stop
