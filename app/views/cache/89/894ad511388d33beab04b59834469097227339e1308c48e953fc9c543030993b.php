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
        echo " ";
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        echo " ";
        $this->loadTemplate("partials/nav.html", "pedidosVerTodos.html", 1)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
        echo "} ";
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
    <th>Tareas</th>
    <th>Estado</th>
    <th>Prioridad</th>
    <th>Usuario</th>
    <th></th>
    ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "todosPedidos", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["pedido"]) {
            // line 31
            echo "    <tr>
        <td>";
            // line 32
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 33
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "descripcion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 34
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "sector", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "fechaInicio", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "tareasAsignadas", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "estado", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 38
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "prioridad", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "nombreUsuario", array()), "html", null, true);
            echo "</td>
        <td>
            <a href='/fichaPedido?id=";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"VER MAS\">
            </a>
            <a href='/pedido/modificar/seleccionado?id=";
            // line 44
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"MODIFICAR\">
            </a>
            <a href='/pedido/verTareas?idPedido=";
            // line 47
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"VER TAREAS\">
            </a>
        </td>
    </tr>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 53
            echo "    <h2 class='error'>No hay Pedidos</h2> ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pedido'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
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
        return array (  159 => 54,  153 => 53,  142 => 47,  136 => 44,  130 => 41,  125 => 39,  121 => 38,  117 => 37,  113 => 36,  109 => 35,  105 => 34,  101 => 33,  97 => 32,  94 => 31,  89 => 30,  60 => 3,  57 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Lista de Pedidos{% endblock %} {% block header %} {% set nombreUsuario = datos.userLogueado %} {% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}} {% endblock %} {% block head %} {{ parent() }}
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
    <th>Tareas</th>
    <th>Estado</th>
    <th>Prioridad</th>
    <th>Usuario</th>
    <th></th>
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
                <input type=\"button\" value=\"VER TAREAS\">
            </a>
        </td>
    </tr>
    {% else %}
    <h2 class='error'>No hay Pedidos</h2> {% endfor %}
</table>
{% endblock %}
", "pedidosVerTodos.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\pedidosVerTodos.html");
    }
}
