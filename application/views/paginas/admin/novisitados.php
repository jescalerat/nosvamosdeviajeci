<table class="table">
<?php 
	$CI =&get_instance();
	$listaMunicipiosNoVisitados = $CI->municipiosNoVisitados($idComunidad,$idProvincia,$idMunicipio);

	foreach ($listaMunicipiosNoVisitados as $row){
		$tituloMunicipio=$row["Municipio"];
		$idMunicipioVisitado=$row["IdVisitado"];
?>
			<tr>
				<td class="text-center">
					<a href="visitado.php?idMunicipioVisitado=<?= $idMunicipioVisitado ?>&opcion=N"><?= $tituloMunicipio ?></a>
				</td>
			</tr>
<?php 
	}
?>			
</table>			