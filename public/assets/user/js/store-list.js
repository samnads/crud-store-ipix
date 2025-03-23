$(document).ready(function () {
    datatable = $('#store-list-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: _base_url + 'admin/stores',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'location', name: 'location' },
            { data: 'latitude', name: 'latitude' },
            { data: 'longitude', name: 'longitude' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        "drawCallback": function (settings) {
            $('[data-action="delete"]').off('click');
            $('[data-action="delete"]').click(function () {
                Swal.fire({
                    title: "Delete Store?",
                    text: "You won't be able to revert this!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: deleteConfirmButtonColor,
                    cancelButtonColor: deleteCancelButtonColor,
                    confirmButtonText: "Yes, delete it!",
                    focusCancel: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: _base_url + "admin/store",
                            dataType: 'json',
                            data: { id: $(this).attr('data-id') },
                            success: function (response) {
                                if (response.status == true) {
                                    toast(response.message.title, response.message.content, response.message.type);
                                }
                                else {
                                    toast(response.error.title, response.error.content, response.error.type);
                                }
                                datatable.ajax.reload(null, false);
                            },
                            error: function (response) {
                                toast(response.responseJSON.exception, response.statusText, 'error');
                                datatable.ajax.reload(null, false);
                            },
                        });
                    }
                });
            });
            $('[data-action="show"]').off('click');
            $('[data-action="show"]').click(function () {
                $('[name="name"]').val($(this).attr('data-name'));
                $('[name="location"]').val($(this).attr('data-location'));
                $('[name="latitude"]').val($(this).attr('data-latitude'));
                $('[name="longitude"]').val($(this).attr('data-longitude'));
                details_modal.show();
            });
            $('[data-action="edit"]').off('click');
            $('[data-action="edit"]').click(function () {
                location.href = _base_url + 'admin/store/edit/' + $(this).attr('data-id');
            });
        }
    });
});
let details_modal = new bootstrap.Modal(document.getElementById('details-modal'), {
    //backdrop: 'static',
    keyboard: true
});