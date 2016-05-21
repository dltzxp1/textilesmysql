//-------------------------------------------------------------------------------------------------------------------FUNCIONES GLOBALES
function soportaAjax()
{
    //Navegadores diferentes a IE (Firefox, Netscape, Opera, Safari y Opera)
    if (window.XMLHttpRequest)
    {
        request=new XMLHttpRequest();
    }
    else if (window.ActiveXObject) //Navegadores IE
    {
        request=new ActiveXObject("Msxml2.XMLHTTP");
        if(!request)
        {
            request=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    
    if(!request)
    {
        alert("Su navegador no permite el uso de todas las funcionalidades de esta aplicaci�n, por lo que podria comportarse de manera inesperada.");
        return false;
    }
    else
    {        
        return true;
    }
}

//http://www.cristalab.com/tutoriales/introduccion-a-ajax-con-php-y-formularios-c165l/

function nuevoAjax()
{ 
    var xmlhttp=false;
    try { 
        // Creación del objeto ajax para navegadores diferentes a Explorer 
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
    }
    catch (e) { 
        // o bien 
        try { 
            // Creación del objet ajax para Explorer 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) { 
            xmlhttp = false; 
        } 
    } 
    
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') { 
        xmlhttp = new XMLHttpRequest(); 
    } 
    return xmlhttp; 
} 

function vistas(url){
    $.ajax({
        url: url,
        type: 'post',
        beforeSend: function () {
            $("#detailMenu").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
        }
    });
}
  

/*******************************************************CLIENTES*/      
      
function consCliente(){
    var parametros = {"cli_id" : '0'};
    $.ajax({
        data: parametros,
        url: 'gestion/clienteCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginCliente(nropagina){
    var parametros = {"pag" : nropagina};
    $.ajax({
        data: parametros,
        url: 'gestion/clienteCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
    
function addCliente(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/clienteFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  

function validarCamposCliente() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#cli_nombre").val()===''){
            $("#cli_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#cli_apellido").val().length<=2  || $("#cli_apellido").val().length>31 ){
            $("#cli_apellido").focus().after("<span class='errorE'>Ingresar un valor entre [5–32 caracteres]</span>");
            return false;
        }else if($("#cli_ciudad").val()=== ''){
            $("#cli_ciudad").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_cli").val();
            var cli_id=$("#cli_id").val();
            insertCliente(opcion,cli_id,$("#cli_nombre").val(),$("#cli_apellido").val(),$("#cli_ciudad").val()); 
        } 
    });     
    $("#cli_nombre, #cli_apellido, #cli_ciudad").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertCliente(opcion,cli_id,cli_nombre,cli_apellido,cli_ciudad){
    var parametros = {"opcion" : opcion,"cli_id" : cli_id,"cli_nombre" : cli_nombre,"cli_apellido" : cli_apellido,"cli_ciudad" : cli_ciudad};
    $.ajax({
        data: parametros,
        url: 'gestion/clienteFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consCliente('0');
        }
    });
}

function editCliente(cli_id,cli_nombre,cli_apellido,cli_ciudad){    
    mostrarDiv("divFormulario");
    var parametros = {"cli_id" : cli_id,"cli_nombre" : cli_nombre,"cli_apellido" : cli_apellido,"cli_ciudad" : cli_ciudad};
    $.ajax({
        data: parametros,
        url: 'gestion/clienteFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delCliente(opcion,cli_id){
    var parametros = {"opcion" : opcion,"cli_id" : cli_id};
    $.ajax({
        data: parametros,
        url: 'gestion/clienteFuncion.php',
        type: 'post',
        success: function () { 
            consCliente('0'); 
        }
    }); 
}

//TALA**************************************************

function consTalla(tal_id){
    var parametros = {"tal_id" : tal_id};
    $.ajax({
        data: parametros,
        url: 'gestion/tallaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginTalla(nropagina){
    var parametros = {"pag" : nropagina};
    $.ajax({
        data: parametros,
        url: 'gestion/tallaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
    
function addTalla(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/tallaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  

function validarCamposTalla() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#tal_valor").val() === ""){
            $("#tal_valor").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_tal").val();
            var tal_id=$("#tal_id").val();
            insertTalla(opcion,tal_id,$("#tal_valor").val());
        } 
    });     
    $("#tal_valor").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertTalla(opcion,tal_id,tal_valor){
    var parametros = {"opcion" : opcion,"tal_id" : tal_id,"tal_valor" : tal_valor};
    $.ajax({
        data: parametros,
        url: 'gestion/tallaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consTalla('0');
        }
    });
}

function editTalla(tal_id,tal_valor){
    mostrarDiv("divFormulario");
    var parametros = {"tal_id" : tal_id,"tal_valor" : tal_valor};
    $.ajax({
        data: parametros,
        url: 'gestion/tallaFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delTalla(opcion,tal_id){
    var parametros = {"opcion" : opcion,"tal_id" : tal_id};
    $.ajax({
        data: parametros,
        url: 'gestion/tallaFuncion.php',
        type: 'post',
        success: function () { 
            consTalla('0'); 
        }
    }); 
}

//TELAS ****************************************************************************************
      
function consTela(tel_id){
    var parametros = {
        "tel_id" : tel_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/telaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginTela(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/telaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addTela(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/telaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  

function validarCamposTela() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#tel_nombre").val() === ""){
            $("#tel_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#tel_color").val().length<=2  || $("#tel_color").val().length>31 ){
            $("#tel_color").focus().after("<span class='errorE'>Ingresar un valor entre [5–32 caracteres]</span>");
            return false;
        }else if($("#tel_medida").val() === ""){
            $("#tel_medida").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_tel").val();
            var tel_id=$("#tel_id").val();
            insertTela(opcion,tel_id,$("#tel_nombre").val(),$("#tel_color").val(),$("#tel_medida").val());
        } 
    });     
    $("#tel_nombre, #tel_color, #tel_medida").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertTela(opcion,tel_id,tel_nombre,tel_color,tel_medida){ 
    var parametros = {
        "opcion" : opcion,
        "tel_id" : tel_id,
        "tel_nombre" : tel_nombre,
        "tel_color" : tel_color,
        "tel_medida" : tel_medida
    };
    $.ajax({
        data: parametros,
        url: 'gestion/telaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consTela('0');            
        }
    });
}

function editTela(tel_id,tel_nombre,tel_color,tel_medida){
    mostrarDiv("divFormulario");
    var parametros = {
        "tel_id" : tel_id,
        "tel_nombre" : tel_nombre,
        "tel_color" : tel_color,
        "tel_medida" : tel_medida
    };
    $.ajax({
        data: parametros,
        url: 'gestion/telaFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delTela(opcion,tel_id){
    var parametros = {
        "opcion" : opcion,
        "tel_id" : tel_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/telaFuncion.php',
        type: 'post',
        success: function () { 
            consTela('0'); 
        }
    }); 
}

//MAQUILA**************************************

function consMaquila(maq_id){
    var parametros = {
        "maq_id" : maq_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/maquilaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
    
function PaginMaquila(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/maquilaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function addMaquila(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/maquilaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  

function validarCamposMaquila() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#maq_nombre").val() === ""){
            $("#maq_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_maq").val();
            var maq_id=$("#maq_id").val();
            insertMaquila(opcion,maq_id,$("#maq_nombre").val()); 
        } 
    });     
    $("#maq_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertMaquila(opcion,maq_id,maq_nombre){
    var parametros = {
        "opcion" : opcion,
        "maq_id" : maq_id,
        "maq_nombre" : maq_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/maquilaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consMaquila('0');            
        }
    });
}

function editMaquila(maq_id,maq_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "maq_id" : maq_id,
        "maq_nombre" : maq_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/maquilaFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delMaquila(opcion,maq_id){
    var parametros = {
        "opcion" : opcion,
        "maq_id" : maq_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/maquilaFuncion.php',
        type: 'post',
        success: function () { 
            consMaquila('0'); 
        }
    }); 
}

// despacho******************************+
 
function AgregarDespachoDetalle(){
    var ing=0;
    var jsonArr = []; 
    var x=document.getElementById("example-dropRight"); 
    for (var i = 0; i < x.options.length; i++) {
       if(x.options[i].selected===true){
            jsonArr.push({id: x.options[i].value});
        }
    }
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#des_nombre").val() === ""){
            $("#des_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if(jsonArr.length===0){
            $("#campo_maquila").focus().after("<span class='errorE'>Seleccione al menos un elemento.</span>");
            return false;
        }else{
             ing=1;
        } 
    });     
    $("#des_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });    
    if(ing===1){ 
        var opcion=0;
        var des_nombre=$("#des_nombre").val();
        var formdata=new FormData(); 
        formdata.append('opcion',opcion);
        formdata.append('des_nombre',des_nombre);        
        formdata.append('jsonArr',JSON.stringify(jsonArr));
        $.ajax({
        type: "POST",
        url: "../../../controlador/gestion/despachoFuncion.php",
        data: formdata,
        contentType: false,
        processData: false,
        cache: false,
        success: function(msj){
            console.log(msj);
            consDespacho('0'); 
        }});   
   }
}

function consDespacho(des_id){
    var parametros = {
        "des_id" : des_id        
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/despachoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<br /> <img style='width:50px; height:50px' src='../../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
}  
 
function PaginDespacho(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros, 
        url: '../../../controlador/gestion/despachoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<br /> <img  style='width:50px; height:50px' src='../../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
} 
    
    
function addDespacho(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/despachoFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  

function insertDespacho(opcion,des_nombre){ 
    console.log(des_nombre);
    var parametros = {
        "opcion" : opcion,
        "des_nombre" : des_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/despachoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consDespacho('0'); 
            
        }
    });
}

function updaDespacho(opcion,des_id,des_nombre){
    console.log('ACTUALIZA');
    //console.log(des_nombre+','+cli_apellido+','+cli_ciudad);
    var parametros = {
        "opcion" : opcion,
        "des_id" : des_id,
        "des_nombre" : des_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/despachoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consDespacho('0');
        }
    });
}

function delDespacho(opcion,des_id){
    var parametros = {
        "opcion" : opcion,
        "des_id" : des_id
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/despachoFuncion.php', 
        type: 'post',
        success: function () { 
            consDespacho('0'); 
        }
    }); 
}


function editDespacho(des_id,des_nombre){
    //console.log(des_nombre+','+cli_apellido+','+cli_ciudad);
    mostrarDiv("divFormulario");
    var parametros = {
        "des_id" : des_id,
        "des_nombre" : des_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/despachoFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

//MODELO******************************************

function consModelo(mod_id){
    var parametros = {
        "mod_id" : mod_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/modeloCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginModelo(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/modeloCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addModelo(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/modeloFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  
  
function validarCamposModelo() {
    var cadena = /^[a-z]+$/; 
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#mod_nombre").val() === ""){
            $("#mod_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_mod").val();
            var mod_id=$("#mod_id").val();
            insertModelo(opcion,mod_id,$("#mod_nombre").val()); 
        } 
    });     
    $("#mod_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertModelo(opcion,mod_id,mod_nombre){ 
    var parametros = {
        "opcion" : opcion,
        "mod_id" : mod_id,
        "mod_nombre" : mod_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/modeloFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consModelo('0'); 
            
        }
    });
}
 
function editModelo(mod_id,mod_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "mod_id" : mod_id,
        "mod_nombre" : mod_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/modeloFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delModelo(opcion,mod_id){
    var parametros = {
        "opcion" : opcion,
        "mod_id" : mod_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/modeloFuncion.php',
        type: 'post',
        success: function () { 
            consModelo('0'); 
        }
    }); 
}

// CORTADOR************************************************************************


function consCortador(cor_id){
    var parametros = {
        "cor_id" : cor_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cortadorCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginCortador(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cortadorCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addCortador(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/cortadorFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  
  
function validarCamposCortador() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#cor_nombre").val() === ""){
            $("#cor_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_cor").val();
            var cor_id=$("#cor_id").val();
            insertCortador(opcion,cor_id,$("#cor_nombre").val());  
        } 
    });     
    $("#cor_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertCortador(opcion,cor_id,cor_nombre){ 
    var parametros = {
        "opcion" : opcion,
        "cor_id" : cor_id,
        "cor_nombre" : cor_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cortadorFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consCortador('0'); 
            
        }
    });
}
 
function editCortador(cor_id,cor_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "cor_id" : cor_id,
        "cor_nombre" : cor_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cortadorFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delCortador(opcion,cor_id){
    var parametros = {
        "opcion" : opcion,
        "cor_id" : cor_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cortadorFuncion.php',
        type: 'post',
        success: function () { 
            consCortador('0'); 
        }
    }); 
}


 //TRAZOS **************************************************
  
function consTrazos(tra_id){
    var parametros = {
        "tra_id" : tra_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/trazosCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginTrazos(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/trazosCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addTrazos(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/trazosFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  
  
function validarCamposTrazos() {
    var cadena = /^[a-z]+$/; 
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#tra_nombre").val() === ""){
            $("#tra_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_tra").val();
            var tra_id=$("#tra_id").val();
           insertTrazos(opcion,tra_id,$("#tra_nombre").val()); 
        } 
    });     
    $("#tra_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertTrazos(opcion,tra_id,tra_nombre){ 
    var parametros = {
        "opcion" : opcion,
        "tra_id" : tra_id,
        "tra_nombre" : tra_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/trazosFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consTrazos('0'); 
            
        }
    });
}

function updaTrazos(opcion,tra_id,tra_nombre){
    var parametros = {
        "opcion" : opcion,
        "tra_id" : tra_id,
        "tra_nombre" : tra_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/trazosFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consTrazos('0');
        }
    });
}
 
function editTrazos(tra_id,tra_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "tra_id" : tra_id,
        "tra_nombre" : tra_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/trazosFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delTrazos(opcion,tra_id){
    var parametros = {
        "opcion" : opcion,
        "tra_id" : tra_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/trazosFuncion.php',
        type: 'post',
        success: function () { 
            consTrazos('0'); 
        }
    }); 
}

// calidad****************************************************

  
function consCalidad(cal_id){
    var parametros = {
        "cal_id" : cal_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/calidadCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginCalidad(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/calidadCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addCalidad(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/calidadFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  
  
function validarCamposCalidad() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#cal_nombre").val() === ""){
            $("#cal_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_cal").val();
            var cal_id=$("#cal_id").val();
           insertCalidad(opcion,cal_id,$("#cal_nombre").val()); 
        } 
    });     
    $("#cal_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertCalidad(opcion,cal_id,cal_nombre){ 
    var parametros = {
        "opcion" : opcion,
        "cal_id" : cal_id,
        "cal_nombre" : cal_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/calidadFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consCalidad('0');            
        }
    });
}

function updaCalidad(opcion,cal_id,tra_nombre){
    var parametros = {
        "opcion" : opcion,
        "cal_id" : cal_id,
        "tra_nombre" : tra_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/calidadFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consCalidad('0');
        }
    });
}
 
function editCalidad(cal_id,cal_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "cal_id" : cal_id,
        "cal_nombre" : cal_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/calidadFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delCalidad(opcion,cal_id){
    var parametros = {
        "opcion" : opcion,
        "cal_id" : cal_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/calidadFuncion.php',
        type: 'post',
        success: function () { 
            consCalidad('0'); 
        }
    }); 
}
// empaque

function consEmpaque(emp_id){
    var parametros = {
        "emp_id" : emp_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/empaqueCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginEmpaque(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/empaqueCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addEmpaque(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/empaqueFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
  
function validarCamposEmpaque() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#emp_nombre").val() === ""){
            $("#emp_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_emp").val();
            var emp_id=$("#emp_id").val();
           insertEmpaque(opcion,emp_id,$("#emp_nombre").val()); 
        } 
    });     
    $("#emp_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertEmpaque(opcion,emp_id,emp_nombre){ 
    var parametros = {
        "opcion" : opcion,
        "emp_id" : emp_id,
        "emp_nombre" : emp_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/empaqueFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consEmpaque('0');            
        }
    });
}

