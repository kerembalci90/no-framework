<?php declare(strict_types=1);

namespace SocialNews\Submission\Presentation;

use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;
use SocialNews\Framework\Rendering\TemplateRenderer as TemplateRenderer;

final class SubmissionController {

    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function show(Request $request): Response
    {
        $content = 'Submission controller';
        return new Response($content);
    }
}