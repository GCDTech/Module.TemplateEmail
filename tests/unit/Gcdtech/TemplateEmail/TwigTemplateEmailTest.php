<?php

namespace Gcdtech\TemplateEmail;

class TwigTemplateEmailTest extends TwigTemplateTestCase
{
    public function testTemplateLoads()
    {
        $test = new TestTwigEmail();
        $html = $test->getHtml();

        verify($html)->contains("test");

        $test2 = new TestTwigEmail2();
        $html = $test2->getHtml();

        verify($html)->equals('yip');
    }

    public function testTemplateMailMerges()
    {
        $test = new TestTwigEmail("Sean McGarrity");

        $html = $test->getHtml();

        verify($html)->contains("test Sean McGarrity");
    }
}

class TestTwigEmail extends TwigTemplateEmail
{
    /**
     * @var string
     */
    private $name;
    /** @var  \Twig_Environment $twig */
    private $twig;

    public function __construct($name = "")
    {
        $this->name = $name;

        parent::__construct(__DIR__.'/Template.html');
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        // TODO: Implement getSubject() method.
    }

    protected function getData(): array
    {
        return ['name' => $this->name];
    }
}

class TestTwigEmail2 extends TwigTemplateEmail
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/Template2.html');
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        // TODO: Implement getSubject() method.
    }

    protected function getData(): array
    {
        return [];
    }
}
