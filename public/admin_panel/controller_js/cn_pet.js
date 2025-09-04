$(function () {
    var table = $('#cims_data_table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            url: base_url + "/admin/pet/data-table",
            type: "GET"
        },
        columns: [
            { 
                data: 'DT_RowIndex', 
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            { 
                data: 'pet_code', 
                name: 'pet_code' 
            },
            { 
                data: 'pet_parent', 
                name: 'pet_parent' 
            },
            { 
                data: 'name', 
                name: 'name' 
            },
            { 
                data: 'gender', 
                name: 'gender' 
            },
            { 
                data: 'dob', 
                name: 'dob' 
            },
            { 
                data: 'image', 
                name: 'image', 
                orderable: false, 
                searchable: false 
            },
            { 
                data: 'status', 
                name: 'status', 
                orderable: false, 
                searchable: false 
            },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false 
            }
        ],
        initComplete: function() {
            // Add custom search input
            $('.dataTables_filter').html('');
        }
    });

    // Apply search to the table
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Apply status filter
    $('#statusFilter').on('change', function() {
        var status = $(this).val();
        if (status === '') {
            table.column(7).search('').draw();
        } else {
            table.column(7).search(status).draw();
        }
    });

    // Correct reload function
    function reload_table() {
        table.ajax.reload(null, false);
    }
});


