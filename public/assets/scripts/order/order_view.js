jQuery(document).ready(function() {
   
   $(".model").on("click", function(e){
        var id = $(this).parent().siblings(":first").text();
        window.location.href = "/products/view/" + id; 
   });

});

