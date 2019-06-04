<?php

/* verFormularioEnviado.html */
class __TwigTemplate_a504b58450b52d2cd32f673037f3159a3bdcbbefd82bb64c4bcbdb9fb93bc805 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "verFormularioEnviado.html", 1);
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
        echo "Lista de Tareas";
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
        echo "<h1>Su Turnos</h1>
<dl>
    <dt>Paciente:</dt>
    <dd>";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayTurno"] ?? null), "name", array()), "html", null, true);
        echo "</dd>
    <dt>E-mail:</dt>
    <dd>";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayTurno"] ?? null), "email", array()), "html", null, true);
        echo "</dd>
    <dt>Telefono:</dt>
    <dd>";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayTurno"] ?? null), "phone", array()), "html", null, true);
        echo "</dd>
    <dt>Fecha:</dt>
    <dd>";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayTurno"] ?? null), "adate", array()), "html", null, true);
        echo "</dd>
    <dt>Hora:</dt>
    <dd>";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayTurno"] ?? null), "atime", array()), "html", null, true);
        echo "</dd>
</dl>
";
    }

    public function getTemplateName()
    {
        return "verFormularioEnviado.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 26,  83 => 24,  78 => 22,  73 => 20,  68 => 18,  63 => 15,  60 => 14,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Lista de Tareas{% endblock %}

{% block header %}
{{ include('partials/nav.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h1>Su Turnos</h1>
<dl>
    <dt>Paciente:</dt>
    <dd>{{ arrayTurno.name }}</dd>
    <dt>E-mail:</dt>
    <dd>{{ arrayTurno.email }}</dd>
    <dt>Telefono:</dt>
    <dd>{{ arrayTurno.phone }}</dd>
    <dt>Fecha:</dt>
    <dd>{{ arrayTurno.adate }}</dd>
    <dt>Hora:</dt>
    <dd>{{ arrayTurno.atime }}</dd>
</dl>
{% endblock %}", "verFormularioEnviado.html", "E:\\PATO\\UNIV\\2019\\PAW\\TP4\\2019_TP4_PAW-master\\2019_TP4_PAW\\app\\views\\verFormularioEnviado.html");
    }
}
