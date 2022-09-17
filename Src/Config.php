<?php

declare(strict_types=1);

define("DB_SENHA", "1234");
define("DB_LOGIN", "andre");
define("DB_URL", "mysql:host=127.0.0.1;dbname=pw3");

define("VIEWS_DIR", "Src/View");

define("URL", "http://localhost/pw3/");

function url(string $url = null): string {
    return $url ? URL . "{$url}" : URL;
}
