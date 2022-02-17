<h3>Datatable Serverside</h3>

<div class="table-responsive-sm">
	<table class="table table-sm table-striped table-bordered table-hover w-100" id="tabel_datatable_serverside">
		<thead>
			<tr>
				<th>No.</th>
				<th>District ID</th>
				<th>District Name</th>
			</tr>
		</thead>
	</table>
</div>

<script>
	$("#tabel_datatable_serverside").DataTable({
		ordering: true,
		processing: true,
		serverSide: true,
		ajax: {
			url: "<?= base_url() ?>datatable_serverside/query_data",
			type: "post"
		}
	});
</script>