function updaEmpaque(opcion,emp_id,tra_nombre){
    var parametros = {
        "opcion" : opcion,
        "emp_id" : emp_id,
        "tra_nombre" : tra_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/empaqueFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consEmpaque('0');
        }
    });
}
 
function editEmpaque(emp_id,emp_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "emp_id" : emp_id,
        "emp_nombre" : emp_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/empaqueFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delEmpaque(opcion,emp_id){
    var parametros = {
        "opcion" : opcion,
        "emp_id" : emp_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/empaqueFuncion.php',
        type: 'post',
        success: function () { 
            consEmpaque('0'); 
        }
    }); 
}

// Disenio*************************************
function consDisenio(dise_id){
    var parametros = {
        "dise_id" : dise_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/disenioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginDisenio(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/disenioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addDisenio(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/disenioFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
  
function validarCamposDisenio() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#dise_nombre").val() === ""){
            $("#dise_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_dise").val();
            var dise_id=$("#dise_id").val();
           insertDisenio(opcion,dise_id,$("#dise_nombre").val()); 
        } 
    });     
    $("#dise_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertDisenio(opcion,dise_id,dise_nombre){ 
    var parametros = {
        "opcion" : opcion,
        "dise_id" : dise_id,
        "dise_nombre" : dise_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/disenioFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consDisenio('0');            
        }
    });
}

function updaDisenio(opcion,dise_id,tra_nombre){
    var parametros = {
        "opcion" : opcion,
        "dise_id" : dise_id,
        "tra_nombre" : tra_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/disenioFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consDisenio('0');
        }
    });
}
 
function editDisenio(dise_id,dise_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "dise_id" : dise_id,
        "dise_nombre" : dise_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/disenioFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delDisenio(opcion,dise_id){
    var parametros = {
        "opcion" : opcion,
        "dise_id" : dise_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/disenioFuncion.php',
        type: 'post',
        success: function () { 
            consDisenio('0'); 
        }
    }); 
}

// Produccion.

function consProduccion(prodc_id){
    var parametros = {
        "prodc_id" : prodc_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/produccionCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginProduccion(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/produccionCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addProduccion(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");

    $.ajax({
        url: 'gestion/produccionFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
  
function validarCamposProduccion() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#prodc_nombre").val() === ""){
            $("#prodc_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_prodc").val();
            var prodc_id=$("#prodc_id").val();
           insertProduccion(opcion,prodc_id,$("#prodc_nombre").val()); 
        } 
    });     
    $("#prodc_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertProduccion(opcion,prodc_id,prodc_nombre){ 
    var parametros = {
        "opcion" : opcion,
        "prodc_id" : prodc_id,
        "prodc_nombre" : prodc_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/produccionFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consProduccion('0');            
        }
    });
}

function updaProduccion(opcion,prodc_id,tra_nombre){
    var parametros = {
        "opcion" : opcion,
        "prodc_id" : prodc_id,
        "tra_nombre" : tra_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/produccionFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consProduccion('0');
        }
    });
}
 
function editProduccion(prodc_id,prodc_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "prodc_id" : prodc_id,
        "prodc_nombre" : prodc_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/produccionFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delProduccion(opcion,prodc_id){
    var parametros = {
        "opcion" : opcion,
        "prodc_id" : prodc_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/produccionFuncion.php',
        type: 'post',
        success: function () { 
            consProduccion('0'); 
        }
    }); 
}


//***Insumo******************************
function consInsumo(ins_id){
    var parametros = {
        "ins_id" : ins_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/insumoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginInsumo(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/insumoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addInsumo(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/insumoFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
  
function validarCamposInsumo() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#ins_nombre").val() === ""){
            $("#ins_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_ins").val();
            var ins_id=$("#ins_id").val();
           insertInsumo(opcion,ins_id,$("#ins_nombre").val()); 
        } 
    });     
    $("#ins_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertInsumo(opcion,ins_id,ins_nombre){ 
    var parametros = {
        "opcion" : opcion,
        "ins_id" : ins_id,
        "ins_nombre" : ins_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/insumoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consInsumo('0');            
        }
    });
}

