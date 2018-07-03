<?php declare(strict_types=1);

namespace SocialNews\User\Presentation;

use SocialNews\Framework\Csrf\StoredTokenValidator;
use Symfony\Component\HttpFoundation\Request;

final class RegistrationFormFactory
{
    private $storedTokenValidator;

    public function __construct(StoredTokenValidator $storedTokenValidator)
    {
        $this->storedTokenValidator = $storedTokenValidator;
    }

    public function createFromRequest(Request $request): RegistrationForm
    {
        return new RegistrationForm(
            $this->storedTokenValidator,
            (string)$request->get('token'),
            (string)$request->get('nickname'),
            (string)$request->get('password')
        );
    }
}