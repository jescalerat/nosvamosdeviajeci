<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
		<h1 class="text-center"><?= $municipio ?></h1>
		<div id="formulario" class="formulario">
			<form class="form-horizontal" role="form" method="post" action="<?= site_url('admin/visitasAdmin') ?>/guardar">
				<div class="form-group">
					<label class="col control-label" for="fecha">
						Fecha
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="date" name="fecha" id="fecha" value="<?= $fecha ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="titulo">
						Titulo
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="titulo" id="titulo" value="<?= $titulo ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="facebook">
						Facebook
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="facebook" id="facebook" value="<?= $facebook ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="facebook">
						Coordenada X
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="coordenadax" id="coordenadax" value="<?= $coordenadaX ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="facebook">
						Coordenada Y
					</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="coordenaday" id="coordenaday" value="<?= $coordenadaY ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col">
						<p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
					</div>
				</div>

				<input type="hidden" class="idMunVisitado" name="idMunVisitado" value="<?= $idMunicipioVisitado ?>"/>
				<input type="hidden" class="idVisitado" name="idVisitado" value="<?= $idVisitado ?>"/>
			</form>
		</div>
    </div>
</div>
