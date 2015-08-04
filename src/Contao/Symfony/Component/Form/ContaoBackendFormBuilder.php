<?php

/**
 * Contao News translation
 * Copyright (C) 2015 ContaoBlackForest
 *
 * PHP version 5
 *
 * @package   contaoblackforest/contao-news-translate
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   LGPL-3.0+
 * @copyright ContaoBlackforest 2015
 */


namespace ContaoBlackForest\Twig\Contao\Form;


class ContaoBackendFormBuilder extends FormBuilder
{
    public function __construct()
    {
        parent::__construct();

        $this->setBuilder();
    }

    private function setDefaults()
    {
        return array(
            'csrf_field_name' => 'REQUEST_TOKEN',
            'attr' => array(
                'class' => 'tl_formbody_edit',
            )
        );
    }

    private function setBuilder()
    {
        $this->builder = $this->getFactory()->createNamedBuilder('', 'form', array(), $this->setDefaults());
    }
}
