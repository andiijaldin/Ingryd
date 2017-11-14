<?php

class Categoria
{
	private $categoriaID;
	private $nombre;
	private $estado;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}


