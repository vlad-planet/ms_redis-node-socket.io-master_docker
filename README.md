microservices

# NodeJS Socket.io, Redis и PHP.

Для передачи данных сервером на php клиенту можно использовать следующий алгоритм:
1. Сервер php публикует данные в канал redis.
2. Сервер node подписывается на события в соответствующем канале redis, и при
   наступлении события поступления данных, публикует эти данные уже в
   socket.io
3. Клиент подписывается на сообщения socket.io и обрабатывает их при поступлении


Создадим каталог на локальном хосте и скопируем туда данный проект

```php
git clone https://github.com/vlad-planet/ms_redis-node-socket.io-master_docker
```

Установим сборку Docker

```php
docker-compose up -d
```

NodeJS: Перейдем в папку socket

```php
cd socket
```

Установим необходимые пакеты

```php
npm init -y
npm i -S socket.io redis express
```

Перезапустим докер

```php
docker-compose restart
```


Подключаемся к серверу redis

```php
docker-compose exec redis bash
```

Перейдем к командной строке. 'security' - пароль, который мы ранее задали в файле .env

```php
# redis-cli -a security
```

Подпишемся на канал 'information' который мы определили в файле www/public/info.php

```php
> subscribe information
```

Откроем сначала в браузере http://localhost:8000 <br>
Для демонстрации результата, нужно открыть панель разработчика в браузере *** 'console'

После чего опубликуем сообщение в Redis перейдя по адресу http://localhost:4400/info.php 

Опубликованное сообщение в Redis можно увидеть в консоле 'Shell'
```php
"{\"test\":\"success\"}"
```

Теперь перейдем на раннее открытую вкладку браузера *** 'console' <br>
и увидим полученное от Node сервера сообщение <br>
которое было взято у Redis при прослушки и отправлено через Soket.IO NodeJS
```php
{test: "success"}
```

если запросить несколько раз страницу http://localhost:4400/info.php <br>
то  в 'Shell' видно, как сообщения поступают в канал redis.

после чего передаются по Socket.IO, что видно в *** 'console' браузера

При передачи одним сервисом к другому, можно выполнять непосредственно определенные манипуляции.









