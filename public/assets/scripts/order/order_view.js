jQuery(document).ready(function() {
   
   $(".model").on("click", function(e){
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/view/" + id; 
   });

   $(".addComment").on("click", function(e) {
        var id = $(this).parent().siblings(":first").text();
        $("#product_id").val(id);
   });

   $("#add_comment").on("click", function(e) {
        e.preventDefault();    

        var splitted = window.location.pathname.split('/');

        var order_id = splitted[splitted.length -1];
        var product_id = $("#product_id").val();
        var comment = $("#comment").val();
        
        var data = { 
            "comment"    : comment, 
            "product_id" : product_id, 
            "order_id"   : order_id
        };

         $.ajax({
            'url'  : '/orders/comment',
            'type' : 'PUT',
            'data' : data,
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success' : function(response) {
                alert("Success!");
                window.location.href = "/orders/view/" + order_id; 
            }
        });
   });

});

