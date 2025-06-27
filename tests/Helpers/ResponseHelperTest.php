<?php

namespace Arpanpatoliya\Response\Tests\Helpers;

use Arpanpatoliya\Response\Tests\TestCase;
use Arpanpatoliya\Response\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;

class ResponseHelperTest extends TestCase
{
    public function test_success_method()
    {
        $message = 'User created successfully';
        $data = ['id' => 1, 'name' => 'John Doe'];

        $response = ResponseHelper::success($message, $data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_success_message_method()
    {
        $message = 'User updated successfully';

        $response = ResponseHelper::successMessage($message);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_error_method()
    {
        $message = 'User not found';

        $response = ResponseHelper::error($message);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_error_method_with_custom_status_code()
    {
        $message = 'Bad request';
        $statusCode = 400;

        $response = ResponseHelper::error($message, $statusCode);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_validation_error_method()
    {
        $validator = Validator::make([], [
            'email' => 'required|email',
            'name' => 'required'
        ]);

        $response = ResponseHelper::validationError($validator);

        $this->assertEquals(422, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        
        $this->assertFalse($responseData['status']);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertArrayHasKey('email', $responseData['errors']);
        $this->assertArrayHasKey('name', $responseData['errors']);
    }

    public function test_unauthorized_method()
    {
        $response = ResponseHelper::unauthorized();

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Unauthenticated.',
        ], json_decode($response->getContent(), true));
    }

    public function test_unauthorized_method_with_custom_message()
    {
        $message = 'Invalid token';
        $response = ResponseHelper::unauthorized($message);

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_forbidden_method()
    {
        $response = ResponseHelper::forbidden();

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Permission denied.',
        ], json_decode($response->getContent(), true));
    }

    public function test_forbidden_method_with_custom_message()
    {
        $message = 'Access denied';
        $response = ResponseHelper::forbidden($message);

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_not_found_method()
    {
        $response = ResponseHelper::notFound();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Resource not found.',
        ], json_decode($response->getContent(), true));
    }

    public function test_not_found_method_with_custom_message()
    {
        $message = 'User not found';
        $response = ResponseHelper::notFound($message);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_server_error_method()
    {
        $response = ResponseHelper::serverError();

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => null
        ], json_decode($response->getContent(), true));
    }

    public function test_server_error_method_with_message()
    {
        $errorMessage = 'Database connection failed';
        $response = ResponseHelper::serverError($errorMessage);

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $errorMessage
        ], json_decode($response->getContent(), true));
    }

    public function test_custom_method()
    {
        $status = true;
        $message = 'Custom response';
        $data = ['key' => 'value'];
        $statusCode = 201;

        $response = ResponseHelper::custom($status, $message, $data, $statusCode);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_custom_method_without_data()
    {
        $status = false;
        $message = 'Error occurred';
        $statusCode = 400;

        $response = ResponseHelper::custom($status, $message, [], $statusCode);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals([
            'status' => $status,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }

    public function test_paginated_method()
    {
        $message = 'Users retrieved successfully';
        $data = ['users' => []];
        $pagination = [
            'current_page' => 1,
            'per_page' => 10,
            'total' => 0
        ];

        $response = ResponseHelper::paginated($message, $data, $pagination);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination
        ], json_decode($response->getContent(), true));
    }

    public function test_paginated_method_without_pagination()
    {
        $message = 'Users retrieved successfully';
        $data = ['users' => []];

        $response = ResponseHelper::paginated($message, $data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], json_decode($response->getContent(), true));
    }

    public function test_with_meta_method()
    {
        $message = 'Data retrieved successfully';
        $data = ['items' => []];
        $meta = ['version' => '1.0', 'timestamp' => time()];

        $response = ResponseHelper::withMeta($message, $data, $meta);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'meta' => $meta
        ], json_decode($response->getContent(), true));
    }

    public function test_with_meta_method_without_meta()
    {
        $message = 'Data retrieved successfully';
        $data = ['items' => []];

        $response = ResponseHelper::withMeta($message, $data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], json_decode($response->getContent(), true));
    }

    public function test_created_method()
    {
        $message = 'User created successfully';
        $data = ['id' => 1, 'name' => 'John Doe'];

        $response = ResponseHelper::created($message, $data);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_updated_method()
    {
        $message = 'User updated successfully';
        $data = ['id' => 1, 'name' => 'John Doe Updated'];

        $response = ResponseHelper::updated($message, $data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], json_decode($response->getContent(), true));
    }

    public function test_deleted_method()
    {
        $response = ResponseHelper::deleted();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => 'Resource deleted successfully.',
        ], json_decode($response->getContent(), true));
    }

    public function test_deleted_method_with_custom_message()
    {
        $message = 'User deleted successfully';
        $response = ResponseHelper::deleted($message);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'status' => true,
            'message' => $message,
        ], json_decode($response->getContent(), true));
    }
} 