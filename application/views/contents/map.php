<script src="<?= base_url() ?>assets/mapbox-gl/js/mapbox-gl.js"></script>
<link href="<?= base_url() ?>assets/mapbox-gl/css/mapbox-gl.css" rel="stylesheet"/>

<style>
	body {margin:0; padding:0;}

	#map {top:0; bottom:0; height:500px; width:100%;}
	.coordinates {
		background:rgba(0, 0, 0, 0.5);
		color:#fff;
		position:absolute;
		bottom:40px;
		left:10px;
		padding:5px 10px;
		margin:0;
		font-size:11px;
		line-height:18px;
		border-radius:3px;
		display:none;
	}

	.mapboxgl-popup {
		max-width:400px;
		font:12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
	}

	.legend {
		background-color:#fff;
		border-radius:3px;
		bottom:40px;
		box-shadow:0 1px 2px rgba(0, 0, 0, 0.1);
		font:12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
		padding:10px;
		position:absolute;
		right:25px;
		z-index:1;
	}

	.legend h4 {
		margin:0 0 10px;
	}

	.legend div span {
		border-radius:50%;
		display:inline-block;
		height:10px;
		margin-right:5px;
		width:10px;
	}
</style>

<div class="row">
	<div class="col">
		<h1>Peta</h1>
		<div id="map"></div>

		<div id="state-legend" class="legend">
			<h4>Population</h4>
			<div><span style="background-color: #723122"></span>25,000,000</div>
			<div><span style="background-color: #8B4225"></span>10,000,000</div>
			<div><span style="background-color: #A25626"></span>7,500,000</div>
			<div><span style="background-color: #B86B25"></span>5,000,000</div>
			<div><span style="background-color: #CA8323"></span>2,500,000</div>
			<div><span style="background-color: #DA9C20"></span>1,000,000</div>
			<div><span style="background-color: #E6B71E"></span>750,000</div>
			<div><span style="background-color: #EED322"></span>500,000</div>
			<div><span style="background-color: #F2F12D"></span>0</div>
		</div>
	</div>
</div>

<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoibWFzZmVuZHlwdXJub21vIiwiYSI6ImNrOHB4azZoNTAzNjAzb21mNWtud2N4YmgifQ.ZrlFJPIWAwNM4zvzy-tWhA';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/light-v10',
		center: [106.131,-6.395],
		zoom: 8.2,
		attributionControl: false
	})
	.addControl(new mapboxgl.AttributionControl({
		compact: true
	}));

	/* Add Control Zoom */
	map.addControl(new mapboxgl.NavigationControl());

	/* Disable Scroll Zoom */
	map.scrollZoom.disable();

	/* GeoJSONSource */
	var geojson = {
		'type': 'FeatureCollection',
		'features': [
			{
				'type': 'Feature',
				'properties': {
					'message': 'Kabupaten Pandeglang',
					'name': '<strong>Kabupaten Pandeglang</strong>'
				},
				'geometry': {
					'type': 'Point',
					'coordinates': [105.6445,-6.6227]
				}
			},
			{
				'type': 'Feature',
				'properties': {
					'message': 'Kabupaten Lebak',
					'name': '<strong>Kabupaten Lebak</strong>'
				},
				'geometry': {
					'type': 'Point',
					'coordinates': [106.1946,-6.6435]
				}
			},
			{
				'type': 'Feature',
				'properties': {
					'message': 'Kabupaten Serang',
					'name': '<strong>Kabupaten Serang</strong>'
				},
				'geometry': {
					'type': 'Point',
					'coordinates': [106.1189,-6.0716]
				}
			},
			{
				'type': 'Feature',
				'properties': {
					'message': 'Kabupaten Tangerang',
					'name': '<strong>Kabupaten Tangerang</strong>'
				},
				'geometry': {
					'type': 'Point',
					'coordinates': [106.46438,-6.18596]
				}
			},
			{
				'type': 'Feature',
				'properties': {
					'message': 'Kota Tangerang',
					'name': '<strong>Kota Tangerang</strong>'
				},
				'geometry': {
					'type': 'Point',
					'coordinates': [106.65,-6.1767]
				}
			},
			{
				'type': 'Feature',
				'properties': {
					'message': 'Kota Cilegon',
					'name': '<strong>Kota Cilegon</strong>'
				},
				'geometry': {
					'type': 'Point',
					'coordinates': [106.0048,-5.9784]
				}
			},
			{
				'type': 'Feature',
				'properties': {
					'message': 'Kota Serang',
					'name': '<strong>Kota Serang</strong>'
				},
				'geometry': {
					'type': 'Point',
					'coordinates': [106.1606,-6.1003]
				}
			},
			{
				'type': 'Feature',
				'properties': {
					'message': 'Kota Tangerang Selatan',
					'name': '<strong>Kota Tangerang Selatan</strong>'
				},
				'geometry': {
					'type': 'Point',
					'coordinates': [106.7083,-6.2956]
				}
			}
		]
	};

	geojson.features.forEach(function(marker) {
		// Add popup
		var popup = new mapboxgl.Popup({closeOnClick: false})
				.setHTML(marker.properties.name);

		// Add marker to map
		new mapboxgl.Marker()
				.setLngLat(marker.geometry.coordinates)
				//.setPopup(popup)
				.addTo(map);
	});

	new mapboxgl.Popup({closeOnClick: true})
			.setLngLat([106.0028,-6.5437])
			.setHTML('<h5>Peta Sebaran KPM</h5><p>Peta sebaran KPM Jamsosratu berdasarkan jumlah kpm per wilayah Kabupaten/Kota</p>')
			.addTo(map);

	map.on('load', function() {
		map.addSource('residence', {
			'type': 'geojson',
			'data': base_url + 'geojson'
		});

		// Add layer polygon
		map.addLayer({
			'id': 'residence-places',
			'type': 'fill',
			'source': 'residence',
			'layout': {},
			'paint': {
				'fill-color': ['get', 'color'],
				'fill-outline-color': 'rgba(0, 0, 102, 1)',
				'fill-opacity': 0.5
			}
		});

		map.on('click', 'residence-places', function(e) {
			new mapboxgl.Popup()
					.setLngLat(e.lngLat)
					.setHTML(e.features[0].properties.name)
					.addTo(map);
		});
	});
</script>
