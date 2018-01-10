

<div class="container">

  <div class="col-md-9">
    <div class="panel">
      <div class="panel-heading">
        <div class="col-md-3">
         Report Transaksi
       </div>

       
      <div style="clear:both"></div>

    </br>

    <div class="panel-body">
      <table class="table table-condensed" id="tborder">
        <tr>
          <th>Customer</th>
          <th>No Transaksi</th>
          <th>Uang Muka</th>
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
            <td class="tdtotal">{{$o->total}}</td>
            <td class="tdpiutang">{{$o->grand_total}}</td>
            <td>{{ $o->created_at->format('Y-m-d') }}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="6"></td>
          </tr>
          <tr>
            <td colspan="3" class="text-center">Total Pemasukan</td>

            <td class="total"></td>
            <td class="piutang"></td>
          </tr>

        </tbody>
      </table>
     
    </div>
  </div>
</div>
</div>
</div>



{{-- @section('footer')
<script type="text/javascript">

  $(document).ready(function(){
    function hitung()
    {
      var total = 0;
      var piutang = 0;
      $('#tborder tbody .tdtotal').each(function() {
        total += parseInt($(this).text());
      })
      $('.total').html(total);

      $('#tborder tbody .tdpiutang').each(function() {
        piutang += parseInt($(this).text());
      })
      $('.piutang').html(piutang);
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

    $('#exportPDF').click(function(){
     console.log('click pdf');
     var from_date = $('#from_date').val();
     var to_date = $('#to_date').val();

     if( from_date != '' && to_date != ''){

       $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
     });

       $.ajax({
         url:"{{ route('report.pdf') }}",
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
   })


  })

</script>

@stop
 --}}