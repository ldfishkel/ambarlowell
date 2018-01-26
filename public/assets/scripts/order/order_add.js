jQuery(document).ready(function() {
   
    var clean = function() {
        $("#p").val("");
        $("#product_id").val("");
        $("#model").val("");
        $("#description").val("");
        $("#wholesale").val("");
        $("#retail").val("");
        $("#amount").val("");
        $("#stock").val("");
        $("#unit_price").val("");
        $("#unit_price").prop("disabled", true);
        $("#amount").prop("disabled", true);
        $("#add_item").addClass("disabled");
        $("#clean_item").addClass("disabled");
    }

    var items_order = function() {
        var items = [];

        $('#product-table > tbody  > tr').each(function() {
            var product_id, amount, unit_price;
            
            $(this).find('td').each (function(e) {
                switch (e) {
                    case 0: product_id = $(this).html(); break;
                    case 2: amount     = $(this).html(); break;
                    case 3: unit_price = $(this).html(); break;
                }
            });
            
            items.push({ 
                'product_id' : product_id,
                'amount' : amount,
                'unit_price' : unit_price
            });
        });

        return items;
    }

    var fields = function() {
        var client = null;
        
        if ($("#client_id").val() != "")
            client = { 'client_id' : $("#client_id").val() };
        else
            client = { 
                'name'     : $("#name").val(),
                'email'    : $("#email").val(),
                'phone'    : $("#phone").val(),
                'instagram': $("#instagram").val(),
                'facebook' : $("#facebook").val(),
                'address'  : $("#address").val(),
            }

        var type = $("#type").html();

        var items = items_order();

        return { client : client, items : items, type : type };
    }

    $(".typeItem").on("click", function() {
        $("#type").html($(this).html());
    });

    $("#clean_item").on("click", function() {
        clean();
    });

    $('#p').autocomplete({
      source : '/products/search/autocomplete',
      minlenght: 1,
      autoFocus: true,
      select: function(e,ui){
        $("#product_id").val(ui.item.id);
        $("#model").val(ui.item.model);
        $("#description").val(ui.item.description);
        $("#wholesale").val(ui.item.wholesale);
        $("#retail").val(ui.item.retail);
        $("#stock").val(ui.item.stock);
        $("#amount").val(1);
        $("#unit_price").val(ui.item.retail);
        $("#description").prop("disabled", true);
        $("#model").prop("disabled", true);
        $("#wholesale").prop("disabled", true);
        $("#retail").prop("disabled", true);
        $("#unit_price").prop("disabled", false);
        $("#amount").prop("disabled", false);
        $("#add_item").removeClass("disabled");
        $("#clean_item").removeClass("disabled");
      }
    });
    
    $("#itemsBody").on("click", ".remove", function () {
        var id = $(this).parent().siblings(":first").text();
        $("#row" + id).remove();
    });

    $("#add_item").on("click", function() {
        var exists = false;

         $('#product-table > tbody  > tr').each(function() {
            $(this).find('td').each (function(e) {
                if (e == 0 && parseInt($(this).html()) == parseInt($("#product_id").val())) 
                    exists = true;
            });
        });

        if (exists === false) 
            $("#itemsBody").append("" +
                "<tr id='row" + $("#product_id").val() +"'>" +
                    "<td>" + $("#product_id").val() + "</td>" +
                    "<td>" + $("#model").val() + "</td>" +
                    "<td>" + $("#amount").val() + "</td>" +
                    "<td>" + $("#unit_price").val() + "</td>" +
                    "<td><a class='btn btn-danger btn-xs remove'>Remove</a></td>" +
                "</tr>");
        
        clean();
    });

    $("#submit").on('click', function() {

        var data = fields();

        console.log(data);

        var result = validateOrder(data);

        if (!result.isValid) {
            alert(result.message);
            return false;
        }

        $.ajax({
            'url'  : '/orders/create',
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

});

