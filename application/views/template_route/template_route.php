<!DOCTYPE HTML>
<html lang="en" ng-app="CodeIgniterAngularJS">
	<head>
		<base href="<?= base_url() ?>">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title></title>
		<link href="<?= base_url() ?>assets/bootstrap/css/bootstrap-4.4.1.min.css" rel="stylesheet">
		<link href="<?= base_url() ?>assets/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
		<link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
		<script>var baseUrl = "<?= base_url() ?>";</script>
	</head>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<a class="navbar-brand" href="#">Angular ui-Route Use In CodeIgniter</a>
			</div>
		</nav>
		<div style="margin-bottom: 10%;">&nbsp;</div>

		<!-- ui-view -->
		<ui-view></ui-view>

		<script src="<?= base_url() ?>assets/jquery/jquery-3.4.1.min.js"></script>
		<script src="http://localhost/master/javascript/framework/angularjs/1.8.0/angular.min.js"></script>
		<script src="http://localhost/master/javascript/framework/angularjs/1.8.0/angular-resource.min.js"></script>
		<script src="<?= base_url() ?>assets/angularjs/angular-ui-router/0.2.15/angular-ui-router.min.js"></script>
		<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle-4.4.1.min.js"></script>
		<script src="<?= base_url() ?>assets/js/app_route.js"></script>
	</body>
</html>