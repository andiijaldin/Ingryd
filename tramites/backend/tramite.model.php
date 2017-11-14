<?php
include_once 'tramite.entidad.php';

class TramiteModel {

	private $pdo;

	public function __CONSTRUCT() {

	    try{
			$this->pdo = new PDO('mysql:host=localhost;dbname=bddtramites','root','');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e){
			die($e->getMessage());
		}
		
	}

	public function Paginacion($pagina, $registrosPagina) {

		try{
			$empieza = ($pagina-1) * $registrosPagina;
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tramite WHERE estado=1 LIMIT $empieza,$registrosPagina");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){

				$alm = new Tramite();

                $alm->__SET('tramiteID', $r->tramiteID);
                $alm->__SET('nombre', $r->nombre);
                $alm->__SET('descripcion', $r->descripcion);
                $alm->__SET('imagen', $r->imagen);
                $alm->__SET('estado', $r->estado);
                $alm->__SET('categoriaID',$r->categoriaID);
                $alm->__SET('institucionID',$r->institucionID);

                $result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e){
			die($e->getMessage());
		}

	}
	public function Listar() {
		
				try{
				
					$result = array();
		
					$stm = $this->pdo->prepare("SELECT * FROM tramite WHERE estado=1");
					$stm->execute();
		
					foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
		
						$alm = new Tramite();
		
						$alm->__SET('tramiteID', $r->tramiteID);
						$alm->__SET('nombre', $r->nombre);
						$alm->__SET('descripcion', $r->descripcion);
						$alm->__SET('imagen', $r->imagen);
						$alm->__SET('estado', $r->estado);
						$alm->__SET('categoriaID',$r->categoriaID);
						$alm->__SET('institucionID',$r->institucionID);
		
						$result[] = $alm;
					}
		
					return $result;
				}
				catch(Exception $e){
					die($e->getMessage());
				}
		
	}
		
	public function Obtener($id) {

		try {
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tramite WHERE tramiteID = ?");
			          
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Tramite();

			$alm->__SET('tramiteID', $r->tramiteID);
			$alm->__SET('nombre', $r->nombre);
			$alm->__SET('descripcion', $r->descripcion);
			$alm->__SET('imagen', $r->imagen);
			$alm->__SET('estado', $r->estado);
			$alm->__SET('categoriaID',$r->categoriaID);
			$alm->__SET('institucionID',$r->institucionID);
		
			return $alm;

		} 
		catch (Exception $e) {
			die($e->getMessage());
		}
		
	}
		
}