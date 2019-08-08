<?php


namespace App;


use Exception;
use PDO;

class ResultsImporter
{
    private $dbConnection;

    public function __construct(PDO $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function import()
    {
        if (!$file = fopen("http://www.mbnet.com.pl/dl_plus.txt", "r")) {
            throw new Exception("Couldn't load external data", 500);
        }

        $dates = [];
        while (!feof($file)) {
            $line = trim(fgets($file));
            $lineData = explode(" ", $line);
            $dateParts = explode(".", $lineData[1]);
            $date = "$dateParts[2]-$dateParts[1]-$dateParts[0]";
            $results = explode(",", $lineData[2]);
            $dates[] = ["date" => $date, "results" => $results];
        }
        fclose($file);

        $query = "select max(date) from results;";
        $test = $this->dbConnection->prepare($query);
        $test->execute();

        $maxDate = $test->fetchColumn();
        $newResults = array_values(array_filter($dates, function ($item) use ($maxDate) {
            return $item["date"] > $maxDate;
        }));

        $this->dbConnection->beginTransaction();
        $stmt = $this->dbConnection->prepare("INSERT INTO results (date, number) VALUES (?,?)");
        foreach ($newResults as $day) {
            $date = $day["date"];
            forEach ($day["results"] as $number) {
                $stmt->execute([$date, $number]);
            }
        }
        $this->dbConnection->commit();

        return $newResults;
    }
}
