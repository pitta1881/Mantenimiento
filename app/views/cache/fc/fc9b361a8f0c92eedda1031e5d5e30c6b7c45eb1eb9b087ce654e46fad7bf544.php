<?php

/* index.home.html */
class __TwigTemplate_a6fa914c302a557bd4774038499bc6652d6accc479e0031d6bd45d0c450a8a88 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "index.home.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'header' => array($this, 'block_header'),
            'head' => array($this, 'block_head'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Home";
    }

    // line 5
    public function block_header($context, array $blocks = array())
    {
        // line 6
        echo twig_include($this->env, $context, "partials/nav.html");
        echo "
";
    }

    // line 9
    public function block_head($context, array $blocks = array())
    {
        // line 10
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
";
    }

    // line 14
    public function block_main($context, array $blocks = array())
    {
        // line 15
        echo "<h1>Sobre este proyecto</h1>
<p>aca iria un home</p>
";
    }

    public function getTemplateName()
    {
        return "index.home.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 15,  60 => 14,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Home{% endblock %}

{% block header %}
{{ include('partials/nav.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h1>Sobre este proyecto</h1>
<p>aca iria un home</p>
<<<<<<< Updated upstream
{% endblock %}", "index.home.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\index.home.html");
=======
{% endblock %}", "index.home.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\index.home.html");
>>>>>>> Stashed changes
    }
}
