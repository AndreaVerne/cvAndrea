<?php
require_once('Router.php');
$router = new Router;

//Products
$router->addRoute('productos', 'GET','ProductApiController','getProducts');
$router->addRoute('producto/:ID', 'GET','ProductApiController','getProduct');
$router->addRoute('producto/:ID', 'PUT','ProductApiController','editProduct');

$router->addRoute('categorias', 'GET','ProductApiController','getCategories');

//usuarios -----------solo para el area de admin---------------------
$router->addRoute('usuarios', 'GET','UsuariosApiController','getUsers');
$router->addRoute('usuario/:ID', 'GET','UsuariosApiController','getUser');
$router->addRoute('usuario/:ID', 'DELETE','UsuariosApiController','deleteUsuario');
$router->addRoute('usuario/:ID', 'PUT','UsuariosApiController','editUsuario');

//comentarios
$router->addRoute('comentarios/:ID/:ORDEN', 'GET','ProductApiController','getComentarios');
$router->addRoute('comentarios', 'POST','ProductApiController','addComentario');
$router->addRoute('comentarios/:ID', 'DELETE','ProductApiController','deleteComentario');

$router->addRoute('comentarios/:ID/stars/:CANT', 'GET','ProductApiController','filtrarEstrellas');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
