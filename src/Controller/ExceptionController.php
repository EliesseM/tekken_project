<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

#[AsController]
class ExceptionController
{
    public function __construct(private Environment $twig) {}

    public function __invoke(Request $request, ?\Throwable $exception = null): Response
    {
        $statusCode = 500;
        if ($exception instanceof HttpExceptionInterface) {
            $statusCode = $exception->getStatusCode();
        }

        return new Response(
            $this->twig->render('bundles/TwigBundle/Exception/error' . $statusCode . '.html.twig'),
            $statusCode
        );
    }
}
