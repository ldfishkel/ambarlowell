jQuery(document).ready(function() {
    
    var creditors_table = $('#creditors-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength : 25,
        ajax: { url : "/credits/data"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'creditor', name: 'creditor' },
            { data: 'amount', name: 'amount' },
            { data: 'action', name: 'action', 
              render: function() { return '<span class="btn btn-xs btn-success payed">payed</span>'} },
        ]
    });

    creditors_table.on('click', '.payed', function (e) {
        var id = $(this).parent().siblings(":first").text();
        
        $.ajax({
            'url'  : '/credits/payed/' + id,
            'type' : 'PUT',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                alert("Success!");
                window.location.href = "/"; 
            }
        }); 
    });

    var debtors_table = $('#debtors-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength : 25,
        ajax: { url : "/debts/data"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'debtor', name: 'debtor' },
            { data: 'amount', name: 'amount' },
            { data: 'action', name: 'action', 
              render: function() { return '<span class="btn btn-xs btn-success payedd">payed</span>'} },
        ]
    });

    debtors_table.on('click', '.payedd', function (e) {
        var id = $(this).parent().siblings(":first").text();

        $.ajax({
            'url'  : '/debts/payed/' + id,
            'type' : 'PUT',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                alert("Success!");
                window.location.href = "/"; 
            }
        });
    });

    var requested_table = $('#requested-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength : 25,
        ajax: { url : "/requested/data"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'model', name: 'model' },
            { data: 'amount', name: 'amount' },
            { data: 'action', name: 'action', 
              render: function() { return '<span class="btn btn-xs btn-info view">view</span> <span style="margin-left:5px" class="btn btn-xs btn-danger stock">stock</span>'} },
        ]
    });

    requested_table.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/view/" + id; 
    });

    requested_table.on('click', '.stock', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/" + id +"/stock/"; 
    });

    $(".investorItem").on("click", function() {
        $("#investor").html($(this).html());
    })

    $("#submitInvestor").on("click", function() {

        var data = {
            'investor' : $("#investor").html(),
            'amount'   : $("#amount").val()
        };

        var result = validateInvestment(data);

        if (!result.isValid) {
            alert(result.message);
            return false;
        }

        $.ajax({
            'url'  : '/investments/add',
            'type' : 'POST',
            'data' : data,
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                alert("Success!");
                window.location.href = "/"; 
            }
        });
    });


});

