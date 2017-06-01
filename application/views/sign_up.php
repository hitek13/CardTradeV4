<?php
/**
 * Created by PhpStorm.
 * User: EXTMcaballer
 * Date: 25/05/2017
 * Time: 9:45
 */ ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesSign_up.css">
<script>
    $(document).ready(function(){
        $('#btnSubmit').prop('disabled', true);
        $('#checkTerminos').on('click',function(){
            if( $(this).prop('checked') && $('#inputNick').val() && $('#inputEmail').val()
                && $('#inputPassword').val() && $('#inputPassword2').val() && $('#inputName').val()
                && $('#inputApell').val() && $('#inputDirec').val() && $('#selectPais').val()
                && $('#selectCiudad').val() && $('#inputDNI').val() && $('#bday').val()  ) {
                $('#btnSubmit').prop('disabled', false);
                $('#spanCheck').text('')
            }else {
                $('#btnSubmit').prop('disabled', true);
                $('#spanCheck').text('Rellene todos los campos y acepte los términos y condiciones para continuar.')
                $(this).attr('checked', false);
            }
        });
        $('#inputNick, #inputEmail, #inputPassword, #inputPassword2, #inputName, ' +
        '#inputApell, #inputName, #inputApell, #inputDirec, #selectPais, #selectCiudad, ' +
        '#inputDNI, #bday').on('click',function(){
            $('#btnSubmit').prop('disabled', true);
            $('#checkTerminos').attr('checked', false);
            if( $(this).val() ) {
            }else {
                $('#btnSubmit').prop('disabled', true);
            }
        });
        $('#inputPassword2').on('blur', function(){
           if( $('#inputPassword').val() != $(this).val() ) {
               $(this).css({'background-color': 'red'}).animate({'background-color': 'white'}, 1000);
               $(this).val('');
               $('#spanPass2').text('Las contraseñas no coinciden');
           }else{
               $(this).css({'background-color': 'white'});
               $('#spanPass2').text('');
           }
        });
        $('#btnSubmit').on('click', function(){
            var parametros = {
                'Nick': $('#inputNick').val(),
                'Email': $('#inputEmail').val(),
                'Nombre': $('#inputName').val(),
                'Pass': $('#inputPassword').val(),
                'Apellido': $('#inputApell').val(),
                'Direccion': $('#inputDirec').val(),
                'Pais': $('#selectPais').val(),
                'Ciudad': $('#selectCiudad').val(),
                'DNI': $('#inputDNI').val(),
                'fecha': $('#bday').val()
            };
            $.ajax({
                data: parametros,
                type: "POST",
                url: '<?php echo site_url("Users/insertInto")?>', // Forma correcta de llamar al controlador
                dataType: 'json',
                success: function(result){
                    alert('Se ha dado de alta satisfactoriamente, se le enviara un correo para confirmar su dirección de E-mail');
                    $(location).attr('href', '<?php echo site_url('Main') ?>')
                },
                error: function(result){
                    console.log(result);
                    alert('Error:'+result);
                }
            });
        });
    });
</script>
<div class="container formulario">
    <h1>Regístrate!</h1>
    <form>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label">Nick</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNick" placeholder="Nick">
                <span id="spanNick"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                <span id="spanEmail"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                <span id="spanPass"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Repetir Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword2" placeholder="Repeat Password">
                <span id="spanPass2"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Nombre">
                <span id="spanName"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Apellidos</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputApell" placeholder="Apellidos">
                <span id="spanApell"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Direcci&oacute;n</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputDirec" placeholder="Direcci&oacute;n">
                <span id="spanDirec"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="exampleSelect1" class="col-sm-2 col-form-label">Pa&iacute;s</label>
            <div class="col-sm-10">
                <select class="form-control" id="selectPais">
                    <option></option>
                    <option>España</option>
                    <option>Italia</option>
                    <option>Inglaterra</option>
                    <option>Alemania</option>
                    <option>Francia</option>
                </select>
                <span id="spanPais"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="exampleSelect1" class="col-sm-2 col-form-label">Ciudad</label>
            <div class="col-sm-10">
                <select class="form-control" id="selectCiudad">
                    <option></option>
                    <option>Madrid</option>
                    <option>Roma</option>
                    <option>Londres</option>
                    <option>Berlin</option>
                    <option>Paris</option>
                </select>
                <span id="spanCiudad"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputDNI" placeholder="DNI">
                <span id="spanDNI"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
            <div class="col-sm-10">
                <input type="date" class="form-control"  id="bday">
                <span id="spanFec"></span>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-6">Acepta los <a>terminos y condiciones</a></label>
            <div class="col-sm-6">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="checkTerminos"> Acepto
                    </label>
                    <span id="spanCheck" style="color: red; font-size: 12px;"></span>
                </div>
            </div>
        </div>
        <hr/>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="button" class="btn navbar-inverse btn-block btn_submit" id="btnSubmit">Sign in</button>
            </div>
        </div>
    </form>
</div>