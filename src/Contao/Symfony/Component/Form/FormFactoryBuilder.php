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


use ContaoBlackForest\Twig\Contao\TwigFormHandler;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;

class FormFactoryBuilder
{
    protected $formHandler;

    protected $formBuilder;

    protected $factory;

    public function __construct()
    {
        $this->getTwigFormHandler();
        $this->setFactory();
        $this->addCsrfProvider();
        $this->addValidator();
        $this->getFormFactory();
    }

    private function getTwigFormHandler()
    {
        $this->formHandler = new TwigFormHandler();
    }

    private function setFactory()
    {
        $this->formBuilder = Forms::createFormFactoryBuilder();
    }

    private function addCsrfProvider()
    {
        $this->getFormBuilder()->addExtension(new CsrfExtension($this->formHandler->getCsrfProvider()));
    }

    private function addValidator()
    {
        $this->getFormBuilder()->addExtension(new ValidatorExtension($this->formHandler->getValidator()));
    }

    private function getFormFactory()
    {
        $this->factory = $this->getFormBuilder()->getFormFactory();
    }

    /**
     * @return \Symfony\Component\Form\FormFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @return \Symfony\Component\Form\FormFactoryBuilder
     */
    public function getFormBuilder()
    {
        return $this->formBuilder;
    }

    /**
     * @return TwigFormHandler
     */
    public function getFormHandler()
    {
        return $this->formHandler;
    }
}
