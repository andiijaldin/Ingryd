<?php
class CategoriaModel
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

			$stm = $this->pdo->prepare("SELECT * FROM categoria where estado=1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Categoria();

				$alm->__SET('categoriaID', $r->categoriaID);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('estado', $r->estado);

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
			          ->prepare("SELECT * FROM categoria WHERE categoriaID = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Categoria();

			$alm->__SET('categoriaID', $r->categoriaID);
			$alm->__SET('nombre', $r->nombre);
			$alm->__SET('estado', $r->estado);
		
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
			          ->prepare("UPDATE categoria SET 
					 
						estado        = 2
				    WHERE  categoriaID = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Categoria $data)
	{
		try 
		{
			$sql = "UPDATE categoria SET 
						nombre          = ?, 
						estado        = ?
				    WHERE categoriaID = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
                    
					$data->__GET('nombre'),  
					$data->__GET('estado'),
                    $data->__GET('categoriaID')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Categoria $data)
	{
		try 
		{
		$sql = "INSERT INTO categoria (nombre,estado) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'), 
				$data->__GET('estado')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}