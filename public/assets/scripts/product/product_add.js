jQuery(document).ready(function() {

    $("#fabricated").on("change", function() {
        if ($("#fabricated").val() == 0)
            $("#fabricated").val(1);
        else
            $("#fabricated").val(0);
    });

    $("#submit").on('click', function() {
       
        var model       = $("#model").val();
        var description = $("#description").val();
        var fabricated  = $("#fabricated").val();
        var cost        = $("#cost").val();
        var wholesale   = $("#wholesale").val();
        var retail      = $("#retail").val();

        var data = {
            'model'      : model,
            'description': description,
            'fabricated' : fabricated,
            'cost'       : cost,
            'wholesale'  : wholesale,
            'retail'     : retail,
        };

        var result = validateProduct(data);

        if (!result.isValid) {
            alert(result.message);
            return false;
        }

        $.ajax({
            'url'  : '/products/create',
            'type' : 'POST',
            'data' : data,
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                alert("Success!");
                window.location.href = "/products"; 
            }
        });
    });

});

