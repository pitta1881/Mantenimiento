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

    public function block_title($context, array $blocks = array())
    {
        echo "Home";
    }

    public function block_header($context, array $blocks = array())
    {
        echo " ";
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        echo " ";
        $this->loadTemplate("partials/nav.html", "index.home.html", 1)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
        echo " ";
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
        echo "

<ul class=\"contenido\">
    <li>
        <h4>Pedidos Activos:<br>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "cantidadPedidos", array()), "html", null, true);
        echo " </h4>
    </li>
    <li>
        <h4>Tareas sin Asignar:<br>";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "cantTareasSinAsignar", array()), "html", null, true);
        echo "</h4>
    </li>
    <li>
        <h4>Agentes Disponibles:<br> ";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "agentesDisponibles", array()), "html", null, true);
        echo "</h4>
    </li>
    <li>
        <h4>Ordenes de Trabajo Activas:<br>";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "otActivas", array()), "html", null, true);
        echo " </h4>
    </li>
</ul>

<div class=\"contenido1\">
    <h4>Tareas sin Asignar</h4>
    <table id=\"miTabla\">
        <th onclick=\"sortTable(0,'miTabla')\">Nº Pedido</th>
        <th onclick=\"sortTable(1,'miTabla')\">Nº Tarea</th>
        <th onclick=\"sortTable(2,'miTabla')\">Descripcion</th>
        <th onclick=\"sortTable(3,'miTabla')\">Especializacion</th>
        <th onclick=\"sortTable(4,'miTabla')\">Prioridad</th>
        ";
        // line 28
        $context["i"] = 1;
        echo " ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "tareasSinAsignar", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["tarea"]) {
            // line 29
            echo "        <tr>
            <td> <a href=\"/fichaPedido?id=";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idPedido", array()), "html", null, true);
            echo "\" title=\"Ver Mas\">Pedido ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idPedido", array()), "html", null, true);
            echo "</a></td>
            <td> <a href=\"/fichaTarea?idPedido=";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idPedido", array()), "html", null, true);
            echo "&idTarea=";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idTarea", array()), "html", null, true);
            echo "\" title=\"Ver Mas\"> Tarea
                    ";
            // line 32
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "idTarea", array()), "html", null, true);
            echo "</a></td>
            <td>";
            // line 33
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "descripcion", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 34
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "especializacionNombre", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tarea"], "prioridad", array()), "html", null, true);
            echo "</td>
        </tr>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 38
            echo "        <h2 class='error'>No hay Tareas o ya están todas asignadas</h2> ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tarea'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "    </table>
</div>