function updaInsumo(opcion,ins_id,tra_nombre){
    var parametros = {
        "opcion" : opcion,
        "ins_id" : ins_id,
        "tra_nombre" : tra_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/insumoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consInsumo('0');
        }
    });
}
 
function editInsumo(ins_id,ins_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "ins_id" : ins_id,
        "ins_nombre" : ins_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/insumoFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delInsumo(opcion,ins_id){
    var parametros = {
        "opcion" : opcion,
        "ins_id" : ins_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/insumoFuncion.php',
        type: 'post',
        success: function () { 
            consInsumo('0'); 
        }
    }); 
}
// AREA**********************************************************

function consArea(are_id){
    var parametros = {
        "are_id" : are_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/areaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginArea(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/areaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addArea(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/areaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
  
function validarCamposArea() {
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#are_nombre").val() === ""){
            $("#are_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else{
            var opcion=$("#opcion_are").val();
            var are_id=$("#are_id").val();
           insertArea(opcion,are_id,$("#are_nombre").val()); 
        } 
    });     
    $("#are_nombre").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertArea(opcion,are_id,are_nombre){ 
    var parametros = {
        "opcion" : opcion,
        "are_id" : are_id,
        "are_nombre" : are_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/areaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consArea('0');            
        }
    });
}

function updaArea(opcion,are_id,tra_nombre){
    var parametros = {
        "opcion" : opcion,
        "are_id" : are_id,
        "tra_nombre" : tra_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/areaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consArea('0');
        }
    });
}
 
function editArea(are_id,are_nombre){
    mostrarDiv("divFormulario");
    var parametros = {
        "are_id" : are_id,
        "are_nombre" : are_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/areaFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delArea(opcion,are_id){
    var parametros = {
        "opcion" : opcion,
        "are_id" : are_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/areaFuncion.php',
        type: 'post',
        success: function () { 
            consArea('0'); 
        }
    }); 
}

function deselecChkPadre(chkBoxPadreId) {
    document.getElementById(chkBoxPadreId).checked = 0;
}

function selecAllChkBox(chkBoxPadreId, chkBoxHijosName) {
    var arrChkBoxHijos = document.getElementsByName(chkBoxHijosName);
    var chkPadre = document.getElementById(chkBoxPadreId); 
    /* accedo solo al  elemento del  Padre */
    for (i = 0; i < arrChkBoxHijos.length; i++)
        if (chkPadre.checked)
            arrChkBoxHijos[i].checked = true;
        else
            arrChkBoxHijos[i].checked = 0;
}

var strCmd;
var waitseconds;
var timeOutPeriod;
var hideTimer;

function cerrarAuto(){
    strCmd = "document.getElementById('divFormulario').style.display = 'none'";
    waitseconds = 2;
    timeOutPeriod = waitseconds * 1000;
    hideTimer = setTimeout(strCmd, timeOutPeriod);
}    

function asignarTalla(tal_id,tal_valor){
    if(tal_valor.length>=28){
        document.getElementById('tal_valor').innerHTML=tal_valor.substring(0, 28)+'.';
    }else{
        document.getElementById('tal_valor').innerHTML=tal_valor.substring(0, 28);
    }
    document.getElementById('pre_tal_id').value=tal_id;
}


function imprimeExito(mensaje){
    var divFormulario = document.getElementById('divFormulario');    
    divFormulario.innerHTML = '\n\
                <div class="alert alert-success">\n\
                 <a class="close" data-dismiss="alert">  </a>\n\
                    <strong>'+"<img src='../vista/img/inf.png'/>"+'   '+mensaje+'</strong>\n\
                </div> \n\
                </div>';
}

//$("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");

function imprimeError(mensaje){
    var divFormulario = document.getElementById('divFormulario');
    divFormulario.innerHTML = '\n\
                <div class="alert alert-error">\n\
                 <a class="close" data-dismiss="alert"></a>\n\
                    <strong>'+mensaje+'</strong>\n\
                </div> \n\
                </div>';
}

/*---------------------------------------CANTON--------------------------------------*/

function asignarPersona(pe_id,pe_nombre){
    if(ca_nombre.length>=28){
        document.getElementById('pe_nombre').innerHTML=pe_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('pe_nombre').innerHTML=pe_nombre.substring(0, 28);
    }
    document.getElementById('pe_id').value=pe_id;
}

function asignarCliente(cli_id,cli_nombre){
    if(cli_nombre.length>=28){
        document.getElementById('cli_nombre').innerHTML=cli_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('cli_nombre').innerHTML=cli_nombre.substring(0, 28);
    }
    document.getElementById('pre_cli_id').value=cli_id;
    document.getElementById('campo_cliente').value=cli_id;
}

function asignarArea(are_id,are_nombre){
    console.log(are_id+','+are_nombre);
    if(are_nombre.length>=28){
        document.getElementById('are_nombre').innerHTML=are_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('are_nombre').innerHTML=are_nombre.substring(0, 28);
    }
    document.getElementById('pre_are_id').value=are_id;
    document.getElementById('campo_area').value=are_id;
}

function AgregarPrendaDetalle(){
    var ing=0;
    var opcion=0;
    var pre_nombre=$("#pre_nombre").val();    
    var pre_cli_id=$("#pre_cli_id").val();
    var pre_are_id=$("#pre_are_id").val();
    var jsonArr = []; 
    var x=document.getElementById("example-dropRight");
    for (var i = 0; i < x.options.length; i++) {
       if(x.options[i].selected===true){
            jsonArr.push({id: x.options[i].value}); 
        }
    }
    var jsonArr2 = []; 
    var x2=document.getElementById("example-dropRight2"); 
    for (var i = 0; i < x2.options.length; i++) {
       if(x2.options[i].selected===true){
            jsonArr2.push({id: x2.options[i].value});
        }
    }
    var jsonArr3 = []; 
    var x3=document.getElementById("example-dropRight3"); 
    for (var i = 0; i < x3.options.length; i++) {
       if(x3.options[i].selected===true){
            jsonArr3.push({id: x3.options[i].value});
        }
    }
    var archivo=document.getElementById('pre_imagen');
    var fil=archivo.files[0];    
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#pre_nombre").val() === ""){
            $("#pre_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#campo_cliente").val() === ""){
            $("#campo_cliente").focus().after("<span class='errorE'>Seleccione un cliente</span>");
            return false;
        }else if($("#campo_area").val() === ""){
            $("#campo_area").focus().after("<span class='errorE'>Seleccione un Area</span>");
            return false;
        }
        else if(jsonArr.length===0){
            $("#campo_tela").focus().after("<span class='errorE'>Seleccione al menos un elemento</span>");
            return false;
        }else if(jsonArr2.length===0){
            $("#campo_talla").focus().after("<span class='errorE'>Seleccione al menos un elemento</span>");
            return false;
        }else if(jsonArr3.length===0){
            $("#campo_insumo").focus().after("<span class='errorE'>Seleccione al menos un elemento</span>");
            return false;
        }else if($("#pre_imagen").val() === ""){
            $("#pre_imagen").focus().after("<span class='errorE'>Imagen requerida.</span>");
            return false;
        } 
          else{
             ing=1;
        } 
    });     
    /*
    $("#pre_nombre,#pre_fecha,#campo_cliente").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });  */
    
    if(ing===1){ 
        var formdata=new FormData();
        formdata.append('img',fil);
        formdata.append('opcion',opcion);
        formdata.append('pre_nombre',pre_nombre);        
        formdata.append('pre_cli_id',pre_cli_id);
        formdata.append('pre_are_id',pre_are_id);
        formdata.append('jsonArr',JSON.stringify(jsonArr));
        formdata.append('jsonArr2',JSON.stringify(jsonArr2));
        formdata.append('jsonArr3',JSON.stringify(jsonArr3));
        $.ajax({
           type: "POST",
           url: "../../../controlador/gestion/prendaFuncion.php",
           data: formdata,
           contentType: false,
           processData: false,
           cache: false,
           success: function(msj){
               console.log(msj);
               consPrenda('0');
               //console.log(msj); 
         }});
    } 
} 


