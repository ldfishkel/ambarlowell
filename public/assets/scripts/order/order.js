jQuery(document).ready(function() {
    
    var table = $('#order-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/orders/data"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'type', name: 'type' },
            { name: 'name', data : 'name', searchable : false },
            { data: 'status', name: 'status' },  
            { data: 'date', name: 'date' },
            { data: "Action", orderable: false,
            render: function ( data, type, full, meta ) { 
                var buttons = '<a  href="javascript:;" class="btn btn-info btn-xs view">View</a>';
                if (full.status == "Pending") 
                    buttons += '<button type="button" style="margin-left:5px" class="btn btn-success btn-xs status" data-toggle="modal" data-target="#statusModal">Status</button>' ; 
                
                return buttons;
            } }
        ]
    });

    table.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/orders/view/" + id; 
    });

    table.on('click', '.status', function (e) {
        var currentStatus = $($(this).parent().siblings()[3]).text();
        var id = $(this).parent().siblings(":first").text();
        
        $("#status").html(currentStatus);
        $("#order_id").val(id);
    });

    $(".statusItem").on("click", function() {
        $("#status").html($(this).html());
    });
});

