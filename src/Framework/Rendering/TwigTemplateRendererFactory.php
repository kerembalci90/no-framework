<?php declare(strict_types=1);

namespace SocialNews\Framework\Rendering;

use SocialNews\Framework\Csrf\StoredTokenReader;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig_Loader_Filesystem as TwigLoaderFilesystem;
use Twig_Environment as TwigEnvironment;
use Twig_Function as TwigFunction;

final class TwigTemplateRendererFactory
{
    private $templateDirectory;
    private $storedTokenReader;
    private $session;

    public function __construct(TemplateDirectory $templateDirectory, StoredTokenReader $storedTokenReader, Session $session)
    {
        $this->templateDirectory = $templateDirectory;
        $this->storedTokenReader = $storedTokenReader;
        $this->session = $session;
    }

    public function  create() : TwigTemplateRenderer
    {
        $templateDirectory = $this->templateDirectory->toString();
        $loader = new TwigLoaderFilesystem([$templateDirectory]);
        $twigEnvironment = new TwigEnvironment($loader);

        $twigEnvironment->addFunction(
            new TwigFunction('get_flash_bag', function(): FlashBagInterface {
                return $this->session->getFlashBag();
            })
        );

        $twigEnvironment->addFunction(
            new TwigFunction('get_token', function (string $key): string {
               $token = $this->storedTokenReader->read($key);
               return $token->toString();
            })
        );

        return new TwigTemplateRenderer($twigEnvironment);
    }
}