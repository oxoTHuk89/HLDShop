###Выкачиваем репу и переименовываем .env
```shell
git clone git@gitlab.ilp-crm.ru:solutions/middleware-docker.git
cd  project_dir
mv _.env .env
```
###Запускаем контейнер, потомстопаем, выставляем права на папку logs для postgres`а
```shell
docker-compose up --build
sudo chmod -R 0777 .docker/logs
```

###Устанавливаем сам проект
    cd src/backend
###Думаю, надо удалить из гита папку сразу
    sudo rm -r current

###Выкачиваем проект и сразу же переключаемся на ветку  refactoring
```shell
git clone git@gitlab.ilp-crm.ru:solutions/middleware.git current
cd current
git checkout refactor
sudo cp -R vendor-patch/cebe vendor/
````
###Перезагружаем контейнер
```shell
cd docker_root_dir
docker-compose up --build
docker-compose exec middleware-php bash
Внутри докера идем в папку проекта
cd current/src
```
###Добавляем наш композер (надо будет наверно просто в composer.json добавить, и запускать просто composer install)
```shell
composer require pcs-platform/api:dev-master; composer require pcs-platform/bpmn:dev-master; composer require pcs-platform/cdp-profiles:dev-master; composer require pcs-platform/connect:dev-master; composer require pcs-platform/example-module:dev-master; composer require pcs-platform/gui-data:dev-master; composer require pcs-platform/gui-user:dev-master; composer require pcs-platform/ml:dev-master; composer require pcs-platform/sc-settings:dev-master; composer require pcs-platform/tenant-magnit:dev-master;
```
```shell
cd ../../
```
###В system.json убедиться что база данных соответствует - "database": "postgres"
```shell
mkdir shared/config/tenant
cp shared/config/manage.json shared/config/tenant/my_project.json
```
###Переименовать название БД в файле, и создать БД на базе
####Накатываем голый дамп
```shell
php artisan migrations:createDatabase --code my_project --force true
 ```
####Накатываем миграции(с этим надо разобраться, таблицы дублируются)
```shell
php artisan migrations:ListAllPresets --code t:my_project | egrep '/manage|/common' | egrep "system-init" | bash -
php artisan migrations:ListAllPresets --code t:my_project | egrep '/common' | egrep -v "system-init" | bash -
php artisan migrations:ListAllPresets --code t:my_project | egrep '/manage' | egrep -v "system-init" | bash -
php artisan migrations:ListAllPresets --code t:my_project | egrep '/tenant' | bash -
```
	
####Генерируем OpenAPI - тут вроде как для всех проектов одно и то же генерируется
	php artisan migrations:generateOpenAPI --code t:my_project
	
####Создаем юзера. Так же можно "обнулить" уже существющего
	php artisan migrations:createGUIUser --code t:my_project  --type=test --email aa@aa.aa

Для теста, логинимся через Postman по примеру:
[https://ilp-solutions.postman.co/workspace/Team-Workspace~a8a29016-bed4-4f32-8999-c7cd781882f8/request/12941287-81ca03af-987a-46f2-8927-fffae90af6b3](https://ilp-solutions.postman.co/workspace/Team-Workspace~a8a29016-bed4-4f32-8999-c7cd781882f8/request/12941287-81ca03af-987a-46f2-8927-fffae90af6b3)	
	
