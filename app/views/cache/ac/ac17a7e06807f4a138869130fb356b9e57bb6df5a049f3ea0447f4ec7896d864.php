<?php

/* administracionUsuario.eliminar.html */
class __TwigTemplate_ce6ce3468995b928a49c0f1a7c3274ee4b5b7265e91978742fcfe59a19f08039 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "administracionUsuario.eliminar.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'header' => array($this, 'block_header'),
            'head' => array($this, 'block_head'),
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
        echo twig_include($this->env, $context, "partials/navAdminUsuarios.html");
        echo "
";
    }

    // line 9
    public function block_head($context, array $blocks = array())
    {
        // line 10
        $this->displayParentBlock("head", $context, $blocks);
        echo "


";
    }

    public function getTemplateName()
    {
        return "administracionUsuario.eliminar.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 10,  49 => 9,  43 => 6,  40 => 5,  34 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Gestion de usuarios{% endblock %}

{% block header %}
{{ include('partials/navAdminUsuarios.html') }}
{% endblock %}

{% block head %}
{{ parent() }}


{% endblock %}", "administracionUsuario.eliminar.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\administracionUsuario.eliminar.html");
    }
}
