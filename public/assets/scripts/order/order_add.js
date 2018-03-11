jQuery(document).ready(function() {
    
    var tablePFManagement = function()
    {
        var tablePF = function()
        {
            var self = {
                table : null,

                init : function()
                {
                    var oTable = $('#product-table-pf').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: { url : "/products/data/pf"},
                        pageLength : 100,
                        columns: [
                            { data: 'image', name: 'image',
                                render: function ( data, type, full, meta ) { 

                                     var img = '<p id="prod_' + full.id + '" style="float:left;width:65%" class="image productImage">'+ full.description +'</p>' 
                                    + '<button id="edit_' + full.id + '" style="display:block;float:right;width:35%" class="btn btn-md btn-success addImage">Add Image</button>'
                                    if (data && data != '') 
                                        img = '<img width="255px" id="prod_'+ full.id +'" class="productImage" src="/assets/img/'+ data +'"">';
                                    
                                    img = img + "<input type='hidden' class='productData prod_"+ full.id +"' value='" + JSON.stringify(full) + "'>" ;

                                    return img;
                                }
                            }
                        ]
                    });

                    oTable.on("click", ".addImage", function() {
                        $("#closePF").click();
                        document.getElementById("newIframe").src = "/products/" + $(this).attr("id").replace('_', '/') + "?addorder=1";
                        setTimeout(function() {
                            $("#addNew").click();
                        }, 250);
                    });

                    oTable.on("click", ".productImage", function() {
        
                        console.log($(this).attr("id"));
                        var data = JSON.parse($("." + $(this).attr("id")).val());

                        $("#product_id").val(data.id);
                        $("#model").val(data.model);
                        $("#description").val(data.description);
                        $("#wholesale").val(data.wholesale);
                        $("#retail").val(data.retail);
                        $("#amount").val(1);
                        $("#unit_price").val(data.retail);
                        $("#description").prop("disabled", true);
                        $("#model").prop("disabled", true);
                        $("#wholesale").prop("disabled", true);
                        $("#retail").prop("disabled", true);
                        $("#unit_price").prop("disabled", false);
                        $("#amount").prop("disabled", false);
                        $("#add_item").removeClass("disabled");
                        $("#clean_item").removeClass("disabled");
                        if (data.image && data.image != '')
                            $("#imgHolder").html('<img width="255px" src="/assets/img/'+ data.image +'"">');
                        else
                            $("#imgHolder").html('<img width="100px" class="image" src="https://www.google.com.ar/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png">');
                        
                        $("#closePF").click();
                        setTimeout(function() {$("#itemsList").click();}, 250);
                        
                    });

                    self.table = oTable;

                } 
            };

            self.init();

            return self;
        }

        var tablePI = function()
        {
            var self = {
                table : null,

                init : function()
                {
                    var oTable = $('#product-table-pi').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: { url : "/products/data/pi"},
                        pageLength : 100,
                        columns: [
                            { data: 'image', name: 'image',
                                render: function ( data, type, full, meta ) { 

                                     var img = '<p id="prod_' + full.id + '" style="float:left;width:65%" class="image productImage">'+ full.description +'</p>' 
                                    + '<button id="edit_' + full.id + '" style="display:block;float:right;width:35%" class="btn btn-md btn-success addImage">Add Image</button>'
                                    if (data && data != '') 
                                        img = '<img width="255px" id="prod_'+ full.id +'" class="productImage" src="/assets/img/'+ data +'"">';
                                    
                                    img = img + "<input type='hidden' class='productData prod_"+ full.id +"' value='" + JSON.stringify(full) + "'>" ;

                                    return img;
                                }
                            }
                        ]
                    });

                    oTable.on("click", ".addImage", function() {
                        $("#closePI").click();
                        document.getElementById("newIframe").src = "/products/" + $(this).attr("id").replace('_', '/') + "?addorder=1";
                        setTimeout(function() {
                            $("#addNew").click();
                        }, 250);
                    });

                    oTable.on("click", ".productImage", function() {
        
                        console.log($(this).attr("id"));
                        var data = JSON.parse($("." + $(this).attr("id")).val());

                        $("#product_id").val(data.id);
                        $("#model").val(data.model);
                        $("#description").val(data.description);
                        $("#wholesale").val(data.wholesale);
                        $("#retail").val(data.retail);
                        $("#amount").val(1);
                        $("#unit_price").val(data.retail);
                        $("#description").prop("disabled", true);
                        $("#model").prop("disabled", true);
                        $("#wholesale").prop("disabled", true);
                        $("#retail").prop("disabled", true);
                        $("#unit_price").prop("disabled", false);
                        $("#amount").prop("disabled", false);
                        $("#add_item").removeClass("disabled");
                        $("#clean_item").removeClass("disabled");
                        if (data.image && data.image != '')
                            $("#imgHolder").html('<img width="255px" src="/assets/img/'+ data.image +'"">');
                        else
                            $("#imgHolder").html('<img width="100px" class="image" src="https://www.google.com.ar/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png">');
                        
                        $("#closePI").click();
                        setTimeout(function() {$("#itemsList").click();}, 250);
                        
                    });

                    self.table = oTable;

                } 
            };

            self.init();

            return self;
        }

        var tableAC = function()
        {
            var self = {
                table : null,

                init : function()
                {
                    var oTable = $('#product-table-ac').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: { url : "/products/data/ac"},
                        pageLength : 100,
                        columns: [
                            { data: 'image', name: 'image',
                                render: function ( data, type, full, meta ) { 

                                     var img = '<p id="prod_' + full.id + '" style="float:left;width:65%" class="image productImage">'+ full.description +'</p>' 
                                    + '<button id="edit_' + full.id + '" style="display:block;float:right;width:35%" class="btn btn-md btn-success addImage">Add Image</button>'
                                    if (data && data != '') 
                                        img = '<img width="255px" id="prod_'+ full.id +'" class="productImage" src="/assets/img/'+ data +'"">';
                                    
                                    img = img + "<input type='hidden' class='productData prod_"+ full.id +"' value='" + JSON.stringify(full) + "'>" ;

                                    return img;
                                }
                            }
                        ]
                    });

                    oTable.on("click", ".addImage", function() {
                        $("#closeAC").click();
                        document.getElementById("newIframe").src = "/products/" + $(this).attr("id").replace('_', '/') + "?addorder=1";
                        setTimeout(function() {
                            $("#addNew").click();
                        }, 250);
                    });

                    oTable.on("click", ".productImage", function() {
        
                        console.log($(this).attr("id"));
                        var data = JSON.parse($("." + $(this).attr("id")).val());

                        $("#product_id").val(data.id);
                        $("#model").val(data.model);
                        $("#description").val(data.description);
                        $("#wholesale").val(data.wholesale);
                        $("#retail").val(data.retail);
                        $("#amount").val(1);
                        $("#unit_price").val(data.retail);
                        $("#description").prop("disabled", true);
                        $("#model").prop("disabled", true);
                        $("#wholesale").prop("disabled", true);
                        $("#retail").prop("disabled", true);
                        $("#unit_price").prop("disabled", false);
                        $("#amount").prop("disabled", false);
                        $("#add_item").removeClass("disabled");
                        $("#clean_item").removeClass("disabled");
                        if (data.image && data.image != '')
                            $("#imgHolder").html('<img width="255px" src="/assets/img/'+ data.image +'"">');
                        else
                            $("#imgHolder").html('<img width="100px" class="image" src="https://www.google.com.ar/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png">');
                        
                        $("#closeAC").click();
                        setTimeout(function() {$("#itemsList").click();}, 250);
                        
                    });

                    self.table = oTable;

                } 
            };

            self.init();

            return self;
        }

        var tableAB = function()
        {
            var self = {
                table : null,

                init : function()
                {
                    var oTable = $('#product-table-ab').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: { url : "/products/data/ab"},
                        pageLength : 100,
                        columns: [
                            { data: 'image', name: 'image',
                                render: function ( data, type, full, meta ) { 

                                    var img = '<p id="prod_' + full.id + '" style="float:left;width:65%" class="ifloat:left;mage productImage">'+ full.description +'</p>' 
                                    + '<button id="edit_' + full.id + '" style="display:block;float:right;width:35%" class="btn btn-md btn-success addImage">Add Image</button>'
                                    if (data && data != '') 
                                        img = '<img width="255px" id="prod_'+ full.id +'" class="productImage" src="/assets/img/'+ data +'"">';
                                    
                                    img = img + "<input type='hidden' class='productData prod_"+ full.id +"' value='" + JSON.stringify(full) + "'>" ;

                                    return img;
                                }
                            }
                        ]
                    });

                    oTable.on("click", ".addImage", function() {
                        $("#closeAB").click();
                        document.getElementById("newIframe").src = "/products/" + $(this).attr("id").replace('_', '/') + "?addorder=1";
                        setTimeout(function() {
                            $("#addNew").click();
                        }, 250);
                    });

                    oTable.on("click", ".productImage", function() {
        
                        console.log($(this).attr("id"));
                        var data = JSON.parse($("." + $(this).attr("id")).val());

                        $("#product_id").val(data.id);
                        $("#model").val(data.model);
                        $("#description").val(data.description);
                        $("#wholesale").val(data.wholesale);
                        $("#retail").val(data.retail);
                        $("#amount").val(1);
                        $("#unit_price").val(data.retail);
                        $("#description").prop("disabled", true);
                        $("#model").prop("disabled", true);
                        $("#wholesale").prop("disabled", true);
                        $("#retail").prop("disabled", true);
                        $("#unit_price").prop("disabled", false);
                        $("#amount").prop("disabled", false);
                        $("#add_item").removeClass("disabled");
                        $("#clean_item").removeClass("disabled");
                        if (data.image && data.image != '')
                            $("#imgHolder").html('<img width="255px" src="/assets/img/'+ data.image +'"">');
                        else
                            $("#imgHolder").html('<img width="100px" class="image" src="https://www.google.com.ar/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png">');
                        
                        $("#closeAB").click();
                        setTimeout(function() {$("#itemsList").click();}, 250);
                        
                    });

                    self.table = oTable;

                } 
            };

            self.init();

            return self;
        }

        var self = {

            tablePF     : tablePF(),
            tablePI     : tablePI(),
            tableAC     : tableAC(),
            tableAB     : tableAB(),
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
            }

        };
        
        self.init();

        return self;
    }();


    $(".close").on("click", function() {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove(); 
    });

    $("#myModal").on("hidden.bs.modal", function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

    $("#myModal2").on("hidden.bs.modal", function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

    $("#closeNew").on("click", function() {
        document.getElementById("newIframe").src = "/products/add?addorder=1";
    });

    $("#pfSearch").on("click", function() {
        tablePFManagement.tablePF.table.ajax.reload();
    });

    $("#piSearch").on("click", function() {
        tablePFManagement.tablePI.table.ajax.reload();
    });

    $("#acSearch").on("click", function() {
        tablePFManagement.tableAC.table.ajax.reload();
    });

    $("#abSearch").on("click", function() {
        tablePFManagement.tableAB.table.ajax.reload();
    });

    var clean = function() {
        $("#p").val("");
        $("#product_id").val("");
        $("#model").val("");
        $("#description").val("");
        $("#wholesale").val("");
        $("#retail").val("");
        $("#amount").val("");
        $("#stock").val("");
        $("#comment").val("");
        $("#unit_price").val("");
        $("#unit_price").prop("disabled", true);
        $("#amount").prop("disabled", true);
        $("#add_item").addClass("disabled");
        $("#clean_item").addClass("disabled");
        $("#imgHolder").html("");
    }

    var items_order = function() {
        var items = [];

        $('#product-table > tbody  > tr').each(function() {
            var product_id, amount, unit_price, comment;
            
            $(this).find('td').each (function(e) {
                switch (e) {
                    case 0: product_id = $(this).html(); break;
                    case 2: amount     = $(this).html(); break;
                    case 3: unit_price = $(this).html(); break;
                    case 4: comment    = $(this).html(); break;
                }
            });
            
            items.push({ 
                'product_id' : product_id,
                'amount' : amount,
                'unit_price' : unit_price,
                'comment' : comment,

            });
        });

        return items;
    }

    var fields = function() {
        var client = null;
        var fabricator = null;

        if ($('#fabricator').text() != 'Fabricator')
            fabricator = $('#fabricator').text();

        var channel = null;

        if ($('#channel').text() != 'Channel')
            channel = $('#channel').text();
        
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

        return { client : client, fabricator : fabricator, channel : channel, items : items, type : type };
    }

    $(".typeItem").on("click", function() {
        $("#type").html($(this).html());
    });

    $(".channelItem").on("click", function() {
        $("#channel").html($(this).html());
    });

    $(".fabricatorItem").on("click", function() {
        $("#fabricator").html($(this).html());
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
        if (ui.item.image && ui.item.image != '')
            $("#imgHolder").html('<img width="255px" src="/assets/img/'+ ui.item.image +'"">');
        else
            $("#imgHolder").html('<img width="100px" class="image" src="https://www.google.com.ar/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png">');
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
                    "<td>" + $("#comment").val() + "</td>" +
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

