jQuery(document).ready(function() {
    
    var table = $('#order-table-pending').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/orders/data/pending"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'stock', name: 'stock',
            render: function ( data, type, full, meta ) { 
                var buttons = '<span class="label label-success stockCell">Enough</span>';
                if (data == false) 
                    buttons = '<span class="label label-danger stockCell">NOT Enough</span>';
                
                return buttons;
            } },
            { data: 'type', name: 'type' },
            { name: 'name', data : 'name', searchable : false },
            { data: 'date', name: 'date' },
            { data: "Action", orderable: false,
            render: function ( data, type, full, meta ) { 
                var buttons = '<a  href="javascript:;" class="btn btn-info btn-xs view">View</a>'
                            + '<button type="button" style="margin-left:5px" class="btn btn-success btn-xs status" data-toggle="modal" data-target="#statusModal">Status</button>' ; 
                
                return buttons;
            } }
        ]
    });

    var tableSold = $('#order-table-sold').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/orders/data/sold"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'type', name: 'type' },
            { name: 'name', data : 'name', searchable : false },
            { data: 'date', name: 'date' },
            { data: "Action", orderable: false,
            render: function ( data, type, full, meta ) { 
                return '<a  href="javascript:;" class="btn btn-info btn-xs view">View</a>';
            } }
        ]
    });

    var tableCancelled = $('#order-table-cancelled').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/orders/data/cancelled"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'type', name: 'type' },
            { name: 'name', data : 'name', searchable : false },
            { data: 'date', name: 'date' },
            { data: "Action", orderable: false,
            render: function ( data, type, full, meta ) { 
                return '<a  href="javascript:;" class="btn btn-info btn-xs view">View</a>';
            } }
        ]
    });

    table.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/orders/view/" + id; 
    });

    tableSold.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/orders/view/" + id; 
    });

    tableCancelled.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/orders/view/" + id; 
    });

    table.on('click', '.status', function (e) {
        var stockCell = $($(this).parent().siblings()[1]).html();
        var id = $(this).parent().siblings(":first").text();

        if (stockCell.includes('NOT Enough'))
            $(".soldStatusItem").css("display", "none");
        else
            $(".soldStatusItem").css("display", "block");

        $("#status").html('Pending');
        $("#order_id").val(id);
    });

    $(".statusItem").on("click", function() {
        $("#status").html($(this).html());
    });

    $(".pTypeItem").on("click", function() {
        $("#payment_type").html($(this).html());
    });

    $("#submit").on('click', function() {
        var id = $("#order_id").val();

        var data = { 
            status: $("#status").html(),
            payment_type: $("#payment_type").html()
        };

        var result = validateStatusChange(data);

        if (!result.isValid) {
            alert(result.message);
            return false;
        }

        $.ajax({
            'url'  : '/orders/status/' + id,
            'type' : 'POST',
            'data' : data,
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                alert("Success!");
                //window.location.href = "/"; 
                window.location.href = "/orders"; 
            }
        });
    });
});

