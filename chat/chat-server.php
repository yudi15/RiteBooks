<?php
require '../vendor/autoload.php'; // Ensure this path is correct

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class Chat implements MessageComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onClose(ConnectionInterface $conn) {
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Message from {$from->resourceId}: $msg\n";
        // Broadcast message to all clients
        foreach ($from->httpRequest->getServerParams()['SERVER_ADDR'] as $client) {
            if ($client !== $from) {
                $client->send($msg);
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = IoServer::factory(
    new WsServer(
        new Chat()
    ),
    8080 // Port number, change this if needed
);

echo "WebSocket server running on ws://localhost:8080\n";
$server->run();
