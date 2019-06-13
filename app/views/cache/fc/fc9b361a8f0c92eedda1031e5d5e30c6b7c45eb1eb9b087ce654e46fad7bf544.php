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

    // line 2
    public function block_title($context, array $blocks = array())
    {
        echo "Home";
    }

    // line 3
    public function block_header($context, array $blocks = array())
    {
        // line 4
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        echo " ";
        $this->loadTemplate("partials/nav.html", "index.home.html", 4)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
    }

    // line 5
    public function block_head($context, array $blocks = array())
    {
        echo " ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> ";
    }

    // line 8
    public function block_main($context, array $blocks = array())
    {
        // line 9
        echo "
";
        // line 10
        $this->loadTemplate("partials/nav1.html", "index.home.html", 10)->display($context);
        // line 11
        echo "
<ul class=\"contenido\">
    <li>
        <h4>Pedidos Activos:";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "cantidadPedidos", array()), "html", null, true);
        echo " </h4>
    </li>
    <li>
        <h4>Tareas sin Asignar:";
        // line 17
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "cantTareasSinAsignar", array()), "html", null, true);
        echo "</h4>
    </li>
    <li>
        <h4>Agentes Disponibles: ";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "agentesDisponibles", array()), "html", null, true);
        echo "</h4>
    </li>
    <li>
        <h4>Ordenes de Trabajo Activas:";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "otActivas", array()), "html", null, true);
        echo " </h4>
    </li>
</ul>

<div class=\"contenido1\">
    <h4>Tareas sin Asignar</h4>
    <table>
        <th>Nº Pedido</th>
        <th>Nº Tarea</th>
        <th>Descripcion</th>
        <th>Especializacion</th>
        <th>Prioridad</th>
        ";
        // line 35
        $context["i"] = 1;
        // line 36
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "tareasSinAsignar", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tarea"]) {
            // line 37
            echo "        <tr>
            <td> <a href=\"/fichaPedido?id=";
            // line 38
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idPedido", array()), "html", null, true);
            echo "\" title=\"Ver Mas\">Pedido ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idPedido", array()), "html", null, true);
            echo "</a></td>
            <td> <a href=\"/fichaTarea?idPedido=";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idPedido", array()), "html", null, true);
            echo "&idTarea=";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idTarea", array()), "html", null, true);
            echo "\" title=\"Ver Mas\"> Tarea
                    ";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idTarea", array()), "html", null, true);
            echo "</a></td>
            <td>";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "descripcion", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "especializacionNombre", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "prioridad", array()), "html", null, true);
            echo "</td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tarea'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "    </table>
    ";
        // line 47
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "tareasSinAsignar", array())) == 0)) {
            // line 48
            echo "    <h2 class='error'>No hay Tareas o ya están todas asignadas</h2>
    ";
        }
        // line 50
        echo "</div>

<div class=\"contenido2\">
    <h4>Proximos Eventos</h4>
    <table>
        <th>Nº Evento</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        ";
        // line 60
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "todosEventos", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["evento"]) {
            // line 61
            echo "        ";
            if ((twig_get_attribute($this->env, $this->source, $context["evento"], "fechaInicio", array()) == twig_date_format_filter($this->env, "now", "d/m/Y"))) {
                // line 62
                echo "        <tr>
            <td style=\"background-color:lightgreen\">";
                // line 63
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "idEvento", array()), "html", null, true);
                echo " <a href=\"/pedido/verTodos\"><input
                        type=\"button\" value=\"Crear Pedido\"></a> </td>
            <td style=\"background-color:lightgreen\">";
                // line 65
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "nombreEvento", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 66
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "descripcion", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 67
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaInicio", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 68
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaFin", array()), "html", null, true);
                echo "</td>
        </tr>
        ";
            } else {
                // line 71
                echo "        <tr>
            <td>";
                // line 72
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "idEvento", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 73
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "nombreEvento", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 74
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "descripcion", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 75
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaInicio", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 76
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaFin", array()), "html", null, true);
                echo "</td>
        </tr>
        ";
            }
            // line 79
            echo "        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 80
            echo "        <h2 class='error'>No hay eventos</h2>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['evento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        echo "    </table>
