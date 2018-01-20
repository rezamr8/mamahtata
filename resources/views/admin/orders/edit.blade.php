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
		<div class="panel-heading">Customer</div>
		<div class="panel-body">		
			<div class="form-group row">
				<label for="customer" class="col-md-2 col-form-label col-form-label-md font-weight-bold">customer</label>
				<div class="col-md-8">
					
					{{-- <select class="form-control form-control-md" id="customer" name="customer" required> 
						<option value=""></option>
						@foreach($customers as $customer)
						<option value="{{ $customer->id }}" class="form-control form-control-md"
							@if ($orders->customer->id == $customer->id)
								selected="" 
							@endif
							>{{ $customer->nama }}</option>
						@endforeach
					</select> --}}
					<label for="customernama">{{$orders->customer->nama}}</label> 
				</div>	    
			</div>
			<div class="form-group row">
				<label for="nohp" class="col-md-2 col-form-label col-form-label-md font-weight-bold" >Handphone</label>
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

			<div class="form-group row">
				<label for="namabarang" class="col-md-2 col-form-label">nama produk</label>
				<div class="col-md-8">
				<select name="namaproduk" id="namaproduk">
					<option value="0">Pilih Produk</option>
					@foreach($products as $key => $value)
					<option value="{{$key}}">{{$value}}</option>
					@endforeach
				</select>
				</div>
			</div>

			<div class="form-group row">
			    <label for="harga" class="col-md-2 col-form-label col-form-label-md font-weight-bold">harga</label>
			    <div class="col-md-8">
			      <input type="text" class="form-control form-control-md" id="harga" name="harga" readonly>
			    </div>	    
			</div>

			<div class="form-group row">
			    <label for="jumlah" class="col-md-2 col-form-label col-form-label-md font-weight-bold">jumlah</label>
			    <div class="col-md-8">
			      <input type="text" class="form-control form-control-md" id="jumlah" name="jumlah" >
			    </div>	    
			</div>

			<div class="form-group row">
			    <label for="totharga" class="col-md-2 col-form-label col-form-label-md font-weight-bold">totharga</label>
			    <div class="col-md-8">
			      <input type="text" class="form-control form-control-md" id="totharga" required readonly="readonly" name="totharga">
			    </div>	    
			</div>

			<div class="form-group row">
			    <label for="keterangan" class="col-md-2 col-form-label col-form-label-md font-weight-bold">keterangan</label>
			    <div class="col-md-8">
			      <input type="text" class="form-control form-control-md" id="keterangan" name="keterangan">
			    </div>	    
			</div>

			<table class="table table-striped table-bordered table-light" id="tbproduk">
				<thead>
					<tr align="center">
						
						<th align="center">Nama</th>
						<th align="center">Harga</th>
						<th align="center">Jumlah</th>
						<th align="center">Total</th>
						<th align="center">keterangan</th>
						<th align="center"><a href="#" class="btn btn-primary" id="btnTambah">Tambah Produk</a></th>
					</tr>
				</thead>
				<tbody>
					@if(count($orders->orderdetail)>0)
					@foreach($orders->orderdetail as $order)
						<tr>
							
							<td><input type="hidden" id="orderDetailId" value="{{$order->id}}"><input type="hidden" name="produkid[]" value="{{$order->product->id}}"><input type="hidden" name="tdnamaproduk[]" value="{{$order->product->nama}}">{{$order->product->nama}}</td>
							<td><input type="hidden" name="tdharga[]" readonly value="{{$order->harga}}">{{$order->harga}}</td>
							<td><input type="hidden" name="tdjumlah[]" value="{{$order->jumlah}}">{{$order->jumlah}}</td>
							<td class="tdtotal"><input type="hidden" name="tdtotharga[]" value="{{$order->sub_total}}">{{$order->sub_total}}</td>
							<td><input type="hidden" name="tdketerangan[]" value="{{$order->keterangan}}">{{$order->keterangan}}</td>
							<td>
							

                                <a href="javascript:void(0)" class="btn btn-danger btn-xs" id="delrow" data-id="{{ $order->id }}" data-token="{{ csrf_token() }}" >Delete</a>
                            


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
		<input type="text" class="form-control form-control-md" id="total" name="total" required value="{{$orders->total}}">
	</div>	    
</div>
<div class="form-group row">
    <label for="uangmuka" class="col-md-2 col-form-label col-form-label-md font-weight-bold">UANG MUKA</label>
    <div class="col-md-8">
      <input type="text" class="form-control form-control-md" id="uangmuka" name="uangmuka" value="{{$orders->uang_muka}}">
    </div>	    
</div>

<div class="form-group row">
    <label for="grandtotal" class="col-md-2 col-form-label col-form-label-md font-weight-bold">GRANDTOTAL</label>
    <div class="col-md-8">
      <input type="text" class="form-control form-control-md" id="grandtotal" name="grandtotal" required value="{{$orders->grand_total}}">
    </div>	    
</div>

<div class="form-group">
	<button class="btn btn-primary" type="submit">Save</button>
</div>

</form>
@endsection
	</div>
</div>

@section('footer')

<script type="text/javascript">



