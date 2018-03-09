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
    })

});

