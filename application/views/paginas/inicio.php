        <br/>
        <br/>
        <br/>

        <div class="row">    
                <div class="col-3">
                        &nbsp;
                </div>
                <div class="col-6">
                        <div id="map" style="width: 600px; height: 400px;"></div>
                </div>
                <div class="col-3">
                        &nbsp;
                </div>
        </div>

<script src="js/leaflet.js"></script>
<script>
    var cities = L.layerGroup();

    <?= $Marcas ?>    
    
    var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
    		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
     		mbUrl = 'http://tile.openstreetmap.org/{z}/{x}/{y}.png';
    
    var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr}),
    	   streets  = L.tileLayer(mbUrl, {id: 'mapbox.streets',   attribution: mbAttr});
    
    var map = L.map('map', {
    	center: [40.0000, 0.000],
    	zoom: 5,
    	layers: [streets, cities]
    });
    
    var baseLayers = {
    	"Grayscale": grayscale,
    	"Streets": streets
    };
    
    var overlays = {
    	"Cities": cities
    };
    
    L.control.layers(baseLayers, overlays).addTo(map);
</script>