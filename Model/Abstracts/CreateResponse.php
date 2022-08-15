<?php
namespace PFS\Model\Abstracts;

abstract class CreateResponse
{
    /**
     * @param array $data
     * @return string
     */
    public function createJSONResponse(array $data): string
    {
        return json_encode($data);
    }

    /**
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function createXMLResponse(array $data): string
    {
        return $this->arrayToXml($data);
    }

    /**
     * @param array $array
     * @param String|null $rootElement
     * @param $xml
     * @return string
     * @throws \Exception
     */
    public function arrayToXml(array $array, String $rootElement = null, $xml = null): string
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

