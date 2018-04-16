@extends('layouts.app')
@section('content')
{{-- Customer Order --}}
<div class="container">
@include('admin.sidebar')
<div class="col-md-9">

{{-- modal Customer  --}}
	<div class="modal fade" id="form-modal" tabindex="8" role="dialog" aria-labelledby="form-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="form-modal">Customer</h4>
            </div>
            <div class="modal-body" >
               <form method="POST" action="{{ url('/admin/customer') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.customer.form')

                        </form>
            </div>
        </div>
    </div>
</div>
{{-- end modal customer --}}
<form action="{{ route('orders.store') }}" method="POST">
	{{ csrf_field() }}
	
	<div class="panel panel-default">
		<div class="panel-heading">CUSTOMER</div>
		<div class="panel-body">		
			<div class="form-group row">
				<label for="customer" class="col-md-2 col-form-label col-form-label-md font-weight-bold">CUSTOMER</label>
				<div class="col-md-8">
					<select class="form-control form-control-md" id="customer" name="customer" required> 
						<option value=""></option>
						@foreach($customers as $key => $customer)
						<option value="{{ $key }}" class="form-control form-control-md">{{ $customer }}</option>
						@endforeach
					</select> 
				</div>	  
				<button class="btn btn-info load-form-modal" data-url="{{ route('customer.create') }}" data-toggle ="modal" data-target='#form-modal' >
                        ADD CUSTOMER
                    </button>

			</div>
			<div class="form-group row">
				<label for="nohp" class="col-md-2 col-form-label col-form-label-md font-weight-bold" >HANDPHONE</label>
				<div class="col-md-8">
					<input type="text" class="form-control form-control-md" id="nohp" name="nohp" readonly="readonly">	  
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
				<label for="namabarang" class="col-md-2 col-form-label">PRODUK</label>
				<div class="col-md-8">
				<select name="namaproduk" id="namaproduk">
					<option value="0">Pilih Produk</option>
					@foreach($products as $key => $value)
					<option value="{{$key}}">{{$value}}</option>
					@endforeach
				</select>
				</div>
			</div>

			<div class="form-group controls row">
			    <label for="harga" class="col-md-2 col-form-label col-form-label-md font-weight-bold">HARGA</label>
			    <div class="col-md-3">
			      <input type="text" class="form-control form-control-md" id="fharga" readonly>
			      <input type="hidden" class="form-control form-control-md" id="tempharga" name="tempharga" >
			      <input type="hidden" class="form-control form-control-md" id="harga" name="harga" >
			      <input type="hidden" class="form-control form-control-md" id="temphargabeli" name="temphargabeli" >
			      <input type="hidden" class="form-control form-control-md" id="hargabeli" name="hargabeli" >
			    </div>
			 	<label for="discount" class="col-md-2 col-form-label col-form-label-md font-weight-bold"> DISCOUNT</label>
			    <div class="col-md-3">
			    	<input type="text" class="form-control form-control-md" id="fdisc" >
			    	<input type="hidden" class="form-control form-control-md" id="disc" name="disc">
			    </div>

			</div>

			<div class="form-group row">
			    <label for="jumlah" class="col-md-2 col-form-label col-form-label-md font-weight-bold">JUMLAH</label>
			    <div class="col-md-2">
			      <input type="text" class="form-control form-control-md" id="jumlah" name="jumlah" >
			    </div>	    
			</div>

			<div class="form-group controls row">
				<label for="panjang" class="col-md-2 font-weight-bold">PANJANG</label>
				<div class="col-md-3">
					<input type="number" class="form-control form-control-md" id="panjang"  name="panjang" >
				</div>
				<label for="lebar" class="col-md-2 font-weight-bold">LEBAR</label>
				<div class="col-md-3">
					<input type="number" class="form-control form-control-md" id="lebar" name="lebar" >
				</div>
			</div>	

			<div class="form-group row">
				<label for="luas" class="col-md-2 font-weight-bold">LUAS</label>
				<div class="col-md-3">
					<input type="text" class="form-control form-control-md" id="luas" name="luas" required readonly>
				</div>
				
				
				<div class="col-md-2">
					<input type="hidden" class="form-control form-control-md" id="thbeli" name="thbeli" required readonly>
				</div>
			</div>

			

			

			<div class="form-group row">
			    <label for="totharga" class="col-md-2 col-form-label col-form-label-md font-weight-bold">TOTAL HARGA</label>
			    <div class="col-md-8">
			      <input type="text" class="form-control form-control-md" id="ftotharga" required readonly="readonly">
			      <input type="hidden" class="form-control form-control-md" id="totharga" required readonly="readonly" name="totharga">
			      <input type="hidden" class="form-control form-control-md" id="tothargabeli" required readonly="readonly" name="tothargabeli">
			    </div>	    
			</div>

			<div class="form-group row">
			    <label for="biayasetting" class="col-md-2 col-form-label col-form-label-md font-weight-bold">BIAYA SETTING</label>
			    <div class="col-md-8">
			      <input type="text" class="form-control form-control-md" id="fbiayasetting">
			      <input type="hidden" class="form-control form-control-md" id="biayasetting" name="biayasetting">
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
					<tr>
						
						<th align="center">NAMA</th>
						<th align="center">HARGA</th>
						<th align="center">DISC</th>
						<th align="center">PANJANG</th>
						<th align="center">LEBAR</th>
						<th align="center">LUAS</th>
						<th align="center">JUMLAH</th>
						<th align="center">TOTAL</th>
						<th align="center">JASA</th>
						<th align="center">KETERANGAN</th>						
						<th align="center"><a href="#" class="btn btn-xs btn-primary" id="btnTambah">ADD</a></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>

