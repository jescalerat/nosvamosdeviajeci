<table class="table">
<?php 
	$CI =&get_instance();
	$listaMunicipiosNoVisitados = $CI->municipiosNoVisitados($idComunidad,$idProvincia,$idMunicipio);

	foreach ($listaMunicipiosNoVisitados as $row){
		$tituloMunicipio=$row["Municipio"];
		$idMunicipioVisitado=$row["IdMunicipio"];
?>
			<tr>
				<td class="text-center">
					<a href="<?= site_url('admin/visitasAdmin') ?>/municipioVisitado/<?= $idMunicipioVisitado ?>"><?= $tituloMunicipio ?></a>
				</td>
			</tr>
<?php 
	}
?>			
</table>			