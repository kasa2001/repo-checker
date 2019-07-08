<?php


namespace App\Service\Factory;


use App\Service\Exception\NotFoundRepositoryException;
use App\Service\Repository\AbstractRepository;
use ReflectionClass;
use ReflectionException;

class RepositoryFactory implements IFactory
{


    const PATH = "App\\Service\\Repository\\";

    /**
     * @param string $string
     * @param array $arguments
     * @return AbstractRepository
     * @throws NotFoundRepositoryException
     */
    public function get(
        string $string,
        array $arguments = []
    )
    {
        $class = self::PATH . ucfirst($string) . "Repository";

        try {
            $reflection = new ReflectionClass($class);
            return $reflection->newInstanceArgs($arguments);
        } catch (ReflectionException $e) {
            throw new NotFoundRepositoryException("service $string is unsupported");
        }
    }

}