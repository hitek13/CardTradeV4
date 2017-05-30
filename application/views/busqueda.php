<h1>Bienvenido!</h1>
<p id="demo" onclick="myFunction()">Click me to change my text color.</p>
<script src="<?php echo base_url(); ?>application/js/buscar.js" language="javascript" type="text/javascript"></script>

<input type="text" id="txt"><br><input type="password" id="pass">
<input type="button" value="Crear usuario" id="btn">

<script>
$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: '<?php echo site_url("Main/resultadosBusqueda")?>', // Forma correcta de llamar al controlador
        dataType: 'json',
        success: function(result){
            //alert('Success:'+result);
        },
        error: function(result){
            console.log(result);
        alert('Error:'+result);
        }
    });
    $('#btn').on('click', function(){
        var parametros = {
            'Nombre': $("#txt").val(),
            'Pass': $("#pass").val()
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Main/insertInto")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(result){
                alert('Success:'+result);
            },
            error: function(result){
                console.log(result);
                alert('Error:'+result);
            }
        });
    });
});

function myFunction() {
    document.getElementById("demo").style.color = "red";
}
</script>