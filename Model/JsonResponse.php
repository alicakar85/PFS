<?php
namespace PFS\Model;

use PFS\Controller\Interfaces\IResponse;

class JsonResponse implements IResponse
{
    /**
     * @param array $data
     * @return string
     */
    public function getResponse(array $data): string
    {
        return json_encode($data);
    }
}