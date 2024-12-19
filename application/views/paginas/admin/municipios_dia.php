<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <h1 class="text-center"><?= devolverFecha($titulo) ?></h1>
        <form class="form-horizontal" role="form" method="post" action="<?= site_url('admin/rutasAdmin') ?>/subirMunicipioDia">
            <div class="form-group">
                <div class="col-sm-10">
                    <select name="idVisitado" id="idVisitado" class="form-control">
                        <option value="" disabled selected>Elegir municipio</option>
<?php
                        foreach ($listaMunicipiosDia as $row){
                            $tituloMunicipio=$row["Municipio"];
                            $idMunicipioVisitado=$row["IdVisitado"];
                            $fechaMunicipioVisitado=devolverFecha($row["Fecha"]);
                            $resultado=$tituloMunicipio." ".$fechaMunicipioVisitado;
?>                 
                            <option value="<?= $idMunicipioVisitado ?>"><?= $resultado ?></option>
<?php
	   		      	    }
?>
				    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col">
                    <p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col" id="volverDias">
                    <a href="<?= site_url('admin/rutasAdmin') ?>/ponerDias/<?= $idRuta ?>">Volver</a>
                </div>
            </div>
            
            <input type="hidden" id="idRutaDia" name="idRutaDia" value="<?= $idRutaDia ?>"/>
        </form>

        <h2 class="text-center">Municipios visitados</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Municipio</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
<?php
            foreach ($listaMunicipiosVisitados as $row){
?>                   
                <tr>
                    <td><?= $row["Municipio"] ?></td>
                    <td><a href="<?= site_url('admin/rutasAdmin') ?>/borrarMunicipioDia/<?= $row["IdRutaMunicipio"] ?>/<?= $row["IdRutaDia"] ?>">Eliminar</a></td>
                </tr>
<?php			
            }
?>
        </table>  
    </div>
</div>
