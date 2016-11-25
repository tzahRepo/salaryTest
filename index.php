<?php

require_once("Model/SalaryModel.php");

$model = new \Model\SalaryModel();
$result = $model->buildDates();

if($result)
{
    echo "file has been created successfully" .PHP_EOL;
}
else
{
    echo "Error with file creation" .PHP_EOL;
}