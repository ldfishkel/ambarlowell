jQuery(document).ready(function() {
    
    var table = $('#order-table-pending').DataTable({
        processing: true,
        serverSide: true,
        pageLength : 100,
        ajax: { url : "/orders/data/pending"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'date', name: 'date',
            render: function ( data, type, full, meta ) { 
                var buttons = '<span class="label label-success stockCell">' + data + '</span>';
                if (full.stock == false) 
                    buttons = '<span class="label label-danger stockCell">' + data + '</span>';
                
                return buttons;
            } },
            { name: 'name', data : 'name', searchable : false },
            { data: "Action", orderable: false,
            render: function ( data, type, full, meta ) { 
                var fabricator = full.fabricator;
                if (fabricator == null)
                    fabricator = 'Fabricator';

                var buttons = '<a  href="javascript:;" class="btn btn-info btn-xs view">View</a>'
                            + '<div style="margin-left:5px; display:inline" class="dropdown">'
                            +        '<button class="btn btn-danger btn-xs" type="button" data-toggle="dropdown"><span id="fabricator_' + full.id + '">' + fabricator + '</span>'
                            +        '<span class="caret"></span></button>'
                            +        '<ul class="dropdown-menu">'
                            +            '<li><a class="fabricatorItem_' + full.id + '">Pela</a></li>'
                            +            '<li><a class="fabricatorItem_' + full.id + '">Felix</a></li>'
                            +        '</ul>'
                            +    '</div>'
                            + '<button type="button" style="margin-left:5px" class="btn btn-success btn-xs ready" data-toggle="modal" data-target="#readyModal">Ready</button>' ; 
                
                $(".fabricatorItem_" + full.id ).on("click", function() {
                    $("#fabricator_" + full.id).html($(this).html());
                    
                    var data = { 
                        "fabricator"    : $(this).html(), 
                        "order_id"   : full.id
                    };

                     $.ajax({
                        'url'  : '/orders/fabricator',
                        'type' : 'PUT',
                        'data' : data,
                        'headers': {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        'success' : function(response) {
                            alert("Success!");
                        }
                    });
                });
                return buttons;
            } }
        ]
    });

    var tableReady = $('#order-table-ready').DataTable({
        processing: true,
        serverSide: true,
        pageLength : 100,
        ajax: { url : "/orders/data/ready"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'date', name: 'date',
            render: function ( data, type, full, meta ) { 
                var buttons = '<span class="label label-success stockCell">' + data + '</span>';
                if (full.stock == false) 
                    buttons = '<span class="label label-danger stockCell">' + data + '</span>';
                
                return buttons;
            } },
            { name: 'name', data : 'name', searchable : false },
            { data: "Action", orderable: false,
            render: function ( data, type, full, meta ) { 
                var fabricator = full.fabricator;
                if (fabricator == null)
                    fabricator = 'Fabricator';

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

    tableReady.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/orders/view/" + id; 
    });

    tableCancelled.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/orders/view/" + id; 
    });

    table.on('click', '.ready', function (e) {
        var id = $(this).parent().siblings(":first").text();
        $("#order_id").val(id);
    });

    tableReady.on('click', '.status', function (e) {
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
                window.location.href = "/orders"; 
            }
        });
    });

    $("#submitReady").on("click", function() {
        var id = $("#order_id").val();

        $.ajax({
            'url'  : '/orders/ready/' + id,
            'type' : 'PUT',
            'data' : {},
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                alert("Success!");
                window.location.href = "/orders"; 
            }
        });
    });
});

