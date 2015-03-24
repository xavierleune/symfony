<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\IpRetriever;


use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Request;

/**
 * IpRetriever
 *
 * Can retrieve real user ip from various contexts (proxified query or not).
 * If you use a reverse proxy, set his ip with setTrustedProxies
 * otherwise, you'll get your reverse proxy ip anyway.
 *
 * @author Xavier Leune <xavier.leune@gmail.com>
 */
class LegacyIpRetriever extends IpRetriever
{
    /**
     * Gets the list of trusted proxies.
     *
     * @return array An array of trusted proxies.
     */
    public function getTrustedProxies()
    {
        return $this->trustedProxies;
    }


    /**
     * Sets a list of trusted proxies.
     *
     * You should only list the reverse proxies that you manage directly.
     *
     * @param array $proxies A list of trusted proxies
     *
     * @api
     */
    public function setTrustedProxies(array $proxies)
    {
        $this->trustedProxies = $proxies;
    }

    /**
     * Sets the name for trusted headers.
     *
     * Setting an empty value allows to disable the trusted header for the given key.
     *
     * @param string $key   The header key
     * @param string $value The header name
     *
     * @throws \InvalidArgumentException
     */

    public function setTrustedHeaderName($key, $value)
    {
        if (!array_key_exists($key, $this->trustedHeaders)) {
            throw new \InvalidArgumentException(sprintf('Unable to set the trusted header name for key "%s".', $key));
        }

        $this->trustedHeaders[$key] = $value;
    }

    /**
     * Gets the trusted proxy header name.
     *
     * @param string $key The header key
     *
     * @return string The header name
     *
     * @throws \InvalidArgumentException
     */
    public function getTrustedHeaderName($key)
    {
        if (!array_key_exists($key, $this->trustedHeaders)) {
            throw new \InvalidArgumentException(sprintf('Unable to get the trusted header name for key "%s".', $key));
        }

        return $this->trustedHeaders[$key];
    }
}
