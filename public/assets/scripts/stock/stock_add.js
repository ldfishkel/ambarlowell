jQuery(document).ready(function() {

    $("#submit").on('click', function() {
       
        var product_id  = $("#product_id").val();
        var amount      = $("#amount").val();
        var settlement  = $("#settlement").val();

        var data = {
            'amount'      : amount,
            'settlement'  : settlement
        };

        var result = validateStock(data);

        if (!result.isValid) {
            alert(result.message);
            return false;
        }

        $.ajax({
            'url'  : '/products/' + product_id + '/stock/create',
            'type' : 'POST',
            'data' : data,
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                alert("Success!");
                window.location.href = "/products/" + product_id + "/stock"; 
            }
        });
    });

});

