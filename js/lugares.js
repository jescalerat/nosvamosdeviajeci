$(document).ready(function(){
	var admin = location.pathname.indexOf('admin');
	var tam = location.pathname.indexOf('/', 10);
	var path = location.pathname.substring(0, tam);
	var pathPaises = path + '/conf/paises.php';
	var pathComunidades = path + '/conf/comunidades.php';
	var pathProvincias = path + '/conf/provincias.php';
	var pathMunicipios = path + '/conf/municipios.php';
	
	if (admin == -1){
		var pathRecargaMunicipios = path + '/includes/recargamunicipios.php';
	} else {
		var pathRecargaMunicipios = path + '/admin/includes/recargamunicipios.php';
		var pathAdminListadoRutas = path + '/admin/includes/inc_listado_rutas.php';
		var pathAdminResultados =  path + '/admin/resultados.php';
	}
		
	$("#paisSelect").jCombo({ url: pathPaises, selected_value : '15' } );
	$("#comunidadSelect").jCombo({ url: pathComunidades+"?id=",
	parent: "#paisSelect",
	selected_value: '178'
	});
	$("#provinciaSelect").jCombo({ url: pathProvincias+"?id=",
	parent: "#comunidadSelect",
	selected_value: '630'
	});  
	$("#municipioSelect").jCombo({ url: pathMunicipios+"?id=",
	parent: "#provinciaSelect",
	selected_value: '630'
	});  
   
	$("#paisSelect").change(function () {
		$("#paisSelect option:selected").each(function () {
			idPaisPass = $(this).val();
			$("#idPaisH").val(idPaisPass);
		});            
	});

	$("#comunidadSelect").change(function () {
		$("#comunidadSelect option:selected").each(function () {
			idComunidadPass = $(this).val();
			$("#idComunidadH").val(idComunidadPass);
			idPaisPass = $("#idPaisH").val();
			$("#recargaMunicipios").load(pathRecargaMunicipios,{
				'idPais':idPaisPass,
				'idComunidad':idComunidadPass
			});
		});            
	});

	$("#provinciaSelect").change(function () {
		$("#provinciaSelect option:selected").each(function () {
			idProvinciaPass = $(this).val();
			$("#idProvinciaH").val(idProvinciaPass);
			idPaisPass = $("#idPaisH").val();
			idComunidadPass = $("#idComunidadH").val();
			$("#recargaMunicipios").load(pathRecargaMunicipios,{
				'idPais':idPaisPass,
				'idComunidad':idComunidadPass,
				'idProvincia':idProvinciaPass
			});
		});            
	});

	$("#municipioSelect").change(function () {
		$("#municipioSelect option:selected").each(function () {
			idMunicipioPass = $(this).val();
			$("#idMunicipioH").val(idMunicipioPass);
			idPaisPass = $("#idPaisH").val();
			idComunidadPass = $("#idComunidadH").val();
			idProvinciaPass = $("#idProvinciaH").val();
			$("#recargaMunicipios").load(pathRecargaMunicipios,{
				'idPais':idPaisPass,
				'idComunidad':idComunidadPass,
				'idProvincia':idProvinciaPass,
				'idMunicipio':idMunicipioPass
			});
		});            
	});

});