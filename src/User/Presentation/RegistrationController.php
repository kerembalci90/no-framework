<?php declare(strict_types=1);

namespace SocialNews\User\Presentation;

use SocialNews\Framework\Rendering\TemplateRenderer;
use SocialNews\User\Application\RegisterUserHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

final class RegistrationController
{
    private $templateRenderer;
    private $registrationFormFactory;
    private $session;

    public function __construct(TemplateRenderer $templateRenderer, RegistrationFormFactory $registrationFormFactory, Session $session)
    {
        $this->templateRenderer = $templateRenderer;
        $this->registrationFormFactory = $registrationFormFactory;
        $this->session = $session;
    }

    public function show(): Response
    {
        $content = $this->templateRenderer->render('Registration.html.twig');

        return new Response($content);
    }

    public function register(Request $request): Response
    {
        $response = new RedirectResponse('/register');
        $form = $this->registrationFormFactory->createFromRequest($request);

        if($form->hasValidationErrors()) {
            foreach ($form->getValidationErrors() as $errorMessages) {
                $this->session->getFlashBag()->add('errors', $errorMessages);
            }

            return $response;
        }

        //$this->registerUserHandler->handle($form->toCommand());

        $this->session->getFlashBag()->add('success', 'Your account was created. You can now log in.');

        return $response;
    }
}