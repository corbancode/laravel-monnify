<?php

namespace Corbancode\Monnify\Helpers;
use Carbon\Carbon;

class Authentication
{

    /**
     * Authorization token cache key.
     *
     *
     */
    protected $tokenCacheKey = 'monnify_access_token';

    /**
     * Get authorization token
     *
     * @return string
     */
    public function getToken() {
        if ($token = cache($this->tokenCacheKey))
            return $token;

        if ($response = $this->login())
        {
            $token = $response->accessToken;
            $now = Carbon::now();
            $parseExpiresIn = Carbon::parse($response->expiresIn)->toDateTimeString();
            $expiresIn = Carbon::create($parseExpiresIn)->subSeconds(60);
            $seconds = $expiresIn->diffInSeconds($now);
            cache([$this->tokenCacheKey => $token], $seconds);
            return $token;
        }
    }

    /**
     * Login request
     *
     * @return object
     */
    private function login()
    {
        $apiKey = config('monnify.api_key');
        $clientSecret = config('monnify.secret_key');
        $base64 = base64_encode("{$apiKey}:{$clientSecret}");

        try {
            $client = new \GuzzleHttp\Client([
                'base_uri' => config('monnify.base_uri'),
                'headers' => [
                    'content-type' => 'application/json; charset=utf-8',
                    'authorization' => 'Basic ' . $base64
                ]
            ]);
            $response = $client->post('auth/login', [
                'json' => $params
            ]);

            $status = $response->getStatusCode();
            if ($status === 200)
                $body = json_decode($response->getBody());
                return $body;
        } catch (\Exception $e) {
            \Log::debug($e->getMessage());
        }

        return null;
    }

}
