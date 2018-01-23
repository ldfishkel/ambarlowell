jQuery(document).ready(function() {
    alert("hola!");
    var id = $("#product_id").val();

    var table = $('#stock-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url : "/products/" + id + "/stock/data"},
        columns: [
            { data: 'entrance', name: 'entrance' },
            { data: 'current', name: 'current' },
            { data: 'initial', name: 'initial' },
            { data: 'settlement', name: 'settlement' }
        ]
    });
});

