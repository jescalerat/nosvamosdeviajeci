<br/>
<br/>
<br/>

<form class="col">
        <div class="row">
		<div class="col" id="titulo">
			<h1 class="text-center"><?= mb_strtoupper($rutaTitulo) ?></h1>
		</div>
	</div>

<?php
	$idiom = $this->session->userdata('language');

	foreach ($listaRutas as $row){
			if ("spanish" == $idiom){
				$titulo=$row['FechaES'];
			} else if ("english" == $idiom){
				$titulo=$row['FechaEN'];
			} else if ("catalan" == $idiom){
				$titulo=$row['FechaCA'];
			} else {
				$titulo=$row['FechaES'];
			}

			
			
		
?>
		<a href="rutas/ruta/<?= $row['IdRuta'] ?>" class="list-group-item"><?= $titulo ?></a>
<?php
	}		
?>
</form>