$(function(){

	function updateOrderDetail(){
		var orderid = $('#orderid').val();
			var total = $('#total').val();
			var uangmuka = $('#uangmuka').val();
			var sum = total - uangmuka;
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
					
					total:total,
					uangmuka:uangmuka,				
					grandtotal:sum
				
				}, 

			
				
				success: function(response){ 
				
				console.log('sukses update order');
					
				},
				error: function (xhr, ajaxOptions, thrownError) { 
					alert(thrownError); 
					}
			});
	}
	

	$('#customer').select2();
	$('#namaproduk').select2();
	
    $('#customer').change(function(){   

	    $.ajax({
	        type: 'GET', 
	        //url: '/orders/nohp', 
	        url: '{{route("orders.nohp")}}', 
	        data: { id: $('#customer').val() }, 

	        dataType: 'json',
	        beforeSend: function(e) {
	            if(e && e.overrideMimeType) {
	                e.overrideMimeType("application/json;charset=UTF-8");
	            }
	        },
	        success: function(response){ // Ketika proses pengiriman berhasil
	           
	            $('#nohp').val(response.no_hp);
	            //alert(response.alamat);
	        },
	        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
	           alert(thrownError); 
			}
	    });

	});

	$('#namaproduk').change(function(){   

	    $.ajax({
	        type: 'GET',
	        //url: '/orders/namabarang', 
	        url:'{{route("orders.namabarang")}}',
	        data: { id: $('#namaproduk').val() }, 

	        dataType: 'json',
	        
	        success: function(response){ 
	           
	            $('#harga').val(response.harga);
	           
	            //alert(response.harga);
	            
	        },
	        error: function (xhr, ajaxOptions, thrownError) { 
	            alert(thrownError); 
				}
	    });

	});

    
	$('#btnTambah').click(function(e){
		e.preventDefault();
		var produkid = $('#namaproduk option:selected').val();
		var namaproduk = $('#namaproduk option:selected').text();
		var harga = $('#harga').val();
		var jumlah = $('#jumlah').val();
		var keterangan = $('#keterangan').val();
		var sub_total = $('#totharga').val();
		var orderid = $('#orderid').val();
		
       		
	if(!jumlah)
	{
		alert('isi dahulu');
		// $('#total').attr('value',500);
		// $('#total').val(500);
		return false;
	}else{
			
			$('#jumlah').val("");
			$('#harga').val("");
			$('#totharga').val("");
			$('#keterangan').val("");
			$('#grandtotal').val("");
			//$('#uangmuka').val("");      

		setInterval(function() {
			var total = 0;
			$('#tbproduk tbody .tdtotal').each(function() {
				total += parseInt($(this).text());

			});			
			//total - uang muka

			
			var uangmuka = $('#uangmuka').val();
			var sum = total - uangmuka;
			$('#total').val(total);	
			$('#total').attr('value',total);
			$('#grandtotal').val(sum);
			$('#grandtotal').attr('value',sum);

			
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
					harga:harga,
					jumlah:jumlah,
					sub_total:sub_total,
					keterangan:keterangan,
					
				
				}, 
				success: function(data){ 
				//toastr.success(data.success);
				$('table tbody').append( '<tr>'+        
				        '<td><input type="hidden" name="produkid[]" value="'+ data.produkid +'"><input type="hidden" name="tdnamaproduk[]" value="'+ data.namaproduk +'">'+ namaproduk +'</td>'+
				        '<td class="tdharga"><input type="hidden" name="tdharga[]" readonly value="'+ data.harga +'">'+ harga +'</td>'+
						'<td><input type="hidden" name="tdjumlah[]" value="'+ data.jumlah +'">'+ jumlah +'</td>'+
						'<td class="tdtotal"><input type="hidden" name="tdtotharga[]" value="'+ data.sub_total +'">'+ sub_total +'</td>'+
						'<td><input type="hidden" name="tdketerangan[]" value="'+ data.keterangan +'">'+ keterangan +'</td>'+

						'<td><a href="javascript:void(0)" class="btn btn-danger btn-xs" id="delrow" data-id="'+ data.id +'" data-token="{{ csrf_token() }}" >Delete</a></td>'+

				    	'</tr>');
				//console.log(data);
					
				},
				error: function (xhr, ajaxOptions, thrownError) { 
					alert(thrownError); 
					}
			});

		
	}
	});

	$(document).on('mouseup','#btnTambah',function(){

		setTimeout(updateOrderDetail,1000);
		
	});

     
        
       $(document).on('click', '#delrow', function () {		   
		    
		     $(this).closest('tr').remove();
		     $('#grandtotal').val("");  
		     
		     setInterval(function() {
				var total = 0;
				$('#tbproduk tbody .tdtotal').each(function() {
					total += parseInt($(this).text());
				})
				$('#total').val(total);
				
				var uangmuka = $('#uangmuka').val();
				var sum = total - uangmuka;
				
				$('#grandtotal').val(sum);
			},500);
			
		     

				var id = $(this).data("id");				
				var token = $(this).data('token');
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				
				$.ajax({
					type: 'DELETE',
					url:'produk/'+id,
					//data: {'id':id, '_method': 'DELETE', '_token' :token},
					data:{'id':id},
						success: function(response){ 
							toastr.success(data.success);
							console.log('sukses');

							
						},
						error: function (xhr, ajaxOptions, thrownError) { 
							//alert(thrownError); 
							console.log(thrownError);
						}
				});

				setTimeout(updateOrderDetail,1000);

		 });
          
		
		
        $('#uangmuka').keyup(function(){

        var total = $('#total').val();
        var uangmuka = $('#uangmuka').val();
        var sum = total - uangmuka;
        
        $('#grandtotal').val(sum);
		
    	});


    	$('#jumlah').keyup(function(){
			var jumlah = $('#jumlah').val();
			var harga = $('#harga').val();
			var totharga= jumlah * harga;
			$('#totharga').val(totharga);
	    });

	   {{-- var moneyFormat = wNumb({
						    mark: ',',
						    decimals: 2,
						    thousand: '.',
						    prefix: 'Rp. ',
						    suffix: ''
						  });

		$('#grandtotal, #total, #uangmuka').html(moneyFormat.to(parseInt( $(this).val() ) ) ); --}}

		{{--  $('#grandtotal, #total, #uangmuka').maskMoney({
								prefix: 'Rp '
								});  --}}



        




});

</script>



@endsection