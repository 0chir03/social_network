<?php

namespace App\Service;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    private AMQPStreamConnection $connection;
    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'rmuser', 'rmpassword');
    }

    public function produce(string $queue, string $data)
    {
        $channel = $this->connection->channel();
        $channel->queue_declare($queue, false, false, false, false);

        $msg = new AMQPMessage($data);

        $channel->basic_publish($msg, '', $queue);
    }

    public function consume(string $queue, callable $callback)
    {
        $channel = $this->connection->channel();

        $channel->queue_declare($queue, false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $channel->basic_consume($queue, '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
