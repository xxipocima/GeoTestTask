<?php


namespace App\Service;


use Symfony\Component\HttpKernel\Exception\HttpException;

class Response
{
    /**
     * Raw response data
     *
     * @var array
     */
    protected $data;

    /**
     * Create api response from http-response
     *
     * @param array $response
     * @return \App\Service\Response
     */
    public static function create(array $response)
    {
        // - validate
        $data = $response;
        if (empty($data)) {
            throw new HttpException('500','Invalid response body');
        }
        // - validate internal data
        if (isset($data['error'])) {
            if ($data['error'] != null) {
                $data['display_name'] = $data['error'];
            }
        }

        $item = new self();
        $item->data = $data;
        return $item;
    }

    /**
     * Get the value of Raw response data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
