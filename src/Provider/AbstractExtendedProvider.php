<?php

namespace Bogstag\OAuth2\Client\Provider;

use GuzzleHttp\Exception\BadResponseException;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Http\Message\RequestInterface;

abstract class AbstractExtendedProvider extends AbstractProvider
{
    /**
     * Returns the base URL for revoking an access token.
     *
     * Eg. https://oauth.service.com/revoke
     *
     * @return string
     */
    abstract public function getBaseRevokeAccessTokenUrl();

    /**
     * Revokes an access token.
     *
     * @param AccessTokenInterface $token
     * @throws BadResponseException
     * @return void
     */
    public function revokeAccessToken(AccessTokenInterface $token)
    {
        $params = [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'token'         => $token->getToken(),
        ];

        $request = $this->getRevokeAccessTokenRequest($params);

        $this->getResponse($request);
    }

    /**
     * Returns a prepared request for revoking an access token.
     *
     * @param array $params Post body parameters
     * @return RequestInterface
     */
    protected function getRevokeAccessTokenRequest(array $params)
    {
        $method = $this->getRevokeAccessTokenMethod();
        $url    = $this->getBaseRevokeAccessTokenUrl();

        return $this->getRequest($method, $url, $params);
    }

    /**
     * Returns the method to use when revoking an access token.
     *
     * @return string HTTP method
     */
    protected function getRevokeAccessTokenMethod()
    {
        return self::METHOD_POST;
    }
}
