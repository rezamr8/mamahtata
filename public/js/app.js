// var template = Handlebars.compile($("#details-template").html());
//     var table = $('#users-table').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: 'https://datatables.yajrabox.com/eloquent/master-data',
//         columns: [
//             {
//                 "className":      'details-control',
//                 "orderable":      false,
//                 "searchable":      false,
//                 "data":           null,
//                 "defaultContent": ''
//             },
//             {data: 'id', name: 'id'},
//             {data: 'name', name: 'name'},
//             {data: 'email', name: 'email'},
//             {data: 'created_at', name: 'created_at'},
//             {data: 'updated_at', name: 'updated_at'}
//         ],
//         order: [[1, 'asc']]
//     });

//     // Add event listener for opening and closing details
//     $('#users-table tbody').on('click', 'td.details-control', function () {
//         var tr = $(this).closest('tr');
//         var row = table.row(tr);
//         var tableId = 'posts-' + row.data().id;

//         if (row.child.isShown()) {
//             // This row is already open - close it
//             row.child.hide();
//             tr.removeClass('shown');
//         } else {
//             // Open this row
//             row.child(template(row.data())).show();
//             initTable(tableId, row.data());
//             tr.addClass('shown');
//             tr.next().find('td').addClass('no-padding bg-gray');
//         }
//     });

//     function initTable(tableId, data) {
//         $('#' + tableId).DataTable({
//             processing: true,
//             serverSide: true,
//             ajax: data.details_url,
//             columns: [
//                 { data: 'id', name: 'id' },
//                 { data: 'title', name: 'title' }
//             ]
//         })
//     }