<?php
/**
 * Created by PhpStorm.
 * User: itzahi
 * Date: 11/24/16
 * Time: 10:09
 */

namespace Model\Formatter;

/**
 * abstract Class BaseFormatter that we can keep and modify and add functionality
 * @package Model\Formatter
 */
abstract class BaseFormatter
{
    protected $fileName;

    /**
     * BaseFormatter constructor.
     * @param $fileName
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }


}