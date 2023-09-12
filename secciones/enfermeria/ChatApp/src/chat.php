<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // este metodo indica que se abre la conexión con un cliente o que se conecto uno
        $this->clients->attach($conn);

        echo "Nueva conexión! ({$conn->resourceId})\n";
    }

    /**
     * aqui se captura el mensaje y se envia por la consola pero aun queda pendiente como voy a almacenar
     * mensajes pero para eso se hizo el chat de simulacion.
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf(
            'cliente %d Enviando mensaje "%s" a %d otro cliente %s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        /**
         * aqui se envia el mensaje de cliente a cliente que se encuentre conectado al mismo canal o puerto y se cuenta cuantos clientes están
         */
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    /**
     * aquí unicamente se indica que se a cerrado la conexión entre el cliente
     */
    public function onClose(ConnectionInterface $conn)
    {

        $this->clients->detach($conn);

        echo "Cliente {$conn->resourceId} se a desconectado\n";
    }

    /**
     * si no se logra conectar o sucede algo (error pues se envia a la consola).
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "a ocurrido un error: {$e->getMessage()}\n";

        $conn->close();
    }
}
