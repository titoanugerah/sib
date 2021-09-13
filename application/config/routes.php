<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// link == controller/function
$route['default_controller'] = 'dashboard';
$route['profile'] = 'general/profile';


#AUTH
$route['login'] = 'auth/login';
$route['validate'] = 'auth/validate';
$route['logout'] = 'auth/logout';

#DASHBOARD
$route['dashboard'] = 'dashboard';

#PROFILE
$route['profile'] = 'profile';

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

#Goods
$route['goods'] = 'goods/index';
$route['api/goods/read'] = 'goods/read';
$route['api/goods/readDetail'] = 'goods/readDetail';
$route['api/goods/recover'] = 'goods/recover';
$route['api/goods/create'] = 'goods/create';
$route['api/goods/delete'] = 'goods/delete';
$route['api/goods/update'] = 'goods/update';

#Service
$route['service'] = 'service/index';
$route['api/service/read'] = 'service/read';
$route['api/service/readDetail'] = 'service/readDetail';
$route['api/service/recover'] = 'service/recover';
$route['api/service/create'] = 'service/create';
$route['api/service/delete'] = 'service/delete';
$route['api/service/update'] = 'service/update';

#Stock
$route['stock'] = 'stock/index';
$route['stock/report'] = 'stock/report';
$route['api/stock/read/datatables'] = 'stock/datatables';
$route['api/stock/read'] = 'stock/read';
$route['api/stock/readDetail'] = 'stock/readDetail';
$route['api/stock/create'] = 'stock/create';

#Transaction
$route['transaction'] = 'transaction/index';
$route['api/transaction/read'] = 'transaction/read';
$route['api/transaction/readDetail'] = 'transaction/readDetail';
$route['api/transaction/readOrderDetail'] = 'transaction/readOrderDetail';
$route['api/transaction/recover'] = 'transaction/recover';
$route['api/transaction/create/new'] = 'transaction/createNew';
$route['api/transaction/create/old'] = 'transaction/createOld';
$route['api/transaction/delete'] = 'transaction/delete';
$route['api/transaction/update'] = 'transaction/update';

#Others
$route['template'] = 'general/template';
$route['404_override'] = 'general/error';
$route['translate_uri_dashes'] = FALSE;
