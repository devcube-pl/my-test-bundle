<?php

namespace Devcube\Bundle\MyTestBundle\Service;

class DevcubeSimpleOneService implements DevcubeSimpleOneServiceInterface
{
    public function doSomething(string $value)
    {
        return self::class . ' - ' . $value;
    }
}
