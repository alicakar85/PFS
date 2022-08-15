<?php
namespace PFS\Model;

use PFS\Model\Abstracts\CreateResponse;

class PFSModel extends CreateResponse
{
    /**
     * @param String $key
     * @return array
     */
    public function getAuthResponse(String $key): array
    {
        // Maybe permission and type control with DB in here

        if ($key == "qwerty1234") {
            return array(
                "success" => true,
                "type" => "xml");
        } elseif ($key == "ytrewq4321") {
            return array(
                "success" => true,
                "type" => "json");
        } else {
            return array(
                "success" => false,
                "type" => "");
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getXmlResponse(): string
    {
       return $this->createXMLResponse($this->getData());
    }

    /**
     * @return string
     */
    public function getJSONResponse(): string
    {
        return $this->createJSONResponse($this->getData());
    }

    /**
     * @return array[]
     */
    private function getData(): array
    {
        // Maybe get this data from DB or File

        return array(
            array(
                "id" => 1,
                "name" => "Product 1",
                "price" => 1,
                "category" => "Electronic"
            ),
            array(
                "id" => 2,
                "name" => "Product 2",
                "price" => 2,
                "category" => "Fashion"
            ),
            array(
                "id" => 3,
                "name" => "Product 3",
                "price" => 3,
                "category" => "Home Decor"
            ),
            array(
                "id" => 4,
                "name" => "Product 4",
                "price" => 4,
                "category" => "Electronic"
            ),
            array(
                "id" => 5,
                "name" => "Product 5",
                "price" => 5,
                "category" => "Fashion"
            )
        );
    }
}

