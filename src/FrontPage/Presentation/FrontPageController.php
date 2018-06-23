<?php declare(strict_types=1);

namespace SocialNews\FrontPage\Presentation;

use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;

final class FrontPageController {

    public function show(Request $request): Response
    {
        $content = 'Hello ' . $request->query->get("name", "visitor");
        return new Response($content);
    }
}