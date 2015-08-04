<?php

/**
 * Contao Symfony Component Form
 * Copyright (C) 2015 ContaoBlackForest
 *
 * PHP version 5
 *
 * @package   contaoblackforest/contao-symfony-component-form
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   LGPL-3.0+
 * @copyright ContaoBlackforest 2015
 */

namespace Contao\Symfony\Component\Form\Security;

use Contao\RequestToken;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfProviderInterface;

/**
 * class ContaoCsrfProvider
 *
 * CSRF provider class for Contao
 */
class ContaoCsrfProvider implements CsrfProviderInterface
{
    protected $token;

    public function __construct()
    {
        $this->token = RequestToken::get();
    }


    /**
     * Generates a CSRF token for a page of your application.
     *
     * @param string $intention Some value that identifies the action intention
     *                          (i.e. "authenticate"). Doesn't have to be a secret value.
     *
     * @return string The generated token
     */
    public function generateCsrfToken($intention)
    {
        return $this->token;
    }

    /**
     * Validates a CSRF token.
     *
     * @param string $intention The intention used when generating the CSRF token
     * @param string $token     The token supplied by the browser
     *
     * @return bool Whether the token supplied by the browser is correct
     */
    public function isCsrfTokenValid($intention, $token)
    {
        // TODO: Implement isCsrfTokenValid() method.
    }
}
