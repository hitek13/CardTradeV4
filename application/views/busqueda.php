<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesSign_up.css">
<script>
$(document).ready(function(){
    
    var parametros = {
                'idCarta': localStorage.cartaBuscada
            };
    $.ajax({
                data: parametros,
                type: "POST",
                url: '<?php echo site_url("Fasciculos/showFasciculos")?>', // Forma correcta de llamar al controlador
                dataType: 'json',
                success: function(result){
                    if(result){
                        //alert(result);
                        fillFasciculos(result);
                    }
                    else
                        alert('No hay fasciculos a la venta');
                },
                error: function(result){
                    console.log(result);
                    alert('Error: '+result);
                }
            });
            
    $('#addFasciculo').on('click', function (){
        if( !localStorage.id )
            alert('Inicia sesión para vender');
        else{   
            var parametros = {
                'idCarta': localStorage.cartaBuscada,
                'idUsuario': localStorage.id,
                'Precio': $('#inputPrecio').val(),
                'Cantidad': $('#inputCantidad').val(),
                'Estilo': $('input[name=optradio]:checked', '#radioEstilo').val(),
                'Calidad': $('input[name=optradio1]:checked', '#radioCalidad').val()
            };
            $.ajax({
                data: parametros,
                type: "POST",
                url: '<?php echo site_url("Fasciculos/addFasciculo")?>', // Forma correcta de llamar al controlador
                dataType: 'json',
                success: function(result){
                    if(result){
                        alert('Se ha añadido el fasciculo');
                        $(location).attr('href', '<?php echo site_url('Busqueda') ?>');
                    }
                    else
                        alert('¿No tienes ya esta carta en venta?')
                },
                error: function(result){
                    console.log(result);
                    alert('¿No has introducido ya esta carta?');
                }
            });
        }
    });
});
function fillFasciculos (cadena){
    lineFasciculo = cadena.split('|');
    cabeza = '<div class="col-sm-2"><h3>'; //Nick
    cuerpo1 = '</h3></div><div class="col-sm-2"><h3>'; //Estilo
    cuerpo2 = '</h3></div><div class="col-sm-2"><h3>'; //Calidad
    cuerpo3 = '</h3></div><div class="col-sm-2"><h4>'; //Cantidad
    cuerpo4 = '</h4></div><div class="col-sm-2"><h3>'; //Precio
    cuerpo5 = '€</h3></div><div class="col-sm-2"><p class="btn btn-success btn-lg saldo" id="addSaldo" '; //id's
    
    pie = '>Comprar <span class="glyphicon glyphicon-eur"></span> </p></div><hr/> <br>';
    //alert('Llega');
    for(i=0; i < lineFasciculo.length-1; i++){
        //alert(i);
        elementos = lineFasciculo[i].split(';');
        click = 'name="botonP" onclick="comprarCarta(\''+elementos[5]+'\',\''+elementos[6]+'\' )" ';
        
        string = cabeza+elementos[0]+cuerpo1+elementos[1]+cuerpo2+elementos[2]+cuerpo3+ construirDesplegable(elementos[3], elementos[5] ) +cuerpo4+elementos[4]+cuerpo5+' '+click+' '+pie;
        //alert(string);
        $('#fasciculosList').append(string);
    }
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
                       $(location).attr('href', '<?php echo site_url('Busqueda') ?>')
                    },
                    error: function(result){
                        console.log(result);
                        alert(result);
                    }
                });
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
</script>

<div class="container formulario">
    <div class="form-group row">
            <div class="col-sm-6">
                <img src="<?php echo base_url(); ?>application/resources/images/img_avatar2.png" alt="Avatar" style="width:250px; height: 350px;">
            </div>
        <div class="col-sm-6 fasciculo">
                <label for="inputNick" class="col-sm-2 col-form-label">Precio</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPrecio" placeholder="Precio">
                    </div>
                <label for="inputNick" class="col-sm-2 col-form-label">Cantidad</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCantidad" placeholder="Cantidad">
                    </div>  
                <hr/>
                <div class="align-middle">
                    <form id="radioEstilo">
                        <label class="radio-inline"><input type="radio" name="optradio" value="Normal">Normal</label>
                        <label class="radio-inline"><input type="radio" name="optradio" value="Foil">Foil</label>
                        <label class="radio-inline"><input type="radio" name="optradio" value="Full art">Full art</label>
                        <label class="radio-inline"><input type="radio" name="optradio" value="Rara">Rara</label>
                    </form>
                </div>
                <hr/>
                <div class="align-middle">
                    <form id="radioCalidad">
                        <label class="radio-inline"><input type="radio" name="optradio1" value="Nueva">Nueva</label>
                        <label class="radio-inline"><input type="radio" name="optradio1" value="Semi nueva">Semi nueva</label>
                        <label class="radio-inline"><input type="radio" name="optradio1" value="Usada">Usada</label>
                        <label class="radio-inline"><input type="radio" name="optradio1" value="Muy usada">Muy usada</label>
                    </form>
                </div>
                <br>
                <hr/>
                <div class="align-middle">
                    <p class="btn btn-success btn-lg" id="addFasciculo"> Vender carta</p>    
                </div>
            </div>
        </div>
        <hr/>
        <div class="form-group row" id="fasciculosList">
            
        </div>
        
</div>

<!--
<div class="col-sm-2">
                <h3>Nombre</h3>
            </div>
            <div class="col-sm-2">
                <h3>Estilo</h3>
            </div>
            <div class="col-sm-2">
                <h3>Calidad</h3>
            </div>
            <div class="col-sm-2">
                <h3>Cantidad</h3>
            </div>
            <div class="col-sm-2">
                <h3>Precio</h3>
            </div>
            <div class="col-sm-4">
                <p class="btn btn-success btn-lg saldo" id="addSaldo" onclick="comprarCarta (1, 2)"> Comprar <span class='glyphicon glyphicon-eur'></span> </p>
            </div>
            <hr/>
-->