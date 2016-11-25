<?php
/**
 * Created by PhpStorm.
 * User: itzahi
 * Date: 11/24/16
 * Time: 10:09
 */

namespace Model\Formatter;
use Model\DateHandler\DateHandlerException;

require_once("BaseFormatter.php");
require_once("FormatterInterface.php");

class CSVFormatter extends BaseFormatter implements FormatterInterface
{
    const EXT_FILE = '.csv';
    const FOLDER_NAME = 'files';

    /**
     * CSVFormatter constructor.
     * @param $filename
     */
    public function __construct($filename)
    {
        parent::__construct($filename);
    }

    /**
     * format function that declared in te interface - we have to implement it in each class
     * that method create and format the array to csv
     * @param $array
     * @throws FormatterException
     */
    public function format($array)
    {

           $pathToGenerate = self::FOLDER_NAME.'/'.$this->fileName.self::EXT_FILE;  // your path and file name
           $header=null;

           $createFile = fopen($pathToGenerate,"w+");

           if ( !$createFile ) {
               throw new FormatterException('File open failed.');
           }

           foreach ($array as $row) {

               if(!$header) {
                   fputcsv($createFile,array_keys($row));
                   fputcsv($createFile, $row);   // do the first row of data too
                   $header = true;
               }
               else {
                   fputcsv($createFile, $row);
               }
           }

           fclose($createFile);


    }
}