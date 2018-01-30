jQuery(document).ready(function() {
    
    $('#p').autocomplete({
        source : '/suppliers/search/autocomplete',
        minlenght: 1,
        autoFocus: true,
        select: function(e, ui) {
            $("#supplier_id").val(ui.item.id);
            $("#supplier_info").val(ui.item.value);
            $("#supplier_info").prop("disabled", true);
        }
    });

    $(".typeItem").on("click", function() {
        $("#type").html($(this).html());
    })

    $("#clean_supplier").on("click", function() {
        $('#p').val("");
        $("#supplier_info").val("");
        $("#supplier_info").prop("disabled", false);
    });

    var fields = function() {
        var supplier = null;
        
        if ($("#supplier_id").val() != "")
            supplier = { id : $("#supplier_id").val() };
        else
            supplier = { info : $("#supplier_info").val() };

        var type = $("#type").html();
        var concept = $("#concept").val();
        var amount = $("#amount").val();

        return { 
            supplier : supplier, 
            type     : type, 
            concept  : concept, 
            amount   : amount, 
        };
    }

    $("#submit").on("click", function() {
        var data = fields();

        var result = validateCost(data);

        if (!result.isValid) {
            alert(result.message);
            return false;
        }

        $.ajax({
            'url'  : '/costs/create',
            'type' : 'POST',
            'data' : data,
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                alert("Success!");
                window.location.href = "/costs"; 
            }
        });
    });
});

