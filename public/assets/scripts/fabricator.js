jQuery(document).ready(function() {
    var index = 0;
    $(".items .itemContainer:eq(" + index + ")").removeClass("hidden");

    $("#prev").on("click touch", function() {
        if (index == 0)
            return;

        index--;
        $(".items .itemContainer:eq(" + (index + 1) + ")").addClass("hidden");
        $(".items .itemContainer:eq(" + index + ")").removeClass("hidden");

    });


    $("#next").on("click touch", function() {
        if (index == ($(".items .itemContainer").length - 1))
            return;

        index++;
        $(".items .itemContainer:eq(" + (index - 1) + ")").addClass("hidden");
        $(".items .itemContainer:eq(" + index + ")").removeClass("hidden");
    });

    $(".view").on("click", function() {
        window.location.href = "/" + $(this).attr("id").split('_').join('/'); 
    });

    $(".product").on("click", function() {
        window.location.href = "/" + $(this).attr("id").split('_').join('/'); 
    });

    $("#products").on("click", function(e) {
        e.preventDefault();
        window.location.href = "/products";
    });

    $("#costs").on("click", function(e) {
        e.preventDefault();
        window.location.href = "/costs";
    });

    $(".finished").on("click", function() {
        $("#item_id").val($(this).attr("id").split("_")[1]);
    });

    $(".delayed").on("click", function() {
        $("#item_id").val($(this).attr("id").split("_")[1]);
    });

    var finished = function(data)
    {
        $.ajax({
            'url'  : '/orders/item/finished',
            'type' : 'PUT',
            'data' : data,
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                window.location.href = "/"; 
            }
        });
    }

    $("#submitWithStock").on("click", function() {
        var data = {
            'id' : $("#item_id").val(),
            'stock' : true 
        };

        finished(data);
    });

    $("#submitWithoutStock").on("click", function() {
       var data = {
            'id' : $("#item_id").val(),
            'stock' : false 
        };

        finished(data); 
    });

    $("#submitDelayed").on("click", function() {
        var data = {
            'id' : $("#item_id").val(),
            'delayed_comment' : $("#delayed_reason").val() 
        };

        $.ajax({
            'url'  : '/orders/item/delayed',
            'type' : 'PUT',
            'data' : data,
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                window.location.href = "/"; 
            }
        });
    });

    $(".continue").on("click", function() {
        var data = {
            'id' : $(this).attr("id").split("_")[1]
        };

        $.ajax({
            'url'  : '/orders/item/continue',
            'type' : 'PUT',
            'data' : data,
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                window.location.href = "/"; 
            }
        });
    });

});

