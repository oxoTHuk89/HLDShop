$(document).ready(function () {
    //Объявляем общие vars
    var unban = ".unban";
    var zakyp = ".zakyp";
    var res_zakyp = ".res";

    var extension = ".extension";
    var extension_res = ".extension_res";
    var result = ".result";
    var error = "";

    //Кнопки "Назад"
    $(res_zakyp).find("#back").click(function () {
        $(res_zakyp).hide();
        $(zakyp).find("table").show();
    });

    $("#username_ressult").find("#back").click(function () {
        $("#username_ressult").hide();
        $("#extension").find("table").show();
    });

    /*Вконтакте*/
    $("#vk_auth").click(function () {
        VK.Auth.login(authInfo);
    });
    VK.init({
        apiId: 3997841
    });
    function authInfo(response) {
        if (response.session) {
            $(".tr_vk").find(".td_l").html("<a target='_blank' href=https://vk.com/id" + response.session.mid + ">https://vk.com/id" + response.session.mid + "</a>");
            $("#vk_auth_hidden").val("https://vk.com/id" + response.session.mid);
        } else {
            alert('not auth');
        }
    }

    /*Вконтакте*/
    //UI-Dialog открываем диалоговые окошки

    //Магазин
    $("#open_zakyp").click(function () {
        var width = 550;
        shopDailog(width, zakyp);
    });
    //Разбан
    $("#open_unban").click(function () {
        var width = 550;
        shopDailog(width, unban);
    });
    //Продление
    $("#open_extension").click(function () {
        var width = 550;
        shopDailog(width, extension);
        console.log(extension);
    });

    //По смене сервера меняем список услуг магия.
    //У каждого сервера может быть свой список улуг, котоый формируется по отправке этого аякса

    $(zakyp).find("#servers").change(function () {
        $(zakyp).find("#steamid").hide(); //Заранее скрываем поле стим ид. Если будет сурс, то покажем
        $(zakyp).find("#types").empty(); //Чистим список привилегий. По умолчанию все, при выборе, только нужные
        $(zakyp).find("#steamid_val").val(''); //Чистим поле стимид. Чтобы не было конфликтов при переназначении

        var data = {
            'serverid': $(zakyp).find("#servers").val(),
            'priv_update': true
        };
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: 'JSON',
            data: data,
            beforeSend: function () {
                // Handle the beforeSend event
            },
            success: function (json) {
                $(zakyp).find("#types").find("option").remove();
                /**
                 * @param {{server_type:string}} server_type
                 * @param {{type_id:number}} type_id
                 */
                $.each(json, function (name, value) {
                    //Если тип игры сурс, показываем поле со стимид
                    if (value.server_type == "source") {
                        $(zakyp).find("#steamid").show();
                    }
                    $(zakyp).find("#types").append("<option value=" + value.type_id + ">" + value.type + "</option>");
                });

            },
            complete: function () {
                // Handle the complete event
            },
            error: function (xhr, ajaxOptions, thrownError) {
                ajax_error();
            }
        });
    });
    //Вели данные на странице магазина, разбираем\посылаем
    $("#accept").click(function () {
        var data = {
            'serverid': $(zakyp).find("#servers").val(),
            'types': $(zakyp).find("#types").val(),
            'username': $(zakyp).find("#username").val(),
            'password': $(zakyp).find("#password").val(),
            'steamid_val': $(zakyp).find("#steamid_val").val(), //Если выбран halflife, будет пустой
            'days_val': $(zakyp).find("#days").val(),
            'days': $(zakyp).find("#days  :selected").text(),
            'currency': $(zakyp).find("#currency").val(),
            'vk_link': $(zakyp).find("#vk_auth_hidden").val(),
            'game': $(zakyp).find("#servers  :selected").attr("game"),
            'accept': true
        };
        //Проверочки на обязательные поля
        if (data.serverid == "" ||
            data.types == "" ||
            data.username == "" ||
            data.password == "" ||
            data.days_val == "" ||
            data.currency == "" ||
            data.vk_id == "" ||
            data.game == "") {
            error = "Заполните все поля";
        }
        //Если CS:GO - STEAM_ID обязательный
        console.log(data);
        if (data.game == "source" && data.steamid_val == "") {
            error = "STEAM_ID не заполнено";
        }
        if (data.username.length <= 2) {
            error = "Никнейм слишком короткий";
        }
        if (error) {
            alert(error);
        }
        //Ошибок нет?! Тогда пойдём в пых! Ajax отправит все в таблицу pay_log и заполнит result.tpl
        //Так же заполнит данными форму для мерчанта
        else {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: data,
                success: function (json) {
                    console.log(json);
                    $(zakyp).find("table").hide();
                    $(zakyp).html(json);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    ajax_error();
                }
            });
        }
    });
    //Поиск бана


    $("#search_steam .for_select").mouseover(function () {
        $(this).css("background-color", "rgb(176, 178, 178);");
    });
    $("#search_steam .for_select").mouseout(function () {
        $(this).css("background-color", "#FFF;");
    });
    $("#find_username").click(function () {
        data = {
            'username': $(unban).find("#username").val(),
            'serverid': $(unban).find("#servers").val(),
            'game': $(unban).find("#servers  :selected").val(),
            'find_username': 1
        };
        if (data.username == "" || typeof data.game === "undefined") {
            var error = "Заполните все поля";
        }
        if (error) {
            alert(error);
        }
        //Ошибок нет?! Тогда пойдём в пых! Ajax найдет все баны на сурсе или кстрайк и заполнит result.tpl
        //В щаблон попадет список забаненых попадающие под критерии
        else {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: data,
                success: function (json) {
                    $(unban).find("#reslut").show();
                    $(unban).find("table").hide();
                    $(unban).html(json);
                    //$("#unban_reslut").html(json);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(ajaxOptions);
                    console.log(thrownError);
                }
            });
        }
    });


    $("#username_check").click(function () {
        var data = {
            'game': $(extension).find("#games").val(),
            'username': $(extension).find("#username").val(),
            'password': $(extension).find("#password").val(),
            'currency': $(extension).find("#currency").val(),
            'username_check': 1
        };

        if (data.username == "" || data.password == "") {
            var error = "Заполните все поля";
        }
        if (error) {
            alert(error);
        }
        else {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: data,
                success: function (json) {
                    console.log(json);
                    //$("#main-page").remove();
                    $(extension).html(json);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    ajax_error();
                }
            });
        }
    });
    $("body").on("click", ".extension_check", function () {

        var data = {
            'admin_id': $(this).parent().find(".admin_id").val(),
            'shop_srv_id': $(this).parent().find(".shop_srv_id").val(),
            'pay_type': $(this).parent().find(".pay_type").val(),
            'cost': $(this).parent().find(".cost").val(),
            'game': $(this).parent().find(".game").val(),
            'currency': $(this).parent().find(".currency").val(),
            'extension_check': 1
        };
        var submit = $(this).closest("form");

        if (
            typeof(data.admin_id) == "undefined" ||
            typeof(data.shop_srv_id) == "undefined" ||
            typeof(data.pay_type) == "undefined" ||
            typeof(data.cost) == "undefined") {
            var error = "Что-то пошло не так. Попробуйте снова";
            return false;
        }
        if (error) {
            alert(error);
        }
        else {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: data,
                success: function (json) {
                    console.log(json);
                    $("#merchnt_submit").html(json);
                    $(extension).html(json);
                    //$("#merchnt_submit form").submit();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    ajax_error();
                }
            });
        }
    });


    $(function () {
        $("#accordion").accordion({
            collapsible: true
        });
    });

});


