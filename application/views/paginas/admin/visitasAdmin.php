<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <form class="col">
            
            <div class="row">
                <div class="col-6 selector-pais" id="paises">
                    <label>Paises</label>
                    <select class="form-control"></select>
                </div>
                <div class="col-6 selector-comunidad" id="comunidades">
                    <label>Comunidades</label>
                    <select name="comunidadSelect" id="comunidadSelect" class="form-control" disabled="disabled" ></select>
                </div>
            </div>
            <div class="row">
                <div class="col-6 selector-provincia" id="provincias">
                    <label>Provincias</label>
                    <select name="provinciaSelect" id="provinciaSelect" class="form-control" disabled="disabled"></select>
                </div>
                <div class="col-6 selector-municipio" id="municipios">
                    <label>Municipios</label>
                    <select name="municipioSelect" id="municipioSelect" class="form-control" disabled="disabled"></select>
                </div>
            </div>
        
        <br/>
        
            <div class="row">
                <div class="col" id="municipiosRecarga">
        
                </div>
            </div>
            
        </form>
    </div>
</div>
