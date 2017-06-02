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
                alert('Error: '+result);
            }
        });
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Users/getMsg")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(result){
                //alert(result);
            },
            error: function(result){
                console.log(result);
                alert('Error: '+result);
            }
        });
        $('#mensajes').on('click', function(){ 
            cargar_msg(localStorage.id);
        });
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
            url: '<?php echo site_url("Users/getMsg")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(resultado){
                datos = resultado.split('|');
                for(i=0; i< datos.length-1; i++){
                    nombre = datos[i].split(';')[0];
                    id = datos[i].split(';')[1];
                    addUser(id, nombre);
                }
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
        cabeza = '<h4 id='+id+' onclick="active(this)" onmouseout="deactive(this)">';
        cuerpo1 = "</h4><ul><!-- MENSAJES-->Hola"+id+"<!-- MENSAJES--><!--TEXTO--><textarea class='textarea' id='text";
        cuerpo2 = "'></textarea><button type='button' class='btn navbar-inverse btn-block btn_submit'";
        click = "onclick=addMSG('text"+id+"texto') ";
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
        if($('#'+btn).val()) {
                $(mensajeAzul( Date($.now()) , $('#'+btn).val())).insertBefore('#'+btn);
                $('#'+btn).val('')
            }
    }
    function active(objeto){
        $('h4').removeClass();
        $(objeto).addClass('active');
        
    }
    function deactive(objeto){
        //$(objeto).removeClass();
    }
</script>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><span id='userNickTitle'></span></a></li>
    <li id="mensajes"><a data-toggle="tab" href="#menu1">Mensajes</a></li>
    <li><a data-toggle="tab" href="#menu2">Transacciones</a></li>
</ul>
<div class="tab-content contenedorPrin">
    <div id="home" class="tab-pane fade in active">
        <span id='userNick' style="font-size: 250%;"></span>
            <a href="<?php echo site_url('Main') ?>"><span class='glyphicon glyphicon-pencil' style="font-size: 140%;"></span></a>
        <hr/>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label">Saldo</label>
            <div class="col-sm-5">
                <h3><span id="spanSaldo"></span></h3>
            </div>
            <div class="col-sm-5">
                <p class="btn btn-success btn-lg saldo" id="addSaldo"> Añadir saldo <span class='glyphicon glyphicon-eur'></span> </p>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label">Valoración <span class='glyphicon glyphicon-star-empty'></span></label>
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
            <h4 class="active" style="background-color:#fcfaf8 !important;">Mensajes</h4>
            <ul>
            </ul>
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
            <h4 class="active">Mensajes</h4>
            <ul>
            </ul>
            <h4>What?</h4>
            <ul>
                <li>Potius inflammat, ut coercendi magis quam dedocendi esse videantur.</li>
                <li>Atqui reperies, inquit, in hoc quidem pertinacem;</li>
                <li>Verba tu fingas et ea dicas, quae non sentias?</li>
            </ul>
            <h4>Where?</h4>
            <ul>
                <!-- MENSAJES-->
                <div class="media">
                    <a class="media-left" href="#">
                        <div class = "rounded">
                            <span class='glyphicon glyphicon-user' style="font-size: 200%;"></span>
                            Usuario B
                        </div>
                    </a>
                    <div class="media-body mensaje-B">
                        <div>
                            Lorem ipsum dolor sit amet.
                        </div>
                    </div>
                </div>

                <div class="media">
                    <div class="media-body mensaje-A">
                        <div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </div>
                </div>
                <!-- MENSAJES-->
                <!--TEXTO-->
                <div class="textareaDiv">
                    <textarea class="textarea"></textarea>
                    <button type="button" class="btn navbar-inverse btn-block btn_submit" id="">Enviar</button>
                </div>
                <!--TEXTO-->
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