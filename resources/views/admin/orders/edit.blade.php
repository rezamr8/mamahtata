@extends('layouts.app')
@section('content')
{{-- Customer Order --}}

<div class="container">
	@include('admin.sidebar')
	<div class="col-md-9">
		<form method="POST" action="{{ url('admin/orders/update/'.$orders->id) }}" >
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<input type="hidden" name="orderid" id="orderid" value="{{$orders->id}}">
			<div class="panel panel-default">
				<div class="panel-heading">CUSTOMER NO ORDER <strong>{{ $orders->no_order }} </strong></div>
				<div class="panel-body">		
					<div class="form-group row">
						<label for="customer" class="col-md-2 col-form-label col-form-label-md font-weight-bold">CUSTOMER</label>
						<div class="col-md-8">
							
					
					<label for="customernama">{{ $orders->customer->nama }}</label> 
					
					
				</div>	    
			</div>
			<div class="form-group row">
				<label for="nohp" class="col-md-2 col-form-label col-form-label-md font-weight-bold" >HANDPHONE</label>
				<div class="col-md-8">
					<input type="text" class="form-control form-control-md" id="nohp" name="nohp" readonly="readonly" value="{{$orders->customer->no_hp}}">	  
				</div>  
			</div>
		</div>
	</div>
	
	{{-- tambah Table Produk --}}
	<div class="form-group">
		<div class="panel panel-default">
			<div class="panel-heading">ORDER PRODUK</div>
			<div class="panel-body">

				<div class="form-group row">
					<label for="namabarang" class="col-md-2 col-form-label">PRODUK</label>
					<div class="col-md-8">
						<select name="namaproduk" id="namaproduk">
							<option value="0">PILIH PRODUK</option>
							@foreach($products as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="harga" class="col-md-2 col-form-label col-form-label-md font-weight-bold">HARGA</label>
					<div class="col-md-8">
						<input type="text" class="form-control form-control-md" id="fharga" readonly>
						<input type="hidden" class="form-control form-control-md" id="harga" name="harga" readonly>
						<input type="hidden" class="form-control form-control-md" id="hargabeli" name="hargabeli" readonly>
					</div>	    
				</div>

				<div class="form-group controls row">
					<label for="panjang" class="col-md-2 font-weight-bold">PANJANG</label>
					<div class="col-md-3">
						<input type="number" class="form-control form-control-md" id="panjang"  name="panjang" >
					</div>
					<label for="lebar" class="col-md-1 font-weight-bold">LEBAR</label>
					<div class="col-md-4">
						<input type="number" class="form-control form-control-md" id="lebar" name="lebar" >
					</div>
				</div>	

				<div class="form-group row">
					<label for="luas" class="col-md-2 font-weight-bold">LUAS</label>
					<div class="col-md-3">
						<input type="text" class="form-control form-control-md" id="luas" name="luas" required readonly>
					</div>
					<label for="hargasatuan" class="col-md-1 font-weight-bold">HARGA TOTAL</label>
					<div class="col-md-2">
						<input type="text" class="form-control form-control-md" id="fhargasatuan" required readonly>
						<input type="hidden" class="form-control form-control-md" id="hargasatuan" name="hargasatuan" required readonly>
						<input type="hidden" class="form-control form-control-md" id="thbeli" name="thbeli" required readonly>
					</div>
				</div>

				<div class="form-group controls row">					
					<label for="disc" class="col-md-2 col-form-label col-form-label-md font-weight-bold">DISCOUNT</label>	    
					<div class="col-md-2">
						<input type="text" class="form-control form-control-md" id="fdisc">
						<input type="hidden" class="form-control form-control-md" id="disc" name="disc" >
					</div>
					<label for="jumlah" class="col-md-1 col-form-label col-form-label-md font-weight-bold">JUMLAH</label>
					<div class="col-md-2">
						<input type="text" class="form-control form-control-md" id="jumlah" name="jumlah" >
					</div>	
				</div>

				

				<div class="form-group row">
					<label for="totharga" class="col-md-2 col-form-label col-form-label-md font-weight-bold">TOTAL PRODUK</label>
					<div class="col-md-8">
						<input type="text" class="form-control form-control-md" id="ftotharga" required readonly="readonly">
						<input type="hidden" class="form-control form-control-md" id="totharga" required readonly="readonly" name="totharga">
						<input type="hidden" class="form-control form-control-md" id="tothargabeli" required readonly="readonly" name="tothargabeli">
						<input type="hidden" class="form-control form-control-md" id="keuntungan" required readonly="readonly" name="keuntungan">
					</div>	    
				</div>

				<div class="form-group row">
					<label for="biayasetting" class="col-md-2 col-form-label col-form-label-md font-weight-bold">SETTING</label>
					<div class="col-md-8">
						<input type="text" class="form-control form-control-md" id="fbiayasetting">
						<input type="hidden" class="form-control form-control-md" id="biayasetting" name="biayasetting" >
					</div>	    
				</div>

				<div class="form-group row">
					<label for="keterangan" class="col-md-2 col-form-label col-form-label-md font-weight-bold">KETERANGAN</label>
					<div class="col-md-8">
						<input type="text" class="form-control form-control-md" id="keterangan" name="keterangan">
					</div>	    
				</div>

				<table class="table table-striped table-bordered table-light" id="tbproduk">
					<thead>
						<tr align="center">
							
							<th align="center">NAMA</th>
							<th align="center">PANJANG</th>
							<th align="center">LEBAR</th>
							<th align="center">LUAS</th>
							<th align="center">HARGA</th>
							<th align="center">JUMLAH</th>
							<th align="center">SETTING</th>
							<th align="center">TOTAL</th>
							<th align="center">KETERANGAN</th>
							<th align="center"><a href="#" class="btn btn-primary" id="btnTambah">ADD</a></th>
						</tr>
					</thead>
					<tbody>
						@if(count($orders->orderdetail)>0)
						@foreach($orders->orderdetail as $order)
						<tr>
							{{-- <td>{{$order->stokkeluar->id}}</td> --}}
							<td><input type="hidden" id="orderDetailId" value="{{$order->id}}"><input type="hidden" name="produkid[]" value="{{$order->product->id}}" id="tdprodukid"><input type="hidden" name="tdnamaproduk[]" value="{{$order->product->nama}}">{{$order->product->nama}}</td>
							<td><input type="hidden" name="tdpanjang[]" readonly value="{{$order->panjang}}">{{$order->panjang}}</td>
							<td><input type="hidden" name="tdlebar[]" readonly value="{{$order->lebar}}">{{$order->lebar}}</td>
							<td><input type="hidden" name="tdluas[]" readonly value="{{$order->luas}}" id="tdluas">{{$order->luas}}</td>
							<td><input type="hidden" name="tdharga[]" readonly value="{{$order->harga}}">{{$order->harga}}</td>
							<td><input type="hidden" name="tdjumlah[]" value="{{$order->jumlah}}" id="tdjumlah">{{$order->jumlah}}</td>
							<td class="tdbiayasetting"><input type="hidden" name="tdbiayasetting[]" value="{{ $order->biaya_setting}}" id="tdbiayasetting">{{ $order->biaya_setting }}</td>
							<td class="tdtotal"><input type="hidden" name="tdtotharga[]" value="{{$order->sub_total}}">{{$order->sub_total}}</td>
							<td><input type="hidden" name="tdketerangan[]" value="{{$order->keterangan}}">{{$order->keterangan}}</td>
							<td>
								

								<a href="javascript:void(0)" class="btn btn-danger btn-xs" id="delrow" data-id="{{ $order->id }}" data-token="{{ csrf_token() }}" >DELETE</a>
								


							</td>
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


	<div class="form-group row">
		<label for="total" class="col-md-2 col-form-label col-form-label-md font-weight-bold">TOTAL</label>
		<div class="col-md-8">
			<input type="text" class="form-control form-control-md" id="ftotalproduk" required readonly value="{{ $orders->total_produk}}">
			<input type="hidden" class="form-control form-control-md" id="totalproduk" name="totalproduk" required value="{{ $orders->total_produk}}">
		</div>	    
	</div>
	<div class="form-group row">
		<label for="totbiayasetting" class="col-md-2 col-form-label col-form-label-md font-weight-bold">JASA</label>
		<div class="col-md-8">
			<input type="text" class="form-control form-control-md" id="ftotbiayasetting" readonly value="{{$orders->total_biaya_setting}}">
			<input type="hidden" class="form-control form-control-md" id="totbiayasetting" name="totbiayasetting" value="{{$orders->total_biaya_setting}}">
		</div>	    
	</div>
	<div class="form-group row">
		<label for="uangmuka" class="col-md-2 col-form-label col-form-label-md font-weight-bold">UANG MUKA</label>
		<div class="col-md-8">
			<input type="text" class="form-control form-control-md" id="fuangmuka" value="{{$orders->uang_muka}}"  readonly>
			<input type="hidden" class="form-control form-control-md" id="uangmuka" name="uangmuka" value="{{$orders->uang_muka}}"  readonly>
		</div>	    
	</div>



	<div class="form-group row">
		<label for="grandtotal" class="col-md-2 col-form-label col-form-label-md font-weight-bold">GRANDTOTAL</label>
		<div class="col-md-8">
			<input type="text" class="form-control form-control-md" id="fgrandtotal" required readonly value="{{$orders->grand_total}}">
			<input type="hidden" class="form-control form-control-md" id="grandtotal" name="grandtotal" required value="{{$orders->grand_total}}">
		</div>	    
	</div>

	<div class="form-group">
		<button class="btn btn-primary" type="submit">Save</button>
	</div>

</form>

</div>
</div>
@endsection

@section('footer')

<script type="text/javascript">

$(function(){

	var rupiah = {
             aSep: '.', 
             aDec: ',', 
             aSign: 'Rp '
            };

	$('#customer').select2();
	$('#namaproduk').select2();

	$('#fdisc').bind('blur focusout',function(){
		$('#jumlah').val('');
		$('#ftotharga').val('');
		$('#totharga').val('');
		$('#tothargabeli').val('');
		$('#keuntungan').val('');
		$('#jumlah').focus();
	});
	function ukurluas()
	{
		var panjang = $('#panjang').val();
		var lebar = $('#lebar').val();
		var luas = 0;
		var hargasatuan = 0;
		var thbeli = 0;

		luas = panjang * lebar;

		if (luas <= 1) {
			luas = 1;
		}
		$('#luas').val(luas);
		
		$('#fhargasatuan').autoNumeric('init', rupiah);
		hargasatuan = $('#harga').val();
		hargasatuan = hargasatuan*luas;
		$('#hargasatuan').val(hargasatuan);
		$('#fhargasatuan').autoNumeric('set',hargasatuan);

		thbeli = $('#hargabeli').val();
		thbeli = thbeli*luas;
		$('#thbeli').val(thbeli);
	}
	
	function keuntungan2(){
		var totharga = $('#totharga').val();
		var tothargabeli = $('#tothargabeli').val();
		var untung = totharga - tothargabeli;

		$('#keuntungan').val(untung);

	}
	$('#panjang').keyup(function(){ ukurluas() });


	$('#lebar').keyup(function(){ ukurluas() });

	

	$('#namaproduk').change(function(){   

		$.ajax({
			type: 'GET',

			url:'{{route("orders.namabarang")}}',
			data: { id: $('#namaproduk').val() }, 

			dataType: 'json',

			success: function(response){ 

				$('#harga').val(response.harga_jual);
				$('#hargabeli').val(response.harga_beli);

				$('#fharga').autoNumeric('init', {aSep: '.',aDec:',',aSign:'Rp '});
	            var harga = $('#harga').val();
	            $('#fharga').autoNumeric('set',harga);
			},
			error: function (xhr, ajaxOptions, thrownError) { 
				alert(thrownError); 
			}
		});

	});

	$('#jumlah').keyup(function(){
		var jumlah = $('#jumlah').val();
		var hargasatuan = $('#hargasatuan').val();
		var thbeli = $('#thbeli').val();
		var disc = $('#disc').val();
		var totharga= (jumlah * hargasatuan) - disc;
		var tothargabeli = (jumlah * thbeli) - disc;
		$('#totharga').val(totharga);
		$('#tothargabeli').val(tothargabeli);
		$('#ftotharga').autoNumeric('init', rupiah);
		$('#ftotharga').autoNumeric('set', totharga);

		keuntungan2();

	});
	
	$('#btnTambah').click(function(e){
		e.preventDefault();
		var orderid = $('#orderid').val();
		var produkid = $('#namaproduk option:selected').val();
		var namaproduk = $('#namaproduk option:selected').text();
		var panjang = $('#panjang').val();
		var lebar = $('#lebar').val();
		var luas = $('#luas').val();
		var harga = $('#harga').val();
		var disc = $('#disc').val();
		var jumlah = $('#jumlah').val();
		var sub_total = $('#totharga').val();
		var biaya_setting = $('#biayasetting').val();
		var keterangan = $('#keterangan').val();

		var hargasatuan = $('#hargasatuan').val();
		var tdtotharga = $('#totharga').val();
		var tothargabeli = $('#tothargabeli').val();		
		var untung = tdtotharga - tothargabeli;

		var fdisc = $('#fdisc').val();
        var fharga = $('#fharga').val();
        var fhargasatuan = $('#fhargasatuan').val();
        var ftotharga = $('#ftotharga').val();
        var fbiayasetting = $('#fbiayasetting').val();
		
		if($.trim(jumlah) == '' || $.trim(biaya_setting) == '')
		{
			alert('Jumlah Dan Biaya Setting harus di isi');

			return false;
		}else{
			
			$('#jumlah').val("");
			$('#harga').val("");
			$('#totharga').val("");
			$('#keterangan').val("");
			$('#grandtotal').val("");
			$('#panjang').val("");      
			$('#lebar').val("");
			$('#luas').val("");
			$('#hargasatuan').val("");
			$('#biayasetting').val("");
			$('#disc').val("");
			$('#hargabeli').val("");
			$('#thbeli').val("");
			$('#tothargabeli').val("");
			$('#keuntungan').val("");

			$('#fdisc').val("");
	        $('#fharga').val("");
	        $('#fhargasatuan').val("");
	        $('#ftotharga').val("");
	        $('#fbiayasetting').val("");

			setInterval(function() {
				var total = 0;
				var totalsetting = 0;

				$('#tbproduk tbody .tdtotal').each(function() {
					total += parseInt($(this).text());

				});			
				
				$('#tbproduk tbody .tdbiayasetting').each(function() {
					totalsetting += parseInt($(this).text());

				});
				

				
				var uangmuka = $('#uangmuka').val();
				var sum = (total + totalsetting) - uangmuka;
				$('#totalproduk').val(total);	
				$('#totalproduk').attr('value',total);
				$('#grandtotal').val(sum);
				$('#grandtotal').attr('value',sum);
				$('#totbiayasetting').val(totalsetting);
				$('#totbiayasetting').attr('value',totalsetting)
				$('#ftotalproduk,#ftotbiayasetting,#fgrandtotal,#fuangmuka').autoNumeric('init',rupiah);
				$('#ftotalproduk').autoNumeric('set',total);
				$('#ftotbiayasetting').autoNumeric('set',totalsetting);
				$('#fgrandtotal').autoNumeric('set',sum);
				$('#fuangmuka').autoNumeric('set',uangmuka);
				
			},500);


		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: 'POST',
			url: '{{url("admin/orders/tambah")}}/'+produkid, 
			
			data: {
				orderid:orderid, 
				product_id: produkid,
				panjang: panjang,
				lebar: lebar,
				luas: luas,
				harga:harga,
				discount:disc,
				jumlah:jumlah,
				sub_total:sub_total,
				keterangan:keterangan,
				biaya_setting:biaya_setting,
				keuntungan:untung,
				
				
			}, 
			success: function(data){ 
				console.log(data.namaproduk);
				$('table tbody').append( '<tr>'+        
					'<td><input type="hidden" id="orderDetailId" value="'+ data.order_id +'"><input type="hidden" name="produkid[]" value="'+ data.product_id +'"><input type="hidden" name="tdnamaproduk[]" value="'+ data.namaproduk +'">'+ namaproduk +'</td>'+
					'<td class="tdpanjang"><input type="hidden" name="tdpanjang[]" readonly value="'+ data.panjang +'">'+ panjang +'</td>'+
					'<td class="tdlebar"><input type="hidden" name="tdlebar[]" readonly value="'+ data.lebar +'">'+ lebar +'</td>'+
					'<td class="tdluas"><input type="hidden" name="tdluas[]" readonly value="'+ data.luas +'">'+ luas +'</td>'+
					'<td class="tdharga"><input type="hidden" name="tdharga[]" readonly value="'+ data.harga +'">'+ harga +'</td>'+
					'<td><input type="hidden" name="tdjumlah[]" value="'+ data.jumlah +'">'+ jumlah +'</td>'+
					'<td class="tdbiayasetting"><input type="hidden" name="tdbiayasetting[]" value="'+ data.biaya_setting +'">'+ biaya_setting +'</td>'+
					'<td class="tdtotal"><input type="hidden" name="tdtotharga[]" value="'+ data.sub_total +'">'+ sub_total +'</td>'+
					'<td><input type="hidden" name="tdketerangan[]" value="'+ data.keterangan +'">'+ keterangan +'</td>'+

					'<td><a href="javascript:void(0)" class="btn btn-danger btn-xs" id="delrow" data-id="'+ data.id +'" data-token="{{ csrf_token() }}" >Delete</a></td>'+

					'</tr>');
				
				setTimeout(updateOrderDetail,1000);
			},
			error: function (xhr, ajaxOptions, thrownError) { 
				alert(thrownError,xhr,ajaxOptions); 
			}
		});

		
	}
});

	$(document).on('mouseup','#btnTambah',function(){

		//setTimeout(updateOrderDetail,1000);
		
	});

	function updateOrderDetail(){
		var orderid = $('#orderid').val();
		var total_produk = $('#totalproduk').val();
		var jasa = $('#totbiayasetting').val();
		var uangmuka = $('#uangmuka').val();
		var grandtotal = $('#grandtotal').val();
		var sum = total_produk - uangmuka;
		var token = $(this).data('token');

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: 'POST',
			url: '{{url("admin/orders/updateorder")}}/'+orderid, 
			
			data: {
				
				orderid:orderid, 
				
				totalproduk:total_produk,
				uangmuka:uangmuka,				
				piutang: grandtotal,
				totbiayasetting:jasa,
				grandtotal:grandtotal
				
			}, 

			
			
			success: function(response){ 
				
				console.log('sukses update order');
				
			},
			error: function (xhr, ajaxOptions, thrownError) { 
				alert(thrownError); 
			}
		});
	}

	
	
	$(document).on('click', '#delrow', function () {		   
		
		$(this).closest('tr').remove();
		$('#grandtotal').val("");  
		
		setInterval(function() {
			var total = 0;
			var totalsetting = 0;
			$('#tbproduk tbody .tdtotal').each(function() {
				total += parseInt($(this).text());
			})

			$('#tbproduk tbody .tdbiayasetting').each(function() {
				totalsetting += parseInt($(this).text());

			});

			var uangmuka = $('#uangmuka').val();
			var sum = total + totalsetting;
			$('#totalproduk').val(total);
			$('#totbiayasetting').val(totalsetting);			
			$('#grandtotal').val(sum);
			$('#ftotalproduk,#ftotbiayasetting,#fgrandtotal').autoNumeric('init',rupiah);
			$('#ftotalproduk').autoNumeric('set',total);
			$('#ftotbiayasetting').autoNumeric('set',totalsetting);
			$('#fgrandtotal').autoNumeric('set',sum);
		},500);
		
		
		var orderid = $('#orderid').val();
		var id = $(this).data("id");				
		var token = $(this).data('token');
		var tdprodukid = $(this).closest('tr').find('#tdprodukid').val();
		var tdluas = $(this).closest('tr').find('#tdluas').val();
		//alert(tdprodukid);
		console.log(tdluas);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$.ajax({
			type: 'DELETE',
			url:'produk/'+id,
			data:{'id':id,'produkid':tdprodukid,'jumlah':tdluas,'orderid':orderid},
			success: function(response){ 
				//toastr.success(data.success);
				console.log(response);
				setTimeout(updateOrderDetail,1000);

				
			},
			error: function (xhr, ajaxOptions, thrownError) { 
					
					console.log(thrownError);
				}
			});

		//setTimeout(updateOrderDetail,1000);

	});
	
	
	
	$('#uangmuka').keyup(function(){

		var total = $('#totalproduk').val();
		var uangmuka = $('#uangmuka').val();
		var sum = total - uangmuka;
		
		$('#grandtotal').val(sum);
		
	});
});

</script>



@endsection