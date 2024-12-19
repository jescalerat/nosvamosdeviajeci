<br/>
<br/>
<br/>
<style type="text/css">
  .thumb{
            margin-bottom: 30px;
        }
        
        .page-top{
            margin-top:85px;
        }

   
img.zoom {
    width: 100%;
    height: 200px;
    border-radius:5px;
    object-fit:cover;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
}
        
 
.transition {
    -webkit-transform: scale(1.2); 
    -moz-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
}
    .modal-header {
   
     border-bottom: none;
}
    .modal-title {
        color:#000;
    }
    .modal-footer{
      display:none;  
    }
</style>

<form class="col">
    <div class="row">
		<div class="col" id="titulo">
			<h1 class="text-center"><?= $municipio ?></h1>
		</div>
	</div>

	<div class="row">
		<div class="col" id="facebook">
			<a href="<?= $facebook ?>"  target="_blank"><?= $facebook ?></a>
		</div>
	</div>

	<div class="row">
		<div class="col" id="comentario">
			<?= cambiarAcentos($comentario) ?>
		</div>
	</div>

	<div class="row">
<?php if(!empty($fotos)): foreach($fotos as $foto): ?>
		<div class="col-sm-3" style="margin-bottom: 2rem;">
			<div class="card border-primary">
				<a href="<?= $foto["Foto"] ?>" class="fancybox" rel="ligthbox">
					<img  src="<?= $foto["Foto"] ?>" data-src="<?= $foto["Foto"] ?>" class="zoom img-fluid lazyload"  alt="<?= $foto["Orden"] ?>" title="<?= $foto["Orden"] ?>" >
				</a>
			</div>
		</div>
<?php endforeach; else: ?>
		<div class="alert alert-warning"><?= cambiarAcentos($sin_fotos) ?></div>
<?php endif; ?>
	</div>
	<ul class="pagination pagination-sm justify-content-between">
			<?= $links ?>
	</ul>
	
<?php 
	if ($idRutaDia != null && $idRutaDia != 0) {
?>
		<div class="alert alert-info text-center">
			<a href="<?= site_url('rutas') ?>/ruta_dia/<?= $idRutaDia ?>" class="alert-link"><?= cambiarAcentos($volver) ?></a>
		</div>
<?php 
	}
?>
</form>

<script>
	$(document).ready(function(){
	  $(".fancybox").fancybox({
	        openEffect: "none",
	        closeEffect: "none"
	    });
	    
	    $(".zoom").hover(function(){
			
			$(this).addClass('transition');
		}, function(){
	        
			$(this).removeClass('transition');
		});
	});
</script>