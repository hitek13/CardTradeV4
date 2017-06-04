<?php
/**
 * Created by PhpStorm.
 * User: EXTMcaballer
 * Date: 30/05/2017
 * Time: 16:40
 */
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesSign_up.css">
<script>
    $(document).ready(function(){
        
        var parametros = {
            'idUser': localStorage.userInfo
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Users/getInfo")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(result){
                cadena = result.split(';');
                $('#userNick').append(cadena[0]);
                $('#spanValoracion').append(cadena[6]);
                nombre = " "+cadena[1];
                apellido = " "+cadena[2];
                direc = " "+cadena[3];
                ciudad = " "+cadena[4];
                pais = " "+cadena[5];
                direccion(nombre, apellido, direc, ciudad, pais);
            },
            error: function(result){
                console.log(result);
                alert('Error: '+result);
            }
        });
    });
    function direccion(nombre, apellido, direccion, ciudad, pais){
        cadena = nombre+' '+apellido+'<br>'+direccion+'<br>'+ciudad+'<br>'+pais;
        //alert(direccion+" "+ciudad+" "+pais);
        $('#spanDireccion').append(cadena);
    }
    function sendMSGuser(){
        alert($('#textAreaMSG').val());
    }
</script>
<div class="container formulario">
    <h1 id="userNick"></h1>
    <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label"><br>Valoración</label>
            <div class="col-sm-4">
                <h3><span id="spanValoracion"></span> <span class='glyphicon glyphicon-star-empty'></span></h3>
            </div>

            <label for="inputPassword3" class="col-sm-2 col-form-label"><br>Dirección</label>
            <div class="col-sm-4">
                <h3><span id="spanDireccion"></span></h3>
            </div>
        </div>
    <hr/>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-5">
                <textarea class='textarea' id='textAreaMSG'></textarea>
                <button type="button" class="btn navbar-inverse btn-block btn_submit" onclick="sendMSGuser()">Enviar mensaje</button>
            </div>
        </div>
</div>