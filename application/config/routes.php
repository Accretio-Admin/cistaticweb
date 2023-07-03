if ($_SERVER['HTTP_HOST'] == "www.upsexpress.com.ph" || $_SERVER['HTTP_HOST'] == 'upsexpress.com.ph') {
$route['default_controller'] = 'Ref';
}else{
	// $route['default_controller'] = 'MarketRedirect';
	$route['default_controller'] = 'Ref';
}
$route['Ref/(:any)'] = 'Ref/index/$1';
$route['404_override'] = 'Errors/index';
$route['translate_uri_dashes'] = FALSE;