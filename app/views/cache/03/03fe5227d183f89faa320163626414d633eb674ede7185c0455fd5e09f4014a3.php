<?php

/* verUnPedido.html */
class __TwigTemplate_cab918a9572bba5d95e089ff146a20bc45f3ee35e97b8b05e2550327ef429fdf extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "verUnPedido.html", 1);
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
    <dt>Nº Pedido:</dt>
    <dd>";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "id", array()), "html", null, true);
        echo "</dd>
    <dt>Descripcion:</dt>
    <dd>";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "descripcion", array()), "html", null, true);
        echo "</dd>
    <dt>Fecha:</dt>
    <dd>";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "fechaInicio", array()), "html", null, true);
        echo "</dd>
    <dt>Estado:</dt>
    <dd>";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "estado", array()), "html", null, true);
        echo "</dd>
    <dt>Sector:</dt>
    <dd>";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "sector", array()), "html", null, true);
        echo "</dd>
    <dt>Prioridad:</dt>
    <dd>";
        // line 28
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "prioridad", array()), "html", null, true);
        echo "</dd>
</dl>
<h2>TAREAS</h2>
<table>
    <th>Nº Tarea</th>
    <th>Descripcion</th>
    <th>Especializacion</th>
    <th>Prioridad</th>
    <th>Estado</th>
    ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "tareas", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["tareas"]) {
            // line 38
            echo "    <tr>
        <td>";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "id", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "descripcion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "especializacion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "prioridad", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "estado", array()), "html", null, true);
            echo "</td>
    </tr>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 46
            echo "    <h2 class='error'>No hay Tareas asignadas aún</h2>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tareas'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "verUnPedido.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 48,  137 => 46,  129 => 43,  125 => 42,  121 => 41,  117 => 40,  113 => 39,  110 => 38,  105 => 37,  93 => 28,  88 => 26,  83 => 24,  78 => 22,  73 => 20,  68 => 18,  63 => 15,  60 => 14,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
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
    <dt>Nº Pedido:</dt>
    <dd>{{ datosPedidoTareas.miPedido.id }}</dd>
    <dt>Descripcion:</dt>
    <dd>{{ datosPedidoTareas.miPedido.descripcion }}</dd>
    <dt>Fecha:</dt>
    <dd>{{ datosPedidoTareas.miPedido.fechaInicio }}</dd>
    <dt>Estado:</dt>
    <dd>{{ datosPedidoTareas.miPedido.estado }}</dd>
    <dt>Sector:</dt>
    <dd>{{ datosPedidoTareas.miPedido.sector }}</dd>
    <dt>Prioridad:</dt>
    <dd>{{ datosPedidoTareas.miPedido.prioridad }}</dd>
</dl>
<h2>TAREAS</h2>
<table>
    <th>Nº Tarea</th>
    <th>Descripcion</th>
    <th>Especializacion</th>
    <th>Prioridad</th>
    <th>Estado</th>
    {% for tareas in datosPedidoTareas.tareas %}
    <tr>
        <td>{{ tareas.id }}</td>
        <td>{{ tareas.descripcion }}</td>
        <td>{{ tareas.especializacion }}</td>
        <td>{{ tareas.prioridad }}</td>
        <td>{{ tareas.estado }}</td>
    </tr>
    {% else %}
    <h2 class='error'>No hay Tareas asignadas aún</h2>
    {% endfor %}
</table>
{% endblock %}", "verUnPedido.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\verUnPedido.html");
    }
}
