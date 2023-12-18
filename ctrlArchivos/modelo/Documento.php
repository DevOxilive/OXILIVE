<?php
class Documento
{
    private $nombre;
    private $archivo;
    private $ruta;
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getarchivo()
    {
        return $this->archivo;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;
    }

    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    }
}
?>