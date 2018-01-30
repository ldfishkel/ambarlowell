jQuery(document).ready(function() {
    
    var table = $('#cost-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/costs/data"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'amount', name: 'amount' },
            { data: 'date', name: 'date' },
            { data: "Action", orderable: false,  
              defaultContent : '<a style="margin-left:5px" href="javascript:;" class="btn btn-info btn-xs view">View</a>' }
        ]
    });

    table.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/costs/view/" + id; 
    });
});

