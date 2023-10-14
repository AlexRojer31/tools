<?php

namespace Tools;

use PHPUnit\Framework\TestCase;
use Tools\Exceptions\JWTTokenException;

class JWTTest extends TestCase
{
    public $payload = [
        'userId' => 1,
        'userName' => 'Alex'
    ];

    public $sekret = 'sekret';

    public $token = 'eyJhbGciOiJzaGEyNTYiLCJ0eXAiOiJKV1QifQ==.eyJ1c2VySWQiOjEsInVzZXJOYW1lIjoiQWxleCJ9.8fdea21a2b3570f952c08fb72e9af6645e69a93071f9668f70b8b38dadadeffa';

    /**
     * @covers JWT::generateToken
     */
    public function testGenerateToken() : void
    {
        $jwt = new JWT();
        $this->assertEquals($jwt->generateToken($this->payload, $this->sekret), $this->token);
    }

    /**
     * @covers JWT::getPayload
     */
    public function testGetPayload() : void
    {
        $jwt = new JWT();
        $this->assertEquals(
            json_encode($jwt->getPayload($this->token, $this->sekret)),
            json_encode($this->payload)
        );
    }

    /**
     * @covers JWT::getPayload
     */
    public function testFailToken() : void
    {
        $this->expectException(JWTTokenException::class);
        $jwt = new JWT();
        $jwt->getPayload($this->token, 'failSekret');
    }
}

