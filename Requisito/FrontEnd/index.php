<?php
require_once 'requisito.entidad.php';
require_once 'requisito.model.php';

// Logica
$alm = new Requisito();
$model = new RequisitoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('requisitoID',              $_REQUEST['requisitoID']);
			$alm->__SET('nombreRequisito',          $_REQUEST['nombreRequisito']);
			$alm->__SET('estado',            $_REQUEST['estado']);

			$model->Actualizar($alm);
			header('Location: index.php');
			break;

		case 'registrar':
			$alm->__SET('nombreRequisito',   $_REQUEST['nombreRequisito']);
			$alm->__SET('estado',   $_REQUEST['estado']);
		

			$model->Registrar($alm);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['requisitoID']);
			header('Location: index.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['requisitoID']);
			break;
	}
}

?>








<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Requisitos</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->categoriaID > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="requisitoID" value="<?php echo $alm->__GET('requisitoID'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:right;">Nombre Requisito:&nbsp&nbsp</th>
                            <td><input type="text" name="nombreRequisito" value="<?php echo $alm->__GET('nombreRequisito'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:right;">Descripcion:&nbsp&nbsp</th>
                            <td><input type="text" name="nombreRequisito" value="<?php echo $alm->__GET('nombreRequisito'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:right;">Estado:&nbsp&nbsp</th>
                            <td>
                                <select name="estado" style="width:100%;">
                                    <option value="1" <?php echo $alm->__GET('estado') == 1 ? 'selected' : ''; ?>>activo</option>
                                    <option value="2" <?php echo $alm->__GET('estado') == 2 ? 'selected' : ''; ?>>inactivo</option>
                                </select>
                            </td>
                        </tr>
                     <tr>
                            <th style="text-align:right;">Tramite&nbsp&nbsp</th>
                              <td>
                                <select name="tramiteID" style="width:100%;">
                                     <?php foreach($model->LoadTramites() as $r): ?>
                                        <option value="<?php echo $r->__GET('tramiteID');?>"><?php echo $r->__GET('nombreTramite'); ?></option>
                                     <?php endforeach; ?>
                                 </select>
                            </td>
                        </tr>
                        <tr>
                        <td colspan="2" style="text-align:right"><br>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                        <th style="text-align:left;">Requisito</th>
                        <th style="text-align:left;">Descripcion</th>
                        <th style="text-align:left;">TramiteID</th>
                        <th style="text-align:left;">Estado</th>
                    
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombreRequisito'); ?></td>
                  
                          
                            <td><?php echo $r->__GET('descripcion'); ?></td>
                            <td><?php echo $r->__GET('tramiteID'); ?></td>
                            <td><?php echo $r->__GET('estado') == 1 ? 'a' : 'i'; ?></td>
                  
                            <td>
                                <a href="?action=editar&requisitoID=<?php echo $r->categoriaID; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&requisitoID=<?php echo $r->categoriaID; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>