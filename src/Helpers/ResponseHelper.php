<?php

namespace Arpanpatoliya\Response\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Validator;

class ResponseHelper
{
    // ==================== 1xx Informational Responses ====================
    
    /**
     * Continue (100)
     */
    public static function continue(string $message = 'Continue'): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
        ], 100);
    }

    /**
     * Switching Protocols (101)
     */
    public static function switchingProtocols(string $message = 'Switching Protocols'): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
        ], 101);
    }

    /**
     * Processing (102)
     */
    public static function processing(string $message = 'Processing'): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
        ], 102);
    }

    /**
     * Early Hints (103)
     */
    public static function earlyHints(string $message = 'Early Hints'): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
        ], 103);
    }

    // ==================== 2xx Successful Responses ====================
    
    /**
     * OK (200)
     */
    public static function ok(string $message = 'OK', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    /**
     * Create a success response with data.
     */
    public static function success(string $message, array $data = []): JsonResponse
    {
        return self::ok($message, $data);
    }

    /**
     * Create a success response with message only.
     */
    public static function successMessage(string $message): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
        ], 200);
    }

    /**
     * Created (201)
     */
    public static function created(string $message, array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 201);
    }

    /**
     * Accepted (202)
     */
    public static function accepted(string $message = 'Accepted', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 202);
    }

    /**
     * Non-Authoritative Information (203)
     */
    public static function nonAuthoritativeInformation(string $message = 'Non-Authoritative Information', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 203);
    }

    /**
     * No Content (204)
     */
    public static function noContent(): JsonResponse
    {
        return Response::json([], 204);
    }

    /**
     * Reset Content (205)
     */
    public static function resetContent(): JsonResponse
    {
        return Response::json([], 205);
    }

    /**
     * Partial Content (206)
     */
    public static function partialContent(string $message = 'Partial Content', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 206);
    }

    /**
     * Multi-Status (207)
     */
    public static function multiStatus(string $message = 'Multi-Status', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 207);
    }

    /**
     * Already Reported (208)
     */
    public static function alreadyReported(string $message = 'Already Reported', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 208);
    }

    /**
     * IM Used (226)
     */
    public static function imUsed(string $message = 'IM Used', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 226);
    }

    // ==================== 3xx Redirection Responses ====================
    
    /**
     * Multiple Choices (300)
     */
    public static function multipleChoices(string $message = 'Multiple Choices', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 300);
    }

    /**
     * Moved Permanently (301)
     */
    public static function movedPermanently(string $message = 'Moved Permanently', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 301);
    }

    /**
     * Found (302)
     */
    public static function found(string $message = 'Found', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 302);
    }

    /**
     * See Other (303)
     */
    public static function seeOther(string $message = 'See Other', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 303);
    }

    /**
     * Not Modified (304)
     */
    public static function notModified(): JsonResponse
    {
        return Response::json([], 304);
    }

    /**
     * Use Proxy (305)
     */
    public static function useProxy(string $message = 'Use Proxy', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 305);
    }

    /**
     * Temporary Redirect (307)
     */
    public static function temporaryRedirect(string $message = 'Temporary Redirect', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 307);
    }

    /**
     * Permanent Redirect (308)
     */
    public static function permanentRedirect(string $message = 'Permanent Redirect', array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 308);
    }

    // ==================== 4xx Client Error Responses ====================
    
    /**
     * Bad Request (400)
     */
    public static function badRequest(string $message = 'Bad Request'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 400);
    }

    /**
     * Unauthorized (401)
     */
    public static function unauthorized(string $message = 'Unauthenticated.'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 401);
    }

    /**
     * Payment Required (402)
     */
    public static function paymentRequired(string $message = 'Payment Required'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 402);
    }

    /**
     * Forbidden (403)
     */
    public static function forbidden(string $message = 'Permission denied.'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 403);
    }

    /**
     * Not Found (404)
     */
    public static function notFound(string $message = 'Resource not found.'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 404);
    }

    /**
     * Method Not Allowed (405)
     */
    public static function methodNotAllowed(string $message = 'Method Not Allowed'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 405);
    }

    /**
     * Not Acceptable (406)
     */
    public static function notAcceptable(string $message = 'Not Acceptable'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 406);
    }

    /**
     * Proxy Authentication Required (407)
     */
    public static function proxyAuthenticationRequired(string $message = 'Proxy Authentication Required'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 407);
    }

    /**
     * Request Timeout (408)
     */
    public static function requestTimeout(string $message = 'Request Timeout'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 408);
    }

    /**
     * Conflict (409)
     */
    public static function conflict(string $message = 'Conflict'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 409);
    }

    /**
     * Gone (410)
     */
    public static function gone(string $message = 'Gone'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 410);
    }

    /**
     * Length Required (411)
     */
    public static function lengthRequired(string $message = 'Length Required'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 411);
    }

    /**
     * Precondition Failed (412)
     */
    public static function preconditionFailed(string $message = 'Precondition Failed'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 412);
    }

    /**
     * Payload Too Large (413)
     */
    public static function payloadTooLarge(string $message = 'Payload Too Large'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 413);
    }

    /**
     * URI Too Long (414)
     */
    public static function uriTooLong(string $message = 'URI Too Long'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 414);
    }

    /**
     * Unsupported Media Type (415)
     */
    public static function unsupportedMediaType(string $message = 'Unsupported Media Type'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 415);
    }

    /**
     * Range Not Satisfiable (416)
     */
    public static function rangeNotSatisfiable(string $message = 'Range Not Satisfiable'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 416);
    }

    /**
     * Expectation Failed (417)
     */
    public static function expectationFailed(string $message = 'Expectation Failed'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 417);
    }

    /**
     * I'm a teapot (418)
     */
    public static function imATeapot(string $message = "I'm a teapot"): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 418);
    }

    /**
     * Misdirected Request (421)
     */
    public static function misdirectedRequest(string $message = 'Misdirected Request'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 421);
    }

    /**
     * Unprocessable Entity (422)
     */
    public static function unprocessableEntity(string $message = 'Unprocessable Entity'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 422);
    }

    /**
     * Locked (423)
     */
    public static function locked(string $message = 'Locked'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 423);
    }

    /**
     * Failed Dependency (424)
     */
    public static function failedDependency(string $message = 'Failed Dependency'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 424);
    }

    /**
     * Too Early (425)
     */
    public static function tooEarly(string $message = 'Too Early'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 425);
    }

    /**
     * Upgrade Required (426)
     */
    public static function upgradeRequired(string $message = 'Upgrade Required'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 426);
    }

    /**
     * Precondition Required (428)
     */
    public static function preconditionRequired(string $message = 'Precondition Required'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 428);
    }

    /**
     * Too Many Requests (429)
     */
    public static function tooManyRequests(string $message = 'Too Many Requests'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 429);
    }

    /**
     * Request Header Fields Too Large (431)
     */
    public static function requestHeaderFieldsTooLarge(string $message = 'Request Header Fields Too Large'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 431);
    }

    /**
     * Unavailable For Legal Reasons (451)
     */
    public static function unavailableForLegalReasons(string $message = 'Unavailable For Legal Reasons'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 451);
    }

    // ==================== 5xx Server Error Responses ====================
    
    /**
     * Internal Server Error (500)
     */
    public static function internalServerError(?string $message = null): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $message
        ], 500);
    }

    /**
     * Create a server error response.
     */
    public static function serverError(?string $message = null): JsonResponse
    {
        return self::internalServerError($message);
    }

    /**
     * Not Implemented (501)
     */
    public static function notImplemented(string $message = 'Not Implemented'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 501);
    }

    /**
     * Bad Gateway (502)
     */
    public static function badGateway(string $message = 'Bad Gateway'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 502);
    }

    /**
     * Service Unavailable (503)
     */
    public static function serviceUnavailable(string $message = 'Service Unavailable'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 503);
    }

    /**
     * Gateway Timeout (504)
     */
    public static function gatewayTimeout(string $message = 'Gateway Timeout'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 504);
    }

    /**
     * HTTP Version Not Supported (505)
     */
    public static function httpVersionNotSupported(string $message = 'HTTP Version Not Supported'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 505);
    }

    /**
     * Variant Also Negotiates (506)
     */
    public static function variantAlsoNegotiates(string $message = 'Variant Also Negotiates'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 506);
    }

    /**
     * Insufficient Storage (507)
     */
    public static function insufficientStorage(string $message = 'Insufficient Storage'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 507);
    }

    /**
     * Loop Detected (508)
     */
    public static function loopDetected(string $message = 'Loop Detected'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 508);
    }

    /**
     * Not Extended (510)
     */
    public static function notExtended(string $message = 'Not Extended'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 510);
    }

    /**
     * Network Authentication Required (511)
     */
    public static function networkAuthenticationRequired(string $message = 'Network Authentication Required'): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], 511);
    }

    // ==================== Legacy Methods (for backward compatibility) ====================
    
    /**
     * Create an error response.
     */
    public static function error(string $message, int $statusCode = 200): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], $statusCode);
    }

    /**
     * Create a validation failure response.
     */
    public static function validationError(Validator $validator): JsonResponse
    {
        return Response::json([
            'status' => false,
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors()
        ], 422);
    }

    /**
     * Create a custom response with status and message.
     */
    public static function custom(bool $status, string $message, array $data = [], int $statusCode = 200): JsonResponse
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return Response::json($response, $statusCode);
    }

    /**
     * Create a paginated response.
     */
    public static function paginated(string $message, $data, array $pagination = []): JsonResponse
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];

        if (!empty($pagination)) {
            $response['pagination'] = $pagination;
        }

        return Response::json($response, 200);
    }

    /**
     * Create a response with additional metadata.
     */
    public static function withMeta(string $message, array $data = [], array $meta = []): JsonResponse
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];

        if (!empty($meta)) {
            $response['meta'] = $meta;
        }

        return Response::json($response, 200);
    }

    /**
     * Create a response for resource updated.
     */
    public static function updated(string $message, array $data = []): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    /**
     * Create a response for resource deleted.
     */
    public static function deleted(string $message = 'Resource deleted successfully.'): JsonResponse
    {
        return Response::json([
            'status' => true,
            'message' => $message,
        ], 200);
    }
} 