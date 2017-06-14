<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesSign_up.css">
<script>
    $(document).ready(function(){
        $('#addSaldo').on('click', function(event){
            if(confirm("Se le ingresará el saldo, ¿desea continuar?")){
                event.preventDefault();
                //alert($('#inputMoney').val());
                var parametros = {
                    'idUser': localStorage.id,
                    'money': $('#inputMoney').val()
                };
                $.ajax({
                    data: parametros,
                    type: "POST",
                    url: '<?php echo site_url("Users/addMoney")?>', // Forma correcta de llamar al controlador
                    dataType: 'json',
                    success: function(result){
                        alert(result);
                        $(location).attr('href', '<?php echo site_url('Main/perfil') ?>');
                    },
                    error: function(result){
                        console.log(result);
                        alert('Saldo añadido...');
                        $(location).attr('href', '<?php echo site_url('Main/perfil') ?>');
                    }    
                });
            }
        });
    });
</script>
<div class="container formulario">
    <h1>Añadir saldo</h1>
        <div class="form-group row">
            <label for="inputNick" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputMoney" placeholder="€">
                <span id="spanNick"></span>
            </div>
            <div class="col-sm-5">
                <p class="btn btn-primary btn-lg saldo" id="addSaldo" > Añadir saldo <span class='glyphicon glyphicon-eur'></span> </p>
            </div>
        </div>
</div>