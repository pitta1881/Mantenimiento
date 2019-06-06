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

    public function block_title($context, array $blocks = array())
    {
        echo "Lista de Pedidos";
    }

    public function block_header($context, array $blocks = array())
    {
        // line 2
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

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "<h1>Listado de Pedidos</h1>
<a href=\"/pedido/crear\">
    <input type=\"button\" value=\"Crear Pedido\">
</a>
<select>
    <option value=\"NPedido\">Nº PEDIDO</option>
    <option value=\"Sector\">SECTOR</option>
    <option value=\"mercedes\">FECHA INICIO</option>
    <option value=\"audi\">ESTADO</option>
    <option value=\"audi\">PRIORIDAD</option>
</select>

<input type=\"Search\" value=\"Escribe parametro\">
<input type=\"button\" value=\"Buscar\">
<table>
    <th>Nº Pedido</th>
    <th>Descripcion</th>
    <th>Sector</th>
    <th>Fecha Inicio</th>
    <th>Tareas Asignadas</th>
    <th>Estado</th>
    <th>Prioridad</th>
    <th>Enlace</th>
    ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["todosPedidos"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["pedido"]) {
            // line 28
            echo "    <tr>
        <td>";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "descripcion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "sector", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 32
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "fechaInicio", array()), "html", null, true);
            echo "</td>
        <td>PROXIMAMENTE</td>
        <td>";
            // line 34
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "estado", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "prioridad", array()), "html", null, true);
            echo "</td>
        <td>
            <a href='/fichaPedido?id=";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"VER MAS\">
            </a>
            <a href='/pedido/modificar/seleccionado?id=";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"MODIFICAR\">
            </a>
            <a href='/pedido/verTareas?id=";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pedido"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"VER TAREAS\">
        </td>
    </tr>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 48
            echo "    <h2 class='error'>No hay Pedidos</h2> ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pedido'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
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
        return array (  145 => 49,  139 => 48,  129 => 43,  123 => 40,  117 => 37,  112 => 35,  108 => 34,  103 => 32,  99 => 31,  95 => 30,  91 => 29,  88 => 28,  83 => 27,  58 => 4,  55 => 3,  42 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Lista de Pedidos{% endblock %} {% block header %}
{{ include('partials/nav.html') }} {% endblock %} {% block head %} {{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}
<h1>Listado de Pedidos</h1>
<a href=\"/pedido/crear\">
    <input type=\"button\" value=\"Crear Pedido\">
</a>
<select>
    <option value=\"NPedido\">Nº PEDIDO</option>
    <option value=\"Sector\">SECTOR</option>
    <option value=\"mercedes\">FECHA INICIO</option>
    <option value=\"audi\">ESTADO</option>
    <option value=\"audi\">PRIORIDAD</option>
</select>

<input type=\"Search\" value=\"Escribe parametro\">
<input type=\"button\" value=\"Buscar\">
<table>
    <th>Nº Pedido</th>
    <th>Descripcion</th>
    <th>Sector</th>
    <th>Fecha Inicio</th>
    <th>Tareas Asignadas</th>
    <th>Estado</th>
    <th>Prioridad</th>
    <th>Enlace</th>
    {% for pedido in todosPedidos %}
    <tr>
        <td>{{ pedido.id }}</td>
        <td>{{ pedido.descripcion }}</td>
        <td>{{ pedido.sector }}</td>
        <td>{{ pedido.fechaInicio }}</td>
        <td>PROXIMAMENTE</td>
        <td>{{ pedido.estado }}</td>
        <td>{{ pedido.prioridad }}</td>
        <td>
            <a href='/fichaPedido?id={{ pedido.id }}'>
                <input type=\"button\" value=\"VER MAS\">
            </a>
            <a href='/pedido/modificar/seleccionado?id={{ pedido.id }}'>
                <input type=\"button\" value=\"MODIFICAR\">
            </a>
            <a href='/pedido/verTareas?id={{ pedido.id }}'>
                <input type=\"button\" value=\"VER TAREAS\">
        </td>
    </tr>
    {% else %}
    <h2 class='error'>No hay Pedidos</h2> {% endfor %}
</table>
{% endblock %}", "verTodosPedidos.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\verTodosPedidos.html");
    }
}
