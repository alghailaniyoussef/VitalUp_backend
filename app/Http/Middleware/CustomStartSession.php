<?php

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession;
use Symfony\Component\HttpFoundation\Cookie;
use Closure;

class CustomStartSession extends StartSession
{
    /**
     * Add the session cookie to the application response.
     *
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @param  \Illuminate\Contracts\Session\Session  $session
     * @return void
     */
    protected function addCookieToResponse($response, $session)
    {
        if ($this->sessionIsPersistent($config = $this->manager->getSessionConfig())) {
            $response->headers->setCookie(new Cookie(
                $session->getName(),
                $session->getId(),
                $this->getCookieExpirationDate(),
                $config['path'],
                null, // Force domain to null for cross-origin
                true, // Force secure=true
                $config['http_only'] ?? true,
                false,
                'none' // Force SameSite=none
            ));
        }
    }

    /**
     * Get the session lifetime in seconds.
     *
     * @return \DateTimeInterface|int
     */
    protected function getCookieExpirationDate()
    {
        $config = $this->manager->getSessionConfig();

        return $config['expire_on_close'] ? 0 : time() + ($config['lifetime'] * 60);
    }
}