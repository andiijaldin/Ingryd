<?php

include_once 'tramites/backend/tramite.entidad.php';
include_once 'tramites/backend/tramite.model.php';


function ListarTramites(){

    $tramiteModel = new TramiteModel();
    $tramites=$tramiteModel->Listar();

    $i=1;

    foreach($tramites as $r){

        if($i==3){
            echo '<div class="product_box no_margin_right">';
            echo '<h3>'.$r->__GET('nombre').'</h3>';
            echo '<a href="#"><img src="'.$r->__GET('imagen').'" alt="Shoes 1" /></a>';
            echo '<p>'.$r->__GET('descripcion').'</p>';
            echo '<a href="#" class="addtocart"></a>';
            echo '<a href="productdetail.html" class="detail"></a>';
            echo '</div>';
            $i=0;
        }
        else{
            echo '<div class="product_box">';
            echo '<h3>'.$r->__GET('nombre').'</h3>';
            echo '<a href="#"><img src="'.$r->__GET('imagen').'" alt="Shoes 1" /></a>';
            echo '<p>'.$r->__GET('descripcion').'</p>';
            echo '<a href="#" class="addtocart"></a>';
            echo '<a href="productdetail.html" class="detail"></a>';
            echo '</div>';
        }

       $i++;
    }
}
?>