</div>
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
        return array (  240 => 82,  233 => 80,  228 => 79,  222 => 76,  218 => 75,  214 => 74,  210 => 73,  206 => 72,  203 => 71,  197 => 68,  193 => 67,  189 => 66,  185 => 65,  180 => 63,  177 => 62,  174 => 61,  169 => 60,  157 => 50,  153 => 48,  151 => 47,  148 => 46,  139 => 43,  135 => 42,  131 => 41,  127 => 40,  121 => 39,  115 => 38,  112 => 37,  107 => 36,  105 => 35,  90 => 23,  84 => 20,  78 => 17,  72 => 14,  67 => 11,  65 => 10,  62 => 9,  59 => 8,  50 => 5,  44 => 4,  41 => 3,  35 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}
{% block title %}Home{% endblock %}
{% block header %}
{% set nombreUsuario = datos.userLogueado %} {% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}
{% endblock %} {% block head %} {{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %}

{% block main %}

{% include 'partials/nav1.html' %}

<ul class=\"contenido\">
    <li>
        <h4>Pedidos Activos:{{ datos.cantidadPedidos }} </h4>
    </li>
    <li>
        <h4>Tareas sin Asignar:{{ datos.cantTareasSinAsignar }}</h4>
    </li>
    <li>
        <h4>Agentes Disponibles: {{ datos.agentesDisponibles }}</h4>
    </li>
    <li>
        <h4>Ordenes de Trabajo Activas:{{ datos.otActivas }} </h4>
    </li>
</ul>

<div class=\"contenido1\">
    <h4>Tareas sin Asignar</h4>
    <table>
        <th>Nº Pedido</th>
        <th>Nº Tarea</th>
        <th>Descripcion</th>
        <th>Especializacion</th>
        <th>Prioridad</th>
        {% set i = 1 %}
        {% for tarea in datos.tareasSinAsignar %}
        <tr>
            <td> <a href=\"/fichaPedido?id={{ tarea.idPedido }}\" title=\"Ver Mas\">Pedido {{ tarea.idPedido }}</a></td>
            <td> <a href=\"/fichaTarea?idPedido={{ tarea.idPedido }}&idTarea={{ tarea.idTarea }}\" title=\"Ver Mas\"> Tarea
                    {{ tarea.idTarea }}</a></td>
            <td>{{ tarea.descripcion }}</td>
            <td>{{ tarea.especializacionNombre }}</td>
            <td>{{ tarea.prioridad }}</td>
        </tr>
        {% endfor %}
    </table>
    {% if datos.tareasSinAsignar|length == 0 %}
    <h2 class='error'>No hay Tareas o ya están todas asignadas</h2>
    {% endif %}
</div>

<div class=\"contenido2\">
    <h4>Proximos Eventos</h4>
    <table>
        <th>Nº Evento</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        {% for evento in datos.todosEventos %}
        {% if evento.fechaInicio == \"now\"|date(\"d/m/Y\") %}
        <tr>
            <td style=\"background-color:lightgreen\">{{ evento.idEvento }} <a href=\"/pedido/verTodos\"><input
                        type=\"button\" value=\"Crear Pedido\"></a> </td>
            <td style=\"background-color:lightgreen\">{{ evento.nombreEvento }}</td>
            <td style=\"background-color:lightgreen\">{{ evento.descripcion }}</td>
            <td style=\"background-color:lightgreen\">{{ evento.fechaInicio }}</td>
            <td style=\"background-color:lightgreen\">{{ evento.fechaFin }}</td>
        </tr>
        {% else %}
        <tr>
            <td>{{ evento.idEvento }}</td>
            <td>{{ evento.nombreEvento }}</td>
            <td>{{ evento.descripcion }}</td>
            <td>{{ evento.fechaInicio }}</td>
            <td>{{ evento.fechaFin }}</td>
        </tr>
        {% endif %}
        {% else %}
        <h2 class='error'>No hay eventos</h2>
        {% endfor %}
    </table>
</div>
{% endblock %}", "index.home.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\index.home.html");
    }
}
