var name = '$("#result").html(result)';

$(document).ready(function () {
    //Удаляем сервак
    $(".del_srv").click(function () {
        var server = $(".server").val();
        var del_srv = $(".del_srv").val();
        var data = {
            server: server,
            del_srv: del_srv
        };
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            dataType: 'JSON',
            data: data,
            success: function (json) {
                console.log(json);
                var width = 550;
                success(json, width, name); //Данные, которые пришли после обработки, ширина будущего диалога
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //ajax_error();
                console.log(thrownError);
            }
        });
    });
    //Удаляем сервак
    //Добавляем сервак
    $(".add_srv").click(function () {
        var data = $(".create_server :input").serializeArray();
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            dataType: 'JSON',
            data: data,
            success: function (json) {
                if (json.error != "")  var json = json.error;
                else var json = json.existing;
                var width = 550;
                success(json, width, name); //Данные, которые пришли после обработки, ширина будущего диалога
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //ajax_error();
                console.log(thrownError);
            }
        });
    });
    //Добавили сервак
    //Удаляем услугу
    $(".del_priv").click(function () {
        var type = $(".type").val();
        var del_priv = $(".del_priv").val();
        var data = {
            type: type,
            del_priv: del_priv
        };
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            dataType: 'JSON',
            data: data,
            success: function (json) {
                console.log(json);
                var width = 550;
                success(json, width, name); //Данные, которые пришли после обработки, ширина будущего диалога
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //ajax_error();
                console.log(thrownError);
            }
        });
    });
    //Удаляем услугу
    //Добавляем услугу
    $(".add_priv").click(function () {
        var data = $(".create_type").serializeArray();
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            dataType: 'JSON',
            data: data,
            success: function (json) {
                var width = 550;
                success(json, width, name); //Данные, которые пришли после обработки, ширина будущего диалога
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //ajax_error();
                console.log(thrownError);
            }
        });
    });
    //Добавили услугу
    //Добавляем услугу на сервак
    $(".add_priv_to_server").click(function () {
        var data = $(".create_priv_for_servers").serializeArray();
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            dataType: 'JSON',
            data: data,
            success: function (json) {
                var width = 550;
                success(json, width, name); //Данные, которые пришли после обработки, ширина будущего диалога
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    //Добавили услугу на сервак

    $(".save_cost").click(function () {
        var server_id = $(this).parent().parent().find(".server_id").val();
        var type = $(this).parent().parent().find(".type").val();
        var cost = $(this).parent().parent().find(".cost").val();

        var data = {
            'server_id': server_id,
            'type': type,
            'cost': cost,
            'relations': 1,
            'save_cost': 1
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            dataType: 'JSON',
            data: data,
            success: function (json) {
                var width = 550;
                success(json, width, name); //Данные, которые пришли после обработки, ширина будущего диалога
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.status);
                console.log(thrownError);
            }
        });
    });

    $(".delete_relations").click(function () {
        var server_id = $(this).parent().parent().find(".server_id").val();
        var type = $(this).parent().parent().find(".type").val();
        var cost = $(this).parent().parent().find(".cost").val();

        var data = {
            'server_id': server_id,
            'type': type,
            'cost': cost,
            'relations': 1,
            'delete_relations': 1
        };
        $.ajax({
            type: "POST",
            url: "admin_ajax.php",
            dataType: 'JSON',
            data: data,
            success: function (json) {
                var width = 550;
                success(json, width, name); //Данные, которые пришли после обработки, ширина будущего диалога
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.status);
                console.log(thrownError);
            },
            complete: function(){
                $(".relations").show();
            }
        });

    });
});
