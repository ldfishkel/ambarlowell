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



});

