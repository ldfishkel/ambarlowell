jQuery(document).ready(function() {
    
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/products/data"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'model', name: 'model' },
            { data: 'fabricated', 
              name: 'fabricated',  
              orderable: false, 
              render: function ( data, type, full, meta ) { return data ? "Yes" : "No" ; }
            },
            { data: 'cost', name: 'cost' },
            { data: 'wholesale', name: 'wholesale' },
            { data: 'retail', name: 'retail' },
            { data: "Edit/View", orderable: false,  
              defaultContent : '<a href="javascript:;" class="btn btn-warning btn-xs edit">Edit</a><a style="margin-left:5px" href="javascript:;" class="btn btn-info btn-xs view">View</a>' }
        ]
    });

    table.on('click', '.edit', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/edit/" + id; 
    });

    table.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/view/" + id; 
    });

});

