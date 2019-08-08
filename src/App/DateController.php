<?php

namespace App;

use Exception;
use PDO;

class DateController
{

    private $dbConnection;

    public function __construct(PDO $dbConnection)
    {
        $this->dbConnection = $dbConnection;

    }

    /**
     * @param string $date
     *
     * @return array
     * @throws Exception
     */
    public function getResults(string $date): array
    {
        $query = "SELECT number from results where date = :date order by number";
        $test = $this->dbConnection->prepare($query);
        $test->bindParam(":date", $date);
        $test->execute();

        $results = $test->fetchAll(PDO::FETCH_ASSOC);
        $result = array_map(function ($item) {
            return $item["number"];
        }, $results);
        if (count($results) === 0) {
            throw new Exception("No results found for specified date.", 404);
        }
        return $result;
    }


}
