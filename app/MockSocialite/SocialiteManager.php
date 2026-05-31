<?php

namespace Laravel\Socialite;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class SocialiteManager
{
    /**
     * Get a driver instance.
     *
     * @param string|null $driver
     * @return GoogleProvider
     */
    public function driver($driver = null)
    {
        return new GoogleProvider();
    }
}

class GoogleProvider
{
    /**
     * Redirect the user of the provider to the authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect()
    {
        $url = 'https://accounts.google.com/o/oauth2/auth?' . http_build_query([
            'client_id' => config('services.google.client_id', 'mock-google-client-id'),
            'redirect_uri' => config('services.google.redirect', 'http://localhost:8000/auth/google/callback'),
            'response_type' => 'code',
            'scope' => 'openid profile email',
            'state' => 'mock-state',
        ]);
        
        return Redirect::away($url);
    }

    /**
     * Set the request instance.
     *
     * @return $this
     */
    public function stateless()
    {
        return $this;
    }

    /**
     * Get the User instance for the authenticated user.
     *
     * @return SocialiteUser
     */
    public function user()
    {
        // Dalam mode pengembangan lokal tanpa internet, kita bisa meloloskan data Google buatan
        return new SocialiteUser([
            'id' => request('google_id', 'mock-google-id-12345'),
            'email' => request('email', 'mock-user@gmail.com'),
            'name' => request('name', 'Mock Google User'),
        ]);
    }
}

class SocialiteUser
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function getName()
    {
        return $this->attributes['name'];
    }
}
