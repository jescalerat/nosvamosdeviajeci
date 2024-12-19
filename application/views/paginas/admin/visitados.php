<table class="table">
<?php 
	$CI =&get_instance();
	$listaMunicipiosVisitados = $CI->municipiosVisitados($idComunidad,$idProvincia,$idMunicipio);

	foreach ($listaMunicipiosVisitados as $row){
		$tituloMunicipio=$row["Municipio"];
		$idMunicipioVisitado=$row["IdVisitado"];
?>
			<tr>
				<td width="50%">
					<a href="<?= site_url('admin/visitasAdmin') ?>/visitado/<?= $idMunicipioVisitado ?>"><?= $tituloMunicipio ?></a>
				</td>
				<td class="text-center" width="30%">
					<?= devolverFecha($row["Fecha"]) ?>
				</td>
				<td width="20%">
					<a href="<?= site_url('admin/visitasAdmin') ?>/borrarVisitado/<?= $idMunicipioVisitado ?>">Eliminar</a>
				</td>
			</tr>
<?php 
	}
?>			
</table>			