function buscarPedidoUnidad(){
    var ped_nombre=$("#ped_nombre").val();
    var parametros = {
        "ped_nombre" : ped_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoUnidadCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 


function consPrenda(pre_id){ 
    console.log(1);
    var parametros = {
        "pre_id" : pre_id
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/prendaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<br /> <img  style='width:50px; height:50px' src='../../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
} 

function PaginPrenda(nropagina){    
    var pre_id=0;
    var parametros = {
        "pag" : nropagina,
        "pre_id" : pre_id
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/prendaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<br /> <img  style='width:50px; height:50px' src='../../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
} 
//[$r]->pre_nombre . "' href = 'javascript:editPrenda(\"" . $arrPrenda[$r]->pre_cli_id . "\",\"" . $arrPrenda[$r]->pre_id . "\",\"" . $arrPrenda[$r]->pre_nombre . "\",\"" . utf8_encode($arrPrenda[$r]->pre_fecha) . "\",\"" . utf8_encode($arrPrenda[$r]->pre_img_name) . "\"
function updaPrenda(opcion,ca_id,pre_id,pr_id,pre_nombre,pre_material,pr_precio,pr_talla,pr_color){
    //alert(ca_id+','+pe_id+','+pr_id+','+ pr_nombre+','+pr_material+','+pr_precio+','+pr_talla+','+pr_color);
    
    var parametros = {
        "opcion" : opcion,
        "ca_id" : ca_id,
        "pe_id" : pe_id,
        "pr_id" : pr_id,
        "pr_nombre" : pr_nombre,
        "pr_material" : pr_material,
        "pr_precio" : pr_precio,
        "pr_talla" : pr_talla,
        "pr_color" : pr_color
    };
    $.ajax({
        data: parametros,
        url: 'gestion/prendaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPrenda(ca_id, '0');
        }
    });
}

function editPrenda(pre_cli_id,pre_id,pre_nombre,pre_fecha,pre_img_name){
    document.getElementById('pre_nombre').value=pre_nombre;
    document.getElementById('pre_fecha').value=pre_fecha;
     $.getJSON('../../../controlador/gestion/getListPrenda.php', {
        pre_id: pre_id
     }, function(data) {        
        console.log(data.length);
        /*
        if(data.length >0){          
            for(var i=0;i<data.length;i++){
                console.log(data[i][0]);
            }
        }*/
    });
}
 
 /*
  

 $.getJSON('gestion/selectUsuarioRol.php', {
        us_id: us_id,
        ro_id: ro_id
    }, function(data) {
        var ul=document.getElementById('dropdown-menu');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][2]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:consResponsabilidad("'+data[i][0]+'","'+data[i][1]+'","'+0+'");asignarRol("'+data[i][2]+'");');
                ul.appendChild(elemento);
            }
        }
    });

  */

function delPrenda(opcion,pre_id){
    var parametros = {
        "opcion" : opcion,
        "pre_id" : pre_id
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/prendaFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (data) { 
            console.log(data);
            consPrenda('0');
        }
    });     
}

function changePrenda(id_descripcion){
    document.getElementById('id_descripcion').innerHTML=id_descripcion;
}

/*PEDIDO imprime todos los pedidos*/ 
function cambiarEstadoACINA(ped_estado){ 
    document.getElementById('estado_nombre').innerHTML=ped_estado;
    document.getElementById('ped_estado').value=ped_estado;   
}

function cambiarEstadoENPEDMAQUILA(maqui_nombre){ 
    document.getElementById('estado_nombre').innerHTML=maqui_nombre;
    document.getElementById('maq_estado').value=maqui_nombre;   
}

function buscarMaquilaTodos(){
    
    var fecha_ini=$("#fecha_ini").val();
    var fecha_fin=$("#fecha_fin").val();
    var maq_estado=$("#maq_estado").val();
    var fecha_estado=1;
    

    console.log(fecha_ini+','+fecha_fin+','+maq_estado);
    
    var parametros = {"fecha_ini" : fecha_ini,"fecha_fin" : fecha_fin,"fecha_estado" : fecha_estado,"maq_estado" : maq_estado}; 
    $.ajax({
        data: parametros,
        url: 'gestion/maquilaConsRPT.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    }); 
}


function buscarPedidoTodos(){
    var fecha_ini=$("#fecha_ini").val();
    var fecha_fin=$("#fecha_fin").val();
    var ped_estado=$("#ped_estado").val();
    var fecha_estado=1;
    var parametros = {"fecha_ini" : fecha_ini,"fecha_fin" : fecha_fin,"fecha_estado" : fecha_estado,"ped_estado" : ped_estado}; 
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoConsRPT.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function buscarPedidoTodosPagin(nropagina){
    var fecha_ini=$("#fecha_ini").val();
    var fecha_fin=$("#fecha_fin").val();
    var ped_estado=$("#ped_estado").val();
    var fecha_estado=1;
    
    var parametros = {
        "pag" : nropagina,
        "fecha_ini" : fecha_ini,
        "fecha_fin" : fecha_fin,
        "fecha_estado" : fecha_estado,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoConsRPT.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function buscarMaquilaTodosPagin(nropagina){
    var fecha_ini=$("#fecha_ini").val();
    var fecha_fin=$("#fecha_fin").val();
    var maq_estado=$("#maq_estado").val();
    var fecha_estado=1;
    
    var parametros = {
        "pag" : nropagina,
        "fecha_ini" : fecha_ini,
        "fecha_fin" : fecha_fin,
        "fecha_estado" : fecha_estado,
        "maq_estado" : maq_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/maquilaConsRPT.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function buscarPedidoTodosPDF(){
    var fecha_ini=$("#fecha_ini").val();
    var fecha_fin=$("#fecha_fin").val();
    var fecha_estado=1;
    var parametros = {"fecha_ini" : fecha_ini,"fecha_fin" : fecha_fin,"fecha_estado" : fecha_estado};
    //url: '../../../controlador/gestion/prendaCons.php',
    console.log(fecha_ini);
    console.log(fecha_fin);
    $.ajax({
        data: parametros,
        url: '../../aplicacion/vista/pantalla/registros/vistas/productos.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

// BUSCAR PEDIDO UNIDAD
function pedidoUnidadConsBusqueda(){
    var ped_nombre= $('#ped_nombre').val();
    var parametros = {
        "ped_nombre" : ped_nombre
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/pedidoUnidadConsBusqueda.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#contenedorRpt").html(response);            
            var fecha=$("#ped_fecha_entrega").val();
            var dateMenor=new Date(fecha);            
            var date=new Date();            
            var fMenor = dateMenor.getDate()+'/'+(dateMenor.getMonth()+1)+'/'+dateMenor.getFullYear();
            var fMayor=date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();    
            
            var fechaResta=restaFechas(fMayor,fMenor);
            document.getElementById('FEC').innerHTML=fechaResta;
        }
    });
}

// BUSCAR MAQUILA
function maquilaConsBusqueda(){
    var maqui_nombre= $('#maqui_nombre').val();
    var parametros = {
        "maqui_nombre" : maqui_nombre
    };
    //url: '../../../controlador/gestion/pedidoUnidadConsBusqueda.php',
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/maquilaConsBusqueda.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#contenedorRpt").html(response);            
            /*var fecha=$("#ped_fecha_entrega").val();
            var dateMenor=new Date(fecha);            
            var date=new Date();            
            var fMenor = dateMenor.getDate()+'/'+(dateMenor.getMonth()+1)+'/'+dateMenor.getFullYear();
            var fMayor=date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();    
            
            var fechaResta=restaFechas(fMayor,fMenor);
            document.getElementById('FEC').innerHTML=fechaResta;
            */
        }
    });
}



function mostrarMaquila(){
    console.log(1);
    document.getElementById('mostrar1').style.display='block';
    document.getElementById('mostrar2').style.display='none';
    //document.getElementById("check_maquila").checked = true;
    document.getElementById("check_prod").checked = false;
    
    //check_check_maquila
    //check_prod
    
}

function mostrarProduccion(){
    document.getElementById('mostrar2').style.display='block';
    document.getElementById('mostrar1').style.display='none';
    document.getElementById("check_maquila").checked = false;
}


function consPedidoRPT(ped_id){
    var parametros = {
        "ped_id" : ped_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoConsRPT.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);            
            var valor = $("#tamPedido").val();
            var fCre;
            var dateMenor;
            var date;
            var resta;
            var fMenor;
            var fMayor;
            for (i=0;i<=valor; i++) {
                fCre = document.getElementById('fEnt' + i).innerHTML;
                dateMenor=new Date(fCre);
                date=new Date();
                fMenor = dateMenor.getDate()+'/'+(dateMenor.getMonth()+1)+'/'+dateMenor.getFullYear();
                fMayor=date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
                resta=restaFechas(fMayor,fMenor);
                document.getElementById('diasRest'+i).innerHTML=resta+' días';
            }
        }
    });
} 

function consMaquilaRPT(ped_id){
    var parametros = {
        "ped_id" : ped_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/maquilaConsRPT.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
          
        }
    });
}



function PaginPedidoRPT(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoConsRPT.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function consPedido(ped_id){
    var parametros = {
        "ped_id" : ped_id
    };
    
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
            
            var valor = $("#tamPedido").val();
            var fCre;
            var dateMenor;
            var date;
            var resta;
            var fMenor;
            var fMayor;
            var i=0;
            for (i=0;i<=valor; i++) {
                fCre = document.getElementById('fEnt' + i).innerHTML;
                dateMenor=new Date(fCre);
                date=new Date();
                fMenor = dateMenor.getDate()+'/'+(dateMenor.getMonth()+1)+'/'+dateMenor.getFullYear();
                fMayor=date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
                resta=restaFechas(fMayor,fMenor);
                document.getElementById('diasRest'+i).innerHTML=resta+' días';
            }
        }
    });
}

