<br/>
<br/>
<br/>

<div class="container">
	<form role="form" class="needs-validation" method="post" action="contacta/mensaje" novalidate>
		<div class="row">
			<div class="input-field col">
				<h1 class="text-center"><?= mb_strtoupper($contactaTitulo) ?></h1>
			</div>
		</div>

<?php		
		if ($contactaCorrecto1 != null){
?>
			<form class="col">
				<div class="row">
					<div class="col" id="respuestas">
						<p class="text-center text-info"><?= cambiarAcentos($contactaCorrecto1) ?></p>
						<p class="text-center text-info"><?= cambiarAcentos($contactaCorrecto2) ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<p class="text-center">
							<a class="btn btn-default btn-block" href="<?= site_url('contacta') ?>"><?= cambiarAcentos($contactaOtra) ?></a>
						</p>
					</div>
				</div>
			</form>
<?php		
	} else {
?>


		<div class="form-group">
        	<label class="col control-label" for="nombre">
				<?= cambiarAcentos($contactaNombre) ?>
        	</label>
        	<div class="col-sm-10">
            	<input class="form-control" type="text" name="nombre" id="nombre" required="required" autofocus>
				<div class="invalid-feedback"><?= cambiarAcentos($contactaErrorNombre) ?></div>
            </div>
        </div>
        <div class="form-group">
        	<label class="col control-label" for="email">
				<?= cambiarAcentos($contactaEmail) ?>
        	</label>
            <div id="correo" class="col-sm-10">
                <input class="form-control" type="email" name="correo" id="correo" required="required">
				<div class="invalid-feedback"><?= cambiarAcentos($contactaErrorEmail) ?></div>
            </div>
            
        </div>
        <div class="form-group">
        	<label class="col control-label" for="mensaje">
				<?= cambiarAcentos($contactaMensaje) ?>
        	</label>
            <div class="col-sm-10">
            	<textarea id="mensaje" name="mensaje" class="form-control" rows="3" cols="80" required="required"></textarea>
				<div class="invalid-feedback"><?= cambiarAcentos($contactaErrorMensaje) ?></div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col">
                <p class="text-center"><button type="submit" class="btn btn-default"><?= cambiarAcentos($contactaEnviar) ?></button></p>
            </div>
        </div>
<?php		
	} 
?>
	</form>
</div>


<script>
// Ejemplo de JavaScript inicial para deshabilitar el envío de formularios si hay campos no válidos
(function () {
  'use strict'

  // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
  var forms = document.querySelectorAll('.needs-validation')

  // Bucle sobre ellos y evitar el envío
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>