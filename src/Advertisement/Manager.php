<?php
declare(strict_types=1);

namespace DigitalFarm\Advertisement;

class Manager
{
    protected \Phalcon\Mvc\Micro $app;

    public function __construct(\Phalcon\Mvc\Micro $app)
    {
        $this->app = $app;
    }

    public function get()
    {
        $adv = \DigitalFarm\Model\Advertisement::findFirst([
            'conditions' => 'isActive = true',
            'order' => "RANDOM()"
        ]);

        $adv->setImageViews($adv->getImageViews()+1);
        $adv->save();

        return [
            'urlImage' => $adv->getImageUrl(),
            'urlMobileImage' => $adv->getImageMobileUrl(),
            'actionLink' => $adv->getActionLink()
        ];
    }
}