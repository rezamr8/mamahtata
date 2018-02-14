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
          <th>CUSTOMER</th>
          <th>NO ORDER</th>
         
          <th>SUB TOTAL</th>
          <th>PIUTANG</th>
          <th>KEUNTUNGAN</th>
          <th>TANGGAL</th>
        </tr>
        </thead>
        <tbody id="orderFilter">

          @foreach ($order as $o)
          <tr>
            <td>{{$o->customer->nama}}</td>
              <td>{{$o->no_order}}</td>              
              <td class="tdtotal">{{ number_format($o->grand_total) }}</td>
              <td class="tdpiutang">{{ number_format($o->piutang) }}</td>
              <td class="tduntung">{{ number_format($o->orderdetail->sum('keuntungan')) }}</td>
              <td>{{ $o->created_at->format('Y-m-d') }}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="6"></td>
          </tr>
          <tr>
            <td colspan="2" class="text-center">TOTAL PEMASUKAN</td>

            <td class="total">{{ $data['total'] }}</td>
            <td class="piutang">{{ $data['piutang'] }}</td>
            <td class="untung">{{ $data['untung'] }}</td>
            <td></td>

          </tr>

        </tbody>
      </table>
     
    </div>
  </div>
</div>


@stop

@section('footer')
<script type="text/javascript">

  $(document).ready(function(){
    function hitung()
    {
      var total = 0;
      var piutang = 0;
      var rupiah = {
             aSep: '.', 
             aDec: ',',
             mDec: '0', 
             aSign: 'Rp '
            };
      $('.tdtotal,.total,.tdpiutang,.piutang').autoNumeric('init',rupiah);
      $('#tborder tbody .tdtotal').each(function() {
        total += parseInt($(this).text().replace(/[^0-9]/g, ''));
      })
    
      
      $('.total').html(total+'<input type="hidden" name="total" id="total" value="'+total+'">');
      $('.total').autoNumeric('set',total);

      $('#tborder tbody .tdpiutang').each(function() {
        piutang += parseInt($(this).text().replace(/[^0-9]/g, ''));
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

   




  })

</script>

@stop
