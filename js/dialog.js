//Ширина от экрана, пригодится
//var dialog_width = screen.width / 100 * 60;

//Создаем диалог, пока только для админки
function success(result, width, name) {
    var dialog_name = eval(name);
    dialog_name.dialog({
        resizable: true,
        width: width,
        modal: true,
        hide: 'fade',
        buttons: {
            "Закрыть": function () {
                $(this).dialog("close");
                location.reload();
                //$(name).show();
            }
        }
    });
}
//Диалоги для магазина, окрываются сразу
function shopDailog(width, name) {
    var title_dialog = $(name).find("#title").val();
    console.log(name);
    console.log(title_dialog);
    $(name).dialog({
        resizable: true,
        width: width,
        title: title_dialog,
        modal: true,
        buttons: {
            Отмена: function () {
                $(this).dialog("close");
            }
        }
    });
}

function shopResultDailog(width, name) {
    //var title_dialog = $(name).find("#title").val();
    console.log(name);
    //console.log(title_dialog);
    $(name).dialog({
        resizable: true,
        width: width,
        //title: title_dialog,
        modal: true,
        buttons: {
            Отмена: function () {
                $(this).dialog("close");
            }
        }
    });
}/*
function qwe() {
    $(".extension_check").click(function () {
        console.log('asdawd');
    });
}*/

$(document).ready(function () {
    //Админка
    //Диалог добавления сервера
    $(".open_server").click(function () {
        $(".delete_server").show();
        $(".create_server").show();
        $(".delete_type").hide();
        $(".create_type").hide();
        $(".create_priv_for_servers").hide();
        $(".relations").hide();

    });
    //Диалог добавления услуги
    $(".open_priv").click(function () {
        $(".delete_type").show();
        $(".create_type").show();
        $(".delete_server").hide();
        $(".create_server").hide();
        $(".create_priv_for_servers").hide();
        $(".relations").hide();
    });
    //Диалог добавления услуги к серверу
    $(".open_priv_for_servers").click(function () {
        $(".create_priv_for_servers").show();
        $(".delete_server").hide();
        $(".create_server").hide();
        $(".delete_type").hide();
        $(".create_type").hide();
        $(".relations").hide();
    });
    //Диалог общий - список серверов\услуг\стоимости
    //Список всего, что имеется
    $(".open_relations").click(function () {
        $(".relations").show();
        $(".delete_server").hide();
        $(".create_server").hide();
        $(".delete_type").hide();
        $(".create_type").hide();
        $(".create_priv_for_servers").hide();
    });
});