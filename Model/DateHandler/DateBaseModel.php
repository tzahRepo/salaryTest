<?php

namespace Model\DateHandler;

/**
 * Class to handle required functionality
 * Class DateBaseModel
 * @package Model\DateHandler
 */
abstract class DateBaseModel
{

    private $_dateFormat;
    protected $_currentDate;
    protected $_month;

    /**
     * DateBaseModel constructor.
     * @param $currentDate
     */
    public function __construct($currentDate,$month)
    {
        $this->_dateFormat = 'Y-m-d' ;
        $this->_currentDate = $currentDate;
        $this->_month = $month;
    }


    /**
     * @return string
     */
    public function getDateFormat()
    {
        return $this->_dateFormat;
    }

    /**
     * @param string $dateFormat
     */
    public function setDateFormat($dateFormat)
    {
        $this->_dateFormat = $dateFormat;
    }

    /**
     * get the year from the current date
     * @return string
     */
    public function getYear()
    {
            $date = \DateTime::createFromFormat("Y-m-d", $this->_currentDate);
            return $date->format("Y");
    }

    /**
     * get the day from the current date
     * @return string
     */
    function getDay()
    {
        $datetime = \DateTime::createFromFormat('Y-m-d', $this->_currentDate);
        return $datetime->format('D');
    }

    /**
     * Build array of month name and month number
     * @return array
     * @throws DateHandlerException
     */
    function getMonth()
    {
        $monthNum  = $this->_month;
        $dateObj   = \DateTime::createFromFormat('!m', $monthNum);

        if($dateObj !== null )
        {
            $monthName = $dateObj->format('F');
            $monthNumber =  date('m', strtotime($monthName));
            $parseMonth = array("monthNumber" => $monthNumber,
                "monthName" => $monthName);
        }
        else
        {
            throw new DateHandlerException("Problem with date parsing");
        }

        return $parseMonth;
    }
}