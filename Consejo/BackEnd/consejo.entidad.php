<?php
class Consejo
{
	private $consejoID;
	private $descripcion;
    private $idUsuarioFacebook;
    private $tramiteID;
	private $requisitoID;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}