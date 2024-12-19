<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <h1 class="text-center"><?= $municipio ?></h1>
        <form class="form-horizontal" role="form" method="post" action="<?= site_url('admin/fotos') ?>/subirFotos">
            <div class="form-group">
                <label for="comentarioES">Fotos</label>
                <textarea id="fotos" name="fotos" class="form-control" rows="3" cols="80"></textarea>
            </div>
            
            <div class="form-group">
                <div class="col">
                    <p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
                </div>
            </div>

            <input type="hidden" id="idMunicipio" name="idMunicipio" value="<?= $idMunicipio ?>"/>
        </form>

        <h1 class="text-center">Sin Fotos</h1>
        <table class="table">
<?php
            $mostrarTituloComunidad = 1;
            $mostrarTituloProvincia = 1;
            $idComunidadPost = 0;
            $idProvinciaPost = 0;
            if ($listaSinFotos != null){
                foreach ($listaSinFotos as $row){
                    $tituloComunidad=strtoupper($row["Comunidad"]);
                    $idComunidad=$row["IdComunidad"];
                    $tituloProvincia=strtoupper($row["Provincia"]);
                    $idProvincia=$row["IdProvincia"];
                    $tituloMunicipio=$row["Municipio"];
                    $idMunicipio=$row["IdMunicipio"];
                    $idVisitado=$row["IdVisitado"];

                    if ($idComunidadPost != $idComunidad){
                        $mostrarTituloComunidad = 1;
                    }

                    if ($idProvinciaPost != $idProvincia){
                        $mostrarTituloProvincia = 1;
                    }

                    if ($mostrarTituloComunidad == 1){
                        $mostrarTituloComunidad = 0;
                        $idComunidadPost = $idComunidad;
?>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" colspan="2"><p class="text-center"><?= $tituloComunidad ?></p></th>	
                            </tr>
                        </thead>
<?php 
                    } //if ($mostrarTituloComunidad == 1){

                    if ($mostrarTituloProvincia == 1){
                        $mostrarTituloProvincia = 0;
                        $idProvinciaPost = $idProvincia;
?>
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" colspan="2"><p class="text-center"><?= $tituloProvincia ?></p></th>	
                            </tr>
                        </thead>
<?php 
		            }  //if ($mostrarTituloProvincia == 1){
?>	
                        <tr>
                            <td valign="top">
                                <a href="<?= site_url('admin/fotos') ?>/ponerFotos/<?= $idMunicipio ?>"><?= $tituloMunicipio ?></a>
                            </td>
                            <td valign="top"><?= devolverFecha($row["Fecha"]) ?></td>
                        </tr>
<?php			
	            } //foreach ($listaSinFotos as $row){
            } //if ($listaSinFotos != null){
?>
        </table>  

        <h1 class="text-center">Con Fotos</h1>
        <table class="table">
<?php
            $mostrarTituloComunidad = 1;
            $mostrarTituloProvincia = 1;
            $idComunidadPost = 0;
            $idProvinciaPost = 0;
            if ($listaConFotos != null){
                foreach ($listaConFotos as $row){
                    $tituloComunidad=strtoupper($row["Comunidad"]);
                    $idComunidad=$row["IdComunidad"];
                    $tituloProvincia=strtoupper($row["Provincia"]);
                    $idProvincia=$row["IdProvincia"];
                    $tituloMunicipio=$row["Municipio"];
                    $idMunicipio=$row["IdMunicipio"];
                    $idVisitado=$row["IdVisitado"];

                    if ($idComunidadPost != $idComunidad){
                        $mostrarTituloComunidad = 1;
                    }

                    if ($idProvinciaPost != $idProvincia){
                        $mostrarTituloProvincia = 1;
                    }

                    if ($mostrarTituloComunidad == 1){
                        $mostrarTituloComunidad = 0;
                        $idComunidadPost = $idComunidad;
?>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" colspan="3"><p class="text-center"><?= $tituloComunidad ?></p></th>	
                            </tr>
                        </thead>
<?php 
                    } //if ($mostrarTituloComunidad == 1){

                    if ($mostrarTituloProvincia == 1){
                        $mostrarTituloProvincia = 0;
                        $idProvinciaPost = $idProvincia;
?>
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" colspan="3"><p class="text-center"><?= $tituloProvincia ?></p></th>	
                            </tr>
                        </thead>
<?php 
		            }  //if ($mostrarTituloProvincia == 1){
?>	
                        <tr>
                            <td valign="top">
                                <a href="fotos.php?idMunicipio=<?= $idMunicipio ?>"><?= $tituloMunicipio ?></a>
                            </td>
                            <td valign="top"><?= devolverFecha($row["Fecha"]) ?></td>
                            <td valign="top">
                                <a href="<?= site_url('admin/fotos') ?>/borrarFotos/<?= $idMunicipio ?>">Eliminar</a>
                            </td>
                        </tr>
<?php			
                } //foreach ($listaConFotos as $row){
            } //$listaConFotos != null
?>
        </table>          
    </div>
</div>
