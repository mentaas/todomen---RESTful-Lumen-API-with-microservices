<?php


namespace App\Utils;


class FormatApiResponse
{
    public $data;
    public $code;

    public function __construct($data, $code = 200)
    {
        $this->data = $data;
        $this->code = $code;
    }
}