function PaginPedido(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function addPedido(){
    //var elemento = document.getElementById('#ventanaTotal');// querySelector('#ve');
    //elemento.setAttribute("background", "red");
    //document.getElementById("ventanaTotal").setAttribute('style', 'background:red;z-index:1000000;');
    
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/pedidoFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  

function AgregarPedido() {
    //validar roles
    var date=new Date();
    var fecha=date.getFullYear()+'/'+(date.getMonth()+1)+'/'+date.getDate();
    var fechaResta=date.getFullYear()+'/'+(date.getMonth()+1)+'/'+date.getDate();
    
    var ped_estado=$("#ped_estado_val").val();
    var ped_fecha_entrega=$("#ped_fecha_entrega").val();
    
    
    var opcion=$("#opcion_ped").val();
    var ped_nombre_ROL=$("#ped_nombre_ROL").val();
    if(ped_nombre_ROL==="ROLADMIN"){
        var ped_id=$("#ped_id").val();
        var ped_nombre=$("#ped_nombre").val();
        insertPedidoROLADMIN(opcion,ped_id,ped_nombre_ROL,ped_nombre,fecha,ped_estado,ped_fecha_entrega);
    }
    
    if(ped_nombre_ROL==="ROLPRENDA"){
        var ped_id=$("#ped_id").val();
        var ped_pre_id=$("#ped_pre_id").val();
        var ped_pre_comentario=$("#ped_pre_comentario").val();        
        insertPedidoROLPRENDA(opcion,ped_id,ped_nombre_ROL,ped_pre_id,fecha,ped_pre_comentario,fechaResta,ped_estado);
    }
    
    if(ped_nombre_ROL==="ROLMODELO"){
        var ped_id=$("#ped_id").val();
        var ped_mod_id=$("#ped_mod_id").val();
        var ped_mod_comentario=$("#ped_mod_comentario").val();
        if(ped_mod_id==="on"){
            ped_mod_id=''; 
        }        
        if($("#ped_pre_id").val()){
            insertPedidoROLMODELO(opcion,ped_id,ped_nombre_ROL,ped_mod_id,fecha,ped_mod_comentario,fechaResta,ped_estado);
        }else{
            document.getElementById("divTarea").setAttribute('style', 'top: 7%; display: block;left:35%; width: 30%;position: absolute;');            
        }
    }
    
    if(ped_nombre_ROL==="ROLTRAZO"){
        var ped_id=$("#ped_id").val();
        var ped_tra_id=$("#ped_tra_id").val();  
        var ped_tra_comentario=$("#ped_tra_comentario").val();
        if(ped_tra_id==="on"){
            ped_tra_id=''; 
        }
        if($("#ped_mod_id").val()){
            insertPedidoROLTRAZO(opcion,ped_id,ped_nombre_ROL,ped_tra_id,fecha,ped_tra_comentario,fechaResta,ped_estado);
        }else{
            document.getElementById("divTarea").setAttribute('style', 'top: 7%; display: block;left:35%; width: 30%;position: absolute;');
        }        
    }
    
    if(ped_nombre_ROL==="ROLCORTADOR"){
        var ped_id=$("#ped_id").val();
        var ped_cor_id=$("#ped_cor_id").val();
        var ped_cor_comentario=$("#ped_cor_comentario").val();
        
        if(ped_cor_id==="on"){
            ped_cor_id=''; 
        }
        if($("#ped_tra_id").val()){
            insertPedidoROLCORTADOR(opcion,ped_id,ped_nombre_ROL,ped_cor_id,fecha,ped_cor_comentario,fechaResta,ped_estado);
        }else{
            document.getElementById("divTarea").setAttribute('style', 'top: 7%; display: block;left:35%; width: 30%;position: absolute;');            
        }
    }
    
    if(ped_nombre_ROL==="ROLDISENIO"){
        var ped_id=$("#ped_id").val();
        var ped_dise_id=$("#ped_dise_id").val();
        var ped_dise_comentario=$("#ped_dise_comentario").val();
        if(ped_dise_id==="on"){
            ped_dise_id='';
        }
        if($("#ped_cor_id").val()){
            insertPedidoROLDISENIO(opcion,ped_id,ped_nombre_ROL,ped_dise_id,fecha,ped_dise_comentario,fechaResta,ped_estado);
        }else{
            document.getElementById("divTarea").setAttribute('style', 'top: 7%; display: block;left:35%; width: 30%;position: absolute;');            
        }
    }
    
    if(ped_nombre_ROL==="ROLDESPACHO"){
        var ped_id=$("#ped_id").val();        
        var ped_des_id=$("#ped_des_id").val();        
        var ped_maq_id=$("#ped_maq_id").val();
        var ped_maq_fecha=$("#ped_maq_fecha").val();
        
        var ped_des_comentario=$("#ped_des_comentario").val();
        
        
        if(ped_des_id==="on"){
            ped_des_id='';
        }
        
        if($("#ped_dise_id").val()){
            console.log(ped_des_id+','+ped_maq_id+','+ped_maq_fecha+','+ped_des_comentario);
            insertPedidoROLDESPACHO(opcion,ped_id,ped_nombre_ROL,ped_des_id,fecha,ped_des_comentario,ped_maq_id,ped_maq_fecha,fechaResta,ped_estado);
        }else{
            document.getElementById("divTarea").setAttribute('style', 'top: 7%; display: block;left:35%; width: 30%;position: absolute;');            
        }        
    } 
    
    if(ped_nombre_ROL==="ROLPRODUCCION"){
        var ped_id=$("#ped_id").val();
        var ped_prodc_id=$("#ped_prodc_id").val();
        var ped_prodc_comentario=$("#ped_prodc_comentario").val();
        if($("#ped_des_id").val()){ 
            insertPedidoROLPRODUCCION(opcion,ped_id,ped_nombre_ROL,ped_prodc_id,fecha,ped_prodc_comentario,fechaResta,ped_estado);
        }else{
            document.getElementById("divTarea").setAttribute('style', 'top: 7%; display: block;left:35%; width: 30%;position: absolute;');
            xxx
        }
    }
    
    if(ped_nombre_ROL==="ROLCALIDAD"){
        var ped_id=$("#ped_id").val();
        var ped_cal_id=$("#ped_cal_id").val();
        var ped_cal_comentario=$("#ped_cal_comentario").val();
        
        if($("#ped_prodc_id").val()){
            insertPedidoROLCALIDAD(opcion,ped_id,ped_nombre_ROL,ped_cal_id,fecha,ped_cal_comentario,fechaResta,ped_estado);
        }else{
            document.getElementById("divTarea").setAttribute('style', 'top: 7%; display: block;left:35%; width: 30%;position: absolute;');            
        } 
    }
    
    if(ped_nombre_ROL==="ROLEMPAQUE"){
        var ped_id=$("#ped_id").val();
        var ped_emp_id=$("#ped_emp_id").val();
        var ped_emp_comentario=$("#ped_emp_comentario").val();
        if(ped_emp_id==="on"){
            ped_emp_id='';
        }
        if($("#ped_cal_id").val()){
            insertPedidoROLEMPAQUE(opcion,ped_id,ped_nombre_ROL,ped_emp_id,fecha,ped_emp_comentario,fechaResta,ped_estado);
        }else{
            document.getElementById("divTarea").setAttribute('style', 'top: 7%; display: block;left:35%; width: 30%;position: absolute;');            
        }        
    }    
}

function mostrarDivTarea(div) {
    document.getElementById(div).style.display = 'block';
}

function insertPedidoROLADMIN(opcion,ped_id,ped_nombre_ROL,ped_nombre,fecha,ped_estado,ped_fecha_entrega){
    console.log(ped_id);
    console.log(opcion+','+ped_id+','+ped_nombre_ROL+','+ped_nombre+','+fecha+','+ped_estado+','+ped_fecha_entrega);
    var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_nombre" : ped_nombre,
        "fecha" : fecha,
        "ped_estado" : ped_estado,
        "ped_fecha_entrega" : ped_fecha_entrega
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
} 
function insertPedidoROLPRENDA(opcion,ped_id,ped_nombre_ROL,ped_pre_id,fecha,ped_pre_comentario,fechaResta,ped_estado){
    console.log(fechaResta);
      var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_pre_id" : ped_pre_id,
        "ped_pre_comentario" : ped_pre_comentario,
        "fecha" : fecha,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
}

function insertPedidoROLDESPACHO(opcion,ped_id,ped_nombre_ROL,ped_des_id,fecha,ped_des_comentario,ped_maq_id,ped_maq_fecha,fechaResta,ped_estado){
    //insertPedidoROLDESPACHO(opcion,ped_id,ped_nombre_ROL,ped_des_id,fecha,ped_des_comentario,ped_maq_id,ped_maq_fecha,fechaResta,ped_estado);
    console.log(opcion+','+ped_nombre_ROL+','+ped_des_id);
      var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_des_id" : ped_des_id,
        "ped_des_comentario" : ped_des_comentario,
        "ped_maq_id" : ped_maq_id,
        "ped_maq_fecha" : ped_maq_fecha,
        "fecha" : fecha,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
}

function insertPedidoROLMODELO(opcion,ped_id,ped_nombre_ROL,ped_mod_id,fecha,ped_mod_comentario,fechaResta,ped_estado){
    console.log(opcion+','+ped_nombre_ROL+','+ped_mod_id);
      var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_mod_id" : ped_mod_id,
        "ped_mod_comentario" : ped_mod_comentario,
        "fecha" : fecha,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
}

function insertPedidoROLCORTADOR(opcion,ped_id,ped_nombre_ROL,ped_cor_id,fecha,ped_cor_comentario,fechaResta,ped_estado){
    console.log(opcion+','+ped_nombre_ROL+','+ped_cor_id);
      var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_cor_id" : ped_cor_id,
        "ped_cor_comentario" : ped_cor_comentario,
        "fecha" : fecha,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
}

function insertPedidoROLTRAZO(opcion,ped_id,ped_nombre_ROL,ped_tra_id,fecha,ped_tra_comentario,fechaResta,ped_estado){
    console.log(opcion+','+ped_nombre_ROL+','+ped_tra_id);
      var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_tra_id" : ped_tra_id,
        "ped_tra_comentario" : ped_tra_comentario,
        "fecha" : fecha,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
}

function insertPedidoROLCALIDAD(opcion,ped_id,ped_nombre_ROL,ped_cal_id,fecha,ped_cal_comentario,fechaResta,ped_estado){
      //console.log(opcion+','+ped_nombre_ROL+','+ped_cal_id);
      var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_cal_id" : ped_cal_id,
        "ped_cal_comentario" : ped_cal_comentario,
        "fecha" : fecha,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
}

function insertPedidoROLEMPAQUE(opcion,ped_id,ped_nombre_ROL,ped_emp_id,fecha,ped_emp_comentario,fechaResta,ped_estado){
    console.log(ped_estado);
      var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_emp_id" : ped_emp_id,
        "ped_emp_comentario" : ped_emp_comentario,
        "fecha" : fecha,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
}

function insertPedidoROLDISENIO(opcion,ped_id,ped_nombre_ROL,ped_dise_id,fecha,ped_dise_comentario,fechaResta,ped_estado){
    console.log(opcion+','+ped_nombre_ROL+','+ped_dise_id);
      var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_dise_id" : ped_dise_id,
        "ped_dise_comentario" : ped_dise_comentario,
        "fecha" : fecha,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
}

//insertPedidoROLPRODUCCION(opcion,ped_id,ped_nombre_ROL,ped_prodc_id,fecha,ped_prodc_comentario,fechaResta,ped_estado);
function insertPedidoROLPRODUCCION(opcion,ped_id,ped_nombre_ROL,ped_prodc_id,fecha,ped_prodc_comentario,fechaResta,ped_estado){
       //console.log(opcion+','+ped_nombre_ROL+','+);
      var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id,
        "ped_nombre_ROL" : ped_nombre_ROL,
        "ped_prodc_id" : ped_prodc_id,
        "ped_prodc_comentario" : ped_prodc_comentario,
        "fecha" : fecha,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPedido('0');
            cerrarAuto();
        }
    });
}

