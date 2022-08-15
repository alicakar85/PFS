<?php
namespace PFS\Controller;

use PFS\Controller\Abstracts\FileOperations;
use PFS\Model\JsonResponse;
use PFS\Model\PFSModel;
use Exception;
use PFS\Model\XmlResponse;

class PFSController extends FileOperations
{
    const FileName = "Files/products_";

    /**
     * @param String $key
     * @return void
     */
    public function PFSAction(String $key): void
    {
        $fileName = "";
        $model = new PFSModel();
        $authResponse = $model->getAuthResponse($key);

        if ($authResponse["success"] === true) {
            $response = $this->getResponseWithType($authResponse["type"]);
            $this->createFile($key, $authResponse["type"], $response, self::FileName);
            $fileName = self::FileName . $key . ".".$authResponse["type"];
        }

        $this->fileDownload($fileName);
    }

    /**
     * @param String $type
     * @return String
     */
    public function getResponseWithType(String $type): String
    {
        $model = new PFSModel();
        $response = "";
        try {
            switch ($type) {
                case "xml":
                    $response = $model->getResponse(new XmlResponse());
                    break;
                case "json":
                    $response = $model->getResponse(new JsonResponse());
                    break;
            }
        } catch(Exception $e) {

        }
        return $response;
    }
}
