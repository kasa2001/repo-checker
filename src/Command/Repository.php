<?php


namespace App\Command;


use App\Service\Factory\RepositoryFactory;
use App\Service\Factory\VCSFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Repository extends Command
{

    /**
     * @var VCSFactory
     */
    private $vcsFactory;

    /**
     * @var RepositoryFactory
     */
    private $repositoryFactory;

    /**
     * @var string
     */
    private $repositoryLink;

    /**
     * @var string
     */
    private $branch;

    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $vcs;

    /**
     * @param VCSFactory $vcsFactory
     * @param RepositoryFactory $repositoryFactory
     */
    public function __construct(
        VCSFactory $vcsFactory,
        RepositoryFactory $repositoryFactory
    )
    {
        parent::__construct(null);

        $this->vcsFactory = $vcsFactory;

        $this->repositoryFactory = $repositoryFactory;
    }

    public function configure()
    {
        $this->setName("application:vcs");

        $this->setDescription("Command get last commit sha");

        $this->addOption(
            "service",
            "s",
            InputOption::VALUE_OPTIONAL,
            "Repository (default github)",
            "github"
        );

        $this->addOption(
            "VCS",
            "vc",
            InputOption::VALUE_REQUIRED,
            "VCS",
            "git"
        );

        $this->addArgument(
            "repository-link",
            InputOption::VALUE_REQUIRED,
            "Repository in {owner}/{repo}",
            "kasa2001/hackaton"
        );

        $this->addArgument(
            "branch",
            InputOption::VALUE_REQUIRED,
            "Branch name (default master)",
            "master"
        );

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getData($input);

        $repository = $this->repositoryFactory->get(
            $this->service,
            [
                $this->repositoryLink,
                $this->branch,
            ]
        );

        $vcs = $this->vcsFactory->get(
            $this->vcs,
            [
                $repository,
            ]
        );

        echo $vcs->getLastCommitHash();
    }

    protected function getData(InputInterface $input)
    {
        $this->service = $input->getOption("service");
        $this->branch = $input->getArgument("branch");
        $this->repositoryLink = $input->getArgument("repository-link");
        $this->vcs = $input->getOption("VCS");
    }

}