<h3>Parent Child</h3>

<div class="table-responsive-sm">
	<table class="table table-bordered table-sm w-100 table2excel">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Kode Provinsi</th>
				<th scope="col">Nama Provinsi</th>
				<th scope="col">Kode Kabupaten/Kota</th>
				<th scope="col">Nama Kabupaten/Kota</th>
				<th scope="col">Kode Kecamatan</th>
				<th scope="col">Nama Kecamatan</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$bapak = '';
				$anak = '';
				$tbl = '';
				$no = 1;

				foreach($q as $v):
				if ($bapak != $v->pvid) {
					$bapak = $v->pvid;
					$tbl .= '<tr class="table-secondary"><th scope="row">' . $no . '</th>';
					$tbl .= '<td>' . $v->pvid . '</td>';
					$tbl .= '<td>' . $v->pvnama . '</td>';
					$tbl .= '<td></td>';
					$tbl .= '<td></td>';
					$tbl .= '<td></td>';
					$tbl .= '<td></td></tr>';
					$no++;
				}
				if ($anak != $v->kbid) {
					$anak = $v->kbid;
					$tbl .= '<tr class="bg-light"><th scope="row"></th>';
					$tbl .= '<td></td>';
					$tbl .= '<td></td>';
					$tbl .= '<td>' . $v->kbid . '</td>';
					$tbl .= '<td>' . $v->kbnama . '</td>';
					$tbl .= '<td></td>';
					$tbl .= '<td></td></tr>';
				}
				$tbl .= '<tr><th scope="row"></th>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td>' . $v->kcid . '</td>';
				$tbl .= '<td>' . $v->kcnama . '</td></tr>';
				endforeach;
				echo $tbl;
			?>
		</tbody>
	</table>
	<button class="btn btn-sm btn-outline-primary" id="btnExportToExcel">Export to XLS</button>
</div>

<script>
	$(function() {
		$("#btnExportToExcel").click(function(e) {
			var table = $(this).prev('.table2excel');

			if(table && table.length) {
				var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
				$(table).table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "myFileName" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
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
