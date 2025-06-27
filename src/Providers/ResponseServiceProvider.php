<?php

namespace Arpanpatoliya\Response\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerResponseMacros();
    }

    /**
     * Register response macros for standardized API responses.
     */
    protected function registerResponseMacros(): void
    {
        // ==================== 1xx Informational Responses ====================
        Response::macro('continue', function ($message = 'Continue') {
            return Response::json([
                'status' => true,
                'message' => $message,
            ], 100);
        });

        Response::macro('switchingProtocols', function ($message = 'Switching Protocols') {
            return Response::json([
                'status' => true,
                'message' => $message,
            ], 101);
        });

        Response::macro('processing', function ($message = 'Processing') {
            return Response::json([
                'status' => true,
                'message' => $message,
            ], 102);
        });

        Response::macro('earlyHints', function ($message = 'Early Hints') {
            return Response::json([
                'status' => true,
                'message' => $message,
            ], 103);
        });

        // ==================== 2xx Successful Responses ====================
        Response::macro('ok', function ($message = 'OK', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 200);
        });

        Response::macro('success', function ($message, $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 200);
        });

        Response::macro('successMessage', function ($message) {
            return Response::json([
                'status' => true,
                'message' => $message,
            ], 200);
        });

        Response::macro('created', function ($message, $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 201);
        });

        Response::macro('accepted', function ($message = 'Accepted', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 202);
        });

        Response::macro('nonAuthoritativeInformation', function ($message = 'Non-Authoritative Information', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 203);
        });

        Response::macro('noContent', function () {
            return Response::json([], 204);
        });

        Response::macro('resetContent', function () {
            return Response::json([], 205);
        });

        Response::macro('partialContent', function ($message = 'Partial Content', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 206);
        });

        Response::macro('multiStatus', function ($message = 'Multi-Status', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 207);
        });

        Response::macro('alreadyReported', function ($message = 'Already Reported', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 208);
        });

        Response::macro('imUsed', function ($message = 'IM Used', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 226);
        });

        // ==================== 3xx Redirection Responses ====================
        Response::macro('multipleChoices', function ($message = 'Multiple Choices', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 300);
        });

        Response::macro('movedPermanently', function ($message = 'Moved Permanently', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 301);
        });

        Response::macro('found', function ($message = 'Found', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 302);
        });

        Response::macro('seeOther', function ($message = 'See Other', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 303);
        });

        Response::macro('notModified', function () {
            return Response::json([], 304);
        });

        Response::macro('useProxy', function ($message = 'Use Proxy', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 305);
        });

        Response::macro('temporaryRedirect', function ($message = 'Temporary Redirect', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 307);
        });

        Response::macro('permanentRedirect', function ($message = 'Permanent Redirect', $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 308);
        });

        // ==================== 4xx Client Error Responses ====================
        Response::macro('badRequest', function ($message = 'Bad Request') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 400);
        });

        Response::macro('unauthorized', function ($message = 'Unauthenticated.') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 401);
        });

        Response::macro('paymentRequired', function ($message = 'Payment Required') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 402);
        });

        Response::macro('forbidden', function ($message = 'Permission denied.') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 403);
        });

        Response::macro('notFound', function ($message = 'Resource not found.') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 404);
        });

        Response::macro('methodNotAllowed', function ($message = 'Method Not Allowed') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 405);
        });

        Response::macro('notAcceptable', function ($message = 'Not Acceptable') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 406);
        });

        Response::macro('proxyAuthenticationRequired', function ($message = 'Proxy Authentication Required') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 407);
        });

        Response::macro('requestTimeout', function ($message = 'Request Timeout') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 408);
        });

        Response::macro('conflict', function ($message = 'Conflict') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 409);
        });

        Response::macro('gone', function ($message = 'Gone') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 410);
        });

        Response::macro('lengthRequired', function ($message = 'Length Required') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 411);
        });

        Response::macro('preconditionFailed', function ($message = 'Precondition Failed') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 412);
        });

        Response::macro('payloadTooLarge', function ($message = 'Payload Too Large') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 413);
        });

        Response::macro('uriTooLong', function ($message = 'URI Too Long') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 414);
        });

        Response::macro('unsupportedMediaType', function ($message = 'Unsupported Media Type') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 415);
        });

        Response::macro('rangeNotSatisfiable', function ($message = 'Range Not Satisfiable') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 416);
        });

        Response::macro('expectationFailed', function ($message = 'Expectation Failed') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 417);
        });

        Response::macro('imATeapot', function ($message = "I'm a teapot") {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 418);
        });

        Response::macro('misdirectedRequest', function ($message = 'Misdirected Request') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 421);
        });

        Response::macro('unprocessableEntity', function ($message = 'Unprocessable Entity') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 422);
        });

        Response::macro('locked', function ($message = 'Locked') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 423);
        });

        Response::macro('failedDependency', function ($message = 'Failed Dependency') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 424);
        });

        Response::macro('tooEarly', function ($message = 'Too Early') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 425);
        });

        Response::macro('upgradeRequired', function ($message = 'Upgrade Required') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 426);
        });

        Response::macro('preconditionRequired', function ($message = 'Precondition Required') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 428);
        });

        Response::macro('tooManyRequests', function ($message = 'Too Many Requests') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 429);
        });

        Response::macro('requestHeaderFieldsTooLarge', function ($message = 'Request Header Fields Too Large') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 431);
        });

        Response::macro('unavailableForLegalReasons', function ($message = 'Unavailable For Legal Reasons') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 451);
        });

        // ==================== 5xx Server Error Responses ====================
        Response::macro('internalServerError', function ($message = null) {
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $message
            ], 500);
        });

        Response::macro('serverError', function ($message = null) {
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $message
            ], 500);
        });

        Response::macro('notImplemented', function ($message = 'Not Implemented') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 501);
        });

        Response::macro('badGateway', function ($message = 'Bad Gateway') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 502);
        });

        Response::macro('serviceUnavailable', function ($message = 'Service Unavailable') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 503);
        });

        Response::macro('gatewayTimeout', function ($message = 'Gateway Timeout') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 504);
        });

        Response::macro('httpVersionNotSupported', function ($message = 'HTTP Version Not Supported') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 505);
        });

        Response::macro('variantAlsoNegotiates', function ($message = 'Variant Also Negotiates') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 506);
        });

        Response::macro('insufficientStorage', function ($message = 'Insufficient Storage') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 507);
        });

        Response::macro('loopDetected', function ($message = 'Loop Detected') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 508);
        });

        Response::macro('notExtended', function ($message = 'Not Extended') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 510);
        });

        Response::macro('networkAuthenticationRequired', function ($message = 'Network Authentication Required') {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 511);
        });

        // ==================== Utility Methods ====================
        Response::macro('errorMessage', function ($message) {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], 200);
        });

        Response::macro('error', function ($message, $statusCode = 200) {
            return Response::json([
                'status' => false,
                'message' => $message,
            ], $statusCode);
        });

        Response::macro('validationFailure', function ($validator) {
            return Response::json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        });

        Response::macro('custom', function ($status, $message, $data = [], $statusCode = 200) {
            $response = [
                'status' => $status,
                'message' => $message,
            ];

            if (!empty($data)) {
                $response['data'] = $data;
            }

            return Response::json($response, $statusCode);
        });

        Response::macro('paginated', function ($message, $data, $pagination = []) {
            $response = [
                'status' => true,
                'message' => $message,
                'data' => $data,
            ];

            if (!empty($pagination)) {
                $response['pagination'] = $pagination;
            }

            return Response::json($response, 200);
        });

        Response::macro('withMeta', function ($message, $data = [], $meta = []) {
            $response = [
                'status' => true,
                'message' => $message,
                'data' => $data,
            ];

            if (!empty($meta)) {
                $response['meta'] = $meta;
            }

            return Response::json($response, 200);
        });

        Response::macro('updated', function ($message, $data = []) {
            return Response::json([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 200);
        });

        Response::macro('deleted', function ($message = 'Resource deleted successfully.') {
            return Response::json([
                'status' => true,
                'message' => $message,
            ], 200);
        });
    }
} 