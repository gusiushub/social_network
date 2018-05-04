<?php
namespace MyApp;
//use Ratchet\MessageComponentInterface;
//use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {
        foreach ($this->clients as $client)
        {
            if($conn !== $client)
                $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
?>
    server.php

    <?php
//use Ratchet\Server\IoServer;
//use Ratchet\Http\HttpServer;
//use Ratchet\WebSocket\WsServer;
//use MyApp\Chat;

require dirname(__DIR__) . '/Ratchet/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();
?>