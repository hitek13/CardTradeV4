<?php
/**
 * Created by PhpStorm.
 * User: EXTMcaballer
 * Date: 30/05/2017
 * Time: 17:02
 */?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesSign_up.css">
<script>
    $(document).ready(function(){
        $('#btnSubmit').on('click', function(){
            var parametros = {
                'Nick': $('#inputNick').val(),
                'Pass': $('#inputPassword').val()
            };
            $.ajax({
                data: parametros,
                type: "POST",
                url: '<?php echo site_url("Users/logIn")?>', // Forma correcta de llamar al controlador
                dataType: 'json',
                success: function(result){
                    if(result == 'No existe el usuario, o la contraseña es erronea') {
                        alert(result);
                    }
                    else {
                        //alert(result);
                        localStorage.setItem("id", result);
                        localStorage.setItem("Nick", $('#inputNick').val());
                        $(location).attr('href', '<?php echo site_url('Main') ?>')
                    }
                },
                error: function(result){
                    console.log(result);
                    alert('Error'+result);
                }
            });
        });
    });
</script>
<div class="container formulario">
    <h1>Log In!</h1>
    <form>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label">Nick</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNick" placeholder="Nick">
                <span id="spanNick"></span>
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
            <div class="offset-sm-2 col-sm-10">
                <button type="button" class="btn navbar-inverse btn-block btn_submit" id="btnSubmit">Log In</button>
            </div>
        </div>
    </form>
</div>