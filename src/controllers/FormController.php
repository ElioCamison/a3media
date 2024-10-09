<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Repositories\FormRepository;
use Utils\ResponseBuilder;

class FormController {
    protected $formRepository;

    public function __construct(FormRepository $formRepository) {
        $this->formRepository = $formRepository;
    }

    public function getNames(Request $request, Response $response): Response {
        $term = $request->getQueryParams()['term'] ?? '';

        $names = $this->formRepository->fetchNames($term);
        return ResponseBuilder::json($response, ['options' => $names]);
    }

    public function getTypes(Request $request, Response $response): Response {
        $types = $this->formRepository->fetchType();
        return ResponseBuilder::json($response, ['options' => $types]);
    }
}
