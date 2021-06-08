<?php

namespace Devcube\Bundle\MyTestBundle\Service;

class DevcubeSimpleTwoService implements DevcubeSimpleTwoServiceInterface
{
    public function doOther(string $value)
    {
        return self::class . ' - ' . $value;
    }
}
