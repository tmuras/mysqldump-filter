<?php

namespace MysqldumpProcess;

class Analyzer {

    private $structure;
    private $fileName;

    public function __construct($fileName) {
        $this->fileName = $fileName;
        $handle = fopen($fileName, "rb");

        if($handle === false) {
            die("Couldn't open the file.");
        }

        $currentTable = null;
        $this->structure = array();

        while (($buffer = fgets($handle)) !== false) {
            if($buffer) {
                //echo substr($buffer, 0, 10) . PHP_EOL;
                $currentPosition = ftell($handle);
                if(substr_compare($buffer, "DROP TABLE", 0, 10) == 0) {
                    echo $buffer;
                    preg_match('/(?<=`)\w+(?=`)/', $buffer, $matches);
                    if($currentTable != $matches[0] && $currentTable === null){
                        $this->structure[$matches[0]]['begin'] = $currentPosition;
                    }
                    if($currentTable != $matches[0] && $currentTable !== null) {
                        $this->structure[$matches[0]]['begin'] = $currentPosition;
                        $this->structure[$currentTable]['end'] = $currentPosition - 1;
                    }
                    $currentTable = $matches[0];
                    echo $currentTable . PHP_EOL;
                }
            }
        }
        $this->structure[$currentTable]['end'] = $currentPosition - 1;
        var_dump($this->structure);

    }
    private function keywordCheck($line)
    {
        $tableName = false;
        if (substr_compare($line, "DROP TABLE", 0, 10) == 0) {

        } elseif (substr_compare($line, "CREATE TABLE", 0, 12) == 0) {

        } elseif (substr_compare($line, "LOCK TABLE", 0, 10) == 0) {

        } elseif (substr_compare($line, "INSERT INTO", 0, 10) == 0) {
            
        } elseif (substr_compare($line, "INSERT INTO", 0, 10) == 0) {

        } elseif (substr_compare($line, "INSERT INTO", 0, 10) == 0) {

        } elseif (substr_compare($line, "INSERT INTO", 0, 10) == 0) {

        }
        
        return $tableName;
    }

   public function saveToFile() {
        file_put_contents($this->fileName . ".str", json_encode($this->structure));
   }
}