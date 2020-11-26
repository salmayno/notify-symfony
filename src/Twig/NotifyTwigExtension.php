<?php

namespace Notify\Symfony\Twig;

use Notify\Presenter\Adapter\HtmlPresenter;
use Notify\Presenter\PresenterManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class NotifyTwigExtension extends AbstractExtension
{
    private $htmlPresenter;

    public function __construct(HtmlPresenter $htmlPresenter)
    {
        $this->htmlPresenter = $htmlPresenter;
    }

    public function getFunctions()
    {
        $options = array('is_safe' => array('html'));

        return array(
            new TwigFunction('notify_render', array($this, 'notifyRender'), $options),
        );
    }

    /**
     * @param string|array $criteria
     *
     * @return string
     */
    public function notifyRender($criteria = null)
    {
        return $this->htmlPresenter->render($criteria);
    }
}
