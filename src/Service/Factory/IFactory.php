<?php


namespace App\Service\Factory;


interface IFactory
{

    /**
     * @param string $string
     * @param array $arguments
     * @return mixed
     */
    public function get(
        string $string,
        array $arguments = []
    );
}