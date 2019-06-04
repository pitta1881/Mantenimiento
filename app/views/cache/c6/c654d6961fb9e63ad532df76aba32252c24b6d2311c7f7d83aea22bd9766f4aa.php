<?php

/* tasks.create.html */
class __TwigTemplate_980730411af18788409d9d8301b2c35c42f08ff2969df1b2c369647a087a7e7b extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "tasks.create.html", 1);
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
        echo "Crear Tarea Nueva";
    }

    // line 5
    public function block_header($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        echo twig_include($this->env, $context, "partials/nav.html");
        echo "
";
    }

    // line 9
    public function block_head($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
    <meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
";
    }

    // line 14
    public function block_main($context, array $blocks = array())
    {
        // line 15
        echo "<h2>Crear Tarea</h2>
<form action=\"/tasks/save\" method=\"POST\">
    <input type=\"text\" name=\"description\" placeholder=\"Descripcion de la tarea\">
    <input type=\"checkbox\" name=\"completed\" > ¿Completada?
    <input type=\"submit\" name=\"Enviar\">
</form>
";
    }

    public function getTemplateName()
    {
        return "tasks.create.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 15,  62 => 14,  54 => 10,  51 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Crear Tarea Nueva{% endblock %}

{% block header %}
    {{ include('partials/nav.html') }}
{% endblock %}

{% block head %}
    {{ parent() }}
    <meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h2>Crear Tarea</h2>
<form action=\"/tasks/save\" method=\"POST\">
    <input type=\"text\" name=\"description\" placeholder=\"Descripcion de la tarea\">
    <input type=\"checkbox\" name=\"completed\" > ¿Completada?
    <input type=\"submit\" name=\"Enviar\">
</form>
{% endblock %}
", "tasks.create.html", "E:\\PATO\\UNIV\\2019\\PAW\\TP4\\2019_TP4_PAW-master\\2019_TP4_PAW\\app\\views\\tasks.create.html");
    }
}
