@extends('layouts.app')
@section('content')
{{-- Customer Order --}}

<div class="container">
	@include('admin.sidebar')
	<div class="col-md-9">
		<form method="POST" action="{{ url('admin/orders/updatebayar/'.$orders->id) }}" >
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<input type="hidden" name="orderid" id="orderid" value="{{$orders->id}}">
			<div class="panel panel-default">
				<div class="panel-heading">Customer No transaksi <strong>{{ $orders->no_order }}</strong></div>
				<div class="panel-body">		
					<div class="form-group row">
						<label for="customer" class="col-md-2 col-form-label col-form-label-md font-weight-bold">CUSTOMER</label>
						<div class="col-md-8">
							
					
					<label for="customernama">{{$orders->customer->nama}}</label> 
				</div>	    
			</div>
			<div class="form-group row">
				<label for="nohp" class="col-md-2 col-form-label col-form-label-md font-weight-bold" >HANDPHONE</label>
				<div class="col-md-8">
					<input type="text" class="form-control form-control-md" id="nohp" name="" readonly="readonly" value="{{$orders->customer->no_hp}}">	  
				</div>  
			</div>
		</div>
	</div>
	
	{{-- tambah Table Produk --}}
	<div class="form-group">
		<div class="panel panel-default">
			<div class="panel-heading">Order Product</div>
			<div class="panel-body">



				<table class="table table-striped table-bordered table-light" id="tbproduk">
					<thead>
						<tr align="center">
							
							<th align="center">Nama</th>
							<th align="center">Panjang</th>
							<th align="center">Lebar</th>
							<th align="center">Luas</th>
							<th align="center">Harga</th>
							<th>Disc</th>
							<th align="center">Jasa</th>
							<th align="center">Jumlah</th>
							<th align="center">Total</th>
							<th align="center">keterangan</th>
							
						</tr>
					</thead>
					<tbody>
						@if(count($orders->orderdetail)>0)
						@foreach($orders->orderdetail as $order)
						<tr>
							
							<td><input type="hidden" id="orderDetailId" value="{{$order->id}}"><input type="hidden" name="produkid[]" value="{{$order->product->id}}"><input type="hidden" name="tdnamaproduk[]" value="{{$order->product->nama}}">{{$order->product->nama}}</td>
							<td><input type="hidden" name="tdpanjang[]" readonly value="{{$order->panjang}}">{{$order->panjang}} meter</td>
							<td><input type="hidden" name="tdlebar[]" readonly value="{{$order->lebar}}">{{$order->lebar}} meter</td>
							<td><input type="hidden" name="tdluas[]" readonly value="{{$order->luas}}">{{$order->luas}} meter</td>
							<td><input type="hidden" name="tdharga[]" readonly value="{{$order->harga}}">{{$order->harga}}</td>
							<td>{{ $order->discount}}</td>
							<td><input type="hidden" name="tdbiayasetting[]" readonly value="{{$order->biaya_setting}}">{{$order->biaya_setting}}</td>
							<td><input type="hidden" name="tdjumlah[]" value="{{$order->jumlah}}">{{$order->jumlah}}</td>
							<td class="tdtotal"><input type="hidden" name="tdtotharga[]" value="{{$order->sub_total}}">{{$order->sub_total}}</td>
							<td><input type="hidden" name="tdketerangan[]" value="{{$order->keterangan}}">{{$order->keterangan}}</td>
							
						</tr>
						@endforeach
						@else
						<td colspan="6">tidak ada data produk</td>
						@endif
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

	{{-- Order Detail --}}

	<input type="hidden" name="totalproduk" value="{{$orders->total_produk}}">
	<input type="hidden" name="totbiayasetting" value="{{$orders->total_biaya_setting}}">


	<div class="form-group row">
		<label for="grandtotal" class="col-md-2 col-form-label col-form-label-md font-weight-bold">SUB TOTAL</label>
		<div class="col-md-8">
			<input type="text" class="form-control form-control-md" id="fgrandtotal" value="{{ ($orders->total_produk) + ($orders->total_biaya_setting) }}" required readonly>
			<input type="hidden" class="form-control form-control-md" name="grandtotal" id="grandtotal" value="{{ ($orders->total_produk) + ($orders->total_biaya_setting) }}">
		</div>	    
	</div>
	<div class="form-group row">
		<label for="uangmuka" class="col-md-2 col-form-label col-form-label-md font-weight-bold">UANG MUKA / BAYAR</label>
		<div class="col-md-8">
			<input type="text" class="form-control form-control-md" id="fuangmuka" value="{{$orders->uang_muka}}" required>
			<input type="hidden" class="form-control form-control-md" id="uangmuka" name="uangmuka" value="{{$orders->uang_muka}}" required readonly>
		</div>	    
	</div>

	<div class="form-group row">
		<label for="piutang" class="col-md-2 col-form-label col-form-label-md font-weight-bold">PIUTANG</label>
		<div class="col-md-8">
			<input type="text" class="form-control form-control-md" id="fpiutang" name="fpiutang" value="{{$orders->piutang}}" required readonly>
			<input type="hidden" class="form-control form-control-md" id="piutang" name="piutang" required value="{{$orders->piutang}}" required readonly>
		</div>	    
	</div>
	{{-- <div class="form-group row">
		<label for="bayar" class="col-md-2 col-form-label col-form-label-md font-weight-bold">BAYAR</label>
		<div class="col-md-8">
			<input type="text" class="form-control form-control-md" id="fbayar" required>
			<input type="hidden" class="form-control form-control-md" id="piutang" name="piutang" required value="{{$orders->piutang}}" required readonly>
		</div>	    
	</div> --}}

	<div class="form-group">
		<button class="btn btn-primary" type="submit">Save</button>
		
		<a href="#" id="cetak" class="btn btn-info"><i class="fa fa-print"></i>Cetak</a>
	</div>

