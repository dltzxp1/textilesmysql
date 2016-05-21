<?php
/* * **************************** */
session_start();
require_once("../../../modelo/dao/pantalla.php");
require_once("../../../modelo/dao/tela.php");
include_once '../../../modelo/dao/cliente.php';
include_once '../../../modelo/dao/talla.php';
include_once '../../../modelo/dao/insumo.php';
include_once '../../../modelo/dao/areac.php';

$objTela= new tela('0');
$objCliente = new cliente('0');
$objTalla = new talla('0');
$objInsumo= new insumo('0');
$objArea= new areac('0');

$arrTela=$objTela->arregloTelas;
$arrCliente = $objCliente->arregloCliente;
$arrTalla = $objTalla->arregloTalla; 
$arrInsumo = $objInsumo->arregloInsumo;
$arrArea = $objArea->arregloArea; 


if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../../index.php");
} else {
    $pantalla = "admprenda.php";
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
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <link rel="stylesheet" href="dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>
        <script type="text/javascript" src="dist/js/bootstrap-multiselect-collapsible-groups.js"></script>

        <style>
            
              #divFormulario{
            position: absolute;
            top:15%;
            left: 46%; 
            width:40%;
            height: 74%;
            z-index: 1000;
        }
            
        
        </style> 
        <script>
        
            function handleFileSelect(evt) {
                files = evt.target.files;
                for (var i = 0, f; f = files[i]; i++) {
                    if (!f.type.match('image.*')) {
                        continue;
                    }
                    var reader = new FileReader();
                        reader.onload = (function(theFile) {
                            return function(e) {
                                var img = document.createElement('img');
                                img.style.height='195px';
                                img.style.width='150px';
                                img.src=e.target.result;
                                document.getElementById('list').innerHTML='';
                                document.getElementById('list').insertBefore(img, null);
                            };
                        })(f);
                        reader.readAsDataURL(f);
                    }
                }

        </script>
        
         <link rel="stylesheet" href="calendar/css/datepicker.css">            
         <script type="text/javascript">
            $(document).ready(function() {
                window.prettyPrint() && prettyPrint();
            });
        </script>
            
    </head>

    <body onload="consPrenda('0')">
        <!--<input type="text" id="pre_id" name="pre_id" />-->
        
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    Administración de Prendas
                </div>
            </div> 
        </div>
   
        <div id="contenedor" style="width: 90%">
            <div id="postform">
                <div id="error" style="display: block;"> </div>
                    <table>
                        <tr>
                            <td><strong>Nombre:</strong></td><td><input placeholder='Nombre [5-32]' type="text" id="pre_nombre" name="pre_nombre" /></td>
                            
                        </tr>
                        <tr>
                            <td><strong>Cliente</strong></td>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-default" id='cli_nombre' style='width: 200px;'>Seleccione Cliente
                                </button>
                                
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Desplegar menú</span>
                                </button>

                                <ul class="dropdown-menu" role="menu">
                                   <?php
                                        for ($r = 0; $r < count($arrCliente); $r++) {                                            
                                            echo "<li> <a href=\"javascript:asignarCliente('" . $arrCliente[$r]->cli_id . "','" . utf8_encode($arrCliente[$r]->cli_nombre) . "');\">" . utf8_encode($arrCliente[$r]->cli_nombre) . "</a></li>";
                                        }
                                        ?>
                                </ul>
                              </div>
                                    <input type='text' id='pre_cli_id' style='display:none;'/>
                                    <input type="text" id="campo_cliente" name="campo_cliente" style="display: none;" />
                                    <BR/> <BR/>
                            </td>                            
                       </tr>
                        
                        
                        <tr>
                            <td><strong>Area</strong></td>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-default" id='are_nombre' style='width: 200px;'>Seleccione Area
                                </button>
                                
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Desplegar menú</span>
                                </button>

                                <ul class="dropdown-menu" role="menu">
                                   <?php
                                        for ($r = 0; $r < count($arrArea); $r++) {
                                            echo "<li> <a href=\"javascript:asignarArea('" . $arrArea[$r]->are_id . "','" . utf8_encode($arrArea[$r]->are_nombre) . "');\">" . utf8_encode($arrArea[$r]->are_nombre) . "</a></li>";
                                        }
                                        ?>
                                </ul>
                              </div>
                                    <input type='text' id='pre_are_id' style='display:none;'/>
                                    <input type="text" id="campo_area" name="campo_area" style="display: none;" />
                                    <BR/> <BR/>
                            </td>                            
                       </tr>
                        
                       <tr>
                            <td><strong>Tela</strong></td>
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
                                            for ($i = 0; $i < count($arrTela); $i++) { 
                                            ?>
                                                <option value="<?php echo $arrTela[$i]->tel_id  ?>"><?php echo $arrTela[$i]->tel_nombre ?></option>
                                            <?php
                                            } 
                                            ?>
                                            
                                        </select>
                                        <input  type="text"  id="campo_tela" name="campo_tela"  style="display: none;"></input>
                                     <br><br>
			</div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><strong>Talla</strong></td>
                            <td>
                               	<div>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#example-dropRight2').multiselect({
                                                        buttonWidth: '100%',
                                                        dropCenter: true
                                                });
                                            });
                                        </script>
                                        <select id="example-dropRight2" multiple="multiple">
                                            <?php
                                            for ($i = 0; $i < count($arrTalla); $i++) { 
                                            ?>
                                                <option value="<?php echo $arrTalla[$i]->tal_id  ?>"><?php echo $arrTalla[$i]->tal_valor?></option>
                                            <?php
                                            } 
                                            ?>
                                            
                                        </select>
                                        <input  type="text"  id="campo_talla" name="campo_talla"  style="display: none;"></input>
                                     <br><br>
			</div>
                            </td>
                        </tr>      
                    
                         <tr>
                            <td><strong>Insumo</strong></td>
                            <td>
                               	<div>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#example-dropRight3').multiselect({
                                                        buttonWidth: '100%',
                                                        dropCenter: true
                                                });
                                            });
                                        </script>
                                        <select id="example-dropRight3" multiple="multiple">
                                            <?php
                                            for ($i = 0; $i < count($arrInsumo); $i++) { 
                                            ?>
                                                <option value="<?php echo $arrInsumo[$i]->ins_id  ?>"><?php echo $arrInsumo[$i]->ins_nombre?></option>
                                            <?php
                                            } 
                                            ?>
                                            
                                        </select>
                                    <input  type="text"  id="campo_insumo" name="campo_insumo"  style="display: none;"></input>
                                     <br><br>
			</div>
                            </td>
                        </tr>   
                        
                        <tr>
                            <td>Imagen</td>
                            <td> 
                                <div id='list'></div>
                                <input type='file' id='pre_imagen' name='pre_imagen[]'/>
                                <script>document.getElementById('pre_imagen').addEventListener('change', handleFileSelect, false);</script>
                            </td>                           

                        </tr>
                        
                        <tr>
                            <td colspan="3"> 
                                <button title="Guardar Prenda" type="submit" name="botonn" id="botonn"  style="border: 0;" onclick="AgregarPrendaDetalle();"> <img src="../../img/save.png"/> </button>
                                <a title="Actualizar Prenda" href="" style="color: white;"> <img src="../../img/reload.png"/></a>
                                <a title="Regresar hacia administración" href="../../../controlador/ingreso.php"> <img src="../../img/Admin.png"/> </a>
                            </td>
                        </tr>
                        
                    </table>  
            </div>
        </div>
        
        </div>
        
        <div id="contenedorRpt" style="width: 90%;">
        </div>
    </body>
</html>

