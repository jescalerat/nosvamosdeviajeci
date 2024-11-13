<br/>
<br/>
<br/>

<form class="col">
	<div class="row">
		<div class="col" id="titulo">
			<h1 class="text-center"><?= devolverFecha($rutaDiaTitulo) ?></h1>
		</div>
	</div>


	<div class="row">
		<div class="col" id="comentarios">
			<?= cambiarAcentos($rutaComentario) ?>
		</div>
	</div>
<?php
		foreach ($rutaDia as $row){
			$idRutaDia = $row["IdRutaDia"];
			$idVisitado = $row["IdVisitado"];
			$municipio = $row["Municipio"]." (".$row["Provincia"].")";
			$idRutaVolver = $row["IdRuta"];
			
?>
			<a href="<?= site_url('visitados') ?>/visita/<?= $idVisitado ?>/<?= $idRutaDia ?>" class="list-group-item"><?= cambiarAcentos($municipio) ?></a>
<?php
		}		
?>

	<div class="alert alert-info text-center">
		<a href="<?= site_url('rutas') ?>/ruta/<?= $idRutaVolver ?>" class="alert-link"><?= cambiarAcentos($rutaVolver) ?></a>
	</div>
</form>