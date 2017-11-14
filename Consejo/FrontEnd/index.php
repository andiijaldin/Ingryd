<?php
require_once 'consejo.entidad.php';
require_once 'consejo.model.php';

// Logica
$alm = new Consejo();
$model = new ConsejoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
        case 'actualizar':
            $alm->__SET('consejoID',    $_REQUEST['consejoID']);	
			$alm->__SET('descripcion',   $_REQUEST['descripcion']);	

			$model->Actualizar($alm);
			header('Location: index.php');
			break;

		case 'registrar':
        $alm->__SET('descripcion',    $_REQUEST['nombre']);
        $alm->__SET('idUsuarioFacebook',  $_REQUEST['estado']);
        $alm->__SET('tramiteID',  $_REQUEST['nombre']);
        $alm->__SET('requisitoID',  $_REQUEST['estado']);

			$model->Registrar($alm);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['consejoID']);
			header('Location: index.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['consejoID']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Anexsoft</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->categoriaID > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="consejoID" value="<?php echo $alm->__GET('consejoID'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Consejo:</th>
                            <td><input type="text" name="nombre" value="<?php echo $alm->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
   
                        <tr>
                            <th style="text-align:left;">Usuario Facebook</th>
                            <td>
                                <select name="estado" style="width:100%;">
                                    <option value="1" <?php echo $alm->__GET('estado') == 1 ? 'selected' : ''; ?>>activo</option>
                                    <option value="2" <?php echo $alm->__GET('estado') == 2 ? 'selected' : ''; ?>>inactivo</option>
                                </select>
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Estado</th>
                    
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                  
                            <td><?php echo $r->__GET('estado') == 1 ? 'a' : 'i'; ?></td>
                  
                            <td>
                                <a href="?action=editar&categoriaID=<?php echo $r->categoriaID; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&categoriaID=<?php echo $r->categoriaID; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>