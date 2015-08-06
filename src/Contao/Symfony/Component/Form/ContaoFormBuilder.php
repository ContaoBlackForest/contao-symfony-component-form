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

namespace Contao\Symfony\Component\Form;

/**
 * Class ContaoFormBuilder
 *
 * @package Contao\Symfony\Component\Form
 */
class ContaoFormBuilder extends FormBuilder
{
    public function __construct()
    {
        parent::__construct();

        $this->setBuilder();
        $this->setRequestToken();
    }

    private function setDefaults()
    {
        return array(
            'csrf_protection' => false,
        );
    }

    private function setBuilder()
    {
        $this->builder = $this->getFactory()->createNamedBuilder('', 'form', $this->setDefaults());
    }
}
