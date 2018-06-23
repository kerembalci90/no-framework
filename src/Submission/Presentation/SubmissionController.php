<?php declare(strict_types=1);

namespace SocialNews\Submission\Presentation;

use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;

final class SubmissionController {

    public function show(Request $request): Response
    {
        $content = 'Submission controller';
        return new Response($content);
    }
}