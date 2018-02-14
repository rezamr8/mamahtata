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
            <th>KEUNTUNGAN</th>
            <th>TANGGAL</th>
          </tr>
          </thead>
          <tbody id="orderFilter">
            
            @foreach ($order as $o)
            <tr>
              <td>{{$o->customer->nama}}</td>
              <td>{{$o->no_order}}</td>
              <td>{{ number_format($o->uang_muka) }}</td>
              <td>{{ number_format($o->total_biaya_setting) }}</td>
              <td class="tdtotal">{{ $o->grand_total }}</td>
              <td class="tdpiutang">{{ $o->piutang }}</td>
              <td class="tduntung">{{ $o->orderdetail->sum('keuntungan') }}</td>
              <td>{{ $o->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
            <tr>
              <td colspan="8"></td>
            </tr>
            <tr>
              <td colspan="4" class="text-center">Total Pemasukan</td>
              
              <td class="total"></td>
              <td class="piutang"></td>
              <td class="untung"></td>
              <td></td>
            </tr>
            
          </tbody>
        </table>
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
      var rupiah = {
             aSep: '.', 
             aDec: ',',
             mDec: '0', 
             aSign: 'Rp '
            };
      $('.tdtotal,.total,.tdpiutang,.piutang,.tduntung,.untung').autoNumeric('init',rupiah);
      $('#tborder tbody .tdtotal').each(function() {
        total += parseInt($(this).text().replace(/[^0-9]/g, ''));
      })
    
      
      $('.total').html(total+'<input type="hidden" name="total" id="total" value="'+total+'">');
      $('.total').autoNumeric('set',total);
      var trupiah = $('.total').text();
      $('.total').append('<input type="hidden" name="total" id="total" value="'+trupiah+'">');


      $('#tborder tbody .tdpiutang').each(function() {
        piutang += parseInt($(this).text().replace(/[^0-9]/g, ''));
      })
      $('.piutang').html(piutang+'<input type="hidden" name="piutang" id="piutang" value="'+piutang+'">');
      $('.piutang').autoNumeric('set',piutang);
      var trupiah = $('.piutang').text();
      $('.piutang').append('<input type="hidden" name="piutang" id="piutang" value="'+trupiah+'">');
      
       $('#tborder tbody .tduntung').each(function() {
        untung += parseInt($(this).text().replace(/[^0-9]/g, ''));
      })
       $('.untung').html(untung+'<input type="hidden" name="untung" id="untung" value="'+untung+'">');
      $('.untung').autoNumeric('set',untung);
      var trupiah = $('.untung').text();
      $('.untung').append('<input type="hidden" name="untung" id="untung" value="'+trupiah+'">');

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

   // $('#exportPDF').click(function(){
   //   console.log('click pdf');
   //   var from_date = $('#from_date').val();
   //   var to_date = $('#to_date').val();
   //   var total = $('.total').text();
   //   console.log(from_date);

   //   if( from_date != '' && to_date != ''){

   //     $.ajaxSetup({
   //      headers: {
   //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   //     }
   //   });

   //     // $.ajax({
   //     //   url:"{{ route('report.pdf') }}",
   //     //   method:"POST",
   //     //   data:{from_date:from_date,to_date:to_date},
   //     //   success:function(data)
   //     //   {
   //     //     console.log(data);
   //     //     // $('#orderFilter').empty().html(data);
   //     //     // hitung();
   //     //   }
   //     // });

   //        $.ajax({
   //          cache: false,
   //          type: "POST",
   //          url: "{{ route('report.pdf') }}",
   //          contentType: false,
   //          processData: false,
   //          data:{from_date:from_date,to_date:to_date},
   //           //xhrFields is what did the trick to read the blob to pdf
   //          xhrFields: {
   //              responseType: 'blob'
   //          },
   //          success: function (response, status, xhr) {

   //              var filename = "";                   
   //              var disposition = xhr.getResponseHeader('Content-Disposition');

   //               if (disposition) {
   //                  var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
   //                  var matches = filenameRegex.exec(disposition);
   //                  if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
   //              } 
   //              var linkelem = document.createElement('a');
   //              try {
   //                  var blob = new Blob([response], { type: 'application/octet-stream' });                        

   //                  if (typeof window.navigator.msSaveBlob !== 'undefined') {
   //                      //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
   //                      window.navigator.msSaveBlob(blob, filename);
   //                  } else {
   //                      var URL = window.URL || window.webkitURL;
   //                      var downloadUrl = URL.createObjectURL(blob);

   //                      if (filename) { 
   //                          // use HTML5 a[download] attribute to specify filename
   //                          var a = document.createElement("a");

   //                          // safari doesn't support this yet
   //                          if (typeof a.download === 'undefined') {
   //                              window.location = downloadUrl;
   //                          } else {
   //                              a.href = downloadUrl;
   //                              a.download = filename;
   //                              document.body.appendChild(a);
   //                              a.target = "_blank";
   //                              a.click();
   //                          }
   //                      } else {
   //                          window.location = downloadUrl;
   //                      }
   //                  }   

   //              } catch (ex) {
   //                  console.log(ex);
   //              } 
   //          }
   //      });


   //   }else{
   //     alert('isi dahulu tanggal nya');
   //   }
   // })



 })

</script>

@stop
