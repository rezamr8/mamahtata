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
          <thead>
          <tr>
            <th>CUSTOMER</th>
            <th>NO ORDER</th>
            <th>UANG MUKA</th>
            <th>JASA</th>
            <th>SUB TOTAL</th>
            <th>PIUTANG</th>
            @hasrole('admin')
            <th>KEUNTUNGAN</th>
            @endhasrole
            <th>TANGGAL</th>
          </tr>
          </thead>
          <tbody id="orderFilter">
            
            @foreach ($order as $o)
            <tr>
              <td>{{$o->customer->nama}}</td>
              <td>{{$o->no_order}}</td>
              <td class="tduangmuka">{{ $o->uang_muka }}</td>
              <td class="tdbiayasetting">{{ $o->total_biaya_setting }}</td>
              <td class="tdtotal">{{ $o->grand_total }}</td>
              <td class="tdpiutang">{{ $o->piutang }}</td>
              @hasrole('admin')
              <td class="tduntung">{{ $o->orderdetail->sum('keuntungan') }}</td>
              @endhasrole
              <td>{{ $o->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
            <tr>
              <td colspan="8"></td>
            </tr>
            <tr>
              <td colspan="2" class="text-center">Total Pemasukan</td>
              <td class="totaluangmuka"></td>
              <td class="biayasetting"></td>
              <td class="total"></td>
              <td class="piutang"></td>
              @hasrole('admin')
              <td class="untung"></td>
              @endhasrole
              <td></td>
            </tr>
            
          </tbody>
        </table>
        note : subtotal ( barang tambah jasa biaya setting)
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
      var untung = 0;
      var totaluangmuka =0;
      var biayasetting=0;
      var rupiah = {
             aSep: '.', 
             aDec: ',',
             mDec: '0', 
             aSign: 'Rp '
            };
      $('.tdtotal,.total,.tdpiutang,.piutang,.tduntung,.untung,.tduangmuka,.totaluangmuka,.biayasetting').autoNumeric('init',rupiah);
      /* RUMUS PERHITUNGAN TOTAL*/
      $('#tborder tbody .tdtotal').each(function() {
        total += parseInt($(this).text().replace(/[^0-9]/g, ''));
      })
      $('.total').html(total+'<input type="hidden" name="total" id="total" value="'+total+'">');
      $('.total').autoNumeric('set',total);
      var trupiah = $('.total').text();
      $('.total').append('<input type="hidden" name="total" id="total" value="'+trupiah+'">');
      /* END RUMUS PERHITUNGAN TOTAL*/

      /* RUMUS PERHITUNGAN TOTAL UANG MUKA*/
       $('#tborder tbody .tduangmuka').each(function() {
        totaluangmuka += parseInt($(this).text().replace(/[^0-9]/g, ''));
      })
       $('.totaluangmuka').html(totaluangmuka+'<input type="hidden" name="totaluangmuka" id="totaluangmuka" value="'+totaluangmuka+'">');
      $('.totaluangmuka').autoNumeric('set',totaluangmuka);
      var trupiah = $('.totaluangmuka').text();
      $('.totaluangmuka').append('<input type="hidden" name="totaluangmuka" id="totaluangmuka" value="'+trupiah+'">');
       /* END RUMUS PERHITUNGAN TOTAL UANG MUKA*/

       /* RUMUS PERHITUNGAN TOTAL BIAYA SETTING*/
       $('#tborder tbody .tdbiayasetting').each(function() {
        biayasetting += parseInt($(this).text().replace(/[^0-9]/g, ''));
      })
       $('.biayasetting').html(biayasetting+'<input type="hidden" name="biayasetting" id="biayasetting" value="'+biayasetting+'">');
      $('.biayasetting').autoNumeric('set',biayasetting);
      var trupiah = $('.biayasetting').text();
      $('.biayasetting').append('<input type="hidden" name="biayasetting" id="biayasetting" value="'+trupiah+'">');
       /* END RUMUS PERHITUNGAN TOTAL BIAYA SETTING*/

        /* RUMUS PERHITUNGAN TOTAL PIUTANG*/
      $('#tborder tbody .tdpiutang').each(function() {
        piutang += parseInt($(this).text().replace(/[^0-9]/g, ''));
        if (piutang > 0 ) $(this).parent().css({"background-color": "yellow"});
      });
      $('.piutang').html(piutang+'<input type="hidden" name="piutang" id="piutang" value="'+piutang+'">');
      $('.piutang').autoNumeric('set',piutang);
      var trupiah = $('.piutang').text();
      $('.piutang').append('<input type="hidden" name="piutang" id="piutang" value="'+trupiah+'">');
       /* END RUMUS PERHITUNGAN TOTAL PIUTANG*/

        /* RUMUS PERHITUNGAN TOTAL UNTUNG*/
       $('#tborder tbody .tduntung').each(function() {
        untung += parseInt($(this).text().replace(/[^0-9]/g, ''));
      })
       $('.untung').html(untung+'<input type="hidden" name="untung" id="untung" value="'+untung+'">');
      $('.untung').autoNumeric('set',untung);
      var trupiah = $('.untung').text();
      $('.untung').append('<input type="hidden" name="untung" id="untung" value="'+trupiah+'">');

       /* END RUMUS PERHITUNGAN TOTAL UNTUNG*/

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

   



 })

</script>

@stop
