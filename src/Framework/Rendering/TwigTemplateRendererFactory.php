<?php declare(strict_types=1);

namespace SocialNews\Framework\Rendering;

use Twig_Loader_Filesystem as TwigLoaderFilesystem;
use Twig_Environment as TwigEnvironment;

final class TwigTemplateRendererFactory
{
    private $templateDirectory;

    public function __construct(TemplateDirectory $templateDirectory)
    {
        $this->templateDirectory = $templateDirectory;
    }

    public function  create() : TwigTemplateRenderer
    {
        $templateDirectory = $this->templateDirectory->toString();
        $loader = new TwigLoaderFilesystem([$templateDirectory]);
        $twigEnvironment = new TwigEnvironment($loader);
        return new TwigTemplateRenderer($twigEnvironment);
    }
}