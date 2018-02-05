jQuery(document).ready(function() {
    
    var table = $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/products/data"},
        pageLength : 100,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'model', name: 'model' },
            { data: "Action", orderable: false,  
              defaultContent : '<a href="javascript:;" class="btn btn-warning btn-xs edit">Edit</a>' + 
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-info btn-xs view">View</a>' +
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-danger btn-xs stock">Stock</a>' }
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

    table.on('click', '.stock', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/" + id + "/stock"; 
    });

});

