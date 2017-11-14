<?php
class Institucion
{
	
    private $institucionID;
    private $tipoInstitucion;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}