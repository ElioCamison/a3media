<?php

namespace Utils;

use Psr\Http\Message\ResponseInterface as Response;

/**
 * Clase ResponseBuilder
 *
 * Utilidades para construir respuestas HTTP en formato JSON.
 */
class ResponseBuilder {

    /**
     * Genera una respuesta JSON.
     *
     * @param Response $response La respuesta PSR-7 a modificar.
     * @param mixed $data Los datos a incluir en la respuesta JSON.
     * @param int $status Código de estado HTTP, por defecto 200 (OK).
     * @return Response La respuesta PSR-7 modificada con el contenido JSON.
     */
    public static function json(Response $response, $data, int $status = 200): Response {
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus($status);
    }

    /**
     * Genera una respuesta de éxito en JSON.
     *
     * @param Response $response La respuesta PSR-7 a modificar.
     * @param string $message Mensaje de éxito a incluir en la respuesta.
     * @param int $status Código de estado HTTP, por defecto 200 (OK).
     * @return Response La respuesta PSR-7 modificada con el contenido JSON de éxito.
     */
    public static function success(Response $response, string $message, int $status = 200): Response {
        return self::json($response, ['message' => $message], $status);
    }

    /**
     * Genera una respuesta de error en JSON.
     *
     * @param Response $response La respuesta PSR-7 a modificar.
     * @param string $message Mensaje de error a incluir en la respuesta.
     * @param int $status Código de estado HTTP, por defecto 500 (Internal Server Error).
     * @return Response La respuesta PSR-7 modificada con el contenido JSON de error.
     */
    public static function error(Response $response, string $message, int $status = 500): Response {
        return self::json($response, ['error' => $message], $status);
    }
}
