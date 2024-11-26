<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <h1 class="text-center">Modificar Base de datos</h1>
	
<?php		
		    if ($mensajeError != null){
?>
                <form class="col">
                    <div class="row">
                        <div class="col" id="respuestas">
                            <p class="text-center text-info"><?= $mensajeError ?></p>
                        </div>
                    </div>
                </form>
<?php		
	        } 
?>
        <div class="container">
            <form role="form" id="bbdd" method="post" action="bbdd/mensaje">
                <div class="form-group">
                    <label class="col control-label" for="mensaje">
                        Tu mensaje
                    </label>
                    <div class="col-sm-10">
                        <textarea id="mensaje" name="mensaje" class="form-control" rows="3" cols="80" required="required"></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col">
                        <p class="text-center"><button type="submit" class="btn btn-default">Enviar</button></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
