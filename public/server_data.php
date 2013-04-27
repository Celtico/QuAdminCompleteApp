<?php


    // /Applications/MAMP/bin/php/php5.3.14/bin/php /Users/cel/Desktop/QuModules/web/server_data.php
    // /Applications/MAMP/bin/php/php5.4.4/bin/php /Users/cel/Desktop/QuModules/composer.phar update

    // cd /Users/cel/Desktop/QuModules
    // /Applications/MAMP/bin/php/php5.4.4/bin/php composer.phar update

    $id = '46.16.58.120'; $port = '9000';
    //$id = '127.0.0.1'; $port = '9000';

    chdir(dirname(__DIR__));

    // Setup autoloading
    require 'init_autoloader.php';

    use Ratchet\Server\IoServer;
    use Ratchet\WebSocket\WsServer;
    use React\EventLoop\Factory;
    use React\Socket\Server as Reactor;
    use QuChat\Server\QuChatData;

    echo 'v10'."\n";

    $loop    = Factory::create();
    $webSock = new Reactor($loop);

    try{
        $webSock->listen($port,$id);
        echo 'CONNETD';
    }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }

    $webServer = new IoServer(new WsServer(new QuChatData()),$webSock);

    $loop->run();