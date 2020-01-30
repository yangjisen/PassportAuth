<?php


namespace YangJiSen\PassportAuth\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use YangJiSen\PassportAuth\Exceptions\ProxyException;

class Proxy
{
    private $http;

    /**
     * Login constructor.
     * @param $http
     */
    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    /**
     * php artisan passport:client --password
     * @param array $attribute
     * @return \Illuminate\Http\JsonResponse
     * @throws ProxyException
     */
    public function PasswordClient(array $attribute)
    {
        $attribute = array_merge($attribute, [
            'client_id'     => config('auth.passport.client_id'),
            'client_secret' => config('auth.passport.client_secret'),
            'grant_type'    => 'password'
        ]);

        try {
            $response = $this->http->post(
                url('/oauth/token'),
                ['form_params' => $attribute]
            )->getBody();

            return response()->json([
                'status'=> 200,
                'data'  => json_decode((string) $response, true),
                'message' => [
                    'token_type'    => 'Token 类型',
                    'expires_in'    => 'Token 有效期(秒)',
                    'access_token'  => 'Authorization:Bearer',
                    'refresh_token' => '刷新Access Token时使用'
                ]
            ]);

        } catch (Exception $exception) {
            throw new ProxyException($exception->getMessage());
        }
    }
}
