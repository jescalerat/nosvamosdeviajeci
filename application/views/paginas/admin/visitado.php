<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
		<h1 class="text-center"><?= $municipio ?></h1>
		<div id="formulario" class="formulario">
			<form class="form-horizontal" role="form" method="post" action="resultados.php">
				<div class="form-group">
					<label class="col control-label" for="fecha">
						Fecha
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="date" name="fecha" id="fecha" value="<?= $visitado[0]['Fecha'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="titulo">
						Titulo
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="titulo" id="titulo" value="<?= $visitado[0]['Titulo'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="facebook">
						Facebook
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="facebook" id="facebook" value="<?= $visitado[0]['Facebook'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="facebook">
						Coordenada X
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="coordenadax" id="coordenadax" value="<?= $todomunicipio[0]['CoordenadaX'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="facebook">
						Coordenada Y
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="coordenaday" id="coordenaday" value="<?= $todomunicipio[0]['CoordenadaY'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col">
						<p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>
