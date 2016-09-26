{include file="header.tpl" title=foo}
<body>
<input type="button" class="open_server" value="Управление серверами"><br>
<input type="button" class="open_priv" value="Добавить новую услугу"><br>
<input type="button" class="open_priv_for_servers" value="Добавить услугу на сервер"><br>
<input type="button" class="open_relations" value="Редактировать связки сервер\услуга"><br>
<!---Добавление серверов--->
<form class="delete_server">
    <table class="table">
        <tr>
            <th colspan="2">Удалить сервер</th>
        <tr>
            <td><label for="server">Выберите сервер: </label></td>
            <td>
            <select name="server" class="server" id="server">
                {foreach $servers as $server}
                    <option value="{$server.id}">{$server.servername}</option>
                {/foreach}
            </select>
            </td>
        </tr>
        <tr>
            <td class="" colspan="2">
                <input type="hidden" name="del_srv" class="del_srv" value="1">
                <input type="button" class="del_srv" value="Удалить">
            </td>
        </tr>
    </table>
</form>
<form class="create_server">
    <table class="table">
        <tr>
            <th colspan="2">Добавить сервер</th>
        <tr>
        <tr>
            <th class="">
                <label for="serverip">IP: </label>
            </th>
            <td>
                <input type="text" name="serverip" id="serverip">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="serverpost">PORT: </label>
            </th>
            <td>
                <input type="text" name="serverpost" id="serverpost">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="servername">Название: </label>
            </th>
            <td>
                <input type="text" name="servername" id="servername">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="servertype">Тип: </label>
            </th>
            <td>
                <select name="servertype" id="servertype">
                    {foreach $games as $game}
                        <option value="{$game.id}">{$game.fullname}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="serverdesc">Описание: </label>
            </th>
            <td>
                <input type="text" name="serverdesc" id="serverdesc">
            </td>
        </tr>
        <tr>
            <td class="" colspan="2">
                <input type="hidden" name="add_srv" value="1">
                <input type="button" class="add_srv" value="Добавить сервер">
            </td>
        </tr>
    </table>
</form>
<!---КОНЕЦ Добавление серверов--->
<!---Добавление услуг--->
<form class="delete_type">
    <table class="table">
        <tr>
            <th colspan="2">Удалить услугу</th>
        <tr>
            <td><label for="type">Выберите сервер: </label></td>
            <td>
                <select name="type" class="type" id="type">
                    {foreach $types as $type}
                        <option value="{$type.id}">{$type.name}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td class="" colspan="2">
                <input type="hidden" name="del_priv" class="del_priv" value="1">
                <input type="button" class="del_priv" value="Удалить">
            </td>
        </tr>
    </table>
</form>
<form class="create_type">
    <table class="table">
        <tr>
            <th colspan="2">Добавить услугу</th>
        <tr>
        <tr>
            <th class="">
                <label for="type">Название: </label>
            </th>
            <td>
                <input type="text" name="type" id="type">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="flags">Флаги: </label>
            </th>
            <td>
                <input type="text" name="flags" id="flags">
            </td>
        </tr>
        <tr>
            <th class="">
                <label for="visibility">Видимость: </label>
            </th>
            <td>
                <input type="checkbox" name="visibility" id="visibility">
            </td>
        </tr>
        <tr>
            <td class="" colspan="2">
                <input type="hidden" name="add_priv" value="1">
                <input type="button" class="add_priv" value="Добавить сервер">
            </td>
        </tr>
    </table>
</form>
<!---КОНЕЦ Добавление серверов--->
<!---Добавление услуг--->
<!---Добавление услуг к серверу--->
<form class="create_priv_for_servers">
    <table class="table">
        <tr>
            <td class="">
                <label for="serverlist">Cервер: </label>
            </td>
            <td class="">
                <select name="serverlist" id="serverlist">
                    {foreach $servers as $server}
                        <option value={$server.id}>{$server.servername}</option>
                    {/foreach}
                </select>
            </td>
            <td class="">
                <label for="typelist">Услуги: </label></td>
            <td class="">
                <select name="typelist" id="typelist">
                    {foreach $types as $type}
                        <option value={$type.id}>{$type.name}</option>
                    {/foreach}
                </select>
            </td>
            <td>
                <label for="cost">
                    <input name="cost" type="text" class="cost">
                </label>
            </td>

            <td class="">
                <input type="hidden" name="add_priv_to_server" value="1">
                <input type="button" class="add_priv_to_server" value="Добавить услугу">
            </td>
        </tr>
    </table>
</form>
<!---Конец Добавление услуг к серверу--->
<!---Список всего, что имеется с возможностью редактирования цены и удаления--->
<form class="relations">
    <table class="table">
        <tr>
            <th class="">Cервер:</th>
            <th class="">Услуги</th>
            <th class="" colspan="2">Стоимость:</th>
        </tr>
        {foreach $existing as $existing_each}
            <tr>
                <td class="">
                    {$existing_each.server_name}
                    <input type="hidden" name="server_id" class="server_id" value="{$existing_each.server_id}">
                </td>
                <td class="">
                    {$existing_each.type}
                    <input type="hidden" name="type" class="type" value="{$existing_each.type_id}">
                </td>
                <td class="">
                    <label for="cost">
                        <input type="text" name="cost" class="cost" value="{$existing_each.cost}">
                    </label>
                </td>

                <td class="">
                    <input type="hidden" name="save_cost" value="1">
                    <input type="button" class="save_cost" value="Сохранить цену">
                </td>
                <td class="">
                    <input type="hidden" name="delete_relations" value="1">
                    <input type="button" class="delete_relations" value="Удалить связку">
                </td>
            </tr>
        {/foreach}
    </table>
</form>
<!---КОНЕЦ Список всего, что имеется с возможностью редактирования цены и удаления--->
<div id="result"></div>

