<?php declare(strict_types=1);

use Auryn\Injector as Injector;
use SocialNews\Framework\Rendering\TemplateRenderer as TemplateRenderer;
use SocialNews\Framework\Rendering\TwigTemplateRendererFactory as TemplateRendererFactory;
use SocialNews\Framework\Rendering\TemplateDirectory as TemplateDirectory;
use SocialNews\FrontPage\Application\SubmissionsQuery as SubmissionsQuery;
use SocialNews\FrontPage\Infrastructure\MockSubmissionsQuery as MockSubmissionsQuery;
use SocialNews\Framework\Dbal\DatabaseUrl as DatabaseUrl;
use Doctrine\DBAL\Connection;
use SocialNews\Framework\Dbal\ConnectionFactory;
use SocialNews\FrontPage\Infrastructure\DbalSubmissionsQuery;
use SocialNews\Framework\Csrf\TokenStorage;
use SocialNews\Framework\Csrf\SymfonySessionTokenStorage;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use SocialNews\Submission\Domain\SubmissionRepository;
use SocialNews\Submission\Infrastructure\DbalSubmissionRepository;

$injector = new Injector();

$injector->delegate(
    TemplateRenderer::class,
    function () use ($injector): TemplateRenderer {
        $factory = $injector->make(TemplateRendererFactory::class);
        return $factory->create();
    }
);

$injector->define(TemplateDirectory::class, [':rootDirectory' => ROOT_DIR]);

$injector->alias(SubmissionsQuery::class, DbalSubmissionsQuery::class);
$injector->share(SubmissionsQuery::class);

$injector->define(
    DatabaseUrl::class,
    [':url' => 'sqlite:///' . ROOT_DIR . '/storage/db.sqlite3']
);

$injector->delegate(
    Connection::class,
    function () use ($injector): Connection {
        $factory = $injector->make(ConnectionFactory::class);
        return $factory->create();
    }
);

$injector->share(Connection::class);


$injector->alias(TokenStorage::class, SymfonySessionTokenStorage::class);
$injector->alias(SessionInterface::class, Session::class);

$injector->alias(SubmissionRepository::class, DbalSubmissionRepository::class);

return $injector;