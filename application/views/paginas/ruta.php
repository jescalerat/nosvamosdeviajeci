<br/>
<br/>
<br/>

<form class="col">
	<div class="row">
		<div class="col" id="titulo">
			<h1 class="text-center"><?= mb_strtoupper($rutaTitulo) ?></h1>
		</div>
	</div>

	<div class="row">
		<div class="col" id="rutas">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th class="text-center">		
						<?= mb_strtoupper($rutaDia) ?>
						</th>
						<th class="text-center">		
						<?= mb_strtoupper($rutaMunicipios) ?>
						</th>
					</tr>
				</thead>

	<?php
				$idRutaAnt = 0;
				$totalColspan=0;
				foreach ($listRutaDia as $row){
					$idRutaDia = $row["IdRutaDia"];
					$municipio = $row["Municipio"]." (".$row["Provincia"].")";

					foreach ($listRutaDiaAgrupa as $rowAgrupa){
						if ($rowAgrupa['Fecha'] == $row['Fecha']) {
							$totalColspan=$rowAgrupa['contador'];
						}
					}
	?>
					<tr>
	<?php
							if ($idRutaAnt != $idRutaDia) {
	?>
								<td rowspan="<?=$totalColspan?>" class="align-middle">
									<a href="../ruta_dia/<?= $row['IdRutaDia'] ?>" class="btn btn-default btn-block" role="button"><?= devolverFecha($row["Fecha"]) ?></a>
								</td>
	<?php
							} 
	?>
						<td>
							<?= $municipio ?>
						</td>
					</tr>
	<?php
					$idRutaAnt = $idRutaDia;
				}		
	?>
			</table>
		</div>
	</div>
</form>