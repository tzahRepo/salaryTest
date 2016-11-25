<?php
/**
 * Created by PhpStorm.
 * User: itzahi
 * Date: 11/25/16
 * Time: 10:28
 */

namespace Model\DateHandler;


/**
 * Class LastDayModel
 * @package Model\DateHandler
 */
class LastDayModel extends DateBaseModel
{
    private $_lastDate;
    // define how days to subtract from weekend
    const SAT_SUBTRACTS_BY = 2;
    const FRI_SUBTRACTS_BY = 1;

    /**
     * BonusModel constructor.
     * @param $date
     * @param $month
     */
    public function __construct($date, $month)
    {
        // get the last date;
        $this->_lastDate = date("Y-m-t", strtotime($date));
        parent::__construct($this->_lastDate, $month);
    }

    /**
     * Create the real lastdate of the month
     * @return bool|null|string
     * @throws DateHandlerException
     */
    public function createLastDate()
    {
        // get the month array for the monthName
        $monthArray = $this->getMonth();
        //get last friday of the month
        $friday = date($this->getDateFormat(), strtotime("last friday of " . $monthArray["monthName"] . " " . $this->getYear()));
        //get last saturday of the month
        $sat = date($this->getDateFormat(), strtotime("last saturday of " . $monthArray["monthName"] . " " . $this->getYear()));
        $newDate = null;

        if($this->_lastDate !== null)
        {
            if ($this->_lastDate === $sat)
            {
                // declare new date subs by 2 days - can be change via const variable
                $newDate = date($this->getDateFormat(), strtotime('-'.self::SAT_SUBTRACTS_BY.' day', strtotime($this->_lastDate))); // get the lastdate => class monthly salary
            }
            elseif($this->_lastDate === $friday)
            {
                // declare new date subs by 1 day1 - can be change via const variable
                $newDate =  date($this->getDateFormat(), strtotime('-'.self::FRI_SUBTRACTS_BY.' day', strtotime($this->_lastDate))); // get the lastdate => class monthly salary
            }
            else
            {
                $newDate = $this->_lastDate;

            }
        }
        else
        {
            throw new DateHandlerException("lastDate Does not exist");
        }

        return $newDate;
    }
}