function admPedidoAsignarPrenda(pre_id,pre_nombre){
    if(pre_nombre.length>=28){
        document.getElementById('pre_nombre').innerHTML=pre_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('pre_nombre').innerHTML=pre_nombre.substring(0, 28);
    }
    document.getElementById('ped_pre_id').value=pre_id;
    //document.getElementById('campo_prenda').value=pre_id;
}

function admPedidoAsignarDespacho(des_id,des_nombre){
    if(des_nombre.length>=28){
        document.getElementById('des_nombre').innerHTML=des_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('des_nombre').innerHTML=des_nombre.substring(0, 28);
    }
    document.getElementById('ped_des_id').value=des_id;
}

function admPedidoAsignarMaquila(maq_id,maq_nombre){
    if(maq_nombre.length>=28){
        document.getElementById('maq_nombre').innerHTML=maq_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('maq_nombre').innerHTML=maq_nombre.substring(0, 28);
    }
    document.getElementById('ped_maq_id').value=maq_id;
}


function admPedidoAsignarModelo(mod_id,mod_nombre){
    if(mod_nombre.length>=28){
        document.getElementById('mod_nombre').innerHTML=mod_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('mod_nombre').innerHTML=mod_nombre.substring(0, 28);
    }
    document.getElementById('ped_mod_id').value=mod_id;
    //document.getElementById('campo_modelo').value=mod_id;
}

function admPedidoAsignarCortador(cor_id,cor_nombre){
    if(cor_nombre.length>=28){
        document.getElementById('cor_nombre').innerHTML=cor_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('cor_nombre').innerHTML=cor_nombre.substring(0, 28);
    }
    document.getElementById('ped_cor_id').value=cor_id;
    //document.getElementById('campo_cortador').value=cor_id;
}

function admPedidoAsignarTrazo(tra_id,tra_nombre){
    if(tra_nombre.length>=28){
        document.getElementById('tra_nombre').innerHTML=tra_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('tra_nombre').innerHTML=tra_nombre.substring(0, 28);
    }
    document.getElementById('ped_tra_id').value=tra_id;
    //document.getElementById('campo_trazo').value=tra_id;
}

function admPedidoAsignarCalidad(cal_id,cal_nombre){
    if(cal_nombre.length>=28){
        document.getElementById('cal_nombre').innerHTML=cal_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('cal_nombre').innerHTML=cal_nombre.substring(0, 28);
    }
    document.getElementById('ped_cal_id').value=cal_id;
    //document.getElementById('campo_calidad').value=cal_id;
}

function admPedidoAsignarEmpaque(emp_id,emp_nombre){
    if(emp_nombre.length>=28){
        document.getElementById('emp_nombre').innerHTML=emp_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('emp_nombre').innerHTML=emp_nombre.substring(0, 28);
    }
    document.getElementById('ped_emp_id').value=emp_id;
    //document.getElementById('campo_empaque').value=emp_id;
}

function admPedidoEstado(ped_estado){
    console.log(ped_estado);
    document.getElementById('ped_estado_nombre').innerHTML=ped_estado;
    document.getElementById('ped_estado_val').value=ped_estado;
}

function admPedidoAsignarDisenio(dise_id,dise_nombre){
    if(dise_nombre.length>=28){
        document.getElementById('dise_nombre').innerHTML=dise_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('dise_nombre').innerHTML=dise_nombre.substring(0, 28);
    }
    document.getElementById('ped_dise_id').value=dise_id;
    //document.getElementById('campo_disenio').value=dise_id;
}

function admPedidoAsignarProduccion(prodc_id,prodc_nombre){
    if(prodc_nombre.length>=28){
        document.getElementById('prodc_nombre').innerHTML=prodc_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('prodc_nombre').innerHTML=prodc_nombre.substring(0, 28);
    }
    document.getElementById('ped_prodc_id').value=prodc_id;
    //document.getElementById('campo_area').value=are_id;
}

function restaFechas(f1,f2){
    var aFecha1 = f1.split('/'); 
    var aFecha2 = f2.split('/'); 
    var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
    var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
    return dias;
}
 
function editPedido(ped_fecha,ped_id,ped_nombre,ped_pre_id,ped_des_id,ped_mod_id,ped_cor_id,ped_tra_id,ped_cal_id,ped_emp_id,ped_dise_id,ped_prodc_id,ped_pre_comentario,ped_des_comentario,ped_mod_comentario,ped_cor_comentario,ped_tra_comentario,ped_cal_comentario,ped_emp_comentario,ped_dise_comentario,ped_prodc_comentario,ped_estado,ped_fecha_entrega,ped_maq_id,ped_des_fecha){
    
    console.log(ped_des_id+','+ped_maq_id+','+ped_des_comentario+','+ped_des_fecha);
    console.log(ped_des_id);
    
    
    var dateMenor=new Date(ped_fecha_entrega);    
    var date=new Date();
    var fMenor = dateMenor.getDate()+'/'+(dateMenor.getMonth()+1)+'/'+dateMenor.getFullYear();
    var fMayor=date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();    
    var fechaResta=restaFechas(fMayor,fMenor);
    mostrarDiv("divFormulario");
    console.log('fechaResta');
    console.log(fechaResta);
    var parametros = {
        "ped_id" : ped_id,
        "ped_nombre" : ped_nombre,
        "ped_pre_id" : ped_pre_id,
        "ped_des_id" : ped_des_id,
        "ped_mod_id" : ped_mod_id,
        "ped_cor_id" : ped_cor_id,
        "ped_tra_id" : ped_tra_id,
        "ped_cal_id" : ped_cal_id,
        "ped_emp_id" : ped_emp_id,
        "ped_dise_id" : ped_dise_id,
        "ped_prodc_id" : ped_prodc_id,
        "ped_pre_comentario" : ped_pre_comentario,
        "ped_des_comentario" : ped_des_comentario,
        "ped_mod_comentario" : ped_mod_comentario,
        "ped_cor_comentario" : ped_cor_comentario,
        "ped_tra_comentario" : ped_tra_comentario,
        "ped_cal_comentario" : ped_cal_comentario,
        "ped_emp_comentario" : ped_emp_comentario,
        "ped_dise_comentario" : ped_dise_comentario,
        "ped_prodc_comentario" : ped_prodc_comentario,
        "fechaResta" : fechaResta,
        "ped_estado" : ped_estado,
        "ped_fecha_entrega" : ped_fecha_entrega,
        "ped_maq_id" : ped_maq_id,
        "ped_des_fecha" : ped_des_fecha
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
             if(ped_des_id!==''){
                 document.getElementById('mostrar1').style.display = 'block';
             } 
       }
    });
}

function delPedido(opcion,ped_id){
    var parametros = {
        "opcion" : opcion,
        "ped_id" : ped_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pedidoFuncion.php',
        type: 'post',
        success: function () { 
            consPedido('0'); 
        }
    }); 
}

/*ADMINISTRACION*/

function consUsuario(us_id){
    var parametros = {
        "us_id" : us_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function PaginUsuario(nropagina){
    var parametros = {
        "pag" : nropagina,
        "us_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addUsuario(){
    document.getElementById("divFormulario").setAttribute('style', 'left:35%;display:block; top:55px;width:63%;height:75%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/usuarioFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposUsuario(){    
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    $("#botonn").ready(function (){
        $(".errorE").remove();                 
        if($("#us_nombre").val() === ""){
            $("#us_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#us_nombre").val().length<=2  || $("#us_nombre").val().length>31){
            $("#us_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–32 caracteres]</span>");
            return false;
        }
        else if($("#us_mail").val() === "" ){
            $("#us_mail").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if(!emailreg.test($("#us_mail").val()) ){
            $("#us_mail").focus().after("<span class='errorE'>Ingrese un email válido!.</span>");
            return false;
        }
        else if($("#us_mail").val().length<=2 || $("#us_mail").val().length>23){
            $("#us_mail").focus().after("<span class='errorE'>Ingrese un valor [5–24 caracteres]</span>");
            return false;
        } 
        else if($("#us_clave").val() === "" ){
            $("#us_clave").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#us_clave").val().length<=2 || $("#us_clave").val().length>14){
            $("#us_clave").focus().after("<span class='errorE'>Ingrese un valor [5–15 caracteres]</span>");
            return false;
        }
        else if($("#us_estado").val() === "" ){
            $("#us_estado").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#us_estado").val().length<=1  || $("#us_estado").val().length>4){
            $("#us_estado").focus().after("<span class='errorE'>Ingrese un valor [1–5 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_usr").val();
            var us_id=$("#us_id").val();
            insertUsuario(opcion,us_id,$("#us_nombre").val(),$("#us_mail").val(),$("#us_clave").val(),$("#us_estado").val()); 
        }
    });
    
    $("#us_nombre, #us_mail, #us_clave, #us_estado").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertUsuario(opcion,us_id,us_nombre,us_mail,us_clave,us_estado){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id,
        "us_nombre" : us_nombre,
        "us_mail" : us_mail,
        "us_clave" : us_clave,
        "us_estado" : us_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            imprimeExito(response);
            consUsuario('0');
            //cerrarAuto();
        }
    });
}
  

function editUsuario(us_id,us_nombre,us_mail,us_clave,us_estado){
    mostrarDiv("divFormulario");
    var parametros = { 
        "us_id" : us_id,
        "us_nombre" : us_nombre, 
        "us_mail" : us_mail, 
        "us_clave" : us_clave,
        "us_estado" : us_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
 

function delUsuario(opcion,us_id){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
            consUsuario('0');
        }
    }); 
}

function irUsuarioRol(us_id,us_nombre){
    var parametros = {
        "us_id" : us_id,
        "us_nombre" : us_nombre
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admrol.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
            consRol(us_id, '0');
            asignarUsuario(us_nombre);
        }
    });
} 

function asignarUsuario(us_nombre){
    document.getElementById('us_nombre').innerHTML=us_nombre;
}

/*Rol********************************************************************/

