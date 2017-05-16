<h1>Bienvenido!</h1>
<p id="demo" onclick="myFunction()">Click me to change my text color.</p>
<script src="<?php echo base_url(); ?>application/js/buscar.js" language="javascript" type="text/javascript"></script>

<h1><?php echo base_url() ?></h1>

<script>
$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: '<?php echo site_url("Main/resultadosBusqueda")?>', // Forma correcta de llamar al controlador
        dataType: 'json',
        success: function(result){
        alert('Success:'+result);
        },
        error: function(result){
            console.log( JSON.stringify(result, null, 2) );
        alert('Error:'+result);
        }
    });
});

function myFunction() {
    document.getElementById("demo").style.color = "red";
}
</script>