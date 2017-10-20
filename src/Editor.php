<?php
/**
 * Created by PhpStorm.
 * User: kflis
 * Date: 19.10.17
 * Time: 19:21
 */

namespace MysqldumpProcess;


class Editor
{
    public function __construct(Analyzer $analyzer, $fileName)
    {
        $this->analyzer = $analyzer;
        $this->fileName = $fileName;
    }

    public function removeTable($tableName) {
        //copy from 0 to structure tablename begin, and copy from tablename end to end file
        //write output to file
    }
}