<?php

namespace Model\DateHandler;
require_once("DateBaseModel.php");

/**
 * Provide a bonus date by uisng the createBonusDate method
 * Class BonusModel
 * @package Model\DateHandler
 */
class BonusModel extends DateBaseModel
{
    private $_bonusDate;
    const BONUS_DAY_DATE = "15";
    const DATE_FORMAT  = 'Y-m-d';

    /**
     * BonusModel constructor.
     * @param $_currentDate
     * @param $month
     */
    public function __construct($_currentDate, $month)
    {
        // we adding +1 month for the "next X months"
        $_currentDate = date(self::DATE_FORMAT,strtotime("+ 1 months", strtotime($_currentDate)));
        parent::__construct($_currentDate, $month + 1);
        $monthArray = $this->getMonth();
        $monthNumber = $monthArray["monthNumber"];
        //define the bonus date
        $this->_bonusDate = date($this->getYear() . '-' . $monthNumber . '-' . self::BONUS_DAY_DATE);
        $this->_currentDate = $this->_bonusDate;
    }


    /**
     * return the bonus date
     * @throws DateHandlerException
     */
    public function createBonusDate()
    {
        $bonusDayName = $this->getDay();
        $bonusDate = null;
        if($this->_bonusDate !== null)
        {
            if ($bonusDayName === "Sat" && $bonusDayName !== null) {
                $bonusDate = date($this->getDateFormat(), strtotime('+4 day', strtotime($this->_bonusDate)));
            } elseif ($bonusDayName === "Fri" && $bonusDayName !== null) {
                $bonusDate= date($this->getDateFormat(), strtotime('+5 day', strtotime($this->_bonusDate)));
            } else {
                $bonusDate = $this->_bonusDate;
            }
        }
        else
        {
            throw new DateHandlerException("error with the bonus date");
        }


        return $bonusDate;

    }
}