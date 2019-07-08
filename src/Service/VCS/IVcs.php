<?php


namespace App\Service\VCS;

/**
 * Interface IVcs
 * @package App\Service\VCS
 * Possible vcs examples:
 * 1. svn
 * 2. git
 * 3. mercurial
 */
interface IVcs
{
    /**
     * Method get
     * @return string
     */
    public function getLastCommitHash();
}