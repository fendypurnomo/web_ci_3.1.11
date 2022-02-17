var app = angular.module('CodeIgniterAngularJS', ['ui.router']);

app.config(function($stateProvider, $urlRouterProvider, $locationProvider) {
	$stateProvider
	.state('route', {
		url: '/',
		templateUrl: baseUrl + 'route/login',
		controller: 'LoginCtrl'
	})
	.state('dashboard', {
		url: '/dashboard',
		templateUrl: baseUrl + 'route/dashboard',
		controller: 'DashboardCtrl'
	});

	$urlRouterProvider.otherwise('/')
});

function LoginCtrl() {
}

function DashboardCtrl() {
}