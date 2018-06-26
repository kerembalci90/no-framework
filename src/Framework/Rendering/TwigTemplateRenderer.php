<?php declare(strict_types=1);

namespace SocialNews\Framework\Rendering;

use Twig_Environment;

final class TwigTemplateRenderer implements TemplateRenderer
{
    private $twigEnvironment;

    public function __construct(Twig_Environment $twig_environment)
    {
        $this->twigEnvironment = $twig_environment;
    }

    public function render(string $template, array $data = []): string
    {
        return $this->twigEnvironment->render($template, $data);
    }
}