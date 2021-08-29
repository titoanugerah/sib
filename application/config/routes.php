<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// link == controller/function
$route['default_controller'] = 'general/dashboard';
$route['dashboard'] = 'general/dashboard';
$route['profile'] = 'general/profile';
$route['logout'] = 'general/logout';

$route['dashboard'] = 'dashboard';

#ROLE
$route['role'] = 'role';
$route['api/role/read'] = 'role/read';
$route['api/role/readDetail'] = 'role/readDetail';
$route['api/role/recover'] = 'role/recover';
$route['api/role/create'] = 'role/create';
$route['api/role/delete'] = 'role/delete';
$route['api/role/update'] = 'role/update';

#User
$route['user'] = 'user';
$route['api/user/read'] = 'user/read';
$route['api/user/readDetail'] = 'user/readDetail';
$route['api/user/recover'] = 'user/recover';
$route['api/user/create'] = 'user/create';
$route['api/user/delete'] = 'user/delete';
$route['api/user/update'] = 'user/update';

#Supplier
$route['supplier'] = 'supplier/index';
$route['api/supplier/read'] = 'supplier/read';
$route['api/supplier/readDetail'] = 'supplier/readDetail';
$route['api/supplier/recover'] = 'supplier/recover';
$route['api/supplier/create'] = 'supplier/create';
$route['api/supplier/delete'] = 'supplier/delete';
$route['api/supplier/update'] = 'supplier/update';


#Others
$route['template'] = 'general/template';
$route['404_override'] = 'general/error';
$route['translate_uri_dashes'] = FALSE;
