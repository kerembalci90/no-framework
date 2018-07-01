<?php declare(strict_types=1);

namespace SocialNews\Submission\Presentation;

use SocialNews\Framework\Csrf\StoredTokenValidator;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;
use SocialNews\Framework\Rendering\TemplateRenderer as TemplateRenderer;

final class SubmissionController {

    private $templateRenderer;
    private $storedTokenValidator;

    public function __construct(TemplateRenderer $templateRenderer, StoredTokenValidator $storedTokenValidator)
    {
        $this->templateRenderer = $templateRenderer;
        $this->storedTokenValidator = $storedTokenValidator;
    }

    public function show(Request $request): Response
    {
        $content = $this->templateRenderer->render('Submission.html.twig');
        return new Response($content);
    }

    public function submit(Request $request): Response
    {
        $content = $request->get('title') . ' - ' . $request->get('url');
        return new Response($content);
    }
}