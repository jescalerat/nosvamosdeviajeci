			<table class="table">
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
								<td valign="top" width="70%">
									<a class="btn btn-default btn-block" role="button" href="<?= site_url('visitados') ?>/visita/<?= $idVisitado ?>/0" class="list-group-item"><?= cambiarAcentos($tituloMunicipio) ?></a>
								</td>
								<td valign="top" width="30%"><?= devolverFecha($row["Fecha"]) ?></td>
							</tr>
<?php
				} //foreach
?>
			</table>
