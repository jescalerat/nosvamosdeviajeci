<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <h1 class="text-center"><?= cambiarAcentos($titulo) ?></h1>
        <form class="form-horizontal" role="form" method="post" action="<?= site_url('admin/rutasAdmin') ?>/subirDias">
            <div class="form-group">
                <label class="col control-label" for="fecha">
                    Fecha
                </label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="fecha" id="fecha" value="<?= $fechaForm ?>">
                </div>
            </div>
<?php		
    		if ($idRutaDia != ""){
?>
                <div class="row">
                    <div class="col-6" id="addMunicipios">
                        <a href="<?= site_url('admin/rutasAdmin') ?>/ponerMunicipios/<?= $idRutaDia ?>">Añadir municipios</a>
                    </div>
                    <div class="col-6" id="addComentarios">
                        <a href="<?= site_url('admin/rutasAdmin') ?>/ponerComentarios/<?= $idRutaDia ?>">Añadir comentarios</a>
                    </div>
                </div>
<?php
		    }
?>
            <div class="form-group">
                <div class="col">
                    <p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
                </div>
            </div>
            
            <input type="hidden" id="idRuta" name="idRuta" value="<?= $idRuta ?>"/>
            <input type="hidden" id="idRutaDia" name="idRutaDia" value="<?= $idRutaDia ?>"/>
        </form>

        <h2 class="text-center">Dias realizados</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
<?php
            foreach ($listaDiasRuta as $row){
?>                   
                <tr>
                    <td><a href="<?= site_url('admin/rutasAdmin') ?>/ponerRutaDia/<?= $row["IdRutaDia"] ?>/<?= $row["IdRuta"] ?>"><?= devolverFechaLista($row["Fecha"]) ?></a></td>
                    <td><a href="<?= site_url('admin/rutasAdmin') ?>/borrarRutaDia/<?= $row["IdRutaDia"] ?>/<?= $row["IdRuta"] ?>">Eliminar</a></td>
                </tr>
<?php			
            }
?>
        </table>  
    </div>
</div>
