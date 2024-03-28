<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;

class RestResponseFactory extends ResponseFactory
{
    /**
     * The request succeeded.
     *
     * @param $data
     * @return JsonResponse
     */
    public function ok($data = null): JsonResponse
    {
        return $this->json($data);
    }

    /**
     * The request succeeded, and a new resource was created as a result.
     *
     * @param $request
     * @return JsonResponse
     */
    public function created($request): JsonResponse
    {
        return response()->json($request, 201);
    }

    /**
     * There is no content to send for this request, but the headers may be useful.
     *
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public function noContent($status = 204, array $headers = []): JsonResponse
    {
        $response = [
            'message' => 'No content.'
        ];
        return response()->json($response, 204);
    }

    /**
     * The server cannot or will not process the request due to something that is perceived to be a client error.
     *
     * @param $error
     * @return JsonResponse
     */
    public function badRequest($error): JsonResponse
    {
        $response = [
            'message' => 'Bad request.',
            'error' => $error
        ];

        return response()->json($response, 400);
    }

    /**
     * The client must authenticate itself to get the requested response.
     *
     * @param $error
     * @return JsonResponse
     */
    public function unauthorized($error): JsonResponse
    {
        $response = [
            'message' => 'Unauthorized.',
            'error' => $error
        ];

        return response()->json($response, 401);
    }

    /**
     * The client does not have access rights to the content; that is, it is unauthorized,
     * so the server is refusing to give the requested resource.
     *
     * @param $error
     * @return JsonResponse
     */
    public function forbidden($error): JsonResponse
    {
        $response = [
            'message' => 'Forbidden.',
            'error' => $error
        ];

        return response()->json($response, 403);
    }

    /**
     * The server cannot find the requested resource.
     *
     * @param $error
     * @return JsonResponse
     */
    public function notFound($error): JsonResponse
    {
        $response = [
            'message' => 'Not found.',
            'error' => $error
        ];

        return response()->json($response, 404);
    }

    /**
     * The server has encountered a situation it does not know how to handle.
     *
     * @param $error
     * @return JsonResponse
     */
    public function serverError($error): JsonResponse
    {
        $response = [
            'message' => 'Internal server error.',
            'error' => $error
        ];

        return response()->json($response, 500);
    }
}
