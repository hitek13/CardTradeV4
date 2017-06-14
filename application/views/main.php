<script>
    function buscarCartas(){
        cadena = '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"><div class="card"><img src="<?php echo base_url(); ?>application/resources/images/img_avatar2.png" alt="Avatar" style="width:100%"><div class="container"><h4><b>Jane Doe</b></h4><br><p>Interior Designer</p></div></div></div>';
        $('#resultadosBusqueda').html("");
        if($('#buscador').val()){
            var parametros = {
                'Carta': $('#buscador').val()
            };
            $.ajax({
                data: parametros,
                type: "POST",
                url: '<?php echo site_url("Busqueda/cartas")?>', // Forma correcta de llamar al controlador
                dataType: 'json',
                success: function(result){
                    crearCartas(result.split('|'));
                },
                error: function(result){
                    console.log(result);
                    insertText('<h3 align="middle">No hay cartas que coincidan con la busqueda</h3>');
                }
            });
        }
    }
    function crearCartas(cartas){

        cabeza = '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" onclick="cardViwe(this)" id="';
        pie = '</b></h4><br></div></div></div>';

        for(i=0; i < cartas.length-1; i++) {
            cartaValor = cartas[i].split(';')
            cuerpo = '"><div class="card"><img src="<?php echo base_url(); ?>application/resources/cartas/'+cartaValor[2]+'" alt="Avatar" style="width:100%"><div class="container"><h4><b>';
            insertText(cabeza + cartaValor[1] + cuerpo + cartaValor[0] + pie);
        }
    }
    function insertText(texto){
        $('#resultadosBusqueda').append(texto);
    }
    function cardViwe(objeto){
        localStorage.setItem("cartaBuscada", $(objeto).prop('id') );
        //alert(localStorage.cartaBuscada);
        $(location).attr('href', '<?php echo site_url('Busqueda') ?>');
    }
    function busquedaAvanzada(){
        $('#resultadosBusqueda').html("");
        var parametros = {
                'Edicion': $('#edicionSlct').val(),
                'cmc': $('#CMC').val(),
                'cmcRel': $('#cmcRel').val(),
                'ataque': $('#atk').val(),
                'ataqueRel': $('#atkRel').val(),
                'defensa': $('#def').val(),
                'defensaRel': $('#defRel').val()
            };
            $.ajax({
                data: parametros,
                type: "POST",
                url: '<?php echo site_url("Busqueda/busquedaAvanzada")?>', // Forma correcta de llamar al controlador
                dataType: 'json',
                success: function(result){
                    crearCartas(result.split('|'));
                },
                error: function(result){
                    console.log(result);
                    insertText('<h3 align="middle">No hay cartas que coincidan con la busqueda</h3>');
                }
            });
    }
</script>
<!-- ||||||||||||||||||||||||| Search bar
        http://bootsnipp.com/snippets/featured/advanced-dropdown-search |||||||||||||||||||||||| -->
    <div class="container" style="margin-top: 0px">
	<div class="row">
            
        <div class="col-md-12">
            <img src="<?php echo base_url(); ?>application/resources/images/forceofwill.png" 
                  class="img-responsive hidden-xs logoFoW"/>
                    
            <div class="input-group" id="adv-search">
                <input type="text" class="form-control input-lg" placeholder="Buscar cartas" id="buscador" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle btn-lg" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                    <label for="filter">Filtrar por edicion</label>
                                    <select class="form-control" id="edicionSlct">
                                        <option selected>Todas las ediciones</option>
                                        <option value="TAT">TAT</option>
                                        <option value="RL">RL</option>
                                        <option value="PR">PR</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="contain">Coste de maná convertido</label>
                                    <input class="form-control" id="CMC" type="text" />
                                    <select class="form-control" id="cmcRel">
                                        <option value="=">Igual que</option>
                                        <option value="<=">O mayor que</option>
                                        <option value=">=">O menor que</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-sm-6">
                                        <label for="contain">Ataque</label>
                                        <input class="form-control" id="atk" type="text" />
                                        <select class="form-control" id="atkRel">
                                            <option value="=">Igual que</option>
                                            <option value="<=">O mayor que</option>
                                            <option value=">=">O menor que</option>
                                        </select>
                                      </div>
                                      <div class="col-sm-6">
                                        <label for="contain">Defensa</label>
                                        <input class="form-control" id="def" type="text" />
                                        <select class="form-control" id="defRel">
                                            <option value="=">Igual que</option>
                                            <option value="<=">O mayor que</option>
                                            <option value=">=">O menor que</option>
                                        </select>
                                      </div>
                                  </div>
                                    <button class="btn navbar-inverse" style="color:#FFF;" onclick="buscarCartas()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </form>
                            </div>
                        </div>
                        <button type="button" class="btn navbar-inverse" style="color:#FFF;" onclick="buscarCartas()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
          </div>
        </div>
	</div>
    
    <!-- ||||||||||||||||||||||||||||||||||||||||||||||||| -->

<br>
<br>
<br>

    <div class="container">
        <div class="row">
            <section id="resultadosBusqueda">
            </section>
        </div>
    </div>

<!--
    <div class="container">
        <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="card">
                <img src="<?php //echo base_url(); ?>application/resources/images/img_avatar2.png" alt="Avatar" style="width:100%">
                <div class="container">
                    <h4><b>Jane Doe</b></h4><br>
                    <p>Interior Designer</p>
                </div>
            </div>
        </div>
    </div>
</div>
-->