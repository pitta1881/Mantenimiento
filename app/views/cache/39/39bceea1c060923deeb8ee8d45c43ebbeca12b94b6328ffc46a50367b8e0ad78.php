<?php

/* administracionRol.eliminar.html */
class __TwigTemplate_b1a6e0e61723b950399e62bd65a3e0ce864e439a35483a9bea5eff0b14c86457 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "administracionRol.eliminar.html", 1);
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
        echo "Gestion de usuarios";
    }

    // line 5
    public function block_header($context, array $blocks = array())
    {
        // line 6
        echo twig_include($this->env, $context, "partials/navAdminRol.html");
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

    // line 13
    public function block_main($context, array $blocks = array())
    {
        // line 14
        echo "


";
    }

    public function getTemplateName()
    {
        return "administracionRol.eliminar.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 14,  60 => 13,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Gestion de usuarios{% endblock %}

{% block header %}
{{ include('partials/navAdminRol.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}
{% block main %}



{% endblock %}", "administracionRol.eliminar.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\7.16\\Nueva carpeta\\Mantenimiento-master\\app\\views\\administracionRol.eliminar.html");
    }
}
