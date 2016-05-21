<?php
/* * **************************** */
session_start();
require_once("../../modelo/dao/pantalla.php");
$existe=null;
if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admprenda.php";
    $usId = $_SESSION['usId'];
    $objPant = new pantalla('', '', '', '');
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
//require_once("../../modelo/dao/categoria.php");


//$objCategoria = new categoria('0');
//$arrCategoria = $objCategoria->arregloCategoria;
//echo count($arrCategoria);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../vista/js/estiloadm.css" />
        <style>

            .solobordeIng{
                display: block;
                position: absolute;
                background: white; 
                width: 35%;
                left: 10%;
                height: 4%;
                top: 10%;
            }

            #cabBotones{
                display: block;
                top: 15%; 
                padding-top: 1%;
                position: absolute;
                left:10%; 
                width: 35%; 
                z-index: 100;
                height: 10%;
            }

            #divTabla{
                display: block;
                top: 27%;
                position: absolute;
                left:10%; 
                width: 35%;
                z-index: 40;
                height:65%;
                background: white;
                overflow-y: hidden;
                overflow-x: hidden;
            }

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
           window.onload=consPrenda('0');
        </script>
        
    </head> 
    <body>
        <div class="solobordeIng" align="center">
            Adminsitración de Prendas
        </div>
        <div id="divFormulario">
            
        </div>
        
        <div id="cabBotones">
            <ul class="nav nav-tabs" style="height: auto;margin-left: 0%;">
                <li>
                    <a title="Agregar Prenda" href="javascript:addPrenda();" ><img src="../vista/img/addClothes.png" /></a>
                </li>
                
                <li>
                    <a title="Edita Prenda" href="javascript:editPrendaDesdeMenu('chkHijoRol');"><img src="../vista/img/edit.png" /></a>
                </li>                
                <li>
                    <a title="Eliminar Prenda" href="javascript:delPrendaDesdeMenu('chkHijoRol');"><img src="../vista/img/trash.png" /></a>
                </li> 
                <!--
                <li> 
                    <div class="btn-group" style="left: 10%;margin-top: 5%;">
                        <button class="btn" id="ca_nombre" style="width: 150px;">Seleccione Categoria</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <?php
                            /*
                            for ($r = 0; $r < count($arrCategoria); $r++) {
                                echo "<li> <a href=\"javascript:consPrenda('" . $arrCategoria[$r]->ca_id . "','" . '0' . "');asignarCategoria('" . utf8_encode($arrCategoria[$r]->ca_nombre) . "')\">";
                                if (strlen(utf8_encode($arrCategoria[$r]->ca_nombre)) >= 18) {
                                    echo substr(utf8_encode($arrCategoria[$r]->ca_nombre), 0, 18) . '.';
                                } else {
                                    echo utf8_encode($arrCategoria[$r]->ca_nombre);
                                }
                                echo "</a></li>";
                            }*/
                            ?>
                        </ul> 
                    </div> 
                </li>-->
            </ul>
        </div>

        <div id="divTabla"></div>
        <div id="divFormulario" class="soloborde" style="display: none;">
        </div> 

    </body>
</html> 