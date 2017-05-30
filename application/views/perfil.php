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
        $("#userNick").text(localStorage.Nick);
        $('#btnSubmit').on('click', function(){  
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
                    alert('Success');
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
    <h1><span id='userNick'></span></h1>
     <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label">Saldo</label>
            <div class="col-sm-5">
                <span id="spanSaldo"></span><span class='glyphicon glyphicon-eur'></span>
            </div>
            <div class="col-sm-5">
                <input type="button"> Añadir saldo <span class='glyphicon glyphicon-eur'></span> </a>
            </div>
        </div>
</div>