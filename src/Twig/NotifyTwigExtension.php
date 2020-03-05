<?php

namespace Yoeunes\Notify\Symfony\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Yoeunes\Notify\NotifyManagerInterface;

final class NotifyTwigExtension extends AbstractExtension
{
    private $manager;

    public function __construct(NotifyManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getFunctions()
    {
        $options = array('is_safe' => array('html'));

        return array(
            new TwigFunction('notify_render', array($this, 'notifyRender'), $options),
            new TwigFunction('notify_css', array($this, 'notifyCss'), $options),
            new TwigFunction('notify_js', array($this, 'notifyJs'), $options),
        );
    }

    public function notifyRender()
    {
        return $this->manager->render();
    }

    public function notifyCss()
    {
        return $this->manager->renderStyles();
    }

    public function notifyJs()
    {
        return $this->manager->renderScripts();
    }
}
