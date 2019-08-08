<?php

require __DIR__ . '/vendor/autoload.php';

$data = explode("/", strtok($_SERVER["REQUEST_URI"], "?"));
$endpoint = $data[1];
$value = $data[2];