{{-- Order Detail --}}

<div class="panel panel-default">
	<div class="panel-heading">

		<div class="form-group row">
			<label for="totalproduk" class="col-md-2 col-form-label col-form-label-md font-weight-bold">TOTAL PRODUK</label>
			<div class="col-md-8">
				<input type="text" class="form-control form-control-md" id="ftotalproduk" required readonly>
				<input type="hidden" class="form-control form-control-md" id="totalproduk" name="totalproduk" required readonly>
			</div>	    
		</div>

		<div class="form-group row">
			<label for="totalbiayasetting" class="col-md-2 col-form-label col-form-label-md font-weight-bold">TOTAL BIAYA SETTING</label>
			<div class="col-md-8">
				<input type="text" class="form-control form-control-md" id="ftotalbiayasetting" required readonly>
				<input type="hidden" class="form-control form-control-md" id="totalbiayasetting" name="totalbiayasetting" required>
			</div>	    
		</div>

		<div class="form-group row">
			<label for="total" class="col-md-2 col-form-label col-form-label-md font-weight-bold">GRAND TOTAL</label>
			<div class="col-md-8">
				<input type="text" class="form-control form-control-md" id="fgrandtotal" required readonly>
				<input type="hidden" class="form-control form-control-md" id="grandtotal" name="grandtotal" required>
			</div>	    
		</div>
		

		<div class="form-group">
			<button class="btn btn-primary" type="submit">Save</button>
		</div>

		
	</div>
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
             aSign: 'Rp ',
             mDec:0
            };
	
	
	$('#customer').select2();
	$('#namaproduk').select2();

	$('#fdisc').bind('blur focusout',function(){
		var tempharga = $('#tempharga').val();
		var temphargabeli = $('#temphargabeli').val();
		var disc = $('#disc').val()
		var kurang = tempharga - disc;
		var kurang2 =  temphargabeli - disc;
		$('#fharga').val(kurang);
		$('#fharga').autoNumeric('set',kurang);
		$('#harga').val(kurang);
		$('#hargabeli').val(kurang2);

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
		var jumlah = $('#jumlah').val();
		var luas = 0;
		var totharga = 0;
		var thbeli = 0;

		luas = (panjang * lebar) * jumlah;

		if (luas <= 1) {
			luas = 1;
		}
		$('#luas').val(luas);
		$('#ftotharga').autoNumeric('init', rupiah);
		totharga = $('#harga').val();
		totharga = totharga*luas;
		$('#totharga').val(totharga);
		$('#ftotharga').autoNumeric('set',totharga);

		thbeli = $('#hargabeli').val();
		thbeli = thbeli*luas;
		$('#thbeli').val(thbeli);
		$('#tothargabeli').val(thbeli);
	}

	$('#panjang').keyup(function(){ ukurluas() });
	$('#lebar').keyup(function(){ ukurluas() });	
	
    $('#customer').change(function(){   

	    $.ajax({
	        type: 'GET', 
	        
	        url: '{{route("orders.nohp")}}', 
	        data: { id: $('#customer').val() }, 

	        dataType: 'json',
	        beforeSend: function(e) {
	            if(e && e.overrideMimeType) {
	                e.overrideMimeType("application/json;charset=UTF-8");
	            }
	        },
	        success: function(response){ 
	           
	            $('#nohp').val(response.no_hp);
	           
	        },
	        error: function (xhr, ajaxOptions, thrownError) { 
	            alert(thrownError); 
	        }
	    });

	});

	$('#namaproduk').change(function(){   

	    $.ajax({
	        type: 'GET',
	        url:'{{route("orders.namabarang")}}',
	        data: { id: $('#namaproduk').val() },    

	        dataType: 'json',
	        
	        success: function(response){ 
	        	
	            $('#harga').val(response.harga_jual);
	            $('#tempharga').val(response.harga_jual);

	             $('#hargabeli').val(response.harga_beli);
	             $('#temphargabeli').val(response.harga_beli);

	             $('#fharga').autoNumeric('init', {aSep: '.',aDec:',',aSign:'Rp ',mDec:0});
	            var harga = $('#harga').val();
	            $('#fharga').autoNumeric('set',harga);
	           
	           
	            
	        },
	        error: function (xhr, ajaxOptions, thrownError) { 
	            //alert(thrownError);
	        }
	    });

	});

	$('#jumlah').keyup(function(){
		

		$('#panjang').val('');
		$('#lebar').val('');
		$('#luas').val('');
		$('#hargasatuan').val('');
		$('#fhargasatuan').val('');
		$('#thbeli').val('');

		$('#ftotharga').val('');
		$('#totharga').val('');
		$('#tothargabeli').val('');
		$('#biayasetting').val('');
		$('#fbiayasetting').val('');
	});

	

	$('#btnTambah').click(function(e){  
		e.preventDefault();
		var produkid = $('#namaproduk option:selected').val();
		var namaproduk = $('#namaproduk option:selected').text();
		var harga = $('#harga').val();
		var hargabeli = $('#hargabeli').val();
		var hargasatuan = $('#hargasatuan').val();
		var panjang = $('#panjang').val();
		var lebar = $('#lebar').val();
		var luas = $('#luas').val();
		var jumlah = $('#jumlah').val();
		var keterangan = $('#keterangan').val();
		var tdtotharga = $('#totharga').val();
		var tothargabeli = $('#tothargabeli').val();
		var biayasetting = $('#biayasetting').val();
		var disc = $('#disc').val();

		var fdisc = $('#fdisc').val();
        var fharga = $('#fharga').val();
        var fhargasatuan = $('#fhargasatuan').val();
        var ftotharga = $('#ftotharga').val();
        var fbiayasetting = $('#fbiayasetting').val();

		var untung = tdtotharga - tothargabeli;
        var markup = '<tr>'+
        
        '<td><input type="hidden" name="produkid[]" value="'+ produkid +'"><input type="hidden" name="tdnamaproduk[]" value="'+ namaproduk +'">'+ namaproduk +'</td>'+
        '<td class="tdharga"><input type="hidden" name="tdharga[]" readonly value="'+ harga +'">'+ harga +'</td>'+
        '<td><input type="hidden" name="tddisc[]" readonly value="'+ disc +'">'+ disc +'</td>'+
        '<td><input type="hidden" name="tdpanjang[]" value="'+ panjang +'">'+ panjang +'</td>'+
        '<td><input type="hidden" name="tdlebar[]" value="'+ lebar +'">'+ lebar +'</td>'+
        '<td><input type="hidden" name="tdluas[]" value="'+ luas +'">'+ luas +'</td>'+
		'<td><input type="hidden" name="tdjumlah[]" value="'+ jumlah +'">'+ jumlah +'</td>'+
		'<td class="tdtotal"><input type="hidden" name="tdtotharga[]" value="'+ tdtotharga +'"><input type="hidden" name="tduntung[]" value="'+ untung +'">'+ tdtotharga +'</td>'+
		'<td class="tdbiayasetting"><input type="hidden" name="tdbiayasetting[]" value="'+biayasetting+'">'+biayasetting+'</td>'+
		'<td><input type="hidden" name="tdketerangan[]" value="'+ keterangan +'">'+ keterangan +'</td>'+
		// '<td><input type="hidden" name="tduntung[]" value="'+ untung +'">'+ untung +'</td>'+
		'<td><a href="javascript:void(0)" class="btn btn-primary" id="delrow" onclick="deleteRoworderdetail(this)">del</a></td>'
    	'</tr>';
		
		if($.trim(jumlah) == '' || $.trim(biayasetting) == '')
		{
			return alert('Jumlah Dan Biaya Setting harus di isi');
		}else{
			$('table tbody').append(markup);
		}

        
       
        $('#jumlah').val("");
        $('#harga').val("");
        $('#totharga').val("");
        $('#tothargabeli').val("");
        $('#keterangan').val("");
        $('#grandtotal').val("");
        $('#uangmuka').val("");
        $('#panjang').val("");
        $('#lebar').val("");
        $('#luas').val("");
        $('#hargasatuan').val("");
        $('#biayasetting').val("");
        $('#hargabeli').val("");
        $('#thbeli').val("");
        $('#disc').val("");
        $('#tempharga').val("");
        $('#temphargabeli').val("");

        $('#fdisc').val("");
        $('#fharga').val("");
        $('#fhargasatuan').val("");
        $('#ftotharga').val("");
        $('#fbiayasetting').val("");
        $('#namaproduk').val(null).trigger('change');
        console.log($('#namaproduk').val('3'));
       

		setInterval(function() {
			var total = 0;
			$('#tbproduk tbody .tdtotal').each(function() {
				total += parseInt($(this).text());
			})
			$('#totalproduk').val(total);
			$('#ftotalproduk').autoNumeric('init',rupiah);
			$('#ftotalproduk').autoNumeric('set',total);
			
		},500);


		setInterval(function() {
			var total = 0;
			$('#tbproduk tbody .tdbiayasetting').each(function() {
				total += parseInt($(this).text());
			})
			$('#totalbiayasetting').val(total);
			$('#ftotalbiayasetting').autoNumeric('init',rupiah);
			$('#ftotalbiayasetting').autoNumeric('set',total);
		},500);

		setInterval(function(){
			var totalproduk = parseInt($('#totalproduk').val());
			var totalbiayasetting = parseInt($('#totalbiayasetting').val());
			var grandtotal = 0;

			grandtotal = totalproduk + totalbiayasetting
			$('#grandtotal').val(grandtotal);
			$('#fgrandtotal').autoNumeric('init',rupiah);
			$('#fgrandtotal').autoNumeric('set',grandtotal);

		},1000)

		

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
});

</script>



@endsection