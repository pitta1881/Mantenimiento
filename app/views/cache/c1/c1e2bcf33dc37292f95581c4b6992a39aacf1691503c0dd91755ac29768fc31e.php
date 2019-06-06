<?php

/* verPedidoCreado.html */
class __TwigTemplate_4e232d987c1e4a771d96f5e621061f9f2933d8f4b59345245326d41aa63bb093 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "verPedidoCreado.html", 1);
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
        echo "<h1>Su Pedido</h1>
<dl>
    <dt>Fecha Inicio:</dt>
    <dd>";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayPedido"] ?? null), "fechaInicio", array()), "html", null, true);
        echo "</dd>
    <dt>Estado:</dt>
    <dd>";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayPedido"] ?? null), "estado", array()), "html", null, true);
        echo "</dd>
    <dt>Descripcion:</dt>
    <dd>";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayPedido"] ?? null), "descripcion", array()), "html", null, true);
        echo "</dd>
    <dt>Sector:</dt>
    <dd>";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayPedido"] ?? null), "sector", array()), "html", null, true);
        echo "</dd>
    <dt>Prioridad:</dt>
    <dd>";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayPedido"] ?? null), "prioridad", array()), "html", null, true);
        echo "</dd>
</dl>
";
    }

    public function getTemplateName()
    {
        return "verPedidoCreado.html";
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
<h1>Su Pedido</h1>
<dl>
    <dt>Fecha Inicio:</dt>
    <dd>{{ arrayPedido.fechaInicio }}</dd>
    <dt>Estado:</dt>
    <dd>{{ arrayPedido.estado }}</dd>
    <dt>Descripcion:</dt>
    <dd>{{ arrayPedido.descripcion }}</dd>
    <dt>Sector:</dt>
    <dd>{{ arrayPedido.sector }}</dd>
    <dt>Prioridad:</dt>
    <dd>{{ arrayPedido.prioridad }}</dd>
</dl>
<<<<<<< HEAD
{% endblock %}", "verPedidoCreado.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\verPedidoCreado.html");
=======
{% endblock %}", "verPedidoCreado.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\verPedidoCreado.html");
>>>>>>> master
    }
}
