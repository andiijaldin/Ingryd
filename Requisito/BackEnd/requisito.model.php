<?php
include("../Tramite/tramite.entidad.php");
class RequisitoModel
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

			$stm = $this->pdo->prepare("SELECT * FROM requisito where estado=1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Requisito();

				$alm->__SET('requisitoID', $r->requisitoID);
				$alm->__SET('nombreRequisito', $r->nombreRequisito);
				$alm->__SET('descripcion', $r->descripcion);
	

				$alm->__SET('tramiteID', $r->tramiteID);
				
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
			          ->prepare("SELECT * FROM requisito WHERE requisitoID = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Requisito();

			$alm->__SET('requisitoID', $r->requisitoID);
			$alm->__SET('nombreRequisito', $r->nombreRequisito);
			$alm->__SET('descripcion', $r->descripcion);
			$alm->__SET('tramiteID', $r->tramiteID);
		
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
			          ->prepare("UPDATE requisito SET estado=0
				    WHERE  requisitoID = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Requisito $data)
	{
		try 
		{
			$sql = "UPDATE requisito SET 
						nombreRequisito  = ?, 
						descripcion  = ?, 
						tramiteID  = ?, 
				    WHERE requisitoID = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
                    
					$data->__GET('nombreRequisito'),  
					$data->__GET('descripcion'),
					$data->__GET('tramiteID'),
                    $data->__GET('requisitoID')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Requisito $data)
	{
		try 
		{
		$sql = "INSERT INTO requisito (nombreRequisito,descripcion, tramiteID,estado) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				
				$data->__GET('nombreRequisito'),
				$data->__GET('descripcion'),
				$data->__GET('tramiteID'),
				$data->__GET('estado')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function LoadTramites()
	{
		try
		{
			$result = array();
			
						$stm = $this->pdo->prepare("SELECT tramiteID , nombreTramite FROM tramite");
						$stm->execute();
			
						foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
						{
							$alm = new Tramite();
							$alm->__SET('tramiteID', $r->tramiteID);
							$alm->__SET('nombreTramite', $r->nombreTramite);

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