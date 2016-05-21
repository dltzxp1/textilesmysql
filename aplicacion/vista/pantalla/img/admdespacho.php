<?php
/* * **************************** */
session_start();
require_once("../../../modelo/dao/pantalla.php");
require_once("../../../modelo/dao/maquila.php");

$objMaquila= new maquila('0');
$arrMaquina=$objMaquila->arregloMaquila;
 
if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../../index.php");
} else {
    $pantalla = "admdespacho.php";
    $usId = $_SESSION['usId'];
    $objPant = new pantalla('', '', '', '', '');
    $objPant->obtenerPantallas($usId);
    $arrPant = $objPant->arregloPantalla;

    for ($q = 0; $q < count($arrPant); $q++) {
        if ($arrPant[$q]->pa_nombre == $pantalla) {
            $existe = 1;
        }
    }
    if ($existe == 0) {
        echo '<div class="alert alert-error">
  <a class="close" data-dismiss="alert"></a>
  <strong>No tiene Pemisos !!</strong>
  </div>
  </div>';
        exit;
    }
}
/* * **************************** */

# Muestra el mensaje de confirmación
 
//session_start();
  
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <head>
        <title>TEXTIL</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/bootstrap/css/bootstrap.css" ></link>
        <link rel="stylesheet" type="text/css" href="../../../librerias/bootstrap/css/bootstrap-responsive.css" ></link>  
        <script src="../../js/ajax.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../librerias/datetimepic/css/bootstrap-datetimepicker.min.css" ></link>
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/jquery-1.7.1.min.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/jQuery-form.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/alert.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/jquery.js" />
        
        <meta name="robots" content="noindex, nofollow" />
       <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
       
        <link rel="stylesheet" href="docs/css/bootstrap-3.3.2.min.css" type="text/css">
        <link rel="stylesheet" href="docs/css/bootstrap-example.css" type="text/css">
        <link rel="stylesheet" href="docs/css/prettify.css" type="text/css">
        <script type="text/javascript" src="docs/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="docs/js/bootstrap-3.3.2.min.js"></script>
        <script type="text/javascript" src="docs/js/prettify.js"></script>
        
        <link rel="stylesheet" href="dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>
        <script type="text/javascript" src="dist/js/bootstrap-multiselect-collapsible-groups.js"></script>        
        
        <link rel="stylesheet" href="calendar/css/datepicker.css">            
         <script type="text/javascript"> 
            $(document).ready(function() {
                window.prettyPrint() && prettyPrint();
            });
        </script>
        
    </head>

    <body onload="consDespacho('0')">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    Administración de Despachos
                </div>
            </div> 
        </div>
   
        <div id="contenedor" style="width: 70%">
            <div id="postform">
                <div id="error" style="display: block;"> </div>
                <table>
                    <tr>
                        <td><strong>Nombre:</strong></td><td><input placeholder='Nombre [5-32]' type="text" id="des_nombre" name="des_nombre" /></td>
                    </tr>
                    <tr>
                        <td><strong>Maquila</strong></td>
                        <td> 
                            <div>
                                
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('#example-dropRight').multiselect({
                                                buttonWidth: '100%',
                                                dropCenter: true
                                        });
                                    });
                                </script>
                                
                                <select id="example-dropRight" multiple="multiple">
                                    <?php
                                    for ($i = 0; $i < count($arrMaquina); $i++) { 
                                    ?>
                                        <option value="<?php echo $arrMaquina[$i]->maq_id  ?>"><?php echo $arrMaquina[$i]->maq_nombre ?></option>
                                    <?php
                                    } 
                                    ?>

                                </select>
                                <input  type="text"  id="campo_maquila" name="campo_maquila"  style="display: none;"></input>
                             </div>
                        </td>
                    </tr> 
                    <tr>
                        <td colspan="3"> 
                            <button title="Guardar categoria" type="submit" name="botonn" id="botonn"  style="border: 0;" onclick="AgregarDespachoDetalle();"> <img src="../../img/save.png"/> </button>
                            <a title="Actualizar categoria" href="" style="color: white;"> <img src="../../img/reload.png"/></a>
                            <a title="Regresar hacia administración" href="../../../controlador/ingreso.php"> <img src="../../img/Admin.png"/> </a>
                        </td>
                    </tr> 
                </table>  
            </div>
        </div>
        <div id="contenedorRpt" style="width: 70%;">
        </div>
    </body>
</html>

