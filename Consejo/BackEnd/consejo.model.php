<?php
class ConsejoModel
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

			$stm = $this->pdo->prepare("SELECT * FROM consejo");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Categoria();

				$alm->__SET('consejoID', $r->consejoID);
                $alm->__SET('descripcion', $r->descripcion);
                $alm->__SET('idUsuarioFacebook', $r->idUsuarioFacebook);
                $alm->__SET('tramiteID', $r->tramiteID);
				$alm->__SET('requisitoID', $r->requisitoID);

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
			          ->prepare("SELECT * FROM consejo WHERE consejoID = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Categoria();

			$alm->__SET('consejoID', $r->consejoID);
            $alm->__SET('descripcion', $r->descripcion);
            $alm->__SET('idUsuarioFacebook', $r->idUsuarioFacebook);
            $alm->__SET('tramiteID', $r->tramiteID);
            $alm->__SET('requisitoID', $r->requisitoID);
		
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
			          ->prepare("DELETE FROM consejo
				    WHERE  consejoID = ?");			          

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
			$sql = "UPDATE consejo
                    SET
                    descripcion = ?,
                    WHERE consejoID = ?";
                    




			$this->pdo->prepare($sql)
			     ->execute(
				array(
     
                    $data->__GET('descripcion')

					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Consejo $data)
	{
		try 
		{
		$sql = 
            "INSERT INTO consejo
            (descripcion,
            idUsuarioFacebook,
            tramiteID,
            requisitoID)
            VALUES
            (
            ?,
            ?,
            ?,
            ?)";
                

		$this->pdo->prepare($sql)
		     ->execute(
			array(
                $data->__GET('descripcion'),
                $data->__GET('idUsuarioFacebook'),
                $data->__GET('tramiteID'),
                $data->__GET('requisitoID')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}