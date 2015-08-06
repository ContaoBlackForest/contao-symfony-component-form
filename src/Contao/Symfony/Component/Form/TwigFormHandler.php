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

use Contao\RequestToken;
use Contao\Symfony\Component\Form\Translator\Translator;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Validator\Validation;

class TwigFormHandler
{
    protected $config;

    /** @var  \ContaoTwig */
    protected $twig;

    protected $validator;

    public function __construct()
    {
        $this->setConfig();
        $this->setValidator();
        $this->setTwig();
        $this->setTranslatorToTwig();
        $this->setFormEngine();
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->config)) {
            return $this->config[$name];
        }

        return $this->$name;
    }

    private function setConfig()
    {
        $vendorDir = realpath(TL_ROOT . '/composer/vendor');

        $this->config = array(
            'defaultFormTheme' => 'form_div_layout.html.twig',
            'vendorDir' => $vendorDir,
            'vendorFormDir' => $vendorDir . '/symfony/form',
            'vendorValidatorDir' => $vendorDir . '/symfony/validator',
            'vendorTwigBridgeDir' => $vendorDir . '/symfony/twig-bridge',
        );
    }

    private function setValidator()
    {
        $this->validator = Validation::createValidator();
    }

    private function setTwig()
    {
        $this->twig = \ContaoTwig::getInstance();

        if (file_exists($path = realpath($this->vendorTwigBridgeDir . '/Resources/views/Form'))) {
            $this->getTwig()->getLoaderFilesystem()->addPath($path);
        }
    }

    private function setTranslatorToTwig()
    {
        // Set up the Translation component
        $translator = new Translator($this->config);
        $translator->addStandardValidatorResource();

        $this->getTwig()->getEnvironment()->addExtension(new TranslationExtension($translator));
    }

    private function setFormEngine()
    {
        $formEngine = new TwigRendererEngine(array($this->defaultFormTheme));
        $formEngine->setEnvironment($this->getTwig()->getEnvironment());

        $this->getTwig()->getEnvironment()->addExtension(new FormExtension(new TwigRenderer($formEngine)));
    }

    /**
     * @return mixed
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @return \ContaoTwig
     */
    public function getTwig()
    {
        return $this->twig;
    }
}
