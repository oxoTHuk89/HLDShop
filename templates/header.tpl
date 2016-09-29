<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <title>Game Nation</title>
    <link rel="shortcut icon" href='http://g-nation.ru/favicon.ico'/>
    <link rel="image_src" href='http://g-nation.ru/public/style_images/g_nation/meta_image.png'/>
    <meta property="og:title" content="Game Nation"/>
    <meta property="og:site_name" content="Game Nation"/>
    <meta name="description"
          content="Портал одного из лучших серверов России. Захватывающая и популярная action - игра Сounter-Strike. Вашему вниманию предоставлена информация о сервере, его возможностях, а так же спец.темы для ваших вопросов и пожеланий. Адекватное и понимающее руководство."/>
    <meta property="og:description"
          content="Портал одного из лучших серверов России. Захватывающая и популярная action - игра Сounter-Strike. Вашему вниманию предоставлена информация о сервере, его возможностях, а так же спец.темы для ваших вопросов и пожеланий. Адекватное и понимающее руководство."/>
    <meta name="keywords" content="Counter Strike, cs 16, контра, скачать контру"/>
    <meta property="og:image" content="http://g-nation.ru/public/style_images/g_nation/meta_image.png"/>
    <!-- jQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <!-- jQuery -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <!-- Custom -->
    <!-- <script src="js/script.js"></script> -->
    <script src="js/script_new.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/function.js"></script>
    <script src="js/dialog.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <!-- Если админка -->
    {*{if $admin}
        <link rel="stylesheet" href="css/admin.css">
        <script src="js/script.js"></script>
        <script src="js/admin.js"></script>
    {/if}*}
    <!-- Custom -->
    <!-- Вконтакте -->
    <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
    <!-- Вконтакте -->
</head>
{*if !$admin*}
    {*include file="body.tpl" title=foo*}
{*/if*}
{*include file="result.tpl" title=foo*}