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

    public function block_title($context, array $blocks = array())
    {
        echo "Home";
    }

    public function block_header($context, array $blocks = array())
    {
        echo " ";
        echo twig_include($this->env, $context, "partials/nav.html");
        echo " ";
    }

    public function block_head($context, array $blocks = array())
    {
        echo " ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> ";
    }

    // line 2
    public function block_main($context, array $blocks = array())
    {
        // line 3
        echo "<fieldset class=\"basicosPedido\">
    <legend>General</legend>
    <input type=\"button\" value=\"Gestion de Pedidos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>
<fieldset class=\"prioridad\">
    <legend>Insumos<span class=\"asterisco\">*</span></legend>
    <input type=\"button\" value=\"Gestion de Pedidos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>
<fieldset class=\"\">
    <legend>Otros<span class=\"asterisco\">*</span></legend>
    <input type=\"button\" value=\"Gestion de Pedidos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>
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
        return array (  58 => 3,  55 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Home{% endblock %} {% block header %} {{ include('partials/nav.html') }} {% endblock %} {% block head %} {{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}
<fieldset class=\"basicosPedido\">
    <legend>General</legend>
    <input type=\"button\" value=\"Gestion de Pedidos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>
<fieldset class=\"prioridad\">
    <legend>Insumos<span class=\"asterisco\">*</span></legend>
    <input type=\"button\" value=\"Gestion de Pedidos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>
<fieldset class=\"\">
    <legend>Otros<span class=\"asterisco\">*</span></legend>
    <input type=\"button\" value=\"Gestion de Pedidos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>
{% endblock %}
", "index.home.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\index.home.html");
    }
}
