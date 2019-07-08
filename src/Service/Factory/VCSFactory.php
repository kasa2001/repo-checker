<?php


namespace App\Service\Factory;


use App\Service\Exception\NotFoundVCSException;
use App\Service\VCS\IVcs;
use ReflectionClass;
use ReflectionException;

class VCSFactory implements IFactory
{
    const PATH = "App\\Service\\VCS\\";

    /**
     * @param string $string
     * @param array $arguments
     * @return IVcs
     * @throws NotFoundVCSException
     */
    public function get(
        string $string,
        array $arguments = []
    )
    {
        $class = self::PATH . ucfirst($string);

        try {
            $reflection = new ReflectionClass($class);
            return $reflection->newInstanceArgs($arguments);
        } catch (ReflectionException $e) {
            throw new NotFoundVCSException("VCS $string is unsupported");
        }

    }

}