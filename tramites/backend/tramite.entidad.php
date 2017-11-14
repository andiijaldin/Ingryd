<?php
class Tramite {

    private $tramiteID;
    private $nombre;
    private $descripcion;
    private $imagen;
    private $estado;
    private $categoriaID;
    private $institucionID;

    public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
} 
?>