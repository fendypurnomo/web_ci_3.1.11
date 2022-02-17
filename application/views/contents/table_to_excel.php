<h3>Table to Excel</h3>
<div class="table-responsive-sm">
	<table class="table table-striped table-bordered table-hover table-sm w-100 table2excel">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">First</th>
				<th scope="col">Last</th>
				<th scope="col">Handle</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">1</th>
				<td>Mark</td>
				<td>Otto</td>
				<td>@mdo</td>
			</tr>
			<tr>
				<th scope="row">2</th>
				<td>Jacob</td>
				<td>Thornton</td>
				<td>@fat</td>
			</tr>
			<tr>
				<th scope="row">3</th>
				<td>Larry</td>
				<td>the Bird</td>
				<td>@twitter</td>
			</tr>
			<tr>
				<th scope="row">4</th>
				<td>Mark</td>
				<td>Otto</td>
				<td>@mdo</td>
			</tr>
			<tr>
				<th scope="row">5</th>
				<td>Jacob</td>
				<td>Thornton</td>
				<td>@fat</td>
			</tr>
			<tr>
				<th scope="row">6</th>
				<td>Larry</td>
				<td>the Bird</td>
				<td>@twitter</td>
			</tr>
			<tr>
				<th scope="row">7</th>
				<td>Larry</td>
				<td>the Bird</td>
				<td>@twitter</td>
			</tr>
			<tr>
				<th scope="row">8</th>
				<td>Mark</td>
				<td>Otto</td>
				<td>@mdo</td>
			</tr>
			<tr>
				<th scope="row">9</th>
				<td>Jacob</td>
				<td>Thornton</td>
				<td>@fat</td>
			</tr>
			<tr>
				<th scope="row">10</th>
				<td>Larry</td>
				<td>the Bird</td>
				<td>@twitter</td>
			</tr>
		</tbody>
	</table>
	<button type="button" class="btn btn-sm btn-outline-primary exportToExcel">Export to XLS</button>
</div>

<script>
	$(function() {
		$(".exportToExcel").click(function(e) {
			var table = $(this).prev('.table2excel');

			if(table && table.length) {
				var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
				$(table).table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "table-to-excel-" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true,
					preserveColors: preserveColors
				});
			}
		});
	});
</script>
