<?php

namespace Arpanpatoliya\Response\Tests;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ResponseMacrosTest extends TestCase
{
    // ==================== Basic Response Tests ====================
    
    public function test_success_macro_returns_correct_response()
    {
        $message = 'User created successfully';
        $data = ['id' => 1, 'name' => 'John Doe'];

        $response = response()->success($message, $data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_success_macro_without_data()
    {
        $message = 'User created successfully';

        $response = response()->success($message);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => []
        ], json_decode($response->getContent(), true));
    }

    public function test_success_message_macro()
    {
        $message = 'User updated successfully';

        $response = response()->successMessage($message);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_error_message_macro()
    {
        $message = 'User not found';

        $response = response()->errorMessage($message);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_validation_failure_macro()
    {
        $validator = Validator::make([], [
            'email' => 'required|email',
            'name' => 'required'
        ]);

        $response = response()->validationFailure($validator);

        $this->assertEquals(422, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        
        $this->assertFalse($responseData['status']);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertArrayHasKey('email', $responseData['errors']);
        $this->assertArrayHasKey('name', $responseData['errors']);
    }

    // ==================== 1xx Informational Tests ====================
    
    public function test_continue_macro()
    {
        $response = response()->continue();
        $this->assertEquals(100, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => 'Continue',
        ], json_decode($response->getContent(), true));
    }

    public function test_switching_protocols_macro()
    {
        $response = response()->switchingProtocols();
        $this->assertEquals(101, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => 'Switching Protocols',
        ], json_decode($response->getContent(), true));
    }

    public function test_processing_macro()
    {
        $response = response()->processing();
        $this->assertEquals(102, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => 'Processing',
        ], json_decode($response->getContent(), true));
    }

