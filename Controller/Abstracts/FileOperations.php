<?php
namespace PFS\Controller\Abstracts;

abstract class FileOperations
{
    /**
     * @param String $key
     * @param String $type
     * @param String $data
     * @param string $fileName
     * @return void
     */
    public function createFile(String $key, String $type, String $data, string $fileName): void
    {
        touch($fileName.$key.".".$type);
        $file = fopen($fileName.$key.".".$type, "w");
        fwrite($file, $data);
        fclose($file);
    }

    /**
     * @param String $fileName
     * @return void
     */
    public function fileDownload(String $fileName): void
    {
        if($fileName != "" && file_exists($fileName)) {
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: utf-8");
            header("Content-disposition: attachment; filename=\"" . basename($fileName) . "\"");
            ob_clean();
            flush();
            if (readfile($fileName))
            {
                unlink($fileName);
            }
        }
    }
}