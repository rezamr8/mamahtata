@extends('layouts.app')

@section('content')

    <div class="container">
    @include('admin.sidebar')
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
    <table class="table table-bordered" id="orders-table">
        <thead>
            <tr>
            	<th></th>
                <th>id</th>
                <th>customer</th>
                <th>no order</th>
                <th>uang muka</th>
                <th>total</th>
                <th>grand total</th>
                <th>Action</th>
                {{-- <th>Created At</th>
                <th>Updated At</th> --}}
            </tr>
        </thead>
    </table>
    </div>
</div>
</div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
$(function() {
    var template = Handlebars.compile($("#details-template").html());
    var table = $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'orders/data',
        columns: [
        	{
                "className":      'details-control',
                "orderable":      false,
                "searchable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'id', name: 'id' },
            {{-- { data: 'customer_id', name: 'customer_id' }, --}}
            { data: 'customer.nama', name: 'customer.nama' },
            { data: 'no_order', name: 'no_order' },
            { data: 'uang_muka', name: 'uang_muka'},
            { data: 'total', name: 'total'},
            { data: 'grand_total', name: 'grand_total'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
            {{-- { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' } --}}
        ],
        order: [[1, 'desc']],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement('input');
                $(input).appendTo($(column.footer()).empty())
                .on("change", function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        }
    });

    table.column( 1 ).visible( false );

    // Add event listener for opening and closing details
    $('#orders-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'orders-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });

    function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: data.details_url,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'product.nama', name: 'product.nama' },
                { data: 'harga', name: 'harga' },
                { data: 'jumlah', name: 'jumlah' },
                { data: 'sub_total', name: 'sub_total' }
            ]
        })
    }

    //hapus Order 
    // $('#delO').click(function(e){
    //     e.preventDefault();
    //     ConfirmDialog('Are you sure');
    // });

    $(document).on('click','#delO', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        //console.log($(this).closest('tr').remove());
        var del = $(this).closest('tr');
        ConfirmDialog('Are you sure',id,del);
    });



    function ConfirmDialog(message, id, del) {
        $('<div></div>').appendTo('body')
                        .html('<div><h6>'+message+'?</h6></div>')
                        .dialog({
                            modal: true, title: 'Delete Order', zIndex: 10000, autoOpen: true,
                            width: 'auto', resizable: false,
                            buttons: {
                                Yes: function (m) {
                                   toastr.success('sukses data di delete');
                                   //console.log(id);             
                                   //var token = $(this).data('token');

                                   $.ajax({
                                    type: 'DELETE', 
                                    url:'orders/'+id,
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                    data: {'id':id, '_method': 'DELETE', "_token": "{{ csrf_token() }}"},    

                                        success: function(response){ 
                                        
                                            console.log('delete Order');
                                            del.remove();

                                            
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) { 
                                            //alert(thrownError); 
                                            console.log('error  delete aja');
                                        }
                                });

                                    $(this).dialog("close");
                                },
                                No: function () {                                                                 
                                    $('body').append('<h1>Confirm Dialog Result: <i>No</i></h1>');

                                    $(this).dialog("close");
                                }
                            },
                            close: function (event, ui) {
                                $(this).remove();
                            }
                        });
    };


});
</script>
@endsection


