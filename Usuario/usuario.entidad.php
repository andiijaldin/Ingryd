<?php
class Usuario
{
	private $usuarioID;
	private $tipoUsuario;
    private $cargo;
    private $nombres;
    private $primerAp; 
	private $segundoAp;
    private $telefono;
    private $correo;
    private $nombreUsuario;
    private $password;
    private $estado;
    private $institucionID;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}