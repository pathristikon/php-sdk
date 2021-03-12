<?php

namespace Sameday\Tests\Responses;

use Exception;
use PHPUnit\Framework\TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Responses\SamedayAuthenticateResponse;

class SamedayAuthenticateResponseTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testConstructorParameters()
    {
        $request = $this->createMock('Sameday\Requests\SamedayAuthenticateRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayAuthenticateResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws Exception
     */
    public function testResponse()
    {
        $request = $this->createMock('Sameday\Requests\SamedayAuthenticateRequest');
        $rawResponse = new SamedayRawResponse([], '{"token":"foo","expire_at":"2010-01-02 12:23"}', 200);
        $response = new SamedayAuthenticateResponse($request, $rawResponse);

        $this->assertEquals('foo', $response->getToken());
        $this->assertEquals('2010-01-02 12:23:00', $response->getExpiresAt()->format('Y-m-d H:i:s'));
    }
}
