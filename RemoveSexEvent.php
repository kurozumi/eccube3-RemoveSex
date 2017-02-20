<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Plugin\RemoveSex;

use Eccube\Application;
use Eccube\Event\TemplateEvent;

/**
 * Description of RemoveSexEvent
 *
 * @author kurozumi
 */
class RemoveSexEvent
{
    /** @var  \Eccube\Application $app */
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;

    }

    public function onRenderEntry(TemplateEvent $event)
    {
        $search = "{% block javascript %}";
        $tag = <<< EOT
<script>$(function(){ $("#top_box__sex").parent().remove();});</script>\n
EOT;
        $source = str_replace($search, $search . $tag, $event->getSource());
        $event->setSource($source);

    }

    public function onRenderEntryConfirm(TemplateEvent $event)
    {
        $script = <<< EOT
{% block javascript %}
<script>$(function(){ $("#confirm_box__sex").remove();});</script>\n
{% endblock javascript %}
EOT;
        $event->setSource($event->getSource() . $script);

    }

    public function onRenderCustomerEdit(TemplateEvent $event)
    {
        $search = "{% block javascript %}";
        $tag = <<< EOT
<script>$(function(){ $("#detail_box__sex").remove();});</script>\n
EOT;
        $source = str_replace($search, $search . $tag, $event->getSource());
        $event->setSource($source);

    }

}
