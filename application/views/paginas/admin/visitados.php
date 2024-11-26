<table class="table">
<?php 
	$CI =&get_instance();
	$listaMunicipiosVisitados = $CI->municipiosVisitados($idComunidad,$idProvincia,$idMunicipio);

	foreach ($listaMunicipiosVisitados as $row){
		$tituloMunicipio=$row["Municipio"];
		$idMunicipioVisitado=$row["IdVisitado"];
?>
			<tr>
				<td>
					<a href="visitasAdmin/visitado/<?= $idMunicipioVisitado ?>"><?= $tituloMunicipio ?></a>
				</td>
				<td class="text-center">
					<?= $row["Fecha"] ?>
				</td>
				<td>
					<a href="resultados.php?idVisitado=<?= $idMunicipioVisitado ?>&opcion=D&idPagina=1">Eliminar</a>
				</td>
			</tr>
<?php 
	}
?>			
</table>			