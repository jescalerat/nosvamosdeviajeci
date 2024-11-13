<br/>
<br/>
<br/>

<form class="col">
        
	<div class="row">
		<div class="col-6 selector-pais" id="paises">
			<label><?= cambiarAcentos($municipiosPaises) ?></label>
			<select class="form-control"></select>
		</div>
		<div class="col-6 selector-comunidad" id="comunidades">
			<label><?= cambiarAcentos($municipiosComunidades) ?></label>
			<select name="comunidadSelect" id="comunidadSelect" class="form-control" disabled="disabled" ></select>
		</div>
	</div>
	<div class="row">
		<div class="col-6 selector-provincia" id="provincias">
			<label><?= cambiarAcentos($municipiosProvincias) ?></label>
			<select name="provinciaSelect" id="provinciaSelect" class="form-control" disabled="disabled"></select>
		</div>
		<div class="col-6 selector-municipio" id="municipios">
			<label><?= cambiarAcentos($municipiosMunicipios) ?></label>
			<select name="municipioSelect" id="municipioSelect" class="form-control" disabled="disabled"></select>
		</div>
	</div>

<br/>

	<div class="row">
		<div class="col" id="municipiosRecarga">

		</div>
	</div>
	
</form>