<?php
require_once 'usuario.entidad.php';
require_once 'usuario.model.php';

// Logica
$alm = new Usuario();
$model = new UsuarioModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('usuarioID',     $_REQUEST['usuarioID']);
            $alm->__SET('tipoUsuario',          $_REQUEST['tipoUsuario']);
            $alm->__SET('cargo',          $_REQUEST['cargo']);
            $alm->__SET('nombres',          $_REQUEST['nombres']);
            $alm->__SET('primerAp',          $_REQUEST['primerAp']);
            $alm->__SET('segundoAp',          $_REQUEST['segundoAp']);
            $alm->__SET('telefono',          $_REQUEST['telefono']);
            $alm->__SET('correo',          $_REQUEST['correo']);
            $alm->__SET('nombreUsuario',          $_REQUEST['nombreUsuario']);
            $alm->__SET('password',          $_REQUEST['password']);
            $alm->__SET('estado',          $_REQUEST['estado']);
            $alm->__SET('institucionID',          $_REQUEST['institucionID']);
		

			$model->Actualizar($alm);
			header('Location: index.php');
			break;

        case 'registrar':
        
            $alm->__SET('usuarioID',     $_REQUEST['usuarioID']);
            $alm->__SET('tipoUsuario',          $_REQUEST['tipoUsuario']);
            $alm->__SET('cargo',          $_REQUEST['cargo']);
            $alm->__SET('nombres',          $_REQUEST['nombres']);
            $alm->__SET('primerAp',          $_REQUEST['primerAp']);
            $alm->__SET('segundoAp',          $_REQUEST['segundoAp']);
            $alm->__SET('telefono',          $_REQUEST['telefono']);
            $alm->__SET('correo',          $_REQUEST['correo']);
            $alm->__SET('nombreUsuario',          $_REQUEST['nombreUsuario']);
            $alm->__SET('password',          $_REQUEST['password']);
            $alm->__SET('estado',          $_REQUEST['estado']);
            $alm->__SET('institucionID',          $_REQUEST['institucionID']);
		

			$model->Registrar($alm);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['usuarioID']);
			header('Location: index.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['usuarioID']);
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
                
                <form action="?action=<?php echo $alm->usuarioID > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="usuarioID" value="<?php echo $alm->__GET('usuarioID'); ?>" />
                    
                    <table style="width:500px;">
                        
                        
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombres" value="<?php echo $alm->__GET('nombres'); ?>" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Apellido Paterno</th>
                            <td><input type="text" name="primerAp" value="<?php echo $alm->__GET('primerAp'); ?>" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Apellido Materno</th>
                            <td><input type="text" name="segundoAp" value="<?php echo $alm->__GET('segundoAp'); ?>" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Tipo de Usuario</th>
                            <td>
                                <select name="tipoUsuario" style="width:100%;">
                                    <option value="1" <?php echo $alm->__GET('tipoUsuario') == 1 ? 'selected' : ''; ?>>Administrador</option>
                                    <option value="2" <?php echo $alm->__GET('tipoUsuario') == 2 ? 'selected' : ''; ?>>visitante</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Cargo</th>
                            <td><input type="text" name="cargo" value="<?php echo $alm->__GET('cargo'); ?>" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Telefono</th>
                            <td><input type="text" name="telefono" value="<?php echo $alm->__GET('telefono'); ?>" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Correo</th>
                            <td><input type="text" name="correo" value="<?php echo $alm->__GET('correo'); ?>" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Nombre de Usuario</th>
                            <td><input type="text" name="nombreUsuario" value="<?php echo $alm->__GET('nombreUsuario'); ?>" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Contraseña</th>
                            <td><input type="text" name="password" value="<?php echo $alm->__GET('password'); ?>" style="width:100%;" /></td>
                        </tr>

   
                        <tr>
                            <th style="text-align:left;">Estado</th>
                            <td>
                                <select name="estado" style="width:100%;">
                                    <option value="1" <?php echo $alm->__GET('estado') == 1 ? 'selected' : ''; ?>>activo</option>
                                    <option value="2" <?php echo $alm->__GET('estado') == 2 ? 'selected' : ''; ?>>inactivo</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Institucion</th>
                              <td>
                                <select name="institucionID" style="width:100%;">
                                     <?php foreach($model->LoadInstitucion() as $r): ?>
                                        <option value="<?php echo $r->__GET('institucionID');?>"><?php echo $r->__GET('tipoInstitucion'); ?></option>
                                     <?php endforeach; ?>
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
                            <th style="text-align:left;">Paterno</th>
                            <th style="text-align:left;">Materno</th>
                            <th style="text-align:left;">Telefono</th>
                            <th style="text-align:left;">correo</th>
                            <th style="text-align:left;">nombreUsuario</th>
                            <th style="text-align:left;">password</th>
                            <th style="text-align:left;">tipoUsuario</th>
                            <th style="text-align:left;">cargo</th>
                            <th style="text-align:left;">Estado</th>
                            <th style="text-align:left;">Institucion</th>

                            
                    
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombres'); ?></td>
                            <td><?php echo $r->__GET('primerAp'); ?></td>
                            <td><?php echo $r->__GET('segundoAp'); ?></td>
                            <td><?php echo $r->__GET('telefono'); ?></td>
                            <td><?php echo $r->__GET('correo'); ?></td>
                            <td><?php echo $r->__GET('nombreUsuario'); ?></td>
                            <td><?php echo $r->__GET('password'); ?></td>
                            <td><?php echo $r->__GET('tipoUsuario'); ?></td>
                            <td><?php echo $r->__GET('cargo'); ?></td>

                            <td><?php echo $r->__GET('estado') == 1 ? 'a' : 'i'; ?></td>
                            <td><?php echo $r->__GET('institucionID'); ?></td>
                  
                            <td>
                                <a href="?action=editar&usuarioID=<?php echo $r->usuarioID; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&usuarioID=<?php echo $r->usuarioID; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>