<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <h1 class="text-center">Paginas vistas en Nos vamos de viaje</h1>
<?php 
            if ($titulo != ""){
?>
                <h3 class="text-center"><?= $titulo ?></h3>
<?php
            }
?>	
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr class="d-flex">
                        <th class="col-2 text-center">Eliminar</th>
                        <th class="col-2 text-center">IP</th>
                        <th class="col-2 text-center">Hora</th>
                        <th class="col-2 text-center">Fecha</th>
                        <th class="col-2 text-center">Pagina</th>
                        <th class="col-2 text-center">Observaciones</th>
                    </tr>
                </thead>
<?php 
            foreach ($paginasvistas as $row){
                $CI =&get_instance();
                
                $estilo=$CI->estilo($row["Pagina"]);
                $parametros="";
                $pagina_vista = $CI->titulopagina($row["Pagina"]);
?>                
                <tr class="d-flex" <?php if ($estilo!="") {print($estilo);} ?>>
                    <td class="col-2"><a href="<?= site_url('admin/comprobarPaginasVistas') ?>/eliminar/<?= $row["IdPaginasVistas"] ?>/<?= $params ?>">Eliminar</a></td>
                    <td class="col-2 text-center"><?= $row["IP"] ?></td>
                    <td class="col-2 text-center"><?= $row["Hora"] ?></td>
                    <td class="col-2 text-center"><?= devolverFechaBBDD($row["Fecha"]) ?></td>
                    <td class="col-2 text-center"><?= $pagina_vista ?></td>
                    <td class="col-2 text-center"><?= $row["Observaciones"] ?></td>
                </tr>
<?php 
            }
?>                
    </div>
</div>
