<?php

/* about.html */
class __TwigTemplate_5aa8078023399e9ff44ef44e88d201bee3030ca7715e666770bb4fb34cb3f2c2 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "about.html", 1);
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
        echo "About";
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
        echo "<h3>Ivan Costa - Legajo: xxxxxxx - XXXXXX@gmail.com</h3>
<h3>Valentin Nardoni - Legajo: xxxxxxx - XXXXXX@gmail.com</h3>
<h3>Facundo Otero - Legajo: xxxxxxx - XXXXXX@gmail.com</h3>
<h3>Cristian Cravero - Legajo: xxxxxxx - XXXXXX@gmail.com</h3>
<h3>Patricio Pittavino - Legajo: 121476 - pitta1881@gmail.com</h3>
";
    }

    public function getTemplateName()
    {
        return "about.html";
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

{% block title %}About{% endblock %}

{% block header %}
{{ include('partials/nav.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h3>Ivan Costa - Legajo: xxxxxxx - XXXXXX@gmail.com</h3>
<h3>Valentin Nardoni - Legajo: xxxxxxx - XXXXXX@gmail.com</h3>
<h3>Facundo Otero - Legajo: xxxxxxx - XXXXXX@gmail.com</h3>
<h3>Cristian Cravero - Legajo: xxxxxxx - XXXXXX@gmail.com</h3>
<h3>Patricio Pittavino - Legajo: 121476 - pitta1881@gmail.com</h3>
{% endblock %}", "about.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\7.16\\Nueva carpeta\\Mantenimiento-master\\app\\views\\about.html");
    }
}
