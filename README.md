FizzJWT
=======
A simple library to encode and decode JSON Web Tokens (JWT) in PHP, based on firebase/jwt, add the decode() third param default 'HS256'
(JWT 无状态 restful api 认证)  

Installation
------------

Use composer to manage your dependencies and download PHP-JWT:

```bash
composer require fizzday/fizzjwt dev-master
```

Example
-------
```php
<?php
use Fizzday\FizzJWT\FizzJWT;

$key = "example_key";
$payload = array(
    "iss" => "http://fizzday.net",
    "aud" => "http://fizzday.net",
    "iat" => time(),
    "exp" => time() + 60,
    "nbf" => time() + 0,
    "name" => "fizzday",
    "age" => 26,
    "sex" => "MALE"
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$token = FizzJWT::encode($payload, $key);
$decoded = FizzJWT::decode($token, $key);

print_r($decoded);

/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

$decoded_array = (array) $decoded;

/**
 * You can add a leeway to account for when there is a clock skew times between
 * the signing and verifying servers. It is recommended that this leeway should
 * not be bigger than a few minutes.
 *
 * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
 */
// $leeway in seconds, 多延时60秒token才生效,在nbf设定的基础上累加
FizzJWT::$leeway = 60; 
$decoded = FizzJWT::decode($token, $key);
```

> 注册claim名称有下面几个部分：  

```
iss: token的发行者
sub: token的题目
aud: token的客户
exp: 经常使用的，以数字时间定义失效期，也就是当前时间以后的某个时间本token失效。
nbf: 定义在此时间之前，JWT不会接受处理。
iat: JWT发布时间，能用于决定JWT年龄
jti: JWT唯一标识. 能用于防止 JWT重复使用，一次只用一个token
```