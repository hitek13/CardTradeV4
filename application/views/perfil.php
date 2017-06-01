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
    });
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
    function cargar_msg(idUser){
        alert('Llega '+ idUser);
    }
</script>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><span id='userNickTitle'></span></a></li>
    <li id="mensajes"><a data-toggle="tab" href="#menu1">Mensajes</a></li>
    <li><a data-toggle="tab" href="#menu2">Mis transacciones</a></li>
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
        <span id='userNick' style="font-size: 250%;">Mensajes</span>
        <hr/>
        <!---->
        <div class="col-xs-9">
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home-r">
                    <h3>Home Tab.</h3>
                    <!-- MENSAJES -->
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
                        <a class="media-left" href="#">
                              <div class = "rounded">
                              </div>
                            </a>
                      </div>
                    <!-- MENSAJES -->
                    <!--TEXTO-->
                    <div class="textareaDiv">
                        <textarea class="textarea"></textarea>
                        <button type="button" class="btn navbar-inverse btn-block btn_submit" id="">Enviar</button>
                    </div>
                    <!--TEXTO-->
                </div>
                <div class="tab-pane" id="profile-r">
                    <h3>Profile Tab.</h3>
                    <!--MENSAJES-->
                    <!--MENSAJES-->
                    <!--TEXTO-->
                    <div>
                        <textarea></textarea>
                    </div>
                    <!--TEXTO-->
                </div>
                <div class="tab-pane" id="messages-r">Messages Tab.
                    <!--TEXTO-->
                    <div>
                        <textarea></textarea>
                    </div>
                    <!--TEXTO--></div>
                <div class="tab-pane" id="settings-r">Settings Tab.
                    <!--TEXTO-->
                    <div>
                        <textarea></textarea>
                    </div>
                    <!--TEXTO--></div>
            </div>
        </div>

        <div class="col-xs-3"> <!-- required for floating -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-right">
                <li class="active"><a href="#home-r" data-toggle="tab">Home</a></li>
                <li><a href="#profile-r" data-toggle="tab">Profile</a></li>
                <li><a href="#messages-r" data-toggle="tab">Messages</a></li>
                <li><a href="#settings-r" data-toggle="tab">Settings</a></li>
            </ul>
        </div>
        <!---->
        <div class="form-group row">
            <div class="col-sm-10">
            </div>
        </div>
    </div>
    <div id="menu2" class="tab-pane fade">
        <span id='userNick' style="font-size: 250%;">Transacciones</span>
        <hr/>
        <div class="form-group row">
            <div class="col-sm-10">
            </div>
        </div>
    </div>
</div>
<!--</div>-->