<style>
	.dataTables_wrapper {
		min-height: 500px;
	}
	.dataTables_processing {
		position: absolute;
		top: 50%;
		left: 50%;
		width: 100%;
		margin-left: -50%;
		margin-top: -25px;
		padding-top: 20px;
		text-align: center;
		font-size: 1.2em;
		color: grey;
	}
</style>

<h3>Datatable Ignited</h3>
<h5>City Country</h5>
<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4">
		<?php echo anchor(site_url('datatable_ignited/create'), 'Create', 'class="btn btn-primary"'); ?>
	</div>
	<div class="col-md-4 text-center">
		<div style="margin-top: 4px"  id="message">
			<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
		</div>
	</div>
	<div class="col-md-4 text-right">
		<?php echo anchor(site_url('datatable_ignited/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	</div>
</div>

<div class="table-responsive-sm">
	<table class="table table-striped table-bordered table-hover table-sm w-100" id="mytable">
		<thead class="thead-dark">
			<tr>
				<th width="80px">No</th>
				<th>Nama Negara</th>
				<th>Nama Kota</th>
				<th>Populasi</th>
				<th>Aksi</th>
			</tr>
		</thead>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var t = $("#mytable").dataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
				.off('.DT')
				.on('keyup.DT', function(e) {
					if (e.keyCode == 13) {
						api.search(this.value).draw();
					}
				});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {"url": "datatable_ignited/json", "type": "post"},
			columns: [
				{
					"data": "city_id",
					"orderable": false
				},
				{"data": "country_name"},
				{"data": "city_name"},
				{"data": "city_population"},
				{
					"data": "action",
					"orderable": false
				}
			],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});
	});
</script>
