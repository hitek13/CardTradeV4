<!-- ||||||||||||||||||||||||| Search bar
        http://bootsnipp.com/snippets/featured/advanced-dropdown-search |||||||||||||||||||||||| -->
    <div class="container" style="margin-top: 0px">
	<div class="row">
            
        <div class="col-md-12">
            <img src="<?php echo base_url(); ?>application/resources/images/forceofwill.png" 
                  class="img-responsive logoFoW"/>
                    
            <div class="input-group" id="adv-search">
                <input type="text" class="form-control input-lg" placeholder="Buscar cartas" />
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
                        <button type="button" class="btn navbar-inverse" style="color:#FFF;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
          </div>
        </div>
	</div>
    
    <!-- ||||||||||||||||||||||||||||||||||||||||||||||||| -->

<a href="<?php echo site_url('Main/busqueda') ?>">
    <h1>
        Link
    </h1>
</a>