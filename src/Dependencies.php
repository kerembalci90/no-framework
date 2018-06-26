<?php declare(strict_types=1);

use Auryn\Injector as Injector;
use SocialNews\Framework\Rendering\TemplateRenderer as TemplateRenderer;
use SocialNews\Framework\Rendering\TwigTemplateRendererFactory as TemplateRendererFactory;
use SocialNews\Framework\Rendering\TemplateDirectory as TemplateDirectory;

$injector = new Injector();

$injector->delegate(
    TemplateRenderer::class,
    function () use ($injector): TemplateRenderer {
        $factory = $injector->make(TemplateRendererFactory::class);
        return $factory->create();
    }
);

$injector->define(TemplateDirectory::class, [':rootDirectory' => ROOT_DIR]);

return $injector;