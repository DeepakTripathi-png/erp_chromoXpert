$(function () {
    var table = $('#cims_data_table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax: base_url + "/admin/report/data-table",
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'test_result_code',
                name: 'test_result_code'
            },

            // {
            //     data: 'branch_logo',
            //     name: 'branch_logo',
            //     orderable: false,
            //     searchable: false
            // },
            // {
            //     data: 'branch_name',
            //     name: 'branch_name'
            // },
            // {
            //     data: 'address',
            //     name: 'address'
            // },
            // {
            //     data: 'lab_incharge',
            //     name: 'lab_incharge'
            // },
            // {
            //     data: 'mobile',
            //     name: 'mobile'
            // },
            // {
            //     data: 'email',
            //     name: 'email'
            // },

            // {
            //     data: 'status',
            //     name: 'status',
            //     orderable: false,
            //     searchable: false
            // },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
});