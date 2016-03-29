<?php
/**
 * Created by PhpStorm.
 * User: wakasann
 * Date: 16/03/10
 * Time: 23:58
 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFormGlobals();
$path = $request->getPathInfo(); //Thr URI path being request

echo $path;

//if (in_array($path, array('', '/'))) {
//    $response = new Response('Welcome to the homepage.');
//} elseif ('/contact' === $path) {
//    $response = new Response('Contact us');
//} else {
//    $response = new Response('Page not found.', 404);
//}
//$response->send();