</form>
@endsection
</div>
</div>

@section('footer')

<script type="text/javascript">

	$(function(){

		var rupiah = {
             aSep: '.', 
             aDec: ',', 
             aSign: 'Rp ',
             mDec:'0'
            };
        $('#fgrandtotal,#fuangmuka,#fpiutang').autoNumeric('init', rupiah);
        
        $('#fgrandtotal').bind('blur focusout keypress keyup', function () {
	        var a = $('#fgrandtotal').autoNumeric('get');
	        $('#grandtotal').val(a);
	        
	    });

	    $('#fuangmuka').bind('blur focusout keypress keyup', function () {
	        var a = $('#fuangmuka').autoNumeric('get');
	        var total = $('#grandtotal').val();
			var uangmuka = $('#uangmuka').val();
			var sum = total - uangmuka;

	        $('#uangmuka').val(a);
	        $('#fpiutang').autoNumeric('set',sum);

			$('#piutang').val(sum);
	        
	    });

	    $('#fpiutang').bind('blur focusout keypress keyup', function () {
	        var a = $('#fpiutang').autoNumeric('get');
	        $('#piutang').val(a);
	        
	    });

		// $('#cetak').click(function(e){
		// 	e.preventDefault();
		// 	$.get("{{ url('admin/orders/printbayar/'.$orders->id) }}", function(data){
		// 		console.log(data);
		// 	});
		// });

		$('#cetak').click(function(e){
			e.preventDefault();

			$.post("{{ url('admin/orders/printbayar/'.$orders->id) }}",{
				'_token': $('meta[name=csrf-token]').attr('content'),
				fpiutang:$('#fpiutang').val(),
				piutang:$('#piutang').val()
			}, function(data){
				console.log(data);
			});
		});

		$('#uangmuka').keyup(function(){

			var total = $('#grandtotal').val();
			var uangmuka = $('#uangmuka').val();
			var sum = total - uangmuka;
			
			$('#piutang').val(sum);
			
		});
	
	});

</script>



@endsection