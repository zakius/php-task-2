<?php

use App\DbConnection;

use App\DateController;

use App\NumberController;
use App\ResultsImporter;

require __DIR__ . '/vendor/autoload.php';

$data = explode("/", strtok($_SERVER["REQUEST_URI"], "?"));
$endpoint = $data[1];
$value = $data[2];

$routing = [
    "date" => ["class" => DateController::class, "method" => "getResults"],
    "number" => ["class" => NumberController::class, "method" => "getDatesAndCount"],
    "import" => ["class" => ResultsImporter::class, "method" => "import"]
];

try {
    $dbConnection = DbConnection::getConnection();
    if(!isset($routing[$endpoint])){
        throw new Exception("Invalid endpoint", 404);
    }
    $className = $routing[$endpoint]["class"];
    $methodName = $routing[$endpoint]["method"];
    $class = new $className($dbConnection);
    echo json_encode($class->$methodName($value));
} catch (Exception $ex) {
    http_response_code($ex->getCode());
    echo json_encode(["error" => $ex->getMessage()]);
}


