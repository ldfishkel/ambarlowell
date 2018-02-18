jQuery(document).ready(function() {
    
    var table = $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/products/data/pf"},
        pageLength : 100,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'model', name: 'model' },
            { data: "Action", orderable: false,  
              defaultContent : '<a href="javascript:;" class="btn btn-warning btn-xs edit">Edit</a>' + 
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-info btn-xs view">View</a>' +
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-danger btn-xs stock">Stock</a>' +
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-danger btn-xs image">Images</a>' }
        ]
    });

    table.on('click', '.image', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/images/" + id; 
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

    var table2 = $('#product-table-pi').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/products/data/pi"},
        pageLength : 100,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'model', name: 'model' },
            { data: "Action", orderable: false,  
              defaultContent : '<a href="javascript:;" class="btn btn-warning btn-xs edit">Edit</a>' + 
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-info btn-xs view">View</a>' +
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-danger btn-xs stock">Stock</a>' +
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-danger btn-xs image">Images</a>' }
        ]
    });

    table2.on('click', '.image', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/images/" + id; 
    });

    table2.on('click', '.edit', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/edit/" + id; 
    });

    table2.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/view/" + id; 
    });

    table2.on('click', '.stock', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/" + id + "/stock"; 
    });

    var table3 = $('#product-table-ac').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/products/data/ac"},
        pageLength : 100,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'model', name: 'model' },
            { data: "Action", orderable: false,  
              defaultContent : '<a href="javascript:;" class="btn btn-warning btn-xs edit">Edit</a>' + 
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-info btn-xs view">View</a>' +
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-danger btn-xs stock">Stock</a>' +
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-danger btn-xs image">Images</a>' }
        ]
    });

    table3.on('click', '.image', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/images/" + id; 
    });

    table3.on('click', '.edit', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/edit/" + id; 
    });

    table3.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/view/" + id; 
    });

    table3.on('click', '.stock', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/" + id + "/stock"; 
    });

    var table4 = $('#product-table-ab').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/products/data/ab"},
        pageLength : 100,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'model', name: 'model' },
            { data: "Action", orderable: false,  
              defaultContent : '<a href="javascript:;" class="btn btn-warning btn-xs edit">Edit</a>' + 
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-info btn-xs view">View</a>' +
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-danger btn-xs stock">Stock</a>' +
                               '<a style="margin-left:5px" href="javascript:;" class="btn btn-danger btn-xs image">Images</a>' }
        ]
    });

    table4.on('click', '.image', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/images/" + id; 
    });

    table4.on('click', '.edit', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/edit/" + id; 
    });

    table4.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/view/" + id; 
    });

    table4.on('click', '.stock', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/" + id + "/stock"; 
    });
});

