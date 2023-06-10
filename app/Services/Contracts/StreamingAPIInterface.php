<?php

namespace App\Services\Contracts;

interface StreamingAPIInterface
{
    public function getByISRC(string $isrc);
}
