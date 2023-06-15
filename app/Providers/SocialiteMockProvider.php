<?php

namespace App\Providers;

use Laravel\Socialite\Two\User;

class SocialiteMockProvider extends \Laravel\Socialite\Two\AbstractProvider
{

    /**
     * @inheritDoc
     */
    protected function getAuthUrl($state)
    {
        if(str_ends_with($this->getMockUrl(), '/')){
            return $this->getMockUrl() . 'oauth/authorize';
        }
        return $this->buildAuthUrlFromBase($this->getMockUrl() . '/oauth/authorize', $state);
    }

    /**
     * @inheritDoc
     */
    protected function getTokenUrl()
    {
        if(str_ends_with($this->getMockUrl(), '/')){
            return $this->getMockUrl() . 'oauth/token';
        }
        return $this->getMockUrl() . '/oauth/token';
    }

    /**
     * @inheritDoc
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->getMockUrl() . '/userinfo', [
            'headers' => [
                'cache-control' => 'no-cache',
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['sub'],
            'email' => $user['email'],
            'name' => "Servidor de teste não tem nome",
        ]);
    }

    public function getMockUrl()
    {
        return config('services.mock.base_uri');
    }

}
