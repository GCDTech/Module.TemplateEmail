<?php

namespace Gcdtech\TemplateEmail;

use Rhubarb\Crown\Sendables\Email\Email;

abstract class TwigTemplateEmail extends Email
{
    /**
     * @var string
     */
    private $templatePath;

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        $loader = new \Twig_Loader_Filesystem(dirname($this->templatePath));
        $twig = new \Twig_Environment($loader);

        $template = $twig->load(basename($this->templatePath));

        return $template->render($this->getData());
    }

    /**
     * Returns the data to be used in the twig template.
     *
     * @return array
     */
    protected abstract function getData(): array;


    /**
     * Sendable types must be able to return a text representation of it's message body.
     *
     * This is used by sending frameworks to store and index outgoing communications.
     *
     * @return string
     */
    public function getText()
    {
        // TODO: Implement getText() method.
    }

    /**
     * Expresses the sendable as an array allowing it to be serialised, stored and recovered later.
     *
     * @return array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}