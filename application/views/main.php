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

        cabeza = '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"><div class="card"><img src="<?php echo base_url(); ?>application/resources/images/img_avatar2.png" alt="Avatar" style="width:100%"><div class="container"><h4><b>';
        pie = '</b></h4><br><p>Interior Designer</p></div></div></div>';

        for(i=0; i < cartas.length-1; i++) {
            insertText(cabeza + cartas[i] + pie);
        }
    }
    function insertText(texto){
        $('#resultadosBusqueda').append(texto);
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
                                    <label for="filter">Filter by</label>
                                    <select class="form-control">
                                        <option value="0" selected>All Snippets</option>
                                        <option value="1">Featured</option>
                                        <option value="2">Most popular</option>
                                        <option value="3">Top rated</option>
                                        <option value="4">Most commented</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="contain">Author</label>
                                    <input class="form-control" type="text" />
                                  </div>
                                  <div class="form-group">
                                    <label for="contain">Contains the words</label>
                                    <input class="form-control" type="text" />
                                  </div>
                                  <button type="submit" class="btn navbar-inverse" style="color:#FFF;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
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