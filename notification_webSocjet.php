<?php
require 'vendor/autoload.php';

use Ratchet\Client\WebSocket;
use Ratchet\Client\Connector;
use React\EventLoop\Factory;

function sendNotification($message) {
    $loop = Factory::create();
    $connector = new Connector($loop);
    $connector('ws://localhost:8081')->then(function(WebSocket $conn) use ($message) {
        $conn->send($message);
        $conn->close();
    }, function($e) {
        echo "Could not connect: {$e->getMessage()}\n";
    });

    $loop->run();
}

sendNotification('alerta con WebSocket');       
?>
