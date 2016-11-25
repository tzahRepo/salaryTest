<?php
/**
 * Created by PhpStorm.
 * User: itzahi
 * Date: 11/24/16
 * Time: 10:07
 */

namespace Model\Formatter;

use Model\DateHandler\DateHandlerException;

require_once("CSVFormatter.php");

class FormatterFactory
{

    /**
     * Factory function to create objects depends the format
     * we can add new classes that handle diffrent format and add them to the switch case
     * for instance : we can add new JSONFormatter to return the data as json
     * @param $format
     * @param $fileName
     * @return CSVFormatter
     * @throws DateHandlerException
     */
    public static function createFormatter($format,$fileName)
    {
        switch($format)
        {
            case "csv" :
                return new CSVFormatter($fileName);
            break;
//            case "json" :
//                return new JSONFormatter();
//                break;
 //            case "xml" :
//                return new XMLFormatter();
//                break;

            default: throw new DateHandlerException("Format Error");
        }
    }
}