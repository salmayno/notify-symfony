<?php

namespace Notify\Symfony\Tests\Twig;

use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Notify\NotifyManagerInterface;
use Notify\Symfony\Twig\NotifyTwigExtension;

class NotifyTwigExtensionTest extends TestCase
{
    public function test_notify_render_instance_of_function_expression()
    {
        $expected = "<script>toastr.success('success title')</script>";

        $manager = $this->getMockBuilder('Yoeunes\Notify\NotifyManagerInterface')->getMock();
        $manager->method('render')->willReturn($expected);

        $this->assertEquals($expected, $this->render('{{ notify_render() }}', $manager));
    }

    public function test_notify_css_instance_of_function_expression()
    {
        $expected = '<link rel="stylesheet" type="text/css" href="style.css" />';

        $manager = $this->getMockBuilder('Yoeunes\Notify\NotifyManagerInterface')->getMock();
        $manager->method('renderStyles')->willReturn($expected);

        $this->assertEquals($expected, $this->render('{{ notify_css() }}', $manager));
    }

    public function test_notify_js_instance_of_function_expression()
    {
        $expected = "<script>toastr.success('success title')</script>";

        $manager = $this->getMockBuilder('Yoeunes\Notify\NotifyManagerInterface')->getMock();
        $manager->method('renderScripts')->willReturn($expected);

        $this->assertEquals($expected, $this->render('{{ notify_js() }}', $manager));
    }

    private function render($template, NotifyManagerInterface $manager)
    {
        $twig = new Environment(new ArrayLoader(array('template' => $template)), array(
            'debug' => true, 'cache' => false, 'autoescape' => 'html', 'optimizations' => 0,
        ));

        $twig->addExtension(new NotifyTwigExtension($manager));

        return $twig->render('template');
    }
}