function consRol(us_id,ro_id){
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginRol(nropagina){
    var us_id= $("#US_id").val();
    var parametros = {
        "pag" : nropagina,
        "us_id" : us_id,
        "ro_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}  

function addRol(){
    mostrarDiv("divFormulario");
    var US_id= $("#US_id").val();
    var parametros = {
        "us_id" : US_id 
    }; 
    $.ajax({
        data: parametros,
        url: 'gestion/rolFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposRol(){
    var us_id=$("#US_id").val();
    $("#botonn").ready(function (){
        $(".errorE").remove();    
        if($("#ro_nombre").val() === ""){
            $("#ro_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#ro_nombre").val().length<=2  || $("#ro_nombre").val().length>19){
            $("#ro_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–20 caracteres]</span>");
            return false;
        }else if($("#ro_descripcion").val() === "" ){
            $("#ro_descripcion").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#ro_descripcion").val().length<=2  || $("#ro_descripcion").val().length>63){
            $("#ro_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–64 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_rol").val();
            var ro_id=$("#ro_id").val();
            insertRol(opcion,us_id,ro_id,$("#ro_nombre").val(),$("#ro_descripcion").val()); 
        }
    });
    
    $("#ro_nombre, #ro_descripcion").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertRol(opcion,us_id,ro_id,ro_nombre,ro_descripcion){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "ro_nombre" : ro_nombre,
        "ro_descripcion" : ro_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFuncion.php',
        type: 'post',
        beforeSend: function () {
        //  $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consRol(us_id, '0');
            //cerrarAuto();
        }
    });
}
  

function editRol(us_id,ro_id,ro_nombre,ro_descripcion){
    mostrarDiv("divFormulario");
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "ro_nombre" : ro_nombre,
        "ro_descripcion" : ro_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delRol(opcion,us_id,ro_id){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id,
        "ro_id" : ro_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consRol(us_id, '0');
        }
    }); 
}

/*Modulo*/

function selectUsuarioRol(us_id,ro_id){
    var i=0;
    var elemento='';
    var texto='';
    var ancla='';
    $.getJSON('gestion/selectUsuarioRol.php', {
        us_id: us_id,
        ro_id: ro_id
    }, function(data) {
        var ul=document.getElementById('dropdown-menu');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][2]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:consResponsabilidad("'+data[i][0]+'","'+data[i][1]+'","'+0+'");asignarRol("'+data[i][2]+'");');
                ul.appendChild(elemento);
            }
        }
    });
} 

function asignarRol(ro_nombre){
    document.getElementById('ro_nombre').innerHTML = ro_nombre.toString();
}

function consResponsabilidad(us_id,ro_id,re_id){
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginRespon(nropagina){
    var em_id=$("#EM_id").val();
    var us_id=$("#US_id").val();
    var ro_id=$("#RO_id").val();
    var parametros = {
        "pag" : nropagina,
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addResponsabilidad(){
    mostrarDiv("divFormulario");
    var US_id=$("#US_id").val();
    var RO_id=$("#RO_id").val();
    
    var parametros = {
        "us_id" : US_id,
        "ro_id" : RO_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposResponsabilidad(){
    var us_id=  $("#re_us_id").val();
    var ro_id=  $("#re_ro_id").val();    
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#re_nombre").val() === "" ){
            $("#re_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#re_nombre").val().length<=2  || $("#re_nombre").val().length>19){
            $("#re_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–20 caracteres]</span>");
            return false;
        }
        else if($("#re_descripcion").val() === ""){
            $("#re_descripcion").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        } 
        else if($("#re_descripcion").val().length<=2  || $("#re_descripcion").val().length>63){
            $("#re_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–64 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_resp").val();
            var re_id=$("#re_re_id").val();
           insertResponsabilidad(opcion,us_id,ro_id,re_id,$("#re_nombre").val(),$("#re_descripcion").val());
        }
    });
    
    $("#re_nombre, #re_descripcion").keyup(function(){
        if( $(this).val() !== "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}

function insertResponsabilidad(opcion,us_id,ro_id,re_id,re_nombre,re_descripcion){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id, 
        "ro_id" : ro_id,
        "re_id" : re_id,
        "re_nombre" : re_nombre,
        "re_descripcion" : re_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFuncion.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            //alert(response);
            consResponsabilidad(us_id, ro_id, '0'); 
        }
    });
}

function editResponsabilidad(us_id,ro_id,re_id,re_nombre,re_descripcion){
    mostrarDiv("divFormulario");
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id,
        "re_nombre" : re_nombre,
        "re_descripcion" : re_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delResponsabilidad(opcion,us_id,ro_id,re_id){  
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consResponsabilidad(us_id, ro_id, '0');
        }
    });     
}
function irRolResponsabilidad(us_id,ro_id,ro_nombre){
    var us_nombre=document.getElementById('us_nombre').innerHTML;
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "ro_nombre" : ro_nombre
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admresponsabilidad.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
            selectUsuarioRol(us_id, ro_id);
            asignarUsuario(us_nombre);
            consResponsabilidad(us_id, ro_id, '0');
            asignarRol(ro_nombre);
        }
    });
} 

/*PANTALLAS*/

function asignarResponsabilidad(re_nombre){
    document.getElementById('re_nombre').innerHTML=re_nombre;
}

function selectUsuarioRol_pantalla(us_id,us_nombre){
    var i=0;
    var elemento='';
    var texto='';
    var ancla='';
    $.getJSON('gestion/selectUsuarioRol.php', {
        us_id: us_id,
        us_nombre: us_nombre
    }, function(data) {
        var ul=document.getElementById('dropdown-menu_doble');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][2]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:consRolResponsabilidad_pantalla("'+data[i][0]+'","'+data[i][1]+'","'+0+'");asignarRol("'+data[i][2]+'");');
                ul.appendChild(elemento);
            }
        }
    });
} 

function consRolResponsabilidad_pantalla(us_id,ro_id,ro_nombre){
    console.log(us_id+','+ro_id+','+ro_nombre);
    var i=0;
    var elemento='';
    var texto='';
    var ancla='';
    $.getJSON('gestion/selectRolResponsabilidad.php', {
        us_id: us_id,
        ro_id: ro_id,
        ro_nombre: ro_nombre
    }, function(data) {
        console.log(data);
        
        var ul=document.getElementById('dropdown-menu_triple');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][3]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href','javascript:consPantalla("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+0+'");asignarResponsabilidad("'+data[i][3]+'");');
                ul.appendChild(elemento);
            }
        }
    });
} 

function consPantalla(us_id,ro_id,re_id,pa_id){
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id,
        "pa_id" : pa_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pantallaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function activarChkBox(nameChkBox) {
    var arreglock = document.getElementsByName(nameChkBox);
    for (i = 0; i < arreglock.length; i++)
        arreglock[i].removeAttribute("disabled");
    var chkpadre=document.getElementById('chkPadreRol'); 
    if(chkpadre)
        chkpadre.removeAttribute("disabled");
}

function consultarPantallasAsignadas() {
    var p_us_id=  $("#PA_us_id").val();
    var p_ro_id=  $("#PA_ro_id").val();
    var p_re_id=  $("#PA_re_id").val();
    $.getJSON('gestion/pantallaSelect.php', {
        p_us_id: p_us_id,
        p_ro_id: p_ro_id,
        p_re_id: p_re_id
    } ,function(data) {
        marcarChkBox("chkHijoRol", data);
    });
}

function marcarChkBox(chkBoxName, elementSelecteds) {
    var listChkBox = document.getElementsByName(chkBoxName);
    for (i = 0; i < elementSelecteds.length; i++) {
        for (j = 0; j < listChkBox.length; j++)
            if (elementSelecteds[i] == listChkBox[j].id)
                listChkBox[j].checked = true;
    }
} 

function closer() { 
    /*$.ajax({
        url: 'exit.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            
        }
    });    */
    var ventana = window.self;
    ventana.opener = window.self;
    ventana.close();
}

function insertarPantallas() {
    var arrPanSelected = new Array();
    var arrChkBox = new Array();
    var j = 0;
    var usu,rol, res ,pt_id, pt_nombre, pt_descripcion=null;
    arrChkBox = document.getElementsByName('chkHijoRol');    
    for (i = 0; i <arrChkBox.length; i++) { 
        usu = document.getElementById('pt_us_id' + i).innerHTML;
        rol = document.getElementById('pt_ro_id' + i).innerHTML;
        res = document.getElementById('pt_re_id' + i).innerHTML;
        pt_id = document.getElementById('pt_id' + i).innerHTML;
        pt_nombre = document.getElementById('pt_nom' + i).innerHTML;
        pt_descripcion = document.getElementById('pt_des' + i).innerHTML;
        if (arrChkBox[i].checked) {
            //alert(usu+','+rol+','+res+','+pt_id+','+pt_nombre+','+pt_descripcion); 
            arrPanSelected[j] = [usu.toString(),rol.toString(),res.toString(),pt_id.toString(),pt_nombre.toString(),pt_descripcion.toString()];
            j++;
        }else
        {
            eliminarPantalla(usu,rol, res ,pt_id);
            j++;
        }
    }
    
    var	ajaxGuardarPantallas = nuevoAjax();
    ajaxGuardarPantallas.onreadystatechange = function() {
        if (ajaxGuardarPantallas.readyState === 4)
            if (ajaxGuardarPantallas.responseText) {
                //alert(ajaxGuardarPantallas.responseText);
                document.getElementById('resultadoPantalla').innerHTML = ajaxGuardarPantallas.responseText;
            }
            else{ 
                document.getElementById('resultadoPantalla').innerHTML = "<img src='img/loading2.gif' /> Cargando...";
            }
    };
    ajaxGuardarPantallas.open('post', 'gestion/pantallaInsert.php', true);
    ajaxGuardarPantallas.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajaxGuardarPantallas.send(returnGuardarPantallas(arrPanSelected, arrChkBox));
    ComprobarSeleCheckHijos(); // comprobamos en el caso de que no tengamos
}

function returnGuardarPantallas(arrPanSelected, arrChkBox) {
    var cad = '';
    cad = 'arrPanSelected='+ encodeURIComponent(JSON.stringify(arrPanSelected)) + '&arrChkBox=' + encodeURIComponent(JSON.stringify(arrChkBox));
    return cad;
}

function eliminarPantalla(usu,rol, res ,pt_id) {
    var parametros = {
        "usu" : usu,
        "rol" : rol,
        "res" : res,
        "pt_id" : pt_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pantallaDel.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
        }
    });     
} 

