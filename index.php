<?php
include 'Controller\Abstracts\FileOperations.php';
include 'Controller\PFSController.php';
include 'Model\Interfaces\IResponse.php';
include 'Model\XmlResponse.php';
include 'Model\JsonResponse.php';
include 'Model\PFSModel.php';

use PFS\Controller\PFSController;

// $key maybe get from post with route
$key = "qwerty1234";      // For xml file
//$key = "ytrewq4321";        // For json file

$testData = new PFSController();

$testData->PFSAction($key);