    public function test_early_hints_macro()
    {
        $response = response()->earlyHints();
        $this->assertEquals(103, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => 'Early Hints',
        ], json_decode($response->getContent(), true));
    }

    // ==================== 2xx Success Tests ====================
    
    public function test_ok_macro()
    {
        $message = 'OK';
        $data = ['key' => 'value'];
        
        $response = response()->ok($message, $data);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_created_macro()
    {
        $message = 'User created successfully';
        $data = ['id' => 1, 'name' => 'John Doe'];

        $response = response()->created($message, $data);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_accepted_macro()
    {
        $message = 'Request accepted';
        $data = ['job_id' => 123];

        $response = response()->accepted($message, $data);

        $this->assertEquals(202, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_no_content_macro()
    {
        $response = response()->noContent();
        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEmpty(json_decode($response->getContent(), true));
    }

    public function test_reset_content_macro()
    {
        $response = response()->resetContent();
        $this->assertEquals(205, $response->getStatusCode());
        $this->assertEmpty(json_decode($response->getContent(), true));
    }

    public function test_partial_content_macro()
    {
        $message = 'Partial content';
        $data = ['items' => [1, 2, 3]];

        $response = response()->partialContent($message, $data);

        $this->assertEquals(206, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_updated_macro()
    {
        $message = 'User updated successfully';
        $data = ['id' => 1, 'name' => 'John Doe Updated'];

        $response = response()->updated($message, $data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_deleted_macro()
    {
        $response = response()->deleted();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => 'Resource deleted successfully.',
        ], json_decode($response->getContent(), true));
    }

    public function test_deleted_macro_with_custom_message()
    {
        $message = 'User deleted successfully';
        $response = response()->deleted($message);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    // ==================== 4xx Client Error Tests ====================
    
    public function test_bad_request_macro()
    {
        $message = 'Invalid input data';
        $response = response()->badRequest($message);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_unauthorized_macro()
    {
        $response = response()->unauthorized();

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Unauthenticated.',
        ], json_decode($response->getContent(), true));
    }

    public function test_unauthorized_macro_with_custom_message()
    {
        $message = 'Invalid token';
        $response = response()->unauthorized($message);

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_payment_required_macro()
    {
        $message = 'Payment required';
        $response = response()->paymentRequired($message);

        $this->assertEquals(402, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_forbidden_macro()
    {
        $response = response()->forbidden();

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Permission denied.',
        ], json_decode($response->getContent(), true));
    }

    public function test_forbidden_macro_with_custom_message()
    {
        $message = 'Access denied';
        $response = response()->forbidden($message);

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_not_found_macro()
    {
        $response = response()->notFound();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Resource not found.',
        ], json_decode($response->getContent(), true));
    }

    public function test_not_found_macro_with_custom_message()
    {
        $message = 'User not found';
        $response = response()->notFound($message);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_method_not_allowed_macro()
    {
        $message = 'Method not allowed';
        $response = response()->methodNotAllowed($message);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_conflict_macro()
    {
        $message = 'Resource already exists';
        $response = response()->conflict($message);

        $this->assertEquals(409, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_gone_macro()
    {
        $message = 'Resource no longer available';
        $response = response()->gone($message);

        $this->assertEquals(410, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_payload_too_large_macro()
    {
        $message = 'File too large';
        $response = response()->payloadTooLarge($message);

        $this->assertEquals(413, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_unsupported_media_type_macro()
    {
        $message = 'Unsupported file type';
        $response = response()->unsupportedMediaType($message);

        $this->assertEquals(415, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_im_a_teapot_macro()
    {
        $message = "I'm a teapot";
        $response = response()->imATeapot($message);

        $this->assertEquals(418, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_too_many_requests_macro()
    {
        $message = 'Rate limit exceeded';
        $response = response()->tooManyRequests($message);

        $this->assertEquals(429, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    // ==================== 5xx Server Error Tests ====================
    
    public function test_server_error_macro_with_message()
    {
        $errorMessage = 'Database connection failed';

        $response = response()->serverError($errorMessage);

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $errorMessage
        ], json_decode($response->getContent(), true));
    }

    public function test_server_error_macro_without_message()
    {
        $response = response()->serverError();

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => null
        ], json_decode($response->getContent(), true));
    }

    public function test_internal_server_error_macro()
    {
        $errorMessage = 'Internal error';
        $response = response()->internalServerError($errorMessage);

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $errorMessage
        ], json_decode($response->getContent(), true));
    }

    public function test_not_implemented_macro()
    {
        $message = 'Feature not implemented';
        $response = response()->notImplemented($message);

        $this->assertEquals(501, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_bad_gateway_macro()
    {
        $message = 'Bad gateway';
        $response = response()->badGateway($message);

        $this->assertEquals(502, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_service_unavailable_macro()
    {
        $message = 'Service temporarily unavailable';
        $response = response()->serviceUnavailable($message);

        $this->assertEquals(503, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_gateway_timeout_macro()
    {
        $message = 'Gateway timeout';
        $response = response()->gatewayTimeout($message);

        $this->assertEquals(504, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    // ==================== Utility Method Tests ====================
    
    public function test_error_macro()
    {
        $message = 'User not found';

        $response = response()->error($message);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_error_macro_with_custom_status_code()
    {
        $message = 'Bad request';
        $statusCode = 400;

        $response = response()->error($message, $statusCode);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_custom_macro()
    {
        $status = true;
        $message = 'Custom response';
        $data = ['key' => 'value'];
        $statusCode = 201;

        $response = response()->custom($status, $message, $data, $statusCode);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_custom_macro_without_data()
    {
        $status = false;
        $message = 'Error occurred';
        $statusCode = 400;

        $response = response()->custom($status, $message, [], $statusCode);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals([
            'status' => $status,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_paginated_macro()
    {
        $message = 'Users retrieved successfully';
        $data = ['users' => []];
        $pagination = [
            'current_page' => 1,
            'per_page' => 10,
            'total' => 0
        ];

        $response = response()->paginated($message, $data, $pagination);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination
        ], json_decode($response->getContent(), true));
    }

    public function test_paginated_macro_without_pagination()
    {
        $message = 'Users retrieved successfully';
        $data = ['users' => []];

        $response = response()->paginated($message, $data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], json_decode($response->getContent(), true));
    }

    public function test_with_meta_macro()
    {
        $message = 'Data retrieved successfully';
        $data = ['items' => []];
        $meta = ['version' => '1.0', 'timestamp' => time()];

        $response = response()->withMeta($message, $data, $meta);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'meta' => $meta
        ], json_decode($response->getContent(), true));
    }

    public function test_with_meta_macro_without_meta()
    {
        $message = 'Data retrieved successfully';
        $data = ['items' => []];

        $response = response()->withMeta($message, $data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], json_decode($response->getContent(), true));
    }

    // ==================== Macro Registration Test ====================
    
    public function test_all_macros_are_registered()
    {
        // Basic macros
        $this->assertTrue(Response::hasMacro('success'));
        $this->assertTrue(Response::hasMacro('successMessage'));
        $this->assertTrue(Response::hasMacro('errorMessage'));
        $this->assertTrue(Response::hasMacro('validationFailure'));
        
        // 1xx Informational
        $this->assertTrue(Response::hasMacro('continue'));
        $this->assertTrue(Response::hasMacro('switchingProtocols'));
        $this->assertTrue(Response::hasMacro('processing'));
        $this->assertTrue(Response::hasMacro('earlyHints'));
        
        // 2xx Success
        $this->assertTrue(Response::hasMacro('ok'));
        $this->assertTrue(Response::hasMacro('created'));
        $this->assertTrue(Response::hasMacro('accepted'));
        $this->assertTrue(Response::hasMacro('noContent'));
        $this->assertTrue(Response::hasMacro('resetContent'));
        $this->assertTrue(Response::hasMacro('partialContent'));
        $this->assertTrue(Response::hasMacro('updated'));
        $this->assertTrue(Response::hasMacro('deleted'));
        
        // 4xx Client Errors
        $this->assertTrue(Response::hasMacro('badRequest'));
        $this->assertTrue(Response::hasMacro('unauthorized'));
        $this->assertTrue(Response::hasMacro('paymentRequired'));
        $this->assertTrue(Response::hasMacro('forbidden'));
        $this->assertTrue(Response::hasMacro('notFound'));
        $this->assertTrue(Response::hasMacro('methodNotAllowed'));
        $this->assertTrue(Response::hasMacro('conflict'));
        $this->assertTrue(Response::hasMacro('gone'));
        $this->assertTrue(Response::hasMacro('payloadTooLarge'));
        $this->assertTrue(Response::hasMacro('unsupportedMediaType'));
        $this->assertTrue(Response::hasMacro('imATeapot'));
        $this->assertTrue(Response::hasMacro('tooManyRequests'));
        
        // 5xx Server Errors
        $this->assertTrue(Response::hasMacro('internalServerError'));
        $this->assertTrue(Response::hasMacro('serverError'));
        $this->assertTrue(Response::hasMacro('notImplemented'));
        $this->assertTrue(Response::hasMacro('badGateway'));
        $this->assertTrue(Response::hasMacro('serviceUnavailable'));
        $this->assertTrue(Response::hasMacro('gatewayTimeout'));
        
        // Utility methods
        $this->assertTrue(Response::hasMacro('error'));
        $this->assertTrue(Response::hasMacro('custom'));
        $this->assertTrue(Response::hasMacro('paginated'));
        $this->assertTrue(Response::hasMacro('withMeta'));
    }
} 