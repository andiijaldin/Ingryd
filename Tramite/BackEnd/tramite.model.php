<?php
include("../Institucion/institucion.entidad.php");
include("../Categoria/categoria.entidad.php");
class TramiteModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
	try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=tramites', 'root', '');
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

			$stm = $this->pdo->prepare("SELECT * FROM tramite where estado=1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Tramite();

				$alm->__SET('tramiteID', $r->tramiteID);
				$alm->__SET('nombreTramite', $r->nombreTramite);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('estado', $r->estado);
				$alm->__SET('categoriaID', $r->categoriaID);
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
			          ->prepare("SELECT * FROM tramite WHERE tramiteID = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Categoria();

			$alm->__SET('tramiteID', $r->tramiteID);
			$alm->__SET('nombreTramite', $r->nombreTramite);
			$alm->__SET('descripcion', $r->descripcion);
			$alm->__SET('estado', $r->estado);
			$alm->__SET('categoriaID', $r->categoriaID);
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
			          ->prepare("UPDATE tramite SET 
					 
						estado        = 0
				    WHERE  tramiteID = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Tramite $data)
	{
		try 
		{
			$sql = "UPDATE tramite SET 
						nombreTramite = ?,
	 descripcion = ?,
	 estado = ?

				    WHERE tramiteID = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
				
					$data->__GET('nombreTramite'),
					$data->__GET('descripcion'),
					$data->__GET('estado'),
					$data->__GET('tramiteID')
				//	$data->__GET('categoriaID'),
				//	$data->__GET('institucionID')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Tramite $data)
	{
		try 
		{
		$sql = "INSERT INTO tramite (nombreTramite,descripcion,estado,categoriaID,institucionID) 
		        VALUES (?, ?,  ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombreTramite'),
				$data->__GET('descripcion'),
		
				$data->__GET('estado'),
				$data->__GET('categoriaID'),
				$data->__GET('institucionID')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	public function LoadInstituciones()
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

	public function LoadCategorias()
	{
		try
		{
			$result = array();
			
						$stm = $this->pdo->prepare("SELECT categoriaID, nombre FROM categoria");
						$stm->execute();
			
						foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
						{
							$alm = new Categoria();
							$alm->__SET('categoriaID', $r->categoriaID);
							$alm->__SET('nombre', $r->nombre);

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