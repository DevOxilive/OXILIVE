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
        $notificacion = "
        <script>
            Push.create('Sistema: " . $this->text . "' {
                body: '$this->title',
                timeout: 4000
            });
        </script>
        ";
        return $notificacion;
    }
}
 