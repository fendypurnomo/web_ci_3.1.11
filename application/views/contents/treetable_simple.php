<h3>Treetable</h3>
<h5>Basic Table</h5>

<button type="button" class="btn btn-sm btn-primary" id="expander">Expand All</button>
<button type="button" class="btn btn-sm btn-success" id="collapser">Collapse All</button>
<button type="button" class="btn btn-sm btn-danger" id="open1">Open 1</button>
<button type="button" class="btn btn-sm btn-dark" id="close1">Close 1</button>

<br>
<br>

<div class="table-responsive-sm">
	<table class="table table-bordered table-hover table-sm w-100" id="basic">
		<thead class="thead-light">
			<tr>
				<th>#</td>
				<th>Name</td>
			</tr>
		</thead>
		<tbody>
			<tr data-node-id="1">
				<td>1</td>
				<td>text of 1</td>
			</tr>
			<tr data-node-id="1.1" data-node-pid="1">
				<td>1.1</td>
				<td>text of 1.1</td>
			</tr>
			<tr data-node-id="1.1.1" data-node-pid="1.1">
				<td>1.1.1</td>
				<td>text of 1.1.1</td>
			</tr>
			<tr data-node-id="1.1.2" data-node-pid="1.1">
				<td>1.1.2</td>
				<td>text of 1.1.2</td>
			</tr>
			<tr data-node-id="1.2" data-node-pid="1">
				<td>1.2</td>
				<td>text of 1.2</td>
			</tr>
			<tr data-node-id="1.2.1" data-node-pid="1.2">
				<td>1.2.1</td>
				<td>text of 1.2.1</td>
			</tr>
			<tr data-node-id="1.2.2" data-node-pid="1.2">
				<td>1.2.2</td>
				<td>text of 1.2.2</td>
			</tr>
			<tr data-node-id="2">
				<td>2</td>
				<td>text of 2</td>
			</tr>
			<tr data-node-id="2.1" data-node-pid="2">
				<td>2.1</td>
				<td>text of 2.1</td>
			</tr>
			<tr data-node-id="2.2" data-node-pid="2">
				<td>2.2</td>
				<td>text of 2.2</td>
			</tr>
		</tbody>
	</table>
</div>

<script>
	$('#basic').simpleTreeTable({
		expander: $('#expander'),
		collapser: $('#collapser'),
		store: 'session',
		storeKey: 'treetable-simple-basic',
		opened: []
	});

	$('#open1').on('click', function() {
		$('#basic').data('treetable-simple').openByID("1");
	});

	$('#close1').on('click', function() {
		$('#basic').data('treetable-simple').closeByID("1");
	});
</script>
