<?php declare(strict_types=1);

namespace SocialNews\FrontPage\Presentation;

use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;
use SocialNews\Framework\Rendering\TemplateRenderer as TemplateRenderer;

final class FrontPageController {

    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function show(Request $request): Response
    {
        $content = $this->templateRenderer->render('FrontPage.html.twig');
        return new Response($content);
    }
}