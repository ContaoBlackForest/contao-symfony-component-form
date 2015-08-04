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

namespace ContaoBlackForest\Twig\Contao\Translator;


use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Loader\YamlFileLoader;

class Translator extends \Symfony\Component\Translation\Translator
{
    public function __construct(array $config)
    {
        $this->config = $config;

        parent::__construct($GLOBALS['TL_LANGUAGE']);

        $this->setFallbackLocales(array('en'));
    }

    protected function issetLoader(array $loaders)
    {
        foreach ($loaders as $loader) {
            if (!array_key_exists($loader, $this->getLoaders())) {
                switch ($loader) {
                    case 'xlf':
                        $this->addLoader($loader, new XliffFileLoader());
                        break;
                    case 'yml':
                        $this->addLoader($loader, new YamlFileLoader());
                        break;
                    default:
                        //Todo: Throw message loader is not defined
                        break;
                }
            }
        }
    }

    public function addStandardValidatorResource()
    {
        $this->issetLoader(array('xlf'));

        foreach ($this->getFallbackLocales() as $fallback) {
            if (file_exists($path = realpath($this->config['vendorValidatorDir'] . '/Resources/translations/validators.' . $fallback . '.xlf'))) {
                $this->addResource('xlf', $path, $fallback, 'validators');
            }
            if (file_exists($path = realpath($this->config['vendorFormDir'] . '/Resources/translations/validators.' . $fallback . '.xlf'))) {
                $this->addResource('xlf', $path, $fallback, 'validators');
            }
        }

        if ($GLOBALS['TL_LANGUAGE'] != 'en') {
            if (file_exists($path = realpath($this->config['vendorValidatorDir'] . '/Resources/translations/validators.' . $GLOBALS['TL_LANGUAGE'] . '.xlf'))) {
                $this->addResource('xlf', $path, $GLOBALS['TL_LANGUAGE'], 'validators');
            }
            if (file_exists($path = realpath($this->config['vendorFormDir'] . '/Resources/translations/validators.' . $GLOBALS['TL_LANGUAGE'] . '.xlf'))) {
                $this->addResource('xlf', $path, $GLOBALS['TL_LANGUAGE'], 'validators');
            }
        }
    }
}
