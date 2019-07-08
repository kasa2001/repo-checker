<?php


namespace App\Service\VCS;

use App\Service\Repository\AbstractRepository;

class Git implements IVcs
{
    /**
     * @var AbstractRepository
     */
    private $repository;

    /**
     * @var string
     */
    private $process;

    /**
     * @param AbstractRepository $repository
     */
    public function __construct(AbstractRepository $repository)
    {
        $this->repository = $repository;
        $this->process = "git ls-remote " . $repository->getRepositoryLink() . ".git " . $repository->getBranchName();
    }

    public function getLastCommitHash()
    {
        $value = exec($this->process);

        return preg_split("/\t/", $value)[0];
    }

}