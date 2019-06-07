<?php

/* pedidosVerTodos.html */
class __TwigTemplate_9a75d230ecf9e70db7ba0e619d334a75ec3a7e5fd86630d8299b3d4707722ec7 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "pedidosVerTodos.html", 1);
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
        echo "Lista de Pedidos";
    }

    public function block_header($context, array $blocks = array())
    {
        // line 2
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        // line 3
        $this->loadTemplate("partials/nav.html", "pedidosVerTodos.html", 3)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
        echo "} ";
    }

    public function block_head($context, array $blocks = array())
    {
        // line 4
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> ";
    }

    // line 5
    public function block_main($context, array $blocks = array())
    {
        // line 6
        echo "<h1>Listado de Pedidos</h1>
<a href=\"/pedido/crear\">
    <input type=\"button\" value=\"Crear Pedido\">
</a>
<form action=\"/pedido/buscar\" method=\"POST\">
    <select name=\"filtro\">
        <option value=\"id\">Nº PEDIDO</option>
        <option value=\"sector\">SECTOR</option>
        <option value=\"fechaInicio\">FECHA INICIO</option>
        <option value=\"estado\">ESTADO</option>
        <option value=\"prioridad\">PRIORIDAD</option>
    </select>

    <input name=\"textBusqueda\" type=\"Search\" placeholder=\"Escribe parametro\">
    <input type=\"submit\" value=\"Buscar\">
</form>

<table>
    <th>Nº Pedido</th>
    <th>Descripcion</th>
    <th>Sector</th>
    <th>Fecha Inicio</th>
    <th>Tareas Asignadas</th>
    <th>Estado</th>
    <th>Prioridad</th>
    <th>Usuario Iniciador</th>
    <th>Enlace</th>
    ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "todosPedidos", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["pedido"]) {
            // line 34
            echo "    <tr>
        <td>";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "descripcion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "sector", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 38
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "fechaInicio", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "tareasAsignadas", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "estado", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "prioridad", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "nombreUsuario", array()), "html", null, true);
            echo "</td>
        <td>
            <a href='/fichaPedido?id=";
            // line 44
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"VER MAS\">
            </a>
            <a href='/pedido/modificar/seleccionado?id=";
            // line 47
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"MODIFICAR\">
            </a>
            <a href='/pedido/verTareas?idPedido=";
            // line 50
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"VER TAREAS\"></a>
        </td>
    </tr>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 55
            echo "    <h2 class='error'>No hay Pedidos</h2> ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pedido'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "pedidosVerTodos.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  158 => 56,  152 => 55,  142 => 50,  136 => 47,  130 => 44,  125 => 42,  121 => 41,  117 => 40,  113 => 39,  109 => 38,  105 => 37,  101 => 36,  97 => 35,  94 => 34,  89 => 33,  60 => 6,  57 => 5,  51 => 4,  44 => 3,  42 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Lista de Pedidos{% endblock %} {% block header %}
{% set nombreUsuario = datos.userLogueado %}
{% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}} {% endblock %} {% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}
<h1>Listado de Pedidos</h1>
<a href=\"/pedido/crear\">
    <input type=\"button\" value=\"Crear Pedido\">
</a>
<form action=\"/pedido/buscar\" method=\"POST\">
    <select name=\"filtro\">
        <option value=\"id\">Nº PEDIDO</option>
        <option value=\"sector\">SECTOR</option>
        <option value=\"fechaInicio\">FECHA INICIO</option>
        <option value=\"estado\">ESTADO</option>
        <option value=\"prioridad\">PRIORIDAD</option>
    </select>

    <input name=\"textBusqueda\" type=\"Search\" placeholder=\"Escribe parametro\">
    <input type=\"submit\" value=\"Buscar\">
</form>

<table>
    <th>Nº Pedido</th>
    <th>Descripcion</th>
    <th>Sector</th>
    <th>Fecha Inicio</th>
    <th>Tareas Asignadas</th>
    <th>Estado</th>
    <th>Prioridad</th>
    <th>Usuario Iniciador</th>
    <th>Enlace</th>
    {% for pedido in datos.todosPedidos %}
    <tr>
        <td>{{ pedido.id }}</td>
        <td>{{ pedido.descripcion }}</td>
        <td>{{ pedido.sector }}</td>
        <td>{{ pedido.fechaInicio }}</td>
        <td>{{ pedido.tareasAsignadas }}</td>
        <td>{{ pedido.estado }}</td>
        <td>{{ pedido.prioridad }}</td>
        <td>{{ pedido.nombreUsuario }}</td>
        <td>
            <a href='/fichaPedido?id={{ pedido.id }}'>
                <input type=\"button\" value=\"VER MAS\">
            </a>
            <a href='/pedido/modificar/seleccionado?id={{ pedido.id }}'>
                <input type=\"button\" value=\"MODIFICAR\">
            </a>
            <a href='/pedido/verTareas?idPedido={{ pedido.id }}'>
                <input type=\"button\" value=\"VER TAREAS\"></a>
        </td>
    </tr>
    {% else %}
    <h2 class='error'>No hay Pedidos</h2> {% endfor %}
</table>
{% endblock %}", "pedidosVerTodos.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\pedidosVerTodos.html");
    }
}
