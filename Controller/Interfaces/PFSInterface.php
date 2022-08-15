<?php
namespace PFS\Controller\Interfaces;

interface PFSInterface
{
    public function createFile(String $key, String $type, String $data);
    public function getResponseWithType(String $type);
}