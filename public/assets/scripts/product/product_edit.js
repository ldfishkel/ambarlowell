jQuery(document).ready(function() {

    if ($("#fabricated").val() == 1)
        $("#fabricated").prop('checked', true);

    $("#fabricated").on("change", function() {
        if ($("#fabricated").val() == 0)
            $("#fabricated").val(1);
        else
            $("#fabricated").val(0);
    });


    $("form#data").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        
        var model = $("#model").val();
        var id = $("#id").val();

        $.ajax({
            url: '/products/images/' + model,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                alert("Success!");
                window.location.href = "/products/view/" + id; 
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $("#submit").on('click', function() {
       
        var id          = $("#id").val();
        var model       = $("#model").val();
        var description = $("#description").val();
        var fabricated  = $("#fabricated").val();
        var cost        = $("#cost").val();
        var wholesale   = $("#wholesale").val();
        var retail      = $("#retail").val();

        var data = {
            'id'         : id,
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
            'url'  : '/products/update/',
            'type' : 'PUT',
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

