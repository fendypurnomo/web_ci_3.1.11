<h3>Json</h3>
<div class="table-responsive-sm">
	<table class="table table-bordered table-striped table-hover table-sm w-100">
		<thead>
			<tr>
				<th>#</th>
				<th>Village ID</th>
				<th>Village Name</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$table = "";
			$no = 1;
			foreach ($result as $value) {
				$table .= "<tr><td>" . number_format($no, 0, '', '.') . "</td><td>" . $value['villages_id'] . "</td><td>" . $value['villages_name'] . "</td></tr>";
				$no++;
			}
			echo $table;
			?>
		</tbody>
	</table>
</div>