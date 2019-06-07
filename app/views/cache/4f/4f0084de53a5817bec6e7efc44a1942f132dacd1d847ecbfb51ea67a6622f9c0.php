<?php

/* internal-error.html */
class __TwigTemplate_f76097784629d0436b8c5b5b4290eed2de59214740724a97c05d2c1712a502ff extends Twig_Template
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
", "internal-error.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\Mantenimiento\\app\\views\\internal-error.html");
    }
}