function ComprobarSeleCheckHijos(){
    var arrChkBox = document.getElementsByName('chkHijoRol');
    var cont=0;
    for (i = 0; i < arrChkBox.length; i++) {
        if (arrChkBox[i].checked===1)
            cont++;
    }
    if(cont>0){
    //mostrarMensaje("Cambios Realizados");
    }
}

function DesactivarChkBox(){
    document.getElementById('chkPadreRol').disabled='disabled';
    var arreglochekHijo = document.getElementsByName('chkHijoRol');
    for (i = 0; i < arreglochekHijo.length; i++)
        arreglochekHijo[i].disabled='disabled';
}

/*-----------------------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------------------*/

/*Login*/
function asignarRolLogin(ro_id,ro_nombre){
    document.getElementById('ro_id').value=ro_id;
    document.getElementById('ro_nombre').innerHTML=ro_nombre;
}

function obtenerValores(vector){
    var vec = new Array();
    for ( var i = 0; i < vector.length; i++) {
        vec [i] = document.getElementById(vector[0]).value;
    }
    return vec;
}

/*******************************************************************************
 * Para mostrar y cerrar combos al dar click
 ******************************************************************************/
 
var JSON;
if (!JSON) {
    JSON = {};
}

(function() {
    'use strict';
    function f(n) {
        // Format integers to have at least two digits.
        return n < 10 ? '0' + n : n;
    }
    if (typeof Date.prototype.toJSON !== 'function') {
        Date.prototype.toJSON = function(key) {
            return isFinite(this.valueOf()) ? this.getUTCFullYear() + '-'
            + f(this.getUTCMonth() + 1) + '-' + f(this.getUTCDate())
            + 'T' + f(this.getUTCHours()) + ':'
            + f(this.getUTCMinutes()) + ':' + f(this.getUTCSeconds())
            + 'Z' : null;
        };
        
        String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function(
            key) {
            return this.valueOf();
        };
    }
    
    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, gap, indent, meta = { // table
        // of
        // character
        // substitutions
        '\b' : '\\b',
        '\t' : '\\t',
        '\n' : '\\n',
        '\f' : '\\f',
        '\r' : '\\r',
        '"' : '\\"',
        '\\' : '\\\\'
    }, rep;
    
    function quote(string) {
        // If the string contains no control characters, no quote characters,
        // and no
        // backslash characters, then we can safely slap some quotes around it.
        // Otherwise we must also replace the offending characters with safe
        // escape
        // sequences.
        
        escapable.lastIndex = 0;
        return escapable.test(string) ? '"'
        + string.replace(escapable,
            function(a) {
                var c = meta[a];
                return typeof c === 'string' ? c : '\\u'
                + ('0000' + a.charCodeAt(0).toString(16))
                .slice(-4);
            }) + '"' : '"' + string + '"';
    }
    function str(key, holder) {
        // Produce a string from holder[key].
        var i, // The loop counter.
        k, // The member key.
        v, // The member value.
        length, mind = gap, partial, value = holder[key];
        // If the value has a toJSON method, call it to obtain a replacement
        // value.
        if (value && typeof value === 'object'
            && typeof value.toJSON === 'function') {
            value = value.toJSON(key);
        }
        // If we were called with a replacer function, then call the replacer to
        // obtain a replacement value.
        if (typeof rep === 'function') {
            value = rep.call(holder, key, value);
        }
        // What happens next depends on the value's type.
        switch (typeof value) {
            case 'string':
                return quote(value);
            case 'number':
                
                // JSON numbers must be finite. Encode non-finite numbers as null.
                return isFinite(value) ? String(value) : 'null';
            case 'boolean':
            case 'null':
                // If the value is a boolean or null, convert it to a string. Note:
                // typeof null does not produce 'null'. The case is included here in
                // the remote chance that this gets fixed someday.
                return String(value);
            // If the type is 'object', we might be dealing with an object or an
            // array or
            // null.
            case 'object':
                // Due to a specification blunder in ECMAScript, typeof null is
                // 'object',
                // so watch out for that case.
                if (!value) {
                    return 'null';
                }
                // Make an array to hold the partial results of stringifying this
                // object value.
                gap += indent;
                partial = [];
                // Is the value an array?
                if (Object.prototype.toString.apply(value) === '[object Array]') {
                    // The value is an array. Stringify every element. Use null as a
                    // placeholder
                    // for non-JSON values.
                    length = value.length;
                    for (i = 0; i < length; i += 1) {
                        partial[i] = str(i, value) || 'null';
                    }
                    // Join all of the elements together, separated with commas, and
                    // wrap them in
                    // brackets.
                    
                    v = partial.length === 0 ? '[]' : gap ? '[\n' + gap
                    + partial.join(',\n' + gap) + '\n' + mind + ']' : '['
                    + partial.join(',') + ']';
                    gap = mind;
                    return v;
                }
                // If the replacer is an array, use it to select the members to be
                // stringified.
                if (rep && typeof rep === 'object') {
                    length = rep.length;
                    for (i = 0; i < length; i += 1) {
                        if (typeof rep[i] === 'string') {
                            k = rep[i];
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                } else {
                    // Otherwise, iterate through all of the keys in the object.
                    for (k in value) {
                        if (Object.prototype.hasOwnProperty.call(value, k)) {
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                }
                // Join all of the member texts together, separated with commas,
                // and wrap them in braces.
                v = partial.length === 0 ? '{}' : gap ? '{\n' + gap
                + partial.join(',\n' + gap) + '\n' + mind + '}' : '{'
                + partial.join(',') + '}';
                gap = mind;
                return v;
        }
    }
    // If the JSON object does not yet have a stringify method, give it one.
    if (typeof JSON.stringify !== 'function') {
        JSON.stringify = function(value, replacer, space) {
            // The stringify method takes a value and an optional replacer, and
            // an optional
            // space parameter, and returns a JSON text. The replacer can be a
            // function
            // that can replace values, or an array of strings that will select
            // the keys.
            // A default replacer method can be provided. Use of the space
            // parameter can
            // produce text that is more easily readable.
            var i;
            gap = '';
            indent = '';
            // If the space parameter is a number, make an indent string
            // containing that
            // many spaces.
            if (typeof space === 'number') {
                for (i = 0; i < space; i += 1) {
                    indent += ' ';
                }
            // indent string.
            } else if (typeof space === 'string') {
                indent = space;
            }
            // If there is a replacer, it must be a function or an array.
            // Otherwise, throw an error.
            rep = replacer;
            if (replacer
                && typeof replacer !== 'function'
                && (typeof replacer !== 'object' || typeof replacer.length !== 'number')) {
                throw new Error('JSON.stringify');
            }
            // Make a fake root object containing our value under the key of ''.
            // Return the result of stringifying the value.
            return str('', {
                '' : value
            });
        };
    }
    // If the JSON object does not yet have a parse method, give it one.
    if (typeof JSON.parse !== 'function') {
        JSON.parse = function(text, reviver) {
            // The parse method takes a text and an optional reviver function,
            // and returns
            // a JavaScript value if the text is a valid JSON text.
            var j;
            function walk(holder, key) {
                // The walk method is used to recursively walk the resulting
                // structure so
                // that modifications can be made.
                var k, v, value = holder[key];
                if (value && typeof value === 'object') {
                    for (k in value) {
                        if (Object.prototype.hasOwnProperty.call(value, k)) {
                            v = walk(value, k);
                            if (v !== undefined) {
                                value[k] = v;
                            } else {
                                delete value[k];
                            }
                        }
                    }
                }
                return reviver.call(holder, key, value);
            }
            // Parsing happens in four stages. In the first stage, we replace
            // certain
            // Unicode characters with escape sequences. JavaScript handles many
            // characters
            // incorrectly, either silently deleting them, or treating them as
            // line endings.
            text = String(text);
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx,
                    function(a) {
                        return '\\u'
                        + ('0000' + a.charCodeAt(0).toString(16))
                        .slice(-4);
                    });
            }
            // In the second stage, we run the text against regular expressions
            // that look
            // for non-JSON patterns. We are especially concerned with '()' and
            // 'new'
            // because they can cause invocation, and '=' because it can cause
            // mutation.
            // But just to be safe, we want to reject all unexpected forms.
            // We split the second stage into 4 regexp operations in order to
            // work around
            // crippling inefficiencies in IE's and Safari's regexp engines.
            // First we
            // replace the JSON backslash pairs with '@' (a non-JSON character).
            // Second, we
            // replace all simple value tokens with ']' characters. Third, we
            // delete all
            // open brackets that follow a colon or comma or that begin the
            // text. Finally,
            // we look to see that the remaining characters are only whitespace
            // or ']' or
            // ',' or ':' or '{' or '}'. If that is so, then the text is safe
            // for eval.
            if (/^[\],:{}\s]*$/
                .test(text
                    .replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
                    .replace(
                        /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
                        ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                // In the third stage we use the eval function to compile the
                // text into a
                // JavaScript structure. The '{' operator is subject to a
                // syntactic ambiguity
                // in JavaScript: it can begin a block or an object literal. We
                // wrap the text
                // in parens to eliminate the ambiguity.
                j = eval('(' + text + ')');
                // In the optional fourth stage, we recursively walk the new
                // structure, passing
                // each name/value pair to a reviver function for possible
                // transformation.
                return typeof reviver === 'function' ? walk({
                    '' : j
                }, '') : j;
            }
            // If the text is not JSON parseable, then a SyntaxError is thrown.
            throw new SyntaxError('JSON.parse');
        };
    }
}());
 
function ocultarDiv(div) {
    document.getElementById(div).style.display = 'none';
}

function mostrarDiv(div) {
    document.getElementById(div).style.display = 'block';
}
 