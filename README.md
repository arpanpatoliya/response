# Laravel Response Package

[![Latest Version](https://img.shields.io/packagist/v/arpanpatoliya/response.svg?style=flat-square)](https://packagist.org/packages/arpanpatoliya/response)
[![License](https://img.shields.io/packagist/l/arpanpatoliya/response.svg?style=flat-square)](LICENSE)

A comprehensive Laravel package for standardized API responses with full HTTP status code coverage and response macros.

<!-- SEO Keywords: Laravel API Response, Laravel JSON Response, Laravel Response Macros, Laravel HTTP Status Codes, Laravel API Standardization, Laravel Response Helper, Laravel API Format, Laravel Response Package, Laravel API Best Practices, Laravel Response Library, Laravel API Documentation, Laravel Response Examples, Laravel API Development, Laravel Response Utilities, Laravel API Testing -->

## 📋 Table of Contents

- [Features](#-features)
- [Installation](#-installation)
- [Quick Start](#-quick-start)
- [Usage](#-usage)
- [HTTP Status Codes](#-http-status-codes)
- [Response Format](#-response-format)
- [Examples](#-examples)
- [Testing](#-testing)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

- 🚀 **76 Response Macros** - Complete HTTP status code coverage
- 📊 **Standardized Format** - Consistent JSON response structure
- 🎯 **Easy to Use** - Simple, intuitive API
- 🔧 **Flexible** - Custom status codes and messages
- 📄 **Validation Support** - Built-in validation error handling
- 📱 **Pagination Support** - Easy paginated responses
- 🏷️ **Metadata Support** - Add custom metadata to responses
- 📝 **Logging Integration** - Chainable logging for responses
- 🧪 **Fully Tested** - Comprehensive test coverage
- 📚 **Well Documented** - Complete documentation and examples
- ⚡ **Lightweight** - Minimal overhead, maximum functionality

## 🛠️ Installation

1. Install the package via Composer:

```bash
composer require arpanpatoliya/response
```

2. The service provider will be automatically registered via Laravel's package discovery.

## 🚀 Quick Start

```php
// Basic success response
return response()->success('User created successfully', $userData);

// Error response
return response()->notFound('User not found');

// Validation error
return response()->validationFailure($validator);

// Custom status code
return response()->conflict('Resource already exists');
```

## 📖 Usage

### Basic Success Responses

```php
// Success with data (200)
return response()->success('User created successfully', $userData);

// Success message only (200)
return response()->successMessage('User updated successfully');

// Resource created (201)
return response()->created('User created successfully', $userData);

// Resource updated (200)
return response()->updated('User updated successfully', $userData);

// Resource deleted (200)
return response()->deleted('User deleted successfully');

// Accepted (202)
return response()->accepted('Request accepted for processing');
```

### Error Responses

```php
// Basic error (200)
return response()->errorMessage('User not found');

// Error with custom status code
return response()->error('Bad request', 400);

// HTTP status specific errors
return response()->badRequest('Invalid input data');
return response()->unauthorized('Invalid credentials');
return response()->forbidden('Access denied');
return response()->notFound('User not found');
return response()->conflict('Resource already exists');
return response()->tooManyRequests('Rate limit exceeded');
return response()->serverError('Database connection failed');
```

### Validation Responses

```php
// Validation failure (422)
return response()->validationFailure($validator);
```

### Advanced Responses

```php
// Custom response
return response()->custom(true, 'Custom response', $data, 201);

// Paginated response
return response()->paginated('Users retrieved', $users, $pagination);

// Response with metadata
return response()->withMeta('Data retrieved', $data, $meta);

// No content response (204)
return response()->noContent();
```

### Logging Integration

The package provides a chainable `log()` method to log responses to Laravel's logging system. By default, logs are written to the default logging channel.

```php
// Basic logging (default channel, info level)
return response()->success('User created', $user)->log();

// With custom channel
return response()->success('User created', $user)->log('custom-channel');

// With channel and custom log level
return response()->success('User created', $user)->log('custom-channel', 'warning');

// With channel, level, and custom message
return response()->success('User created', $user)->log('custom-channel', 'info', 'User was created successfully', ['actor' => auth()->id()]);

// With just level (default channel)
return response()->success('User created', $user)->log(null, 'error');

// With just custom message (default channel, info level)
return response()->success('User created', $user)->log(null, null, 'Custom log message');

// Logging error responses
return response()->notFound('User not found')->log('api-errors', 'warning');

// Logging validation failures
return response()->validationFailure($validator)->log('validation', 'info');
```

**Log Parameters:**
- `$channel` (optional): Specify a custom logging channel. If not provided, uses the default channel.
- `$level` (optional): PSR-3 log level (`emergency`, `alert`, `critical`, `error`, `warning`, `notice`, `info`, `debug`). Defaults to `info`.
- `$message` (optional): Custom log message. Defaults to `'API response'`.
- `$context` (optional): Additional context array to include in the log entry.

**Log Context:**
The log automatically includes:
- `status`: HTTP status code
- `payload`: Response payload/data
- Any additional context you pass



## 🌐 HTTP Status Codes

### 1xx Informational
| Macro | Status | Description |
|-------|--------|-------------|
| `continue()` | 100 | Continue |
| `switchingProtocols()` | 101 | Switching Protocols |
| `processing()` | 102 | Processing |
| `earlyHints()` | 103 | Early Hints |

### 2xx Success
| Macro | Status | Description |
|-------|--------|-------------|
| `ok()` | 200 | OK |
| `success()` | 200 | Success with data |
| `successMessage()` | 200 | Success message only |
| `created()` | 201 | Created |
| `accepted()` | 202 | Accepted |
| `nonAuthoritativeInformation()` | 203 | Non-Authoritative Information |
| `noContent()` | 204 | No Content |
| `resetContent()` | 205 | Reset Content |
| `partialContent()` | 206 | Partial Content |
| `multiStatus()` | 207 | Multi-Status |
| `alreadyReported()` | 208 | Already Reported |
| `imUsed()` | 226 | IM Used |

### 3xx Redirection
| Macro | Status | Description |
|-------|--------|-------------|
| `multipleChoices()` | 300 | Multiple Choices |
| `movedPermanently()` | 301 | Moved Permanently |
| `found()` | 302 | Found |
| `seeOther()` | 303 | See Other |
| `notModified()` | 304 | Not Modified |
| `useProxy()` | 305 | Use Proxy |
| `temporaryRedirect()` | 307 | Temporary Redirect |
| `permanentRedirect()` | 308 | Permanent Redirect |

### 4xx Client Errors
| Macro | Status | Description |
|-------|--------|-------------|
| `badRequest()` | 400 | Bad Request |
| `unauthorized()` | 401 | Unauthorized |
| `paymentRequired()` | 402 | Payment Required |
| `forbidden()` | 403 | Forbidden |
| `notFound()` | 404 | Not Found |
| `methodNotAllowed()` | 405 | Method Not Allowed |
| `notAcceptable()` | 406 | Not Acceptable |
| `proxyAuthenticationRequired()` | 407 | Proxy Authentication Required |
| `requestTimeout()` | 408 | Request Timeout |
| `conflict()` | 409 | Conflict |
| `gone()` | 410 | Gone |
| `lengthRequired()` | 411 | Length Required |
| `preconditionFailed()` | 412 | Precondition Failed |
| `payloadTooLarge()` | 413 | Payload Too Large |
| `uriTooLong()` | 414 | URI Too Long |
| `unsupportedMediaType()` | 415 | Unsupported Media Type |
| `rangeNotSatisfiable()` | 416 | Range Not Satisfiable |
| `expectationFailed()` | 417 | Expectation Failed |
| `imATeapot()` | 418 | I'm a teapot |
| `misdirectedRequest()` | 421 | Misdirected Request |
| `unprocessableEntity()` | 422 | Unprocessable Entity |
| `locked()` | 423 | Locked |
| `failedDependency()` | 424 | Failed Dependency |
| `tooEarly()` | 425 | Too Early |
| `upgradeRequired()` | 426 | Upgrade Required |
| `preconditionRequired()` | 428 | Precondition Required |
| `tooManyRequests()` | 429 | Too Many Requests |
| `requestHeaderFieldsTooLarge()` | 431 | Request Header Fields Too Large |
| `unavailableForLegalReasons()` | 451 | Unavailable For Legal Reasons |

### 5xx Server Errors
| Macro | Status | Description |
|-------|--------|-------------|
| `internalServerError()` | 500 | Internal Server Error |
| `serverError()` | 500 | Server Error (alias) |
| `notImplemented()` | 501 | Not Implemented |
| `badGateway()` | 502 | Bad Gateway |
| `serviceUnavailable()` | 503 | Service Unavailable |
| `gatewayTimeout()` | 504 | Gateway Timeout |
| `httpVersionNotSupported()` | 505 | HTTP Version Not Supported |
| `variantAlsoNegotiates()` | 506 | Variant Also Negotiates |
| `insufficientStorage()` | 507 | Insufficient Storage |
| `loopDetected()` | 508 | Loop Detected |
| `notExtended()` | 510 | Not Extended |
| `networkAuthenticationRequired()` | 511 | Network Authentication Required |

### Utility Methods
| Macro | Status | Description |
|-------|--------|-------------|
| `errorMessage()` | 200 | Basic error message |
| `error()` | Variable | Error with custom status |
| `validationFailure()` | 422 | Validation errors |
| `custom()` | Variable | Custom response |
| `paginated()` | 200 | Paginated response |
| `withMeta()` | 200 | Response with metadata |
| `updated()` | 200 | Resource updated |
| `deleted()` | 200 | Resource deleted |

### Logging Method
| Method | Description |
|-------|-------------|
| `log()` | Chainable logging method for responses. Supports custom channel, level, message, and context. |

## 📄 Response Format

### Success Response
```json
{
    "status": true,
    "message": "Success message",
    "data": {} // Optional data
}
```

### Error Response
```json
{
    "status": false,
    "message": "Error message",
    "errors": {} // For validation errors
}
```

### Paginated Response
```json
{
    "status": true,
    "message": "Success message",
    "data": [],
    "pagination": {
        "current_page": 1,
        "per_page": 10,
        "total": 100
    }
}
```

### Response with Metadata
```json
{
    "status": true,
    "message": "Success message",
    "data": [],
    "meta": {
        "version": "1.0",
        "timestamp": 1234567890
    }
}
```

## 💡 Examples

### Complete User Controller Example

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->validationFailure($validator);
        }

        try {
            $user = User::create($request->all());
            return response()->created('User created successfully', $user);
        } catch (\Exception $e) {
            return response()->serverError('Failed to create user');
        }
    }

    public function index(Request $request)
    {
        try {
            $users = User::paginate(10);
            
            return response()->paginated(
                'Users retrieved successfully',
                $users->items(),
                [
                    'current_page' => $users->currentPage(),
                    'per_page' => $users->perPage(),
                    'total' => $users->total(),
                    'last_page' => $users->lastPage()
                ]
            );
        } catch (\Exception $e) {
            return response()->serverError('Failed to retrieve users');
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->notFound('User not found');
        }

        return response()->success('User retrieved successfully', $user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->notFound('User not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id
        ]);

        if ($validator->fails()) {
            return response()->validationFailure($validator);
        }

        try {
            $user->update($request->all());
            return response()->updated('User updated successfully', $user);
        } catch (\Exception $e) {
            return response()->serverError('Failed to update user');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->notFound('User not found');
        }

        try {
            $user->delete();
            return response()->deleted('User deleted successfully');
        } catch (\Exception $e) {
            return response()->serverError('Failed to delete user');
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return response()->badRequest('No user IDs provided');
        }

        try {
            $deletedCount = User::whereIn('id', $ids)->delete();
            
            if ($deletedCount === 0) {
                return response()->notFound('No users found to delete');
            }

            return response()->success("Successfully deleted {$deletedCount} users");
        } catch (\Exception $e) {
            return response()->serverError('Failed to delete users');
        }
    }
}
```

### Advanced Usage Examples

```php
// Rate limiting
if ($this->isRateLimited()) {
    return response()->tooManyRequests('Rate limit exceeded. Try again in 60 seconds.');
}

// File upload validation
if ($request->file('image')->getSize() > 5242880) { // 5MB
    return response()->payloadTooLarge('File size exceeds maximum limit of 5MB');
}

// Maintenance mode
if ($this->isMaintenanceMode()) {
    return response()->serviceUnavailable('System is under maintenance. Please try again later.');
}

// Custom response with metadata
return response()->withMeta(
    'Data retrieved successfully',
    $data,
    [
        'version' => '1.0.0',
        'timestamp' => now()->timestamp,
        'cache_hit' => true
    ]
);

// Partial content for large datasets
return response()->partialContent('Partial data retrieved', $partialData);

// Conflict resolution
if ($this->hasConflict($data)) {
    return response()->conflict('Resource already exists with these parameters');
}
```

## 🧪 Testing

To run the tests for this package:

```bash
composer test
```

Or run PHPUnit directly:

```bash
./vendor/bin/phpunit
```

The tests cover all response macros, ensuring they return the correct status codes and response formats.

### Test Coverage

- ✅ All HTTP status code macros (100+ methods)
- ✅ Response format validation
- ✅ Status code verification
- ✅ Error handling
- ✅ Validation responses
- ✅ Pagination responses
- ✅ Metadata responses
- ✅ Custom responses
- ✅ Logging integration

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

### Development Setup

1. Fork the repository
2. Clone your fork
3. Install dependencies: `composer install`
4. Run tests: `composer test`
5. Make your changes
6. Add tests for new features
7. Submit a pull request

## 👨‍💻 Author

**Arpan Patoliya**

- **Email:** info.arpan08@gmail.com
- **GitHub:** [@arpanpatoliya](https://github.com/arpanpatoliya)
- **LinkedIn:** [Arpan Patoliya](https://www.linkedin.com/in/arpan-patoliya-1b16961b6/)

### About the Author

Arpan is a passionate Laravel developer with expertise in building robust and scalable web applications. This package was created to provide a comprehensive solution for standardized API responses in Laravel applications.

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

---

**Made with ❤️ by Arpan Patoliya**

If you find this package helpful, please consider giving it a ⭐ on GitHub!

<!-- SEO Keywords: Laravel API Response, Laravel JSON Response, Laravel Response Macros, Laravel HTTP Status Codes, Laravel API Standardization, Laravel Response Helper, Laravel API Format, Laravel Response Package, Laravel API Best Practices, Laravel Response Library, Laravel API Documentation, Laravel Response Examples, Laravel API Development, Laravel Response Utilities, Laravel API Testing, Laravel REST API, Laravel API Framework, Laravel Response Builder, Laravel API Response Format, Laravel HTTP Response, Laravel API Helper, Laravel Response Standardization, Laravel API Utilities, Laravel Response Library, Laravel API Development Tools --> 
