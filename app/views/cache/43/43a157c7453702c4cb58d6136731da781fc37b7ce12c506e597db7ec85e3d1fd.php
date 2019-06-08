<?php

/* OTTareasSinAsignar.html */
class __TwigTemplate_9a4a8b3d712d31bf71e00361f166e4de6695344508732b9acd7f15a8ed11d196 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "OTTareasSinAsignar.html", 1);
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
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        // line 7
        $this->loadTemplate("partials/nav.html", "OTTareasSinAsignar.html", 7)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
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
        echo "<h3>Aca irian los filtros y metodos de ordenamiento</h3>
<h1>TAREAS SIN ASIGNAR </h1>
<form action=\"/ot/crear/seleccionados\" method=\"post\">
    <table>
        <th>Nº Pedido</th>
        <th>Nº Tarea</th>
        <th>Descripcion</th>
        <th>Especializacion</th>
        <th>Prioridad</th>
        <th>Seleccionar</th>
        ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "tareasSinAsignar", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tareas"]) {
            // line 27
            echo "        <tr>
            <td>";
            // line 28
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "idPedido", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "idTarea", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "descripcion", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "especializacion", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 32
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "prioridad", array()), "html", null, true);
            echo "</td>
            <td><input type=\"checkbox\" name=\"";
            // line 33
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "idPedido", array()), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "idTarea", array()), "html", null, true);
            echo "\"></td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tareas'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "    </table>
    <input type=\"submit\" value=\"Crear OT\">
</form>
";
        // line 39
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "tareasSinAsignar", array())) == 0)) {
            // line 40
            echo "<h2 class='error'>No hay Tareas o ya están todas asignadas</h2>
";
        }
    }

    public function getTemplateName()
    {
        return "OTTareasSinAsignar.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 40,  120 => 39,  115 => 36,  104 => 33,  100 => 32,  96 => 31,  92 => 30,  88 => 29,  84 => 28,  81 => 27,  77 => 26,  65 => 16,  62 => 15,  55 => 11,  52 => 10,  46 => 7,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Lista de Tareas{% endblock %}

{% block header %}
{% set nombreUsuario = datos.userLogueado %}
{% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h3>Aca irian los filtros y metodos de ordenamiento</h3>
<h1>TAREAS SIN ASIGNAR </h1>
<form action=\"/ot/crear/seleccionados\" method=\"post\">
    <table>
        <th>Nº Pedido</th>
        <th>Nº Tarea</th>
        <th>Descripcion</th>
        <th>Especializacion</th>
        <th>Prioridad</th>
        <th>Seleccionar</th>
        {% for tareas in datos.tareasSinAsignar %}
        <tr>
            <td>{{ tareas.idPedido }}</td>
            <td>{{ tareas.idTarea }}</td>
            <td>{{ tareas.descripcion }}</td>
            <td>{{ tareas.especializacion }}</td>
            <td>{{ tareas.prioridad }}</td>
            <td><input type=\"checkbox\" name=\"{{ tareas.idPedido }}\" value=\"{{ tareas.idTarea }}\"></td>
        </tr>
        {% endfor %}
    </table>
    <input type=\"submit\" value=\"Crear OT\">
</form>
{% if datos.tareasSinAsignar|length == 0 %}
<h2 class='error'>No hay Tareas o ya están todas asignadas</h2>
{% endif %}
{% endblock %}", "OTTareasSinAsignar.html", "D:\\Descargas\\mantenimiento\\2019_TP4_PAW\\Mantenimiento\\app\\views\\OTTareasSinAsignar.html");
    }
}
