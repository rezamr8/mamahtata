@extends('layouts.app')

@section('content')

<div class="container">

	@include('admin.sidebar')
	<form action="{{ route('report.pdfstok') }}" method="POST">
    {{ csrf_field() }}
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">Report Stok</div>
			<div class="panel-body">
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

				<table class="table table-condensed" id="tborder">
						<thead>
						<tr>
							<th>NO TRANSAKSI</th>
							<th>NAMA PRODUK</th>
							<th>STOK KELUAR</th>
							<th>KEUNTUNGAN</th>
							
						</tr>
						</thead>
						<tbody id="orderFilter">
							@foreach( $stok as $s)
							<tr>
								<td>{{$s->order->no_order}}</td>
								<td>{{$s->product->nama}}</td>
								<td class="tdout">{{$s->luas}}</td>
								<td class="tduntung">{{ $s->keuntungan }}</td>
								
							</tr>
							@endforeach
							<td colspan="2" class="text-center">Total Pemasukan</td>
							<td class="out"></td>
							<td class="total"></td>
						</tbody>
					</table>
			</div>
		</div>

	</div>
	</form>



@section('footer')
<script type="text/javascript">
	$(document).ready(function(){
		$.datepicker.setDefaults({
	      dateFormat:'yy-mm-dd'
	    });
    
     $('#from_date').datepicker();
     $('#to_date').datepicker();
  
  function hitung()
    {
      var total = 0;
      var tdout = 0;
      var rupiah = {
             aSep: '.', 
             aDec: ',',
             mDec: '0', 
             aSign: 'Rp '
            };
      $('.tduntung,.total').autoNumeric('init',rupiah);
      $('#tborder tbody .tduntung').each(function() {
        total += parseInt($(this).text().replace(/[^0-9]/g, ''));
      })
      $('.total').html(total+'<input type="hidden" name="total" id="total" value="'+total+'">');
       $('.total').autoNumeric('set',total);
      var trupiah = $('.total').text();
      $('.total').append('<input type="hidden" name="total" id="total" value="'+trupiah+'">');

       $('#tborder tbody .tdout').each(function() {
        tdout += parseInt($(this).text());
      })
      $('.out').html(tdout);

      
    }

    hitung();
    
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
         url:"{{ route('report.poststok') }}",
         method:"POST",
         data:{from_date:from_date,to_date:to_date},
         success:function(data)
         {
           console.log( data);
           //$('#orderFilter').empty().html(data);
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
@stop