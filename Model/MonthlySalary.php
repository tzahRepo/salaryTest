<?php
/**
 * Created by PhpStorm.
 * User: itzahi
 * Date: 11/24/16
 * Time: 09:52
 */

namespace Model;

/**
 * Class MonthlySalary - represent a salary row
 * @package Model
 */
class MonthlySalary
{
    private $_monthName;

    private $_bonusDate;

    private $_salary_Date;

    /**
     * MonthlySalary constructor.
     * @param $_monthName
     * @param $_bonusDate
     * @param $_salary_Date
     */
    public function __construct($_monthName, $_bonusDate, $_salary_Date)
    {
        $this->_monthName = $_monthName;
        $this->_bonusDate = $_bonusDate;
        $this->_salary_Date = $_salary_Date;
    }

    /**
     * @return mixed
     */
    public function getMonthName()
    {
        return $this->_monthName;
    }

    /**
     * @param mixed $monthName
     */
    public function setMonthName($monthName)
    {
        $this->_monthName = $monthName;
    }

    /**
     * @return mixed
     */
    public function getSalaryDate()
    {
        return $this->_salary_Date;
    }

    /**
     * @param mixed $salary_Date
     */
    public function setSalaryDate($salary_Date)
    {
        $this->_salary_Date = $salary_Date;
    }

    /**
     * @return mixed
     */
    public function getBonousDate()
    {
        return $this->_bonusDate;
    }

    /**
     * @param mixed $bonusDate
     */
    public function setBonousDate($bonusDate)
    {
        $this->_bonusDate = $bonusDate;
    }

    public function objToArray()
    {
        $array = array(
            "Month Name"=>$this->_monthName,
            "Salary Payment Date"=>$this->_salary_Date,
            "Bonus Payment Date."=>$this->_bonusDate
        );

        return $array;

    }



}