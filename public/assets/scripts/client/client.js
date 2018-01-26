jQuery(document).ready(function() {
    $("#clean_client").on("click", function() {
        $("#q").val("");
        $("#client_id").val("");
        $("#email").val("");
        $("#name").val("");
        $("#phone").val("");
        $("#instagram").val("");
        $("#facebook").val("");
        $("#address").val("");
        $("#client_id").prop("disabled", false);
        $("#email").prop("disabled", false);
        $("#name").prop("disabled", false);
        $("#phone").prop("disabled", false);
        $("#instagram").prop("disabled", false);
        $("#facebook").prop("disabled", false);
        $("#address").prop("disabled", false);
    });

    $('#q').autocomplete({
      source : '/clients/search/autocomplete',
      minlenght:1,
      autoFocus:true,
      select:function(e,ui){
        $("#client_id").val(ui.item.id);
        $("#email").val(ui.item.email);
        $("#name").val(ui.item.name);
        $("#phone").val(ui.item.phone);
        $("#instagram").val(ui.item.instagram);
        $("#facebook").val(ui.item.facebook);
        $("#address").val(ui.item.address);
        $("#client_id").prop("disabled", true);
        $("#email").prop("disabled", true);
        $("#name").prop("disabled", true);
        $("#phone").prop("disabled", true);
        $("#instagram").prop("disabled", true);
        $("#facebook").prop("disabled", true);
        $("#address").prop("disabled", true);
      }
    });
});

