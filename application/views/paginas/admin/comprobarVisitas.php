<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <h1 class="text-center">Visitas en Nos vamos de viaje</h1>
        
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr class="d-flex">
                    <th class="col-3 text-center">Eliminar</th>
                    <th class="col-3 text-center">IP</th>
                    <th class="col-2 text-center">Hora</th>
                    <th class="col-2 text-center">Fecha</th>
                    <th class="col-2 text-center">Idioma</th>
                </tr>
            </thead>
<?php 
            foreach ($visitas as $row){
                $fecha_futura=$row["Fecha"];

                if (strcmp($fecha_actual,$fecha_futura)!=0){
                    $CI =&get_instance();
                    $visitasDia = $CI->visitasDia($fecha_actual);
                    $visitasDiaDistintas = $CI->visitasDiaDistintas($fecha_actual);
?>
                    <tr class="d-flex" bgcolor="green">
        				<td class="col-4"><a href="<?= site_url('admin/comprobarPaginasVistas') ?>/fecha/<?= $fecha_actual ?>"><?= $fecha_actual ?></a></td>
        	       		<td class="col-3 text-right">Visitas dia:</td>
        	       		<td class="col-1 text-center"><?= $visitasDia ?></td>
        	       		<td class="col-3 text-right">Visitas dia distintas:</td>
        	       		<td class="col-1 text-center"><?= $visitasDiaDistintas ?></td>
        	       	</tr>
<?php 
                    $fecha_actual=$row["Fecha"]; 
                }
?>
                <tr class="d-flex">
                    <td class="col-3"><a href="<?= site_url('admin/comprobarVisitas') ?>/eliminar/<?= $row["IdVisita"] ?>">Eliminar</a></td>
                    <td class="col-3 text-center"><a href="<?= site_url('admin/comprobarPaginasVistas') ?>/fechaIP/<?= $row["Fecha"] ?>/<?= $row["IP"] ?>"><?= $row["IP"] ?></a></td>
                    <td class="col-2 text-center"><?= $row["Hora"] ?></td>
                    <td class="col-2 text-center"><?= $row["Fecha"] ?></td>
                    <td class="col-2 text-center"><?= $row["Idioma"] ?></td>
                </tr>
<?php 
            }

                    $CI =&get_instance();
                    $visitasDia = $CI->visitasDia($fecha_actual);
                    $visitasDiaDistintas = $CI->visitasDiaDistintas($fecha_actual);
?>            
                    <tr class="d-flex" bgcolor="green">
                        <td class="col-4"><a href="<?= site_url('admin/comprobarPaginasVistas') ?>/fecha/<?= $fecha_actual ?>"><?= $fecha_actual ?></a></td>
                        <td class="col-3">Visitas dia:</td>
                        <td class="col-1 text-center"><?= $visitasDia ?></td>
                        <td class="col-3">Visitas dia distintas:</td>
                        <td class="col-2 text-center"><?= $visitasDiaDistintas ?></td>
                    </tr>
        </table>
    </div>
</div>
