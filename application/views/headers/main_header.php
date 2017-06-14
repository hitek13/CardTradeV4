<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        
        
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
            integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" 
            integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
$(document).ready(function(){
    if( !localStorage.id ){
        noSessionUL = "<li><a href='<?php echo site_url('Main/sign_up') ?>'><span class='glyphicon glyphicon-user'></span> Registrarse</a></li> <li><input class='input-xs' type='text' id='user' placeholder='Usuario' size='10'>&nbsp;</li> <li><input class='input-xs' type='password' id='pass' placeholder='Contraseña' size='10'></li> <li id='login'><a href='#'><span class='glyphicon glyphicon-log-in'></span></a></li>";
        noSessionULmovil = "<li><a href='<?php echo site_url('Main/sign_up') ?>'><span class='glyphicon glyphicon-user'></span> Registrarse</a></li> <li><a href='<?php echo site_url('Main/log_in') ?>'><span class='glyphicon glyphicon-log-in'></span> Entrar</a></li>";
        $('#sessionUL').append(noSessionUL);
        $('#sessionULmovil').append(noSessionULmovil);
    }else{
        sessionUL = "<li><a href='<?php echo site_url('Main/perfil') ?>'>"+localStorage.Nick+" <span class='glyphicon glyphicon-user'></span>  </a></li> <li id='logout'><a href='#'>Salir <span class='glyphicon glyphicon-log-out'></span></a></li>";
        sessionULmovil = "<li><a href='<?php echo site_url('Main/perfil') ?>'>"+localStorage.Nick+" <span class='glyphicon glyphicon-user'></span>  </a></li> <li id='logoutMovil'><a href='#'> Salir <span class='glyphicon glyphicon-log-out'></span></a></li>";
        $('#sessionUL').append(sessionUL);
        $('#sessionULmovil').append(sessionULmovil);
    }
    $('#login').on('click', function(){
        var parametros = {
            'Nick': $('#user').val(),
            'Pass': $('#pass').val()
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Users/logIn")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(result){
                if(!result) {
                    alert('No existe el usuario, o la contraseña es erronea.');
                }
                else {
                    //alert(result);
                    localStorage.setItem("id", result);
                    localStorage.setItem("Nick", $('#user').val());
                    $(location).attr('href', '<?php echo site_url('Main') ?>');
                }
            },
            error: function(result){
                console.log(result);
                alert('Error'+result);
            }
        });
    });
    $('#logout, #logoutMovil').on('click',function(){
       //alert(" Hola");
        localStorage.removeItem('id');
        localStorage.removeItem('Nick');
        $(location).attr('href', '<?php echo site_url('Main') ?>')
    });

    /// NO PERMITIR LETRAS, SOLO NÚMEROS
    $("#inputCantidad, #CMC").keydown(function (e) {
        // Allow: backspace, delete, tab, escape and enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }

        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    /// Solo letras y punto
   $("#inputPrecio").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    /// NO PERMITE EL CARACTER |
    $("#textarea").on('keypress', function (e) {
        var code = e.keyCode || e.which;
        if(code == 124)
            e.preventDefault();
    });
});
function noSpecial(e){
    var code = e.keyCode || e.which;
        if(code == 124)
            e.preventDefault();
}
function verUserInfo(idUser){
    //alert('Hola usuario '+idUser);
    localStorage.setItem("userInfo", idUser);
    $(location).attr('href', '<?php echo site_url('Main/userInfo') ?>');
}
    </script>
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesHeader.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesFoot.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesMain.css">
	<title>FoW</title>
	
</head>
<body>
        <!-- ||||||||||||||||||||||||| Menu Bar BIG |||||||||||||||||||||||| -->
    <nav class="navbar navbar-inverse navbar-static-top hidden-xs" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo site_url('Main') ?>">FoW Card-Trade</a>
          </div>
          <ul class="nav navbar-nav">
              <!--
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lenguage
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/Espana.png"
                               height="16px" />
                          Spanish</a></li>
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/italy_flag_128.png"
                               height="16px"/>
                          Italian</a></li>
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/united_kingdom_flags_flag_17079.png"
                               height="16px"/>
                          English</a></li>
                </ul>
              </li>  
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>-->
          </ul>
          <ul class="nav navbar-nav navbar-right" id="sessionUL">
           <!-- <li><a href="<?php /*echo site_url('Main/sign_up') */?>"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><input class="input-xs" type="text" id="user" placeholder="User" size="10">&nbsp;</li>
            <li><input class="input-xs" type="password" id="pass" placeholder="Pass" size="10"></li>
            <li id="login"><a href="#"><span class="glyphicon glyphicon-log-in"></span></a></li>-->

<!--            <li><a href="--><?php //echo site_url('Main/sign_up') ?><!--">Nombre <span class="glyphicon glyphicon-user"></span>  </a></li>-->
<!--            <li id="logout"><a href="#"><span class="glyphicon glyphicon-log-out"></span></a></li>-->
          </ul>
        </div>
    </nav>
    
    <!-- ||||||||||||||||||||||||| Menu Bar small |||||||||||||||||||||||| -->
    
    <nav class="navbar navbar-inverse navbar-static-top visible-xs" role="navigation">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <img src="<?php echo base_url(); ?>application/resources/images/forceofwill.png"
                         class="img-responsive logoFoW2"/>
                </a>
                <ul class="dropdown-menu" id="sessionULmovil">
                    <li><a href="<?php echo site_url('Main') ?>">Home</a></li>
                   <!-- <li><a href="#">Page 1</a></li>
                    <li><a href="#">Page 2</a></li> -->
<!--                    <li><a href="--><?php //echo site_url('Main/sign_up') ?><!--"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
<!--                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
                </ul>
              </li>
<!--
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lenguage
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/Espana.png" 
                               height="16px" />
                          Spanish</a></li>
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/italy_flag_128.png"
                               height="16px"/>
                          Italian</a></li>
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/united_kingdom_flags_flag_17079.png"
                               height="16px"/>
                          English</a></li>
                </ul>
              </li>
-->
          </ul>
        </div>
    </nav>

<!--        --><?//
//    if( isset($_SESSION['Nick']) )
//        echo '<button  id="btn_storage">pulsa</button>';
//    else
//        echo $this->session->$_SESSION['Nick'];
//    ?>