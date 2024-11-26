<table class="table">
	<thead>
		<tr>
			<th scope="col"><h1 class="text-center">Visitados</h1></th>
			<th scope="col"><h1 class="text-center">No visitados</h1></th>
		</tr>
	</thead>

<?php
				$mostrarTituloComunidad = 1;
				$mostrarTituloProvincia = 1;
				$idComunidadPost = 0;
				$idProvinciaPost = 0;

				foreach ($listaMunicipios as $row){
					$tituloComunidad=mb_strtoupper($row["Comunidad"]);
					$idComunidad=$row["IdComunidad"];
					$tituloProvincia=mb_strtoupper($row["Provincia"]);
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
									<th scope="col" colspan="2" class="text-center"><?= $tituloComunidad ?></th>	
								</tr>
							</thead>

<?php
					}

					if ($mostrarTituloProvincia == 1){
						$mostrarTituloProvincia = 0;
						$idProvinciaPost = $idProvincia;
?>
							<thead class="thead-light">
								<tr>
									<th scope="col" colspan="2" class="text-center"><?= $tituloProvincia ?></th>	
								</tr>
							</thead>
<?php
					}
?>
							<tr>
								<td style="vertical-align:top"><?php include("visitados.php"); ?></td>
								<td style="vertical-align:top"><?php include("novisitados.php"); ?></td>
							</tr>

<?php
				}
?>
</table>
