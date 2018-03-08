jQuery(document).ready(function() {
    var index = 0;
    
    $(".items img:eq(" + index + ")").removeClass("hidden");

    $("#prev").on("click", function() {
        if (index == 0)
            return;

        index--;
        $(".items img:eq(" + (index + 1) + ")").addClass("hidden");
        $(".items img:eq(" + index + ")").removeClass("hidden");

    });

    $("#next").on("click", function() {
        console.log($(".items img").length - 1);
        console.log(index);
        if (index == ($(".items img").length - 1))
            return;

        index++;
        $(".items img:eq(" + (index - 1) + ")").addClass("hidden");
        $(".items img:eq(" + index + ")").removeClass("hidden");
    });

});

