<?php
/* * **************************** */

session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admpedido.php";
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

require_once("../../modelo/dao/rol.php");
$usId = $_SESSION['usId'];
$objRol=new rol($usId,'');

echo $objRol->ro_nombre;
/*
if($objRol->ro_nombre=="ROLADMIN"){
    
}*/
/* * **************************** */
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        
    
    <style>
       .solobordeIng{
                display: block;
                position: absolute;
                background: white; 
                width: 90%;
                left: 5%;
                height: 4%;
                top: 10%;
            }

            #cabBotones{
                display: block;
                top: 15%; 
                padding-top: 1%;
                position: absolute;
                left:5%; 
                width: 90%; 
                z-index: 100;
                height: 10%;
            }
            
           #divTarea{
                top: 7%; 
                display: block;
                left:35%; 
                position: relative;
                width:40%;
            }

            #divTabla{
                display: block;
                top: 27%;
                position: absolute;
                left:5%; 
                width: 90%;
                z-index: 40;
                height:65%;
                background: white;
                overflow-y: hidden;
                overflow-x: hidden;
            }

            #divFormulario{
                position: absolute;
                left: 30%; 
                width:40%;
                height: 74%;
                z-index: 1000;
                box-shadow: 30px 30px 30px #aaa; 
                background-color:#ddd;
            }

    </style>
    
    <link rel="stylesheet" type="text/css" href="../vista/js/estiloadm.css" /> 
    <script>
        window.onload=consPedido('0');
    </script>
    </head>
    <body>
        
        <div class="solobordeIng" align="center">
            Adminsitración de Pedidos
        </div>
        <div id="cabBotones">
            <ul class="nav nav-tabs" style="height: auto;">
                <?php
                if($objRol->ro_nombre=="ROLADMIN"){
                 echo '<li><a title="Agregar Pedido" href="javascript:addPedido();" ><img src="../vista/img/agregar.png" /></a></li>';                
                }
                ?>
            </ul>
        </div>
        
        <div id="divTabla" ></div>
        
        <div id="divFormulario" class="soloborde" style="display: none;"> 
        </div>  
                
        <div id="divTarea" style="display: none;">
            <div class="alert alert-error"><center>Debe Llenar el campo Anterior!</center> 
            </div>
        </div>
        
 
    </body> 
</html>