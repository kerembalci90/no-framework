<?php declare(strict_types=1);

namespace SocialNews\FrontPage\Application;

interface SubmissionsQuery
{
    /** @return submission[] */
    public function execute(): array;
}