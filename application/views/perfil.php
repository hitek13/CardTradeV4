<?php
/**
 * Created by PhpStorm.
 * User: EXTMcaballer
 * Date: 30/05/2017
 * Time: 16:40
 */
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesPerfil.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/bootstrap.vertical-tabs.min.css">
<script>
    $(document).ready(function(){
        
        $("#userNickTitle").text(localStorage.Nick);
        $("#userNick").text(localStorage.Nick);
        cargarUsuarios();
        cargarComprasActivas();
        cargarComprasFin();
        cargarVentasActivas();
        cargarVentasFin();
        misOfertas ();
        //$("<h1>Hola</h1>").insertBefore('#texto'+'1234');
        //loadSMG('1234', 'Hola');
        var parametros = {
            'Nick': localStorage.Nick,
            'idUser': localStorage.id
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Users/getUserInfo")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(result){
                data = result.split(';');
                colocar(data[0],data[1],data[2],data[3],data[4],data[5],data[6],data[7],data[8],data[9]);
            },
            error: function(result){
                console.log(result);
                alert('Error getInfo: '+result);
            }
        });

   /*     $('#mensajes').on('click', function(){ 
            cargar_msg(localStorage.id);
        });*/
        /*||||||||||*/
        $('section h4').click(function(event) {
            event.preventDefault();
            $(this).addClass('active');
            $(this).siblings().removeClass('active');

            var ph = $(this).parent().height();
            var ch = $(this).next().height();

            if (ch > ph) {
                $(this).parent().css({
                    'min-height': ch + 'px'
                });
            } else {
                $(this).parent().css({
                    'height': 'auto'
                });
            }
        });

        function tabParentHeight() {
            var ph = $('section').height();
            var ch = $('section ul').height();
            if (ch > ph) {
                $('section').css({
                    'height': ch + 'px'
                });
            } else {
                $(this).parent().css({
                    'height': 'auto'
                });
            }
        }

        $(window).resize(function() {
            tabParentHeight();
        });

        $(document).resize(function() {
            tabParentHeight();
        });
        tabParentHeight();
        /*||||||||||*/
        $('#btn1234').on('click', function(){
            if($('#text1234').val()) {
                $(mensajeAzul('12/12/1222', $('#text1234').val())).insertBefore('#text1234');
                $('#text1234').val('')
            }
        });
    });
    function cargarUsuarios() {
        var parametros = {
            'idUser': localStorage.id
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Users/getTthread")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                datos = resultado.split('|');
                for(i=0; i< datos.length-1; i++){
                    nombre = datos[i].split(';')[0];
                    id = datos[i].split(';')[1];
                    addUser(id, nombre);
                }
                populateMSG();     
            },
            error: function(resultado){
                console.log(resultado);
                alert('Error: '+resultado);
            }
        });
    }
    function colocar(Email, Nombre, Apellidos, DNI, Direccion, Ciudad, Pais, FechaNac, Saldo, Valoracion){
        $('#spanSaldo').html(Saldo+" <span class='glyphicon glyphicon-eur' style='font-size: 65%;'></span>");
        $('#spanEmail').html(Email);
        $('#spanValoracion').html( Valoracion+" <span class='glyphicon glyphicon-star'></span>");
        $('#numValoraciones').html("(Te han valorado X veces)");
        $('#spanNombre').html(Nombre);
        $('#spanApellidos').html(Apellidos);
        $('#spanDNI').html(DNI);
        $('#spanFecNac').html(FechaNac);
        $('#spanDireccion').html(Direccion+'<br>'+Ciudad+'<br>'+Pais);
    }
    function addUser (id, nick){
        test = "<h4>What?</h4><ul><li>Potius inflammat, ut coercendi magis quam dedocendi esse videantur.</li><li>Atqui reperies, inquit, in hoc quidem pertinacem;</li><li>Verba tu fingas et ea dicas, quae non sentias?</li></ul>"
        cabeza = '<h4 id='+id+' onclick="active(this)" >';
        cuerpo1 = "</h4><ul><!-- MENSAJES--><!-- MENSAJES--><!--TEXTO--><textarea class='textarea' id='text";
        cuerpo2 = "'></textarea><button type='button' class='btn navbar-inverse btn-block btn_submit'";
        click = "onclick=addMSG('"+id+"') ";
        pie = ">Enviar</button><!--TEXTO--></ul>";
        $('#usuariosMsg').append(cabeza+nick+cuerpo1+id+cuerpo2+click+pie);
    }
    function mensajeVerde(nick, fecha, texto){
        cabeza = "<div class='media'> <a class='media-left' href='#'> <div class = 'rounded'> <span class='glyphicon glyphicon-user' style='font-size: 200%;'></span>";
        cuerpo = "</div> </a> <div class='media-body mensaje-B'> <div>";
        pie = " </div> </div> </div>";
        return cabeza+nick+cuerpo+'<h6>'+fecha+'</h6>'+texto+pie;
    }
    function mensajeAzul( fecha, texto){
        cuerpo = "<div class='media'><div class='media-body mensaje-A'> <div>";
        pie = " </div> </div> </div>";
        return cuerpo+'<h6>'+fecha+'</h6>'+texto+pie;
    }
    function addMSG (btn){
        //alert('llega');
        var d = new Date($.now());
        fecha = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
        texto = $('#text'+btn).val();
        if($('#text'+btn).val()) {
                $(mensajeAzul( fecha, $('#text'+btn).val())).insertBefore('#text'+btn);
                $('#text'+btn).val('')
            }
        var parametros = {
            'idUser': localStorage.id,
            'idReceptor': btn,
            'fechaHoy': fecha,
            'texto': texto
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Users/sendMsg")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                //alert("Exito "+resultado);
                //alert(resultado.length);
                //assingMsg(resultado);
            },
            error: function(resultado){
                console.log(resultado);
                alert('Error: '+resultado);
            }
        });
    }
    function loadMSG (btn, text){
        //alert('#texto'+btn);
        //$(text).insertBefore('#texto'+btn);
        $(text).insertBefore('#text'+btn);
    }
    function active(objeto){
        $('h4').removeClass();
        $(objeto).addClass('active');
        
    }
    function populateMSG(){
        var parametros = {
            'idUser': localStorage.id
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Users/getMsg")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                //alert(resultado[1]);
                //alert(resultado.length);
                assingMsg(resultado);
            },
            error: function(resultado){
                console.log(resultado);
                alert('Error: '+resultado);
            }
        });
    }
    function assingMsg(msgs){

        for(i=0; i < msgs.length; i++){
            currentMSG = msgs[i].split('|');
            if( currentMSG[0] == localStorage.id){
                loadMSG(currentMSG[1] ,mensajeAzul(currentMSG[2], currentMSG[3]));
            }else{
                if( currentMSG[1] == localStorage.id)
                    loadMSG(currentMSG[0] ,mensajeVerde( currentMSG[5], currentMSG[2], currentMSG[3]));  
            }
        }
    }
    function cargarComprasActivas() {
        var parametros = {
            'idUsuario': localStorage.id
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Transacciones/comprasActivas")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                //alert(resultado);
                crearCompra(resultado)
            },
            error: function(resultado){
                console.log(resultado);
                alert('Error: '+resultado);
            }
        });
    }
    function crearCompra(cadena){
        ventas = cadena.split('|');
        cabeza = '<div class="col-sm-12"><div class="col-sm-2"><h3>';
        cuerpo2 = '</h3></div><div class="col-sm-1"><h3>';
        cuerpo3 = '</h3></div><div class="col-sm-1"><h3>';
        cuerpo4 = '</h3></div><div class="col-sm-1"><h3>';
        cuerpo5 = '</h3></div><div class="col-sm-3"><h5><br>';
        cuerpo6 = '</h5></div><div class="col-sm-1"><h3>';
        pie = '<div class="col-sm-12"><br></div>';
        check = '<span class="glyphicon glyphicon-check"></span>';
        nocheck = '<span class="glyphicon glyphicon-unchecked"></span>';
        result = nocheck;
        for(i=0; i < ventas.length-1; i++){
            result = nocheck;
            //alert('Llega');
            //string = 'Hola';
            datos = ventas[i].split(';');
            cuerpo1 = ' <span class="glyphicon glyphicon-envelope" onclick="verUserInfo(\''+datos[1]+'\')"></span></h3></div><div class="col-sm-1"><h3>';
        
            cuerpo7 = '</h3></div><div class="col-sm-1"><p class="btn btn-success btn-lg saldo" id="addSaldo" onclick="compraFinalizada (\''+datos[0]+'\')"> Recibido <span class="glyphicon glyphicon-ok"></span> </p></div></div><hr/>';
            //alert(datos[2]);
            if(datos[6] == 1)
                result = check;
            string = cabeza+datos[2]+cuerpo1+datos[4]+cuerpo2+datos[7]+cuerpo3+datos[3]+cuerpo4+datos[8]+cuerpo5+datos[5]+cuerpo6+result+cuerpo7;
            $('#comprasActivas').append(string);
            //alert(string);
        }
        $('#comprasActivas').append(pie);
    }
    function compraFinalizada (idVenta){
        //alert('Compra realizada '+ idVenta);
        var parametros = {
            'idVenta': idVenta
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Transacciones/recibido")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                alert(resultado);
                $(location).attr('href', '<?php echo site_url('Main/perfil') ?>');
                //crearCompraFin(resultado)
            },
            error: function(resultado){
                console.log(resultado);
                alert('Error: '+resultado);
            }
        });
    }
    function envioFinalizado (idVenta){
        //alert('Envio realizado'+ idVenta);
        var parametros = {
            'idVenta': idVenta
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Transacciones/enviado")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                alert(resultado);
                $(location).attr('href', '<?php echo site_url('Main/perfil') ?>');
                //crearCompraFin(resultado)
            },
            error: function(resultado){
                console.log(resultado);
                alert('Error: '+resultado);
            }
        });
    }
    function cargarComprasFin() {
        var parametros = {
            'idUsuario': localStorage.id
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Transacciones/comprasFin")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                //alert(resultado);
                crearCompraFin(resultado)
            },
            error: function(resultado){
                console.log(resultado);
                alert('Error: '+resultado);
            }
        });
    }
    function cargarVentasActivas() {
        var parametros = {
            'idUsuario': localStorage.id
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Transacciones/ventasActivas")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                //alert(resultado);
                crearVentaActiva(resultado)
            },
            error: function(resultado){
                console.log(resultado);
                alert('Error: '+resultado);
            }
        });
    }
    function cargarVentasFin() {
        var parametros = {
            'idUsuario': localStorage.id
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Transacciones/ventasFin")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                //alert(resultado);
                crearVentaFin(resultado)
            },
            error: function(resultado){
                console.log(resultado);
                alert('Error: '+resultado);
            }
        });
    }
    function crearCompraFin(cadena){
        ventas = cadena.split('|');
        cabeza = '<div class="col-sm-12"><div class="col-sm-2"><h3>';

        cuerpo2 = '</h3></div><div class="col-sm-2"><h3>';
        cuerpo3 = '</h3></div><div class="col-sm-1"><h3>';
        cuerpo4 = '</h3></div><div class="col-sm-1"><h3>';
        cuerpo5 = '</h3></div><div class="col-sm-2"><h5><br>';
        cuerpo6 = '</h5></div><div class="col-sm-1"><h5>';
        cuerpo8 = '</h5></div><div class="col-sm-1"><h5>';
        cuerpo7 = '</h5></div><hr/>';
        check = '<span class="glyphicon glyphicon-check"></span>';
        pie = '<div class="col-sm-12"><br></div><hr/></div>';
        for(i=0; i < ventas.length-1; i++){
            //alert('Llega');
            //string = 'Hola';
            datos = ventas[i].split(';');
            cuerpo1 = ' <span class="glyphicon glyphicon-envelope" onclick="verUserInfo(\''+datos[1]+'\')"></span></h3></div><div class="col-sm-1"><h3>';
            //alert(datos[2]);
            string = cabeza+datos[2]+cuerpo1+datos[4]+cuerpo2+datos[7]+cuerpo3+datos[3]+cuerpo4+datos[8]+cuerpo5+datos[5]+cuerpo6+'Enviado'+check+cuerpo8+'Recibido'+check+cuerpo7;
            $('#comprasFin').append(string);
            //alert(string);
        }
        $('#comprasFin').append(pie);
    }
    function crearVentaActiva(cadena){
        ventas = cadena.split('|');
        cabeza = '<div class="col-sm-12"><div class="col-sm-2"><h3>';
        cuerpo2 = '</h5></div><div class="col-sm-1"><h5>';
        cuerpo3 = '</h5></div><div class="col-sm-1"><h3>';
        cuerpo4 = '</h3></div><div class="col-sm-1"><h3>';
        cuerpo5 = '</h3></div><div class="col-sm-2"><h5><br>';
        cuerpo6 = '</h5></div><div class="col-sm-1"><h5>';
        check = '<div class="col-sm-1"><span class="glyphicon glyphicon-check"></span></div></div><hr/>';
        //nocheck = '<span class="glyphicon glyphicon-unchecked"></span>';
        pie = '<div class="col-sm-12"><br></div><hr/></div><hr/>';
        for(i=0; i < ventas.length-1; i++){
            //alert('Llega');
            //string = 'Hola';
            datos = ventas[i].split(';');
            cuerpo1 = ' <span class="glyphicon glyphicon-envelope" onclick="verUserInfo(\''+datos[1]+'\')"></span></h3></div><div class="col-sm-2"><h5>';
            cuerpo7 = '</h3></div><div class="col-sm-1"><p class="btn btn-success btn-lg saldo" id="addSaldo" onclick="envioFinalizado(\''+datos[0]+'\')"> Enviado <span class="glyphicon glyphicon-ok"></span> </p></div></div><hr/>';
            //alert(datos[2]);
            if(datos[6] == 1)
                cuerpo7 = check;
            string = cabeza+datos[2]+cuerpo1+datos[4]+cuerpo2+datos[7]+cuerpo3+datos[3]+cuerpo4+datos[8]+cuerpo5+datos[5]+cuerpo6+cuerpo7;
            $('#ventasActivas').append(string);
            //alert(string);
        }
        $('#ventasActivas').append(pie);
    }
    function crearVentaFin(cadena){
        ventas = cadena.split('|');
        cabeza = '<div class="col-sm-12"><div class="col-sm-2"><h3>';
        cuerpo2 = '</h5></div><div class="col-sm-1"><h5>';
        cuerpo3 = '</h5></div><div class="col-sm-1"><h3>';
        cuerpo4 = '</h3></div><div class="col-sm-1"><h3>';
        cuerpo5 = '</h3></div><div class="col-sm-2"><h5><br>';
        cuerpo6 = '</h5></div><div class="col-sm-1"><h5>';
        cuerpo8 = '</h5></div><div class="col-sm-1"><h5>';
        cuerpo7 = '</h5></div><hr/>';
        check = '<span class="glyphicon glyphicon-check"></span>';
        pie = '<div class="col-sm-12"><br></div></div><hr/>';
        for(i=0; i < ventas.length-1; i++){
            //alert('Llega');
            //string = 'Hola';
            datos = ventas[i].split(';');
            cuerpo1 = ' <span class="glyphicon glyphicon-envelope" onclick="verUserInfo(\''+datos[1]+'\')"></span></h3></div><div class="col-sm-2"><h5>';
            //alert(datos[2]);
            string = cabeza+datos[2]+cuerpo1+datos[4]+cuerpo2+datos[7]+cuerpo3+datos[3]+cuerpo4+datos[8]+cuerpo5+datos[5]+cuerpo6+'Enviado'+check+cuerpo8+'Recibido'+check+cuerpo7;
            $('#ventasFin').append(string);
            //alert(string);
        }
        $('#ventasFin').append(pie);
    }
    function misOfertas (){
        var parametros = {
            'idUsuario': localStorage.id
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Fasciculos/showFasciculosByUser")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(result){
                if(result){
                    //alert(result);
                    fillFasciculos(result);
                }
                else
                    $('#misOfertas').append('No hay fasciculos a la venta');
            },
            error: function(result){
                console.log(result);
                alert('Error: '+result);
            }
        });
    }
    function fillFasciculos (cadena){
        lineFasciculo = cadena.split('|');
        pelo = '<div class="col-sm-12"> <div class="col-sm-2"><h4>Nombre</h4> </div> <div class="col-sm-2"><h4>Estilo</h4> </div><div class="col-sm-2">    <h4>Calidad</h4></div><div class="col-sm-2">    <h4>Cantidad</h4></div><div class="col-sm-2">    <h4>Precio</h4></div><div class="col-sm-1">    <h4> Comprar </h4></div></div>';
        $('#listaVentas').append(pelo);
        cabeza = '<div class="col-sm-12"><div class="col-sm-2"><h3>'; //Nick
        //cuerpo1 = '</h3></div><div class="col-sm-2"><h3>'; //Estilo
        cuerpo2 = '</h3></div><div class="col-sm-2"><h3>'; //Calidad
        cuerpo3 = '</h3></div><div class="col-sm-2"><h3>'; //Cantidad
        cuerpo4 = '</h3></div><div class="col-sm-2"><h3>'; //Precio
        cuerpo5 = '€</h3></div><div class="col-sm-2"><br><p class="btn btn-danger btn-lg" '; //id's

        pie = '>Borrar <span class="glyphicon glyphicon-remove"></span> </p></div> </div><hr/> <br>';
        //alert('Llega');
        $('#misOfertas').append('<div class="col-sm-12"></div>');
        $('#misOfertas').append('<div class="col-sm-2"><h5>Nombre</h5></div><div class="col-sm-2"><h5>Estilo</h5></div><div class="col-sm-2"><h5>Calidad</h5></div><div class="col-sm-2"><h5>Cantidad</h5></div><div class="col-sm-2"><h5>Precio</h5></div>');
        for(i=0; i < lineFasciculo.length-1; i++){
            //alert(i);
            elementos = lineFasciculo[i].split(';');
            cuerpo1 = '</h3></div><div class="col-sm-2"><h3>';
            click = 'name="botonP" onclick="borrarVenta(\''+elementos[5]+'\',\''+elementos[6]+'\' )" ';

            string =cabeza+elementos[0]+cuerpo1+elementos[1]+cuerpo2+elementos[2]+cuerpo3+elementos[3]+cuerpo4+elementos[4]+cuerpo5+' '+click+' '+pie;
            //alert(string);
            $('#misOfertas').append(string);
        }
        $('#misOfertas').append('<div class="col-sm-12"><br></div>');
    }
    function borrarVenta(fasciculo, usuario){
        var parametros = {
            'idUsuario': usuario,
            'idFasciculo': fesciculo
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Fasciculos/deleteFasciculo")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(result){
                alert(result);
            },
            error: function(result){
                console.log(result);
                alert('Error: '+result);
            }
        });
    }
