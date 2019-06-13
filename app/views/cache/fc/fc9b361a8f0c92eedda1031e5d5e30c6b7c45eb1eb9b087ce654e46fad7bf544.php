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
            <td>";
            // line 38
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idPedido", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idTarea", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "descripcion", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "especializacionNombre", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "prioridad", array()), "html", null, true);
            echo "</td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tarea'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "    </table>
    ";
        // line 46
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "tareasSinAsignar", array())) == 0)) {
            // line 47
            echo "    <h2 class='error'>No hay Tareas o ya están todas asignadas</h2>
    ";
        }
        // line 49
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
        // line 59
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "todosEventos", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["evento"]) {
            // line 60
            echo "        ";
            if ((twig_get_attribute($this->env, $this->source, $context["evento"], "fechaInicio", array()) == twig_date_format_filter($this->env, "now", "d/m/Y"))) {
                // line 61
                echo "        <tr>
            <td style=\"background-color:lightgreen\">";
                // line 62
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "idEvento", array()), "html", null, true);
                echo " <a href=\"/pedido/verTodos\"><input
                        type=\"button\" value=\"Crear Pedido\"></a> </td>
            <td style=\"background-color:lightgreen\">";
                // line 64
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "nombreEvento", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 65
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "descripcion", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 66
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaInicio", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 67
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaFin", array()), "html", null, true);
                echo "</td>
        </tr>
        ";
            } else {
                // line 70
                echo "        <tr>
            <td>";
                // line 71
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "idEvento", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 72
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "nombreEvento", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 73
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "descripcion", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 74
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaInicio", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 75
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaFin", array()), "html", null, true);
                echo "</td>
        </tr>
        ";
            }
            // line 78
            echo "        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 79
            echo "        <h2 class='error'>No hay eventos</h2>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['evento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
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
        return array (  232 => 81,  225 => 79,  220 => 78,  214 => 75,  210 => 74,  206 => 73,  202 => 72,  198 => 71,  195 => 70,  189 => 67,  185 => 66,  181 => 65,  177 => 64,  172 => 62,  169 => 61,  166 => 60,  161 => 59,  149 => 49,  145 => 47,  143 => 46,  140 => 45,  131 => 42,  127 => 41,  123 => 40,  119 => 39,  115 => 38,  112 => 37,  107 => 36,  105 => 35,  90 => 23,  84 => 20,  78 => 17,  72 => 14,  67 => 11,  65 => 10,  62 => 9,  59 => 8,  50 => 5,  44 => 4,  41 => 3,  35 => 2,  15 => 1,);
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
            <td>{{ tarea.idPedido }}</td>
            <td>{{ tarea.idTarea }}</td>
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
