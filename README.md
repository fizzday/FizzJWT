FizzJWT
=======
A simple library to encode and decode JSON Web Tokens (JWT) in PHP, conforming to 

Installation
------------

Use composer to manage your dependencies and download PHP-JWT:

```bash
composer require fizzday/fizzjwt
```

Example
-------
```php
<?php
use Fizzday\FizzJWT\FizzJWT;

$key = "example_key";
$token = array(
    "iss" => "http://fizzday.net",
    "aud" => "http://fizzday.net",
    "iat" => time(),
    "nbf" => time() + 60,
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
$jwt = JWT::encode($token, $key);
$decoded = JWT::decode($jwt, $key);

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
JWT::$leeway = 60; // $leeway in seconds
$decoded = JWT::decode($jwt, $key);
```