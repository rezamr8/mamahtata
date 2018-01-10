@extends('layouts.app')

@section('content')

    <div class="container">
    @include('admin.sidebar')
    <div class="col-md-9">
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
});
</script>
@endsection


