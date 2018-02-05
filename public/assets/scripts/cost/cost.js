jQuery(document).ready(function() {
    
    var table = $('#cost-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength : 25,
        ajax: { url : "/costs/data"},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'concept', name: 'concept' },
            { data: 'amount', name: 'amount' },
            { data: 'date', name: 'date' },
        ]
    });

    table.on('click', '.view', function (e) {
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/costs/view/" + id; 
    });
});

