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
        $('#userNick').append(localStorage.userInfo);
        //$('#userNick').append('localStorage.userInfo');
       /* $('#btnSubmit').on('click', function(){
            var parametros = {
                'Nick': $('#inputNick').val(),
                'Pass': $('#inputPassword').val()
            };
            $.ajax({
                data: parametros,
                type: "POST",
                url: '<?php //echo site_url("Users/logIn")?>', // Forma correcta de llamar al controlador
                dataType: 'json',
                success: function(result){
                    if(result == 'No existe el usuario, o la contraseña es erronea') {
                        alert(result);
                    }
                    else {
                        //alert(result);
                        localStorage.setItem("id", result);
                        localStorage.setItem("Nick", $('#inputNick').val());
                        $(location).attr('href', '<?php //echo site_url('Main') ?>')
                    }
                },
                error: function(result){
                    console.log(result);
                    alert('Error'+result);
                }
            });
        });*/
    });
</script>
<div class="container formulario">
    <h1 id="userNick"></h1>
    
</div>