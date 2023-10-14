<?php
namespace Tools;

use Tools\Exceptions\JWTTokenException;

/**
 * Генератор рандомных значений
 * и хэшей
 */
class JWT
{
    /**
     * Заголовок JWT токена
     *
     * @var array
     */
    private $header = [
        'alg' => 'sha256',
        'typ' => 'JWT'
    ];

    /**
     * Генерация JWT токена
     *
     * @param array $payload
     * @param string $secret
     *
     * @return string
     */
    public function generateToken(array $payload, string $secret): string
    {
        $header = json_encode($this->header);
        $payload = json_encode($payload);
        $unsignedToken = base64_encode($header) . '.' . base64_encode($payload);
        $signature = hash_hmac('sha256', $unsignedToken, $secret);
        return $unsignedToken . '.' . $signature;
    }

    /**
     * Получение payload JWT токена
     *
     * @param string $token
     * @param string $secret
     *
     * @return array
     */
    public function getPayload(string $token, string $secret): array
    {
        $arr = explode('.', $token);
        if (count($arr) !== 3) {
            throw new JWTTokenException('Недопустимый размер токена - ' . $token);
        }

        $header = $arr[0];
        $alg = json_decode(base64_decode($header), true)['alg'];
        if ($alg !== 'sha256') {
            throw new JWTTokenException('Недопустимый алгоритм шифрования - ' . $alg);
        }

        $payload = $arr[1];
        $signature = $arr[2];

        if ($signature !== hash_hmac($alg, $header . '.' . $payload, $secret)) {
            throw new JWTTokenException('Недействительная подпись');
        }

        return json_decode(base64_decode($payload), true);
    }
}
