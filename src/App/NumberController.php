<?php

namespace App;


use Exception;
use PDO;

class NumberController
{
    private $dbConnection;


    public function __construct(PDO $dbConnection)
    {
        $this->dbConnection = $dbConnection;

    }

    /**
     * @param int $number
     *
     * @return array
     * @throws Exception
     */
    public function getDatesAndCount(int $number): array
    {
        if ($number < 1 || $number > 49) {
            throw new Exception("Number has to be in range from 1 to 49", 404);
        }

        $datesQuery = "SELECT date from results where number = :number order by date";
        $test = $this->dbConnection->prepare($datesQuery);
        $test->bindParam(":number", $number);
        $test->execute();

        $results = $test->fetchAll(PDO::FETCH_ASSOC);
        $count = count($results);
        $dates = array_map(function ($item) {
            return $item["date"];
        }, $results);
        return ["dates" => $dates, "count" => $count];
    }
}
