<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <form class="form-horizontal" role="form" method="post" action="<?= site_url('admin/rutasAdmin') ?>/subirRutas">
            <div class="form-group">
                <label class="col control-label" for="rutaFechaES">
                    Español
                </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="fechaES" id="fechaES" value="<?= $fechaES ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col control-label" for="rutaFechaCA">
                    Catalan
                </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="fechaCA" id="fechaCA" value="<?= $fechaCA ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col control-label" for="rutaFechaEN">
                    Ingles
                </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="fechaEN" id="fechaEN" value="<?= $fechaEN ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col control-label" for="orden">
                    Orden
                </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="orden" id="orden" value="<?= $orden ?>">
                </div>
            </div>
<?php		
    		if ($idRuta != "" && $idRuta != "undefined"){
?>
                <div class="row">
                    <div class="col" id="addDias">
                        <a href="<?= site_url('admin/rutasAdmin') ?>/ponerDias/<?= $idRuta ?>">Añadir dias</a>
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
        </form>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Orden</th>
                    <th>Fecha</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
<?php
            foreach ($listaRutas as $row){
?>                   
                <tr>
                    <td><?= $row["Orden"] ?></td>
                    <td><a href="<?= site_url('admin/rutasAdmin') ?>/ponerRuta/<?= $row["IdRuta"] ?>"><?= $row["FechaES"] ?></a></td>
                    <td><a href="<?= site_url('admin/rutasAdmin') ?>/borrarRutas/<?= $row["IdRuta"] ?>">Eliminar</a></td>
                </tr>
<?php			
            }
?>
        </table>  
    </div>
</div>
