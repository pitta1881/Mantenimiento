<?php

/* pedidoVerFicha.html */
class __TwigTemplate_d4e2a1d8ad0f867737c182b4fbc5dc2a5fbe9d4e33e372d648d3d1b08fc8e724 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "pedidoVerFicha.html", 1);
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
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "userLogueado", array());
        // line 7
        $this->loadTemplate("partials/nav.html", "pedidoVerFicha.html", 7)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
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
        echo "<input type=\"button\" value=\"IMPRIMIR\" onclick=\"print()\">
<h1>Su Pedido</h1>
<dl>
    <dt>Nº Pedido:</dt>
    <dd>";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "id", array()), "html", null, true);
        echo "</dd>
    <dt>Usuario Creador:</dt>
    <dd>";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "nombreUsuario", array()), "html", null, true);
        echo "</dd>
    <dt>Descripcion:</dt>
    <dd>";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "descripcion", array()), "html", null, true);
        echo "</dd>
    <dt>Fecha:</dt>
    <dd>";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "fechaInicio", array()), "html", null, true);
        echo "</dd>
    <dt>Estado:</dt>
    <dd>";
        // line 28
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "estado", array()), "html", null, true);
        echo "</dd>
    <dt>Sector:</dt>
    <dd>";
        // line 30
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "miPedido", array()), "sector", array()), "html", null, true);
        echo "</dd>
    <dt>Prioridad:</dt>
    <dd>";
        // line 32
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
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datosPedidoTareas"] ?? null), "tareas", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["tareas"]) {
            // line 42
            echo "    <tr>
        <td>";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "idTarea", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 44
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "descripcion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 45
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "especializacion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 46
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "prioridad", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 47
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "estado", array()), "html", null, true);
            echo "</td>
    </tr>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 50
            echo "    <h2 class='error'>No hay Tareas asignadas aún</h2>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tareas'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "pedidoVerFicha.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 52,  145 => 50,  137 => 47,  133 => 46,  129 => 45,  125 => 44,  121 => 43,  118 => 42,  113 => 41,  101 => 32,  96 => 30,  91 => 28,  86 => 26,  81 => 24,  76 => 22,  71 => 20,  65 => 16,  62 => 15,  55 => 11,  52 => 10,  46 => 7,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Lista de Tareas{% endblock %}

{% block header %}
{% set nombreUsuario = datosPedidoTareas.userLogueado %}
{% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<input type=\"button\" value=\"IMPRIMIR\" onclick=\"print()\">
<h1>Su Pedido</h1>
<dl>
    <dt>Nº Pedido:</dt>
    <dd>{{ datosPedidoTareas.miPedido.id }}</dd>
    <dt>Usuario Creador:</dt>
    <dd>{{ datosPedidoTareas.miPedido.nombreUsuario }}</dd>
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
        <td>{{ tareas.idTarea }}</td>
        <td>{{ tareas.descripcion }}</td>
        <td>{{ tareas.especializacion }}</td>
        <td>{{ tareas.prioridad }}</td>
        <td>{{ tareas.estado }}</td>
    </tr>
    {% else %}
    <h2 class='error'>No hay Tareas asignadas aún</h2>
    {% endfor %}
</table>
{% endblock %}", "pedidoVerFicha.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\pedidoVerFicha.html");
    }
}
