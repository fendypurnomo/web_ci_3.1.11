<style type="text/css">
	#container {
		height:400px;
	}
	.highcharts-figure, .highcharts-data-table table {
		min-width:310px;
		max-width:800px;
		margin:1em auto;
	}
	#sliders td input[type=range] {
		display:inline;
	}
	#sliders td {
		padding-right:1em;
		white-space:nowrap;
	}
</style>

<script src="<?= base_url() ?>assets/highcharts/highcharts.js"></script>
<script src="<?= base_url() ?>assets/highcharts/highcharts-3d.js"></script>
<script src="<?= base_url() ?>assets/highcharts/modules/exporting.js"></script>
<script src="<?= base_url() ?>assets/highcharts/modules/export-data.js"></script>
<script src="<?= base_url() ?>assets/highcharts/modules/accessibility.js"></script>

<h3>Hightchart</h3>
<figure class="highcharts-figure">
	<div id="container"></div>
	<p class="highcharts-description">
		Chart designed to highlight 3D column chart rendering options.
		Move the sliders below to change the basic 3D settings for the chart.
		3D column charts are generally harder to read than 2D charts, but provide an interesting visual effect.
	</p>
	<div id="sliders">
		<table>
			<tr>
				<td><label for="alpha">Alpha Angle</label></td>
				<td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
			</tr>
			<tr>
				<td><label for="beta">Beta Angle</label></td>
				<td><input id="beta" type="range" min="-45" max="45" value="15"/> <span id="beta-value" class="value"></span></td>
			</tr>
			<tr>
				<td><label for="depth">Depth</label></td>
				<td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
			</tr>
		</table>
	</div>
</figure>

<script type="text/javascript">
	//Set up the chart
	var chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			type: 'column',
			options3d: {
				enabled: true,
				alpha: 15,
				beta: 15,
				depth: 50,
				viewDistance: 25
			}
		},
		title: {
			text: 'Chart rotation demo'
		},
		subtitle: {
			text: 'Test options by dragging the sliders below'
		},
		plotOptions: {
			column: {
				depth: 25
			}
		},
		series: [{
			data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
		}]
	});

	function showValues() {
		$('#alpha-value').html(chart.options.chart.options3d.alpha);
		$('#beta-value').html(chart.options.chart.options3d.beta);
		$('#depth-value').html(chart.options.chart.options3d.depth);
	}

	//Activate the sliders
	$('#sliders input').on('input change', function () {
		chart.options.chart.options3d[this.id] = parseFloat(this.value);
		showValues();
		chart.redraw(false);
	});
	showValues();
</script>
