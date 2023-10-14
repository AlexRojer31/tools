<?php

namespace Tools;

use PHPUnit\Framework\TestCase;
use Tools\Exceptions\JWTTokenException;

class JWTTest extends TestCase
{
    public $payload = [
        'userId' => 1,
        'user_name' => 'Alex'
    ];

    public $secret = 'secret';

    public $token = 'eyJhbGciOiJzaGEyNTYiLCJ0eXAiOiJKV1QifQ==.eyJ1c2VySWQiOjEsInVzZXJfbmFtZSI6IkFsZXgifQ==.adee0532162fd9f05485bbdb14019bd2807fb109c76bf161c61ba5840c7567a0';

    /**
     * @covers JWT::generateToken
     */
    public function testGenerateToken() : void
    {
        $jwt = new JWT();
        $this->assertEquals($jwt->generateToken($this->payload, $this->secret), $this->token);
    }

    /**
     * @covers JWT::getPayload
     */
    public function testGetPayload() : void
    {
        $jwt = new JWT();
        $this->assertEquals(
            json_encode($jwt->getPayload($this->token, $this->secret)),
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
        $jwt->getPayload($this->token, 'failSecret');
    }
}

