<?php

/* verTodosPedidos.html */
class __TwigTemplate_9996f5daa2955a939f4581ed305606effad3abdf4d0afa1d4c86ab87b7ae3e74 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "verTodosPedidos.html", 1);
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
        echo "Lista de Pedidos";
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
        echo "<h1>Listado de Pedidos</h1>
<table>
    <th>Nº Pedido</th>
    <th>Descripcion</th>
    <th>Sector</th>
    <th>Fecha Inicio</th>
    <th>Tareas Asignadas</th>
    <th>Estado</th>
    <th>Enlace</th>
    ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["todosPedidos"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["pedido"]) {
            // line 25
            echo "    <tr>
        <td>";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 27
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "descripcion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 28
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "sector", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "fechaInicio", array()), "html", null, true);
            echo "</td>
        <td>PROXIMAMENTE</td>
        <td>";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "estado", array()), "html", null, true);
            echo "</td>
        <td><a href='/fichaPedido?id=";
            // line 32
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'><input type=\"button\" value=\"VER MAS\"></a>
            <a href='/pedido/modificar/seleccionado?id=";
            // line 33
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'><input type=\"button\" value=\"MODIFICAR\"></a></td>
    </tr>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 36
            echo "    <h2 class='error'>No hay Pedidos</h2>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pedido'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "verTodosPedidos.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 38,  115 => 36,  107 => 33,  103 => 32,  99 => 31,  94 => 29,  90 => 28,  86 => 27,  82 => 26,  79 => 25,  74 => 24,  63 => 15,  60 => 14,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Lista de Pedidos{% endblock %}

{% block header %}
{{ include('partials/nav.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h1>Listado de Pedidos</h1>
<table>
    <th>Nº Pedido</th>
    <th>Descripcion</th>
    <th>Sector</th>
    <th>Fecha Inicio</th>
    <th>Tareas Asignadas</th>
    <th>Estado</th>
    <th>Enlace</th>
    {% for pedido in todosPedidos %}
    <tr>
        <td>{{ pedido.id }}</td>
        <td>{{ pedido.descripcion }}</td>
        <td>{{ pedido.sector }}</td>
        <td>{{ pedido.fechaInicio }}</td>
        <td>PROXIMAMENTE</td>
        <td>{{ pedido.estado }}</td>
        <td><a href='/fichaPedido?id={{ pedido.id }}'><input type=\"button\" value=\"VER MAS\"></a>
            <a href='/pedido/modificar/seleccionado?id={{ pedido.id }}'><input type=\"button\" value=\"MODIFICAR\"></a></td>
    </tr>
    {% else %}
    <h2 class='error'>No hay Pedidos</h2>
    {% endfor %}
</table>
{% endblock %}", "verTodosPedidos.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\verTodosPedidos.html");
    }
}
