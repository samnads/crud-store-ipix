$(document).ready(function () {
    $('#store-list-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: _base_url +'admin/stores',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // SL No.
            { data: 'name', name: 'name' },
            { data: 'location', name: 'location' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});