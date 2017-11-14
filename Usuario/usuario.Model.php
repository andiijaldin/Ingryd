<?php
include("../Institucion/institucion.entidad.php");
class UsuarioModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
	try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=bddtramites', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM usuario where estado=1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Usuario();

				$alm->__SET('usuarioID', $r->usuarioID);
				$alm->__SET('tipoUsuario', $r->tipoUsuario);
				$alm->__SET('cargo', $r->cargo);
				$alm->__SET('nombres', $r->nombres);
				$alm->__SET('primerAp', $r->primerAp);
				$alm->__SET('segundoAp', $r->segundoAp);
				$alm->__SET('telefono', $r->telefono);
				$alm->__SET('correo', $r->correo);
				$alm->__SET('nombreUsuario', $r->nombreUsuario);
				$alm->__SET('password', $r->password);
				$alm->__SET('estado', $r->estado);
				$alm->__SET('institucionID', $r->institucionID);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuario WHERE usuarioID = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Usuario();

		
			$alm->__SET('usuarioID', $r->usuarioID);
			$alm->__SET('tipoUsuario', $r->tipoUsuario);
			$alm->__SET('cargo', $r->cargo);
			$alm->__SET('nombres', $r->nombres);
			$alm->__SET('primerAp', $r->primerAp);
			$alm->__SET('segundoAp', $r->segundoAp);
			$alm->__SET('telefono', $r->telefono);
			$alm->__SET('correo', $r->correo);
			$alm->__SET('nombreUsuario', $r->nombreUsuario);
			$alm->__SET('password', $r->password);
			$alm->__SET('estado', $r->estado);
			$alm->__SET('institucionID', $r->institucionID);
		
			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{



		try 
		{
			$stm = $this->pdo
			          ->prepare("UPDATE usuario SET 
					 
						    estado   = 2
				    WHERE  UsuarioID = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Usuario $data)
	{
		try 
		{
			$sql = "UPDATE usuario SET 
						tipoUsuario      = ?, 
						cargo            = ?,
						nombres          = ?,
						primerAp         = ?,
						segundoAp        = ?,
						telefono         = ?,
						correo           = ?,
						nombreUsuario    = ?,
						password         = ?,
						estado           = ?,
						institucionID    = ?
				    WHERE usuarioID  = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
                    
					
					$data->__GET('tipoUsuario'), 
					$data->__GET('cargo'),
					$data->__GET('nombres'),
					$data->__GET('primerAp'),
					$data->__GET('segundoAp'),
					$data->__GET('telefono'),
					$data->__GET('correo'),
					$data->__GET('nombreUsuario'),
					$data->__GET('password'),
					$data->__GET('estado'),
					$data->__GET('institucionID'),
					$data->__GET('usuarioID') 
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{
		try 
		{
		   $sql = "INSERT INTO Usuario (tipoUsuario,cargo,nombres,primerAp,segundoAp,telefono,correo,nombreUsuario,password,estado,institucionID) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('tipoUsuario'), 
				$data->__GET('cargo'),
                $data->__GET('nombres'),
                $data->__GET('primerAp'),
                $data->__GET('segundoAp'),
                $data->__GET('telefono'),
                $data->__GET('correo'),
                $data->__GET('nombreUsuario'),
                $data->__GET('password'),
                $data->__GET('estado'),
                $data->__GET('institucionID')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function LoadInstitucion()
	{
		try
		{
			$result = array();
			
						$stm = $this->pdo->prepare("SELECT * FROM Institucion");
						$stm->execute();
			
						foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
						{
							$alm = new Institucion();
							$alm->__SET('institucionID', $r->institucionID);
							$alm->__SET('tipoInstitucion', $r->tipoInstitucion);

							$result[] = $alm;
						}
			
						return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}

	}
}