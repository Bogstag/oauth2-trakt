<?php namespace Bogstag\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class TraktResourceOwner implements ResourceOwnerInterface
{

    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array $response
     */
    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    /**
     * Get username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->response['user']['username'] ?: null;
    }

    /**
     * Get user name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->response['user']['name'] ?: null;
    }

    /**
     * Get user avatarurl
     *
     * @return string|null
     */
    public function getAvatarUrl()
    {
        return $this->response['user']['images']['avatar']['full'] ?: null;
    }

    /**
     * Get user id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->response['user']['ids']['slug'] ?: null;
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
