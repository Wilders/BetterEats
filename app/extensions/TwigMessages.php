<?php

namespace app\extensions;

use Slim\Flash\Messages;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class TwigMessages
 * @link https://github.com/kanellov/slim-twig-flash for the canonical source repository
 * @package app\extensions
 */
final class TwigMessages extends AbstractExtension {

    protected Messages $flash;

    public function __construct(Messages $flash) {
        $this->flash = $flash;
    }

    public function getName() {
        return 'slim-twig-flash';
    }

    public function getFunctions() {
        return [
            new TwigFunction('flash', [$this, 'getMessages']),
        ];
    }

    public function getMessages($key = null) {
        if ($key !== null) {
            return $this->flash->getMessage($key);
        }

        return $this->flash->getMessages();
    }
}