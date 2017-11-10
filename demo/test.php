<?php
require __DIR__.'/../src/FizzJWT.php';

use Fizzday\FizzJWT\FizzJWT;

$key = 'key';

$payload = array(
    'iat'=>time(),
    'exp'=>time()+5,    // 有效期
    'name'=>'fizz',
    'age'=>18
);

$token = FizzJWT::encode($payload, $key);
//echo $encode;

//$payload = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE0ODY0MzU4MzUsIm5hbWUiOiJmaXp6IiwiYWdlIjoxODJ9.YKZif-Z0lDix9vlz7vzY-d54m_2aWtjgJdgI4s8C4Mw';
FizzJWT::$leeway = 30;
//try {
//    $decode = JWT::decode($encode.'a', $key, array('HS256'));
//    print_r($decode);
//} catch (Exception $e) {
//    echo $e->getMessage();
//}
$decode = FizzJWT::decode($token, $key);

print_r($decode); // $payload
