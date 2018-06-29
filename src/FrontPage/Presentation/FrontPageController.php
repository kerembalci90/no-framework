<?php declare(strict_types=1);

namespace SocialNews\FrontPage\Presentation;

use SocialNews\FrontPage\Application\SubmissionsQuery;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;
use SocialNews\Framework\Rendering\TemplateRenderer as TemplateRenderer;

final class FrontPageController {

    private $templateRenderer;
    private $submissionQuery;

    public function __construct(TemplateRenderer $templateRenderer, SubmissionsQuery $submissionsQuery)
    {
        $this->templateRenderer = $templateRenderer;
        $this->submissionQuery = $submissionsQuery;
    }

    public function show(Request $request): Response
    {
        $content = $this->templateRenderer->render('FrontPage.html.twig',
            ['submissions' => $this->submissionQuery->execute()]);
        return new Response($content);
    }
}