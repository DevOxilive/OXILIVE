<?php
class Notificacion
{
    private $title;
    private $text;

    public function __construct($title = 'oxilive', $text = 'Bienvenido al sistema!.')
    {
        $this->title = $title;
        $this->text = $text;
    }
    public function notificar()
    {
        $notificacion = '<script>
        Push.create("Oxilive: ' . $this->title . '", {
            body: "' . $this->text . '",
            timeout: 4000
        })
    </script>';
        return $notificacion;
    }
}
