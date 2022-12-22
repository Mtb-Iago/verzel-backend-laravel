# API LARAVEL

## ETAPAS
* Executar o docker
`````
docker-compose up --build
`````
``````
docker-compose start
``````
* Entrar na bash container 
* Renomei o arquivo <b>.env.example</b> PARA <b>.env</b>

````
docker exec -it {nome_do_container OU id_do_container APP} /bin/bash
````

* Na bash do container INSTALAR as depedências com composer
``````
composer install
``````
* Executar as migrates para gerar o BD já com um usuário Admin padrão
``````
php artisan migrate --seed
``````
###### * Usuario Padrão:
``````
Email: admin@gmail.com
Password: 123
``````
*  Criar o link simbólico da pasta storage (Para acessar as imagens via link)
``````
php artisan storage:link
``````

## Extras
* URL BASE 
``````
http://localhost:8989/api/
``````

* Para importar os endpoints e configurações de parâmetros para o <b>INSOMNIA</b> basta importar o arquivo <b>Insomnia_2022-12-21.har</b>

<br>
<br>
<br>
<br>
<br>

#
###### Desenvolvido por <b>Iago Oliveira 2022





