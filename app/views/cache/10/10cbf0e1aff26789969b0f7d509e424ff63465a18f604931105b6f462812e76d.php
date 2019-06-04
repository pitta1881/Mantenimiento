<?php

/* internal-error.html */
class __TwigTemplate_d60532dd1d0e760261cd5222a607508761163e110a51920945ecc221aa4889aa extends Twig_Template
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
        echo "<h1>500 - Internal Server Error</h1>
";
    }

    public function getTemplateName()
    {
        return "internal-error.html";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<h1>500 - Internal Server Error</h1>
", "internal-error.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\internal-error.html");
    }
}
