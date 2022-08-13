<?php
namespace PFS\Controller;

use PFS\Model\PFSModel;
use Exception;

class PFSController
{
    const FileName = "Files/products_";

    /**
     * @param $key
     * @return void
     */
    public function PFSAction($key): void
    {
        $filename = "";
        $model = new PFSModel();

        $authResponse = $model->getAuthResponse($key);

        try {
            if ($authResponse["success"] === true) {
                switch ($authResponse["type"]) {
                    case "XML":
                        $response = $model->getXmlResponse();
                        $this->createFile($key, "xml", $response);
                        $filename = self::FileName.$key.".xml";
                        break;
                    case "JSON":
                        $response = $model->getJSONResponse();
                        $this->createFile($key, "json", $response);
                        $filename = self::FileName.$key.".json";
                        break;
                }
            }
        } catch(Exception $e) {

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
     * @param $key
     * @param $type
     * @param $data
     * @return void
     */
    private function createFile($key, $type, $data): void
    {
        touch(self::FileName.$key.".".$type);
        $file = fopen(self::FileName.$key.".".$type, "w");
        fwrite($file, $data);
        fclose($file);
    }
}
