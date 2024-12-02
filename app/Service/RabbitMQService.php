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

    //консьюмер для отправки писем на почту
    public function consumeMail(callable $callback)
    {
        $channel = $this->connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }

    //консьюмер для доски жалоб в yougile
    public function consumeReport(callable $callback)
    {
        $channel = $this->connection->channel();
        $channel->queue_declare('yougile', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $channel->basic_consume('yougile', '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }

    //консьюмер для доски проблем в yougile
    public function consumeProblem(callable $callback)
    {
        $channel = $this->connection->channel();
        $channel->queue_declare('yougile', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $channel->basic_consume('yougile', '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
