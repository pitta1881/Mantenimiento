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
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "nombreUsuario", array());
        // line 7
        $this->loadTemplate("partials/nav.html", "verPedidoCreado.html", 7)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
        echo "}
";
    }

    // line 10
    public function block_head($context, array $blocks = array())
    {
        // line 11
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
";
    }

    // line 15
    public function block_main($context, array $blocks = array())
    {
        // line 16
        echo "<h1>Su Pedido</h1>
<dl>
    <dt>Usuario Creador:</dt>
    <dd>";
        // line 19
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "arrayPedido", array()), "nombreUsuario", array()), "html", null, true);
        echo "</dd>
    <dt>Fecha Inicio:</dt>
    <dd>";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "arrayPedido", array()), "fechaInicio", array()), "html", null, true);
        echo "</dd>
    <dt>Estado:</dt>
    <dd>";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "arrayPedido", array()), "estado", array()), "html", null, true);
        echo "</dd>
    <dt>Descripcion:</dt>
    <dd>";
        // line 25
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "arrayPedido", array()), "descripcion", array()), "html", null, true);
        echo "</dd>
    <dt>Sector:</dt>
    <dd>";
        // line 27
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "arrayPedido", array()), "sector", array()), "html", null, true);
        echo "</dd>
    <dt>Prioridad:</dt>
    <dd>";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "arrayPedido", array()), "prioridad", array()), "html", null, true);
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
        return array (  95 => 29,  90 => 27,  85 => 25,  80 => 23,  75 => 21,  70 => 19,  65 => 16,  62 => 15,  55 => 11,  52 => 10,  46 => 7,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Lista de Tareas{% endblock %}

{% block header %}
{% set nombreUsuario = datos.nombreUsuario %}
{% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h1>Su Pedido</h1>
<dl>
    <dt>Usuario Creador:</dt>
    <dd>{{ datos.arrayPedido.nombreUsuario }}</dd>
    <dt>Fecha Inicio:</dt>
    <dd>{{ datos.arrayPedido.fechaInicio }}</dd>
    <dt>Estado:</dt>
    <dd>{{ datos.arrayPedido.estado }}</dd>
    <dt>Descripcion:</dt>
    <dd>{{ datos.arrayPedido.descripcion }}</dd>
    <dt>Sector:</dt>
    <dd>{{ datos.arrayPedido.sector }}</dd>
    <dt>Prioridad:</dt>
    <dd>{{ datos.arrayPedido.prioridad }}</dd>
</dl>
{% endblock %}", "verPedidoCreado.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\verPedidoCreado.html");
    }
}
