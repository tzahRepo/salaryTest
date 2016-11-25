<?php
/**
 * Created by PhpStorm.
 * User: itzahi
 * Date: 11/24/16
 * Time: 09:53
 */

namespace Model;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Model\Formatter\FormatterFactory;
use Model\DateHandler\LastDayModel;
use Model\DateHandler\BonusModel;
use Model\DateHandler\DateHandlerException;
use Model\Formatter\FormatterException;

require_once("SalaryModel.php");
require_once("MonthlySalary.php");
require_once("Formatter/FormatterFactory.php");
require_once("DateHandler/BonusModel.php");
require_once("DateHandler/LastDayModel.php");
require_once("DateHandler/DateHandlerException.php");


/**
 * Class SalaryModel handle the functionality, build the dates and create the files
 * @package Model
 */
class SalaryModel
{

    private $_date;
    private $_currentDate;
    private $_month;
    private $_endDate;
    const DATE_FORMAT = "Y-m-d";
    const REQUESTED_DATE = 12;
    const FILE_NAME = "salaries_";

    /**
     * SalaryModel constructor.
     */
    public function __construct()
    {
        // Set timezone
        date_default_timezone_set('UTC');
        $this->_currentDate = date('Y-m-d');
        // we adding +1 month for the "next X months"
        $this->_date = date(self::DATE_FORMAT,strtotime("+ 1 months", strtotime($this->_currentDate)));
        $this->_month = date("m", strtotime($this->_date));
        $this->_endDate = date (self::DATE_FORMAT,strtotime("+".self::REQUESTED_DATE -1 ." months", strtotime($this->_date)));
    }

    /**
     * Build the dates array
     */
    public function buildDates()
    {
            try
            {
                $salariesArray = array();

                while (strtotime($this->_date) <= strtotime($this->_endDate))
                {
                    $lastDateOb = new LastDayModel($this->_date,$this->_month);
                    $salaryDate = $lastDateOb->createLastDate();
                    $bonus = new BonusModel($this->_date,$this->_month);
                    $bonusDate = $bonus->createBonusDate();

                    if($salaryDate !== null && $bonusDate !== null)
                    {
                        $salaryObj = new MonthlySalary($this->getMonthName(),$bonusDate,$salaryDate);
                        $salariesArray[] = $salaryObj->objToArray();

                    }
                    else
                    {
                        throw new DateHandlerException("error with date creation");
                    }

                    $this->_date = date (self::DATE_FORMAT, strtotime("+1 month", strtotime($this->_date)));
                    $this->_month++;
                }

                $this->createFile($salariesArray);
                return true;

            }
            catch(DateHandlerException $e)
            {
                echo $e->getMessage().PHP_EOL;
                exit(0);
            }
            catch(FormatterException $e)
            {
               echo $e->getMessage().PHP_EOL;
                exit(0) ;
            }


    }

    /**
     * get the salaries array and output to csv or other format
     * @param $salariesArray
     */
    private function createFile($salariesArray)
    {
        $fileName =self::FILE_NAME.$this->_currentDate;
        $x = FormatterFactory::createFormatter("csv",$fileName);
        $x->format($salariesArray);
    }

    private function getMonthName()
    {
        $monthsArray = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthName = date('F', strtotime($this->_date));

        if($monthName !== null && !in_array($monthName,$monthsArray))
        {
            throw new DateHandlerException("can not find the month name");
        }

        return $monthName;
    }

}