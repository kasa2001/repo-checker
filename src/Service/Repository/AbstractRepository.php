<?php


namespace App\Service\Repository;


abstract class AbstractRepository
{
    /**
     * @var string main link to repository
     */
    protected $name;

    /**
     * @var string link to selected repository
     */
    protected $link;

    /**
     * @var string
     */
    protected $branch;

    public function __construct(
        string $link,
        string $branch
    )
    {
        $this->link = $link;
        $this->branch = $branch;
    }

    /**
     * Full repository link
     * @return string
     */
    public function getRepositoryLink()
    {
        return $this->name . "/" . $this->link;
    }

    public function getBranchName()
    {
        return $this->branch;
    }

}