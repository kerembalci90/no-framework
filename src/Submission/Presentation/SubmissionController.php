<?php declare(strict_types=1);

namespace SocialNews\Submission\Presentation;

use SocialNews\Framework\Csrf\StoredTokenValidator;
use SocialNews\Submission\Application\SubmitLink;
use SocialNews\Submission\Application\SubmitLinkHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;
use SocialNews\Framework\Rendering\TemplateRenderer as TemplateRenderer;
use Symfony\Component\HttpFoundation\Session\Session;
use SocialNews\Framework\Csrf\Token;

final class SubmissionController {

    private $templateRenderer;
    private $session;
    private $submitLinkHandler;
    private $submissionFormFactory;

    public function __construct(TemplateRenderer $templateRenderer, Session $session, SubmitLinkHandler $submitLinkHandler, SubmissionFormFactory $submissionFormFactory)
    {
        $this->templateRenderer = $templateRenderer;
        $this->session = $session;
        $this->submitLinkHandler = $submitLinkHandler;
        $this->submissionFormFactory = $submissionFormFactory;
    }

    public function show(Request $request): Response
    {
        $content = $this->templateRenderer->render('Submission.html.twig');
        return new Response($content);
    }

    public function submit(Request $request): Response
    {
        $response = new RedirectResponse('/submit');

        $submissionForm = $this->submissionFormFactory->createFormRequest($request);

        if($submissionForm->hasValidationErrors())
        {
            foreach ($submissionForm->getValidationErrors() as $errorMessage) {
                $this->session->getFlashBag('errors', $errorMessage);
            }
            return $response;
        }

        $this->submitLinkHandler->handle($submissionForm->toCommand());

        $this->session->getFlashBag()->add('success', 'Your URL was submitted successfully');

        return $response;
    }
}