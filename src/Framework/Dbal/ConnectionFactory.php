<?php declare(strict_types=1);

namespace SocialNews\Framework\Dbal;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

final class ConnectionFactory
{
    private $databaseURL;

    public function __construct(DatabaseUrl $databaseUrl)
    {
        $this->databaseURL = $databaseUrl;
    }

    public function create(): Connection
    {
        return DriverManager::getConnection( ['url' => $this->databaseURL->toString()], new Configuration());
    }
}