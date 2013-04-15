<?php
// /Applications/MAMP/bin/php/php5.3.14/bin/php /Users/cel/Desktop/QuModules/web/server.php
$id = '46.16.58.120'; $port = '9000';
//$id = '127.0.0.1'; $port = '9000';

chdir(dirname(__DIR__));
// Setup autoloading
if (file_exists('server/vendor/autoload.php')){
    $loader = include 'server/vendor/autoload.php';
}

use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use React\EventLoop\Factory;
use React\Socket\Server as Reactor;

class Chat implements MessageComponentInterface {

    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }
    public function onOpen(ConnectionInterface $conn){
        $this->clients->attach($conn);
        foreach($this->clients as $client){
            $client->send('{id:"'.$client->resourceId.'",msg:"'.'clients|'.count($this->clients).'"}');
        }
    }
    public function onMessage(ConnectionInterface $from, $msg){
        //$numR = count($this->clients) - 1;
        //echo sprintf('Jo %d envio "%s" a %d' . "\n", $from->resourceId, $msg, $numR);
        foreach($this->clients as $client){
            if($from !== $client){
                $client->send('{id:"'.$client->resourceId.'",msg:"'.$msg.'"}');
            }
        }
    }
    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
    function getSubProtocols()
    {

    }
}

    echo 'v2'."\n";

    $loop    = Factory::create();
    $webSock = new Reactor($loop);

    try{
        $webSock->listen($port,$id);
        echo 'CONNETD';
    }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }

    $webServer = new IoServer(new WsServer(new Chat()),$webSock);

    $loop->run();