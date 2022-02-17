<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?= $title; ?></title>

	<!--------------------------------------- Optional CSS --------------------------------------->
	<!-- Dropdown Multilevel CSS -->
	<link href="<?= base_url() ?>assets/bootstrap-dropdown-multilevel/css/bootstrap-dropdown-multilevel.css" rel="stylesheet">

	<!-- Placeholder CSS -->
	<link href="<?= base_url() ?>assets/placeholder-loading/css/placeholder-loading-0.2.5.min.css" rel="stylesheet">

	<!-- Datatable CSS -->
	<link href="<?= base_url() ?>assets/datatables/css/datatables-4.1.1.min.css" rel="stylesheet">

	<!-- Treeview CSS -->
	<link href="<?= base_url() ?>assets/bootstrap-treeview/css/bootstrap-treeview-1.2.0.css" rel="stylesheet">

	<!-- Sidebar Offcanvas CSS -->
	<link href="<?= base_url() ?>assets/jquery-sidebar-offcanvas/css/jquery-sidebar-offcanvas.css" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link href="<?= base_url() ?>assets/bootstrap/css/bootstrap-4.4.1.min.css" rel="stylesheet">

	<!--------------------------------------- Optional JS --------------------------------------->
	<!-- jQuery first, then Bootstrap JS -->
	<script>
		var base_url = "<?= base_url(); ?>";
	</script>
	<script src="<?= base_url() ?>assets/jquery/jquery-3.4.1.min.js"></script>
	<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle-4.4.1.min.js"></script>

	<!-- Datatable JS -->
	<script src="<?= base_url() ?>assets/datatables/js/jquery.dataTables-1.10.18.min.js"></script>
	<script src="<?= base_url() ?>assets/datatables/js/dataTables.bootstrap4.min.js"></script>

	<!-- Treeview JS -->
	<script src="<?= base_url() ?>assets/bootstrap-treeview/js/bootstrap-treeview-1.2.0.js"></script>

	<!-- Dropdown Multilevel JS -->
	<script src="<?= base_url() ?>assets/bootstrap-dropdown-multilevel/js/bootstrap-dropdown-multilevel.js"></script>

	<!-- Treetable Simple JS -->
	<script src="<?= base_url() ?>assets/jquery-treetable-simple/jquery-treetable-simple.js"></script>

	<!-- Sidebar Offcanvas JS -->
	<script src="<?= base_url() ?>assets/jquery-sidebar-offcanvas/js/jquery-sidebar-offcanvas.js"></script>

	<!-- Table to Excel JS -->
	<script src="<?= base_url() ?>assets/jquery-table-to-excel/jquery.table2excel.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top justify-content-sm-start py-0 my-0">
		<a class="navbar-brand order-1 order-lg-0 ml-2 ml-lg-0 mr-auto" href="<?= base_url() ?>">
			<img class="d-inline-block align-top" src="https://assets.local/img/brand/bootstrap-outline.svg" alt="logo" width="30" height="30"> akufendypurnomo
		</a>

		<button class="navbar-toggler align-self-start my-1" type="button">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div id="navbarSupportedContent" class="collapse navbar-collapse bg-dark d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end p-3 p-lg-0 mobileMenu">

			<ul class="navbar-nav align-self-stretch">

				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>">Beranda</a>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
					<div class="dropdown-menu dropdown-menu-lg-right shadow-sm">
						<a class="dropdown-item" href="<?= base_url() ?>placeholder_loading">Placeholder Loading</a>
						<a class="dropdown-item" href="<?= base_url() ?>table_to_excel">Table to Excel</a>
						<a class="dropdown-item" href="<?= base_url() ?>upload">Upload</a>
						<a class="dropdown-item" href="<?= base_url() ?>json">Json</a>
						<a class="dropdown-item" href="<?= base_url() ?>map">Map</a>
						<a class="dropdown-item" href="<?= base_url() ?>hightchart">Hightchart</a>
						<a class="dropdown-item" href="<?= base_url() ?>parent_child">Parentchild</a>
						<a class="dropdown-item" href="<?= base_url() ?>dropdown_scrollable">Dropdown Scrollable</a>
						<a class="dropdown-item" href="<?= base_url() ?>multi_level">Multi Level</a>
						<div class="nav-item dropdown">
							<a class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nested Array</a>
							<div class="dropdown-menu shadow-sm left">
								<a class="dropdown-item" href="<?= base_url() ?>nested_array">Print</a>
								<a class="dropdown-item" href="<?= base_url() ?>nested_array/header_json">Header Json</a>
							</div>
						</div>
						<div class="nav-item dropdown">
							<a class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Datatable</a>
							<div class="dropdown-menu shadow-sm left">
								<a class="dropdown-item" href="<?= base_url() ?>datatable_ignited">Datatable Ignited</a>
								<a class="dropdown-item" href="<?= base_url() ?>datatable_serverside">Datatable Serverside</a>
							</div>
						</div>
						<div class="nav-item dropdown">
							<a class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tree</a>
							<div class="dropdown-menu shadow-sm left">
								<a class="dropdown-item" href="<?= base_url() ?>treemenu">Treemenu</a>
								<a class="dropdown-item" href="<?= base_url() ?>treeview">Treeview</a>
								<a class="dropdown-item" href="<?= base_url() ?>treetable_simple">Treetable Simple</a>
							</div>
						</div>
						<div class="nav-item dropdown">
							<a class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pdf</a>
							<div class="dropdown-menu shadow-sm left">
								<a class="dropdown-item" href="<?= base_url() ?>pdf/html2pdf">Html2Pdf</a>
								<a class="dropdown-item" href="<?= base_url() ?>pdf/mpdf">mPdf</a>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</nav>

	<div class="overlay"></div>

	<main class="container my-4">
		<?= $contents ?>
	</main>

	<script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>