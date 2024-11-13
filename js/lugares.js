$(document).ready(function(){
	var admin = location.pathname.indexOf('admin');
	var tam = location.pathname.indexOf('/', 10);
	var path = location.pathname.substring(0, tam);
	var pathPaises = path + '/combos/paises';
	var pathComunidadesLimpio = path + '/combos/comunidades_limpio';
	var pathComunidades = path + '/combos/comunidades';
	var pathProvincias = path + '/combos/provincias';
	var pathMunicipios = path + '/combos/municipios';
	
	if (admin == -1){
		var pathRecargaMunicipios = path + '/municipios/recarga';
	} else {
		var pathRecargaMunicipios = path + '/admin/includes/recargamunicipios.php';
		var pathAdminListadoRutas = path + '/admin/includes/inc_listado_rutas.php';
		var pathAdminResultados =  path + '/admin/resultados.php';
	}

	$.ajax({
		type: "POST",
		url: pathPaises,
		success: function(response)
		{
			$('.selector-pais select').html(response).fadeIn();
			$.post(pathRecargaMunicipios, {  }, function(data){
				$("#municipiosRecarga").html(data);
			});  
		}
	});

	$.ajax({
		type: "POST",
		url: pathComunidades,
		success: function(response)
		{
			$('.selector-comunidad select').html(response).fadeIn();
		}
	});

	$.ajax({
		type: "POST",
		url: pathProvincias,
		success: function(response)
		{
			$('.selector-provincia select').html(response).fadeIn();
		}
	});

	$.ajax({
		type: "POST",
		url: pathMunicipios,
		success: function(response)
		{
			$('.selector-municipio select').html(response).fadeIn();
		}
	});

	$("#paises").on('change', function () {
		$("#paises option:selected").each(function () {
			paiselegido=$(this).val();
			$.post(pathComunidades, { paiselegido: paiselegido }, function(data){
				$("#comunidadSelect").html(data);
				$("#comunidadSelect").prop("disabled", false);
				$("#provinciaSelect").prop("disabled", true);
				$("#municipioSelect").prop("disabled", true);
			});   
			$.post(pathRecargaMunicipios, { paiselegido: paiselegido }, function(data){
				$("#municipiosRecarga").html(data);
			});         
		});
	});
	   
	$("#comunidades").on('change', function () {
		$("#comunidades option:selected").each(function () {
			comunidadelegida=$(this).val();
			$.post(pathProvincias, { comunidadelegida: comunidadelegida }, function(data){
				$("#provinciaSelect").html(data);
				$("#provinciaSelect").prop("disabled", false);
				$("#municipioSelect").prop("disabled", true);
			});   
			$.post(pathRecargaMunicipios, { comunidadelegida: comunidadelegida }, function(data){
				$("#municipiosRecarga").html(data);
			});        
		});
	});

	$("#provincias").on('change', function () {
		$("#provincias option:selected").each(function () {
			provinciaelegida=$(this).val();
			$.post(pathMunicipios, { provinciaelegida: provinciaelegida }, function(data){
				$("#municipioSelect").html(data);
				$("#municipioSelect").prop("disabled", false);
			});   
			$.post(pathRecargaMunicipios, { provinciaelegida: provinciaelegida }, function(data){
				$("#municipiosRecarga").html(data);
			});      
		});
	});

	$("#municipios").on('change', function () {
		$("#municipios option:selected").each(function () {
			municipioelegido=$(this).val();
			$.post(pathRecargaMunicipios, { municipioelegido: municipioelegido }, function(data){
				$("#municipiosRecarga").html(data);
			});      
		});
	});
	
	

});