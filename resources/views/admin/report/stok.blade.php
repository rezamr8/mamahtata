@extends('layouts.app')

@section('content')

<div class="container">

	@include('admin.sidebar')
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
				</div>
				<div style="clear:both"></div>

      			</br>

				<table class="table table-condensed">
						<tr>
							<th>NO TRANSAKSI</th>
							<th>NAMA PRODUK</th>
							<th>STOK KELUAR</th>
							
						</tr>
						<tbody id="orderfilter">
							@foreach( $stok as $s)
							<tr>
								<td>{{$s->order->no_order}}</td>
								<td>{{$s->product->nama}}</td>
								<td>{{$s->luas}}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
			</div>
		</div>

	</div>

@section('footer')
<script type="text/javascript">
	$(document).ready(function(){
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
@stop