jQuery(document).ready(function() {

    if(location.search.substr(1).split('=')[0] == 'addorder')
        $(".navbar-header").css('display', 'none');

    $("#fabricated").on("change", function() {
        if ($("#fabricated").val() == 0)
            $("#fabricated").val(1);
        else
            $("#fabricated").val(0);
    });

    $(".typeItem").on("click", function() {
        $("#type").html($(this).html());
    });

    var getTags = function() {
        var tags = [];

        $('#tag-table > tbody  > tr').each(function() {
            var id, name;
            
            $(this).find('td').each (function(e) {
                switch (e) {
                    case 0: id = $(this).html(); break;
                    case 1: name = $(this).html(); break;
                }
            });
            
            tags.push({ 
                'id' : id,
                'name' : name,
            });
        });

        return tags;
    };

    $("#submit").on('click', function() {
       
        var model       = $("#model").val();
        var description = $("#description").val();
        var fabricated  = $("#fabricated").val();
        var cost        = $("#cost").val();
        var wholesale   = $("#wholesale").val();
        var retail      = $("#retail").val();

        var data = {
            //'model'      : model,
            'type'       : $("#type").html(),
            'description': description,
            'fabricated' : fabricated,
            'cost'       : cost,
            'wholesale'  : wholesale,
            'retail'     : retail,
            'tags'       : getTags()
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
                
                var url = "/products/edit/" + response;

                if(location.search.substr(1).split('=')[0] == 'addorder')
                    url = url + '?addorder=1';

                window.location.href = url; 
            }
        });
    });

    $("#create_tag").on("click", function() {
        var data = { "name" : $("#q").val() };

        var result = validateTag(data);

        if (!result.isValid) {
            alert(result.message);
            return false;
        }

        $.ajax({
            'url'     : '/tags/create',
            'type'    : 'POST',
            'data'    : data,
            'headers' : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            'success' : function(response) {
                alert("Success!");
                $("#q").val("");
            }
        });
       
    });

    $("#tagsBody").on("click", ".remove", function () {
        var id = $(this).parent().siblings(":first").text();
        $("#row" + id).remove();
    });

    $('#q').autocomplete({
        source    : '/tags/search/autocomplete',
        minlenght : 1,
        autoFocus : true,
        select    : function(e, ui) {
            $("#tagsBody").append("" +
                "<tr id='row" + ui.item.id + "'>" +
                    "<td>" + ui.item.id + "</td>" +
                    "<td>" + ui.item.name + "</td>" +
                    "<td><a class='btn btn-danger btn-xs remove'>Remove</a></td>" +
                "</tr>");
            $("#q").val("");
            $("#q").html("");
            $("#q").text("");
            
        }
    });

});

