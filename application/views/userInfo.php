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
                $('#spanValoracion').append(cadena[1]);
            },
            error: function(result){
                console.log(result);
                alert('Error: '+result);
            }
        });
        getVentas();
    });
    function sendMSGuser(){
        //alert($('#textAreaMSG').val());
        if( !localStorage.id )
            alert('Inicia sesión para enviar un mensaje');
        else{
            if(confirm("Se enviará un mensaje al usuario, ¿desea continuar?")){
                var d = new Date($.now());
                fecha = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
                var parametros = {
                    'idReceptor': localStorage.userInfo,
                    'idUser': localStorage.id,
                    'texto': $('#textAreaMSG').val(),
                    'fechaHoy': fecha
                };
                $.ajax({
                    data: parametros,
                    type: "POST",
                    url: '<?php echo site_url("Users/sendMsg")?>', // Forma correcta de llamar al controlador
                    dataType: 'json',
                    success: function(result){
                        alert('Mensaje enviado');
                        $('#textAreaMSG').val('');
                    },
                    error: function(result){
                        console.log(result);
                        alert('Error: '+result);
                    }
                });
            }
        }
    }
    function getVentas(){
        var parametros = {
            'idUsuario': localStorage.userInfo
        };
        $.ajax({
            data: parametros,
            type: "POST",
            url: '<?php echo site_url("Fasciculos/showFasciculosByUser")?>', // Forma correcta de llamar al controlador
            dataType: 'json',
            success: function(result){
                if(result){
                    //alert(result);
                    fillFasciculos(result);
                }
                else
                    $('#listaVentas').append('No hay fasciculos a la venta');
            },
            error: function(result){
                console.log(result);
                alert('Error: '+result);
            }
        });
    }
    function fillFasciculos (cadena){
        lineFasciculo = cadena.split('|');
        pelo = '<div class="col-sm-12 hidden-xs"> <div class="col-sm-2"><h4>Nombre</h4> </div> <div class="col-sm-2"><h4>Estilo</h4> </div><div class="col-sm-2">    <h4>Calidad</h4></div><div class="col-sm-2">    <h4>Cantidad</h4></div><div class="col-sm-2">    <h4>Precio</h4></div><div class="col-sm-1">    <h4> Comprar </h4></div></div>';
        $('#listaVentas').append(pelo);
        cabeza = '<div class="col-sm-12"><div class="col-sm-2"><h3>'; //Nick
        //cuerpo1 = '</h3></div><div class="col-sm-2"><h3>'; //Estilo
        cuerpo2 = '</h3></div><div class="col-sm-2"><h3>'; //Calidad
        cuerpo3 = '</h3></div><div class="col-sm-2"><h4>'; //Cantidad
        cuerpo4 = '</h4></div><div class="col-sm-2"><h3>'; //Precio
        cuerpo5 = '€</h3></div><div class="col-sm-2"><p class="btn btn-success btn-lg saldo" id="addSaldo" '; //id's

        pie = '>Comprar <span class="glyphicon glyphicon-eur"></span> </p></div> </div><hr/> <br>';
        //alert('Llega');
        for(i=0; i < lineFasciculo.length-1; i++){
            //alert(i);
            elementos = lineFasciculo[i].split(';');
            cuerpo1 = '</h3></div><div class="col-sm-2"><h3>';
            click = 'name="botonP" onclick="comprarCarta(\''+elementos[5]+'\',\''+elementos[6]+'\' )" ';

            string =cabeza+elementos[0]+cuerpo1+elementos[1]+cuerpo2+elementos[2]+cuerpo3+ construirDesplegable(elementos[3], elementos[5] ) +cuerpo4+elementos[4]+cuerpo5+' '+click+' '+pie;
            //alert(string);
            $('#listaVentas').append(string);
        }
    }
    function construirDesplegable (cantidad, idFasciculo){
        options = '';
        for(j=1; j < (parseInt(cantidad)+1); j++){
            options = options + '<option value="'+j+'">'+j+'</option>';
        }
        return '<select id=\''+idFasciculo+'\'>'+options+'</select>';
        //return options;
    }
    function comprarCarta (idFasciculo, idUsuario){
        //alert("Fasciculo: "+idFasciculo+", Usuario: "+idUsuario+" Cantidad: "+$('#'+idFasciculo).val());
        if( !localStorage.id )
            alert('Inicia sesión para comprar');
        else{   
            var d = new Date($.now());
                fecha = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
            var parametros = {
                        'idFasciculo': idFasciculo,
                        'idComprador': localStorage.id,
                        'idVendedor': idUsuario,
                        'Cantidad': $('#'+idFasciculo).val(),
                        'GE': 1.5,
                        'fecha': fecha
                    };
                    //alert('P'+$('#'+idFasciculo).val()+'/ C'+$('#inputCantidad').val()+'/ ')
                    $.ajax({
                        data: parametros,
                        type: "POST",
                        url: '<?php echo site_url("Transacciones/comprar")?>', // Forma correcta de llamar al controlador
                        dataType: 'json',
                        success: function(result){
                           alert(result);
                           $('#listaVentas').html('');
                           getVentas();
                           //$(location).attr('href', '<?php echo site_url('Busqueda') ?>');
                        },
                        error: function(result){
                            console.log(result);
                            alert(result);
                        }
                    });
            }
    }
</script>
<div class="container formulario">
    <h1 id="userNick"></h1>
    <div class="form-group row">
            <label for="inputNick" class="col-sm-2 col-form-label"><br>Valoración</label>
            <div class="col-sm-4">
                <h3><span id="spanValoracion"></span> <span class='glyphicon glyphicon-star-empty'></span></h3>
            </div>
        </div>
    <hr/>
    <section id="listaVentas">
        
    </section>
            <hr/>
    <div class="col-sm-12"> </div>
        
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-5">
            <br>
            <br>
            <br>

            <h2>Envía un mensaje a este usuario</h2>
            <textarea class='textarea' id='textAreaMSG'></textarea>
            <button type="button" class="btn navbar-inverse btn-block btn_submit" onclick="sendMSGuser()">Enviar mensaje</button>
        </div>
    </div>
</div>