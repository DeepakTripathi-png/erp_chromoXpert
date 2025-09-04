$(function () {
    var table = $('#cims_data_table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax: base_url + "/admin/departments/data-table",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'code', name: 'code' },
            { data: 'department_name', name: 'department_name' },
            { data: 'description', name: 'description' },
            { data: 'department_head', name: 'department_head' },
            { data: 'mobile', name: 'mobile' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});