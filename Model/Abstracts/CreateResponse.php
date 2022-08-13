<?php
namespace PFS\Model\Abstracts;

abstract class CreateResponse
{
    /**
     * @param $data
     * @return string
     */
    public function createJSONResponse($data): string
    {
        return json_encode($data);
    }

    /**
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function createXMLResponse($data): string
    {
        return $this->arrayToXml($data);
    }

    /**
     * @param $array
     * @param $rootElement
     * @param $xml
     * @return string
     * @throws \Exception
     */
    public function arrayToXml($array, $rootElement = null, $xml = null): string
    {
        $_xml = $xml;

        if ($_xml === null) {
            $_xml = new \SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
        }

        foreach ($array as $k => $v)
        {
            if (is_array($v)) {
                $this->arrayToXml($v, $k, $_xml->addChild($k));
            }
            else {
                $_xml->addChild($k, $v);
            }
        }

        return $_xml->asXML();
    }
}

