<?php
include 'Controller\PFSController.php';
include 'Model\Abstracts\CreateResponse.php';
include 'Model\PFSModel.php';

use PFS\Controller\PFSController;

//$key = "qwerty1234";      // For xml file
$key = "ytrewq4321";        // For json file

$testData = new PFSController();

$testData->PFSAction($key);