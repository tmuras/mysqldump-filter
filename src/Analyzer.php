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

        $this->structure = array();
        $currentTable = null;
        $previousLine = null;

        while (($buffer = fgets($handle)) !== false) {
            if($buffer) {
                //echo substr($buffer, 0, 10) . PHP_EOL;
                if(substr_compare($buffer, "DROP TABLE", 0, 10) == 0) {
                    $currentPosition = ftell($handle);
                    echo $buffer;
                    preg_match('/(?<=`)\w+(?=`)/', $buffer, $matches);
                    if($currentTable != $matches[0] && $currentTable === null){
                        $this->structure[$matches[0]]['begin'] = $previousLine;
                    }
                    if($currentTable != $matches[0] && $currentTable !== null) {
                        $this->structure[$matches[0]]['begin'] = $previousLine;
                        $this->structure[$currentTable]['end'] = $currentPosition - 1;
                    }
                    $currentTable = $matches[0];
                    echo $currentTable . PHP_EOL;
                }
                $previousLine = ftell($handle);
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