</script>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><span id='userNickTitle'></span></a></li>
    <li id="mensajes"><a data-toggle="tab" href="#menu1">Mensajes</a></li>
    <li><a data-toggle="tab" href="#menu3">En venta</a></li>
    <li><a data-toggle="tab" href="#menu2">Transacciones</a></li>
</ul>
<div class="tab-content contenedorPrin">
    <div id="home" class="tab-pane fade in active">
        <span id='userNick' style="font-size: 250%;"></span>
            <a href="<?php echo site_url('Main') ?>"><span class='glyphicon glyphicon-pencil' style="font-size: 140%;"></span></a>
        <hr/>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label"><br>Saldo</label>
            <div class="col-sm-5">
                <h3><span id="spanSaldo"></span></h3>
            </div>
            <div class="col-sm-5">
                <p class="btn btn-primary btn-lg saldo" id="addSaldo"> Añadir saldo <span class='glyphicon glyphicon-eur'></span> </p>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label"><br>Valoración <span class='glyphicon glyphicon-star-empty'></span></label>
            <div class="col-sm-5">
                <h3><span id="spanValoracion"></span></h3>
            </div>
            <div class="col-sm-5">
                <h6>*Necesitas una media superior a 7, y más de 10 valoraciones para hacer envíos por correo ordnario
                    <span id="numValoraciones"></span>
                </h6>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label">Email <span class='glyphicon glyphicon-envelope'></span></label>
            <div class="col-sm-4">
                <span id="spanEmail"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-4">
                <span id="spanNombre"></span>
            </div>
            <label for="inputNick" class="col-sm-2 col-form-label">Apellidos</label>
            <div class="col-sm-4">
                <span id="spanApellidos"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label">DNI</label>
            <div class="col-sm-4">
                <span id="spanDNI"></span>
            </div>
            <label for="inputNick" class="col-sm-2 col-form-label">Fecha de Nacimiento</label>
            <div class="col-sm-4">
                <span id="spanFecNac"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label">Dirección <span class='glyphicon glyphicon-home'></span></label>
            <div class="col-sm-10">
                <span id="spanDireccion"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
            </div>
        </div>

    </div>
    <div id="menu1" class="tab-pane fade">
