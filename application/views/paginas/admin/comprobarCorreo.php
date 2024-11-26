<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <h1 class="text-center">Correo en Nos vamos de viaje</h1>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr class="d-flex">
                    <th class="col-2 text-center">Eliminar</th>
    	       		<th class="col-2 text-center">Nombre</th>
    	       		<th class="col-2 text-center">Email</th>
    	       		<th class="col-5 text-center">Mensaje</th>
    	       		<th class="col-1 text-center">IP</th>
                </tr>
            </thead>
<?php 
            foreach ($correos as $row){
?>                
                <tr class="d-flex">
                    <td class="col-2"><a href="<?= site_url('admin/comprobarCorreo') ?>/eliminar/<?= $row["IdCorreo"] ?>">Eliminar</a></td>
                    <td class="col-2"><?= $row["Nombre"] ?></td>
                    <td class="col-2"><?= $row["Email"] ?></td>
                    <td class="col-5"><?= $row["Mensaje"] ?></td>
                    <td class="col-1"><?= $row["IP"] ?></td>
                </tr>
<?php 
            }
?>                
    </div>
</div>
