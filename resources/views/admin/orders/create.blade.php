@extends('layouts.app')
@section('content')
{{-- Customer Order --}}
<div class="container">
@include('admin.sidebar')
<div class="col-md-9">
<form action="{{ route('orders.store') }}" method="POST">
	{{ csrf_field() }}
	
	<div class="panel panel-info">
		<div class="panel-heading">Customer</div>
		<div class="panel-body">		
			<div class="form-group row">
				<label for="customer" class="col-md-2 col-form-label col-form-label-md font-weight-bold">customer</label>
				<div class="col-md-8">
					<select class="form-control form-control-md" id="customer" name="customer" required> 
						<option value=""></option>
						@foreach($customers as $key => $customer)
						<option value="{{ $key }}" class="form-control form-control-md">{{ $customer }}</option>
						@endforeach
					</select> 
				</div>	    
			</div>
			<div class="form-group row">
				<label for="nohp" class="col-md-2 col-form-label col-form-label-md font-weight-bold" >Handphone</label>
				<div class="col-md-8">
					<input type="text" class="form-control form-control-md" id="nohp" name="" readonly="readonly">	  
				</div>  
			</div>
		</div>
	</div>
	
{{-- tambah Table Produk --}}
  <div class="form-group">
	<div class="panel panel-info">
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
					
				</tbody>
			</table>
		</div>
	</div>
</div>

{{-- Order Detail --}}


<div class="form-group row">
	<label for="total" class="col-md-2 col-form-label col-form-label-md font-weight-bold">TOTAL</label>
	<div class="col-md-8">
		<input type="text" class="form-control form-control-md" id="total" name="total" required>
	</div>	    
</div>
<div class="form-group row">
    <label for="uangmuka" class="col-md-2 col-form-label col-form-label-md font-weight-bold">UANG MUKA</label>
    <div class="col-md-8">
      <input type="text" class="form-control form-control-md" id="uangmuka" name="uangmuka">
    </div>	    
</div>

<div class="form-group row">
    <label for="grandtotal" class="col-md-2 col-form-label col-form-label-md font-weight-bold">GRANDTOTAL</label>
    <div class="col-md-8">
      <input type="text" class="form-control form-control-md" id="grandtotal" name="grandtotal" required>
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
	            alert(thrownError); // Munculkan alert error
	        }
	    });

	});

	$('#namaproduk').change(function(){   

	    $.ajax({
	        type: 'GET', // Method pengiriman data bisa dengan GET atau POST
	        //url: '/orders/namabarang', 
	        url:'{{route("orders.namabarang")}}',
	        data: { id: $('#namaproduk').val() }, // data yang akan dikirim ke file yang dituju   

	        dataType: 'json',
	        
	        success: function(response){ // Ketika proses pengiriman berhasil
	           
	            $('#harga').val(response.harga);
	           
	            //alert(response.harga);
	            
	        },
	        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
	            alert(thrownError); // Munculkan alert error
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
		var tdtotharga = $('#totharga').val();
        var markup = '<tr>'+
        
        '<td><input type="hidden" name="produkid[]" value="'+ produkid +'"><input type="hidden" name="tdnamaproduk[]" value="'+ namaproduk +'">'+ namaproduk +'</td>'+
        '<td class="tdharga"><input type="hidden" name="tdharga[]" readonly value="'+ harga +'">'+ harga +'</td>'+
		'<td><input type="hidden" name="tdjumlah[]" value="'+ jumlah +'">'+ jumlah +'</td>'+
		'<td class="tdtotal"><input type="hidden" name="tdtotharga[]" value="'+ tdtotharga +'">'+ tdtotharga +'</td>'+
		'<td><input type="hidden" name="tdketerangan[]" value="'+ keterangan +'">'+ keterangan +'</td>'+
		'<td><a href="javascript:void(0)" class="btn btn-primary" id="delrow" onclick="deleteRoworderdetail(this)">del</a></td>'
    	'</tr>';
		
		if(!jumlah)
		{
			alert('isi dahulu');
		}else{
			$('table tbody').append(markup);
		}

        
       {{--  $('#namaproduk').find('option:eq(0)').prop('selected', true); --}}
        {{-- $('#customer').find('option:eq(0)').prop('selected', true); --}}
        $('#jumlah').val("");
        $('#harga').val("");
        $('#totharga').val("");
        $('#keterangan').val("");
        $('#grandtotal').val("");
         $('#uangmuka').val("");

        {{-- $('#tbproduk').each(function(){
		var sum = 0;
		sum += Number($(this).html());
		$('#total').val(sum);
		}); --}}

		setInterval(function() {
			var total = 0;
			$('#tbproduk tbody .tdtotal').each(function() {
				total += parseInt($(this).text());
			})
			$('#total').val(total);

			{{-- var grand_total = 0;
			grand_total += total;
			grand_total += parseInt($('#tax').val());
			grand_total -= parseInt($('#discount').val());

			$('#grandtotal').val(grand_total); --}}
		},500);

    });

     // Find and remove selected table rows
        
       $(document).on('click', '#delrow', function () { // <-- changes
		   
		     $(this).closest('tr').remove();
		     $('#grandtotal').val("");
		     return false;
		 });
          
		function deleteRoworderdetail(t) {

			if(confirm("Are you sure ?")) {
				$(t).parent().parent().remove();
				
			}									
		}
		
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

	    {{--  $('#grandtotal').priceFormat({
					      prefix: 'Rp ',
					      centsSeparator: ',',
					      thousandsSeparator: '.'
					       });	  --}}
});

</script>



@endsection