<!--        <span id='userNick' style="font-size: 250%;">Mensajes</span>
        <hr/>-->
        <!---->
        <section id="usuariosMsg">
            <h4 class="active">Mensajes</h4>
            <ul>
            </ul>
        </section>
        <!---->
        <div class="form-group row">
            <div class="col-sm-10">
            </div>
        </div>
    </div>
    <div id="menu3" class="tab-pane fade">
<!--        <span id='userNick' style="font-size: 250%;">Mensajes</span>
        <hr/>-->
        <!---->
        <section id="misOfertas">
            
        </section>
        <!---->
        <div class="form-group row">
            <div class="col-sm-10">
            </div>
        </div>
    </div>
    <div id="menu2" class="tab-pane fade">
        <span id='userNick' style="font-size: 250%;">Transacciones</span>
        <hr/>
        <!---->
        <section>
            <h4>Compras activas</h4>
            <ul id="comprasActivas">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <h5>Nombre</h5>
                    </div>
                    <div class="col-sm-1">
                        <h5>Cantidad</h5>
                    </div>
                    <div class="col-sm-1">
                        <h5>Precio</h5>
                    </div>
                    <div class="col-sm-1">
                        <h5>Gastos de envio</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>TOTAL<span class='glyphicon glyphicon-eur'></span></h5>
                    </div>
                    <div class="col-sm-1">
                        <h5>Fecha</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>Enviado</h5>
                    </div>
                </div>
            </ul>
            <h4>Compras finalizadas</h4>
            <ul id="comprasFin">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <h5>Nombre</h5>
                    </div>
                    <div class="col-sm-1">
                        <h5>Cantidad</h5>
                    </div>
                    <div class="col-sm-1">
                        <h5>Precio</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>Gastos de envio</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>TOTAL <span class='glyphicon glyphicon-eur'></span></h5>
                    </div>
                    <div class="col-sm-1">
                        <h5>Fecha</h5>
                    </div>
                </div>    
            </ul>
            <h4>Ventas activas</h4>
            <ul id="ventasActivas">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <h5>Nombre</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>Direccion</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>Pedido</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>TOTAL<span class='glyphicon glyphicon-eur'></span></h5>
                    </div>
                    <div class="col-sm-1">
                        <h5>Fecha</h5>
                    </div>
                </div>
                    
            </ul>
            <h4>Ventas finalizadas</h4>
            <ul id="ventasFin">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <h5>Nombre</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>Direccion</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>Pedido</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5>TOTAL<span class='glyphicon glyphicon-eur'></span></h5>
                    </div>
                    <div class="col-sm-1">
                        <h5>Fecha</h5>
                    </div>
                </div>    
            </ul>
        </section>
        <!---->
        <div class="form-group row">
            <div class="col-sm-10">
            </div>
        </div>
    </div>
</div>
<!--</div>-->