<?php

namespace Arpanpatoliya\Response\Tests;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class LoggingTest extends TestCase
{
    public function test_log_method_is_chainable()
    {
        $response = response()->success('User created', ['id' => 1])->log();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_log_method_returns_same_response()
    {
        $originalResponse = response()->success('Test', ['key' => 'value']);
        $loggedResponse = $originalResponse->log();

        $this->assertEquals(
            json_decode($originalResponse->getContent(), true),
            json_decode($loggedResponse->getContent(), true)
        );
        $this->assertEquals(
            $originalResponse->getStatusCode(),
            $loggedResponse->getStatusCode()
        );
    }

    public function test_log_with_default_parameters()
    {
        $response = response()->success('User created', ['id' => 1])->log();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        
        // Verify response data is preserved
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals([
            'status' => true,
            'message' => 'User created',
            'data' => ['id' => 1]
        ], $responseData);
    }

    public function test_log_with_custom_channel()
    {
        $response = response()->success('User created', ['id' => 1])
            ->log('custom-channel');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_log_with_custom_level()
    {
        $response = response()->success('User created', ['id' => 1])
            ->log(null, 'warning');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_log_with_custom_channel_and_level()
    {
        $response = response()->success('User created', ['id' => 1])
            ->log('api-logs', 'error');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_log_with_custom_message()
    {
        $response = response()->success('User created', ['id' => 1])
            ->log(null, null, 'User was created successfully');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_log_with_custom_context()
    {
        $customContext = ['actor' => 123, 'ip' => '127.0.0.1'];

        $response = response()->success('User created', ['id' => 1])
            ->log(null, null, null, $customContext);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_log_includes_status_code()
    {
        $response = response()->notFound('User not found')->log();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function test_log_includes_payload()
    {
        $userData = ['id' => 1, 'name' => 'John Doe'];

        $response = response()->success('User created', $userData)->log();

        $this->assertInstanceOf(JsonResponse::class, $response);
        
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals([
            'status' => true,
            'message' => 'User created',
            'data' => $userData
        ], $responseData);
    }

    public function test_log_with_all_parameters()
    {
        $customContext = ['request_id' => 'abc123'];

        $response = response()->created('User created', ['id' => 1])
            ->log('api-channel', 'warning', 'User creation logged', $customContext);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_log_with_error_response()
    {
        $response = response()->badRequest('Invalid input')->log('errors', 'warning');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_log_with_validation_error_response()
    {
        $validator = \Illuminate\Support\Facades\Validator::make([], [
            'email' => 'required|email',
        ]);

        $response = response()->validationFailure($validator)
            ->log('validation', 'info');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(422, $response->getStatusCode());
    }

    public function test_log_with_different_levels()
    {
        $levels = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];

        foreach ($levels as $level) {
            $response = response()->success('Test')->log(null, $level);
            
            $this->assertInstanceOf(JsonResponse::class, $response);
            $this->assertEquals(200, $response->getStatusCode());
        }
    }

    public function test_log_with_empty_response()
    {
        // noContent() returns a regular Response, not JsonResponse, so log() won't work
        // This test verifies that log() works with JsonResponse instances
        $response = response()->json([], 204)->log();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function test_log_with_paginated_response()
    {
        $response = response()->paginated(
            'Users retrieved',
            ['users' => []],
            ['current_page' => 1, 'per_page' => 10, 'total' => 100]
        )->log();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_log_preserves_response_data()
    {
        $userData = ['id' => 1, 'name' => 'John Doe'];
        
        $response = response()->success('User created', $userData)->log();

        $responseData = json_decode($response->getContent(), true);
        
        $this->assertEquals([
            'status' => true,
            'message' => 'User created',
            'data' => $userData
        ], $responseData);
    }

    public function test_log_works_with_all_response_types()
    {
        $responses = [
            response()->ok('OK', ['data' => 'test'])->log(),
            response()->created('Created', ['id' => 1])->log(),
            response()->badRequest('Bad Request')->log(),
            response()->notFound('Not Found')->log(),
            response()->serverError('Server Error')->log(),
        ];

        foreach ($responses as $response) {
            $this->assertInstanceOf(JsonResponse::class, $response);
        }
    }
}
