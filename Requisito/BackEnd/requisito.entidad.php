<?php
class Requisito
{
	private $requisitoID;
	private $nombreRequisito;
	private $descripcion;
	private $tramiteID;
	private $estado;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}