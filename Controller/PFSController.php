<?php
namespace PFS\Controller;

use PFS\Model\PFSModel;
use PFS\Controller\Interfaces\PFSInterface;
use Exception;

class PFSController implements PFSInterface
{
    const FileName = "Files/products_";

    /**
     * @param String $key
     * @return void
     */
    public function PFSAction(String $key): void
    {
        $filename = "";
        $model = new PFSModel();
        $authResponse = $model->getAuthResponse($key);

        if ($authResponse["success"] === true) {
            $response = $this->getResponseWithType($authResponse["type"]);
            $this->createFile($key, $authResponse["type"], $response);
            $filename = self::FileName . $key . ".".$authResponse["type"];
        }

        if($filename != "" && file_exists($filename)) {
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: utf-8");
            header("Content-disposition: attachment; filename=\"" . basename($filename) . "\"");
            ob_clean();
            flush();
            if (readfile($filename))
            {
                unlink($filename);
            }
        }
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
                    $response = $model->getXmlResponse();
                    break;
                case "json":
                    $response = $model->getJSONResponse();
                    break;
            }
        } catch(Exception $e) {

        }
        return $response;
    }

    /**
     * @param String $key
     * @param String $type
     * @param String $data
     * @return void
     */
    public function createFile(String $key, String $type, String $data): void
    {
        touch(self::FileName.$key.".".$type);
        $file = fopen(self::FileName.$key.".".$type, "w");
        fwrite($file, $data);
        fclose($file);
    }
}