<div class=\"contenido2\">
    <h4>Proximos Eventos</h4>
    <table id=\"miTabla2\">
        <th onclick=\"sortTable(0,'miTabla2')\">Nº Evento</th>
        <th onclick=\"sortTable(1,'miTabla2')\">Nombre</th>
        <th onclick=\"sortTable(2,'miTabla2')\">Descripcion</th>
        <th onclick=\"sortTable(3,'miTabla2')\">Fecha Inicio</th>
        <th onclick=\"sortTable(4,'miTabla2')\">Fecha Fin</th>
        <th>Accion</th>
        ";
        // line 51
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "todosEventos", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["evento"]) {
            echo " ";
            if ((twig_get_attribute($this->env, $this->source, $context["evento"], "fechaInicio", array()) == twig_date_format_filter($this->env, "now", "d/m/Y"))) {
                // line 52
                echo "        <tr>
            <td style=\"background-color:lightgreen\">";
                // line 53
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "idEvento", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 54
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "nombreEvento", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 55
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "descripcion", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 56
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaInicio", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">";
                // line 57
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaFin", array()), "html", null, true);
                echo "</td>
            <td style=\"background-color:lightgreen\">
                <a href=\"/pedido/verTodos?idEvento=";
                // line 59
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "idEvento", array()), "html", null, true);
                echo "\">
                    <input type=\"button\" value=\"Crear Pedido\">
                </a>
            </td>
        </tr>
        ";
            } else {
                // line 65
                echo "        <tr>
            <td>";
                // line 66
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "idEvento", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 67
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "nombreEvento", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 68
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "descripcion", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 69
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaInicio", array()), "html", null, true);
                echo "</td>
            <td>";
                // line 70
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["evento"], "fechaFin", array()), "html", null, true);
                echo "</td>
            <td></td>
        </tr>
        ";
            }
            // line 73
            echo " ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 74
            echo "        <h2 class='error'>No hay eventos</h2> ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['evento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
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
        return array (  238 => 75,  232 => 74,  227 => 73,  220 => 70,  216 => 69,  212 => 68,  208 => 67,  204 => 66,  201 => 65,  192 => 59,  187 => 57,  183 => 56,  179 => 55,  175 => 54,  171 => 53,  168 => 52,  161 => 51,  147 => 39,  141 => 38,  133 => 35,  129 => 34,  125 => 33,  121 => 32,  115 => 31,  109 => 30,  106 => 29,  99 => 28,  84 => 16,  78 => 13,  72 => 10,  66 => 7,  60 => 3,  57 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Home{% endblock %} {% block header %} {% set nombreUsuario = datos.userLogueado %} {% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %} {% endblock %} {% block head %} {{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}


<ul class=\"contenido\">
    <li>
        <h4>Pedidos Activos:<br>{{ datos.cantidadPedidos }} </h4>
    </li>
    <li>
        <h4>Tareas sin Asignar:<br>{{ datos.cantTareasSinAsignar }}</h4>
    </li>
    <li>
        <h4>Agentes Disponibles:<br> {{ datos.agentesDisponibles }}</h4>
    </li>
    <li>
        <h4>Ordenes de Trabajo Activas:<br>{{ datos.otActivas }} </h4>
    </li>
</ul>

<div class=\"contenido1\">
    <h4>Tareas sin Asignar</h4>
    <table id=\"miTabla\">
        <th onclick=\"sortTable(0,'miTabla')\">Nº Pedido</th>
        <th onclick=\"sortTable(1,'miTabla')\">Nº Tarea</th>
        <th onclick=\"sortTable(2,'miTabla')\">Descripcion</th>
        <th onclick=\"sortTable(3,'miTabla')\">Especializacion</th>
        <th onclick=\"sortTable(4,'miTabla')\">Prioridad</th>
        {% set i = 1 %} {% for tarea in datos.tareasSinAsignar %}
        <tr>
            <td> <a href=\"/fichaPedido?id={{ tarea.idPedido }}\" title=\"Ver Mas\">Pedido {{ tarea.idPedido }}</a></td>
            <td> <a href=\"/fichaTarea?idPedido={{ tarea.idPedido }}&idTarea={{ tarea.idTarea }}\" title=\"Ver Mas\"> Tarea
                    {{ tarea.idTarea }}</a></td>
            <td>{{ tarea.descripcion }}</td>
            <td>{{ tarea.especializacionNombre }}</td>
            <td>{{ tarea.prioridad }}</td>
        </tr>
        {% else %}
        <h2 class='error'>No hay Tareas o ya están todas asignadas</h2> {% endfor %}
    </table>
</div>

<div class=\"contenido2\">
    <h4>Proximos Eventos</h4>
    <table id=\"miTabla2\">
        <th onclick=\"sortTable(0,'miTabla2')\">Nº Evento</th>
        <th onclick=\"sortTable(1,'miTabla2')\">Nombre</th>
        <th onclick=\"sortTable(2,'miTabla2')\">Descripcion</th>
        <th onclick=\"sortTable(3,'miTabla2')\">Fecha Inicio</th>
        <th onclick=\"sortTable(4,'miTabla2')\">Fecha Fin</th>
        <th>Accion</th>
        {% for evento in datos.todosEventos %} {% if evento.fechaInicio == \"now\"|date(\"d/m/Y\") %}
        <tr>
            <td style=\"background-color:lightgreen\">{{ evento.idEvento }}</td>
            <td style=\"background-color:lightgreen\">{{ evento.nombreEvento }}</td>
            <td style=\"background-color:lightgreen\">{{ evento.descripcion }}</td>
            <td style=\"background-color:lightgreen\">{{ evento.fechaInicio }}</td>
            <td style=\"background-color:lightgreen\">{{ evento.fechaFin }}</td>
            <td style=\"background-color:lightgreen\">
                <a href=\"/pedido/verTodos?idEvento={{ evento.idEvento }}\">
                    <input type=\"button\" value=\"Crear Pedido\">
                </a>
            </td>
        </tr>
        {% else %}
        <tr>
            <td>{{ evento.idEvento }}</td>
            <td>{{ evento.nombreEvento }}</td>
            <td>{{ evento.descripcion }}</td>
            <td>{{ evento.fechaInicio }}</td>
            <td>{{ evento.fechaFin }}</td>
            <td></td>
        </tr>
        {% endif %} {% else %}
        <h2 class='error'>No hay eventos</h2> {% endfor %}
    </table>
</div>
{% endblock %}
", "index.home.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\index.home.html");
    }
}
