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

class FormBuilder extends FormFactoryBuilder
{
    /** @var  \Symfony\Component\Form\FormBuilder $builder */
    protected $builder;

    public function __construct()
    {
        parent::__construct();

        $this->setBuilder();
        $this->setRequestToken();
    }

    private function setBuilder()
    {
        $this->builder = $this->getFactory()->createBuilder();
    }

    private function setRequestToken()
    {
        if (!\Config::get('disableRefererCheck')) {
            $this->builder->add('REQUEST_TOKEN', 'hidden', array(
                'data' => \RequestToken::get(),
            ));
        }
    }

    /**
     * @return \Symfony\Component\Form\FormBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
