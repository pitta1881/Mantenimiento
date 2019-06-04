<?php

/* partials/nav.html */
class __TwigTemplate_bbe4a72da1951c38efd61304b56a292c1648b28f164ba0c9e609b234455e055b extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<nav class=\"main-nav\">
    <ol>
        <li><a href=\"/\">Home</a></li>
        <li><a href=\"/about\">Sobre nosotros</a></li>
        <li><a href=\"/turno/crear\">Solicitar turno</a></li>
        <li><a href=\"/verTurnos\">Ver Turnos</a></li>
    </ol>
</nav>";
    }

    public function getTemplateName()
    {
        return "partials/nav.html";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"main-nav\">
    <ol>
        <li><a href=\"/\">Home</a></li>
        <li><a href=\"/about\">Sobre nosotros</a></li>
        <li><a href=\"/turno/crear\">Solicitar turno</a></li>
        <li><a href=\"/verTurnos\">Ver Turnos</a></li>
    </ol>
</nav>", "partials/nav.html", "E:\\PATO\\UNIV\\2019\\PAW\\TP4\\2019_TP4_PAW-master\\2019_TP4_PAW\\app\\views\\partials\\nav.html");
    }
}
