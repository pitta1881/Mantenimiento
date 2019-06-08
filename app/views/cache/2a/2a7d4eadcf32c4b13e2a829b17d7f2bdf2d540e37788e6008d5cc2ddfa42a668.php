<?php

/* OTVerTodos.html */
class __TwigTemplate_9335debac7625fc03c4fe094d93a201fee7ba116ea466fed50a74fc6afa30ebe extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "OTVerTodos.html", 1);
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
        echo "Lista de OTs";
    }

    public function block_header($context, array $blocks = array())
    {
        // line 2
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        // line 3
        $this->loadTemplate("partials/nav.html", "OTVerTodos.html", 3)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
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
        echo "<h1>Listado de Ordenes de Trabajo</h1>
<a href=\"/ot/crear\">
    <input type=\"button\" value=\"Crear OT\">
</a>
<table>
    <th>Nº OT</th>
    <th>Fecha de Inicio</th>
    <th>Fecha de Fin</th>
    <th>Estado</th>
    <th>Tareas Asignadas</th>
    <th>Accion</th>
    ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "todasOT", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["OT"]) {
            // line 18
            echo "    <tr>
        <td>";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["OT"], "idOT", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 20
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["OT"], "fechaInicio", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 21
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["OT"], "fechaFin", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 22
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["OT"], "estado", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 23
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["OT"], "tareasAsignadas", array()), "html", null, true);
            echo "</td>
        <td>
            <a href='/OT/verTareas?idOT=";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["OT"], "id", array()), "html", null, true);
            echo "'>
                <input type=\"button\" value=\"VER TAREAS\"></a>
        </td>
    </tr>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 30
            echo "    <h2 class='error'>No hay OTs</h2> ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['OT'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "OTVerTodos.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 31,  112 => 30,  102 => 25,  97 => 23,  93 => 22,  89 => 21,  85 => 20,  81 => 19,  78 => 18,  73 => 17,  60 => 6,  57 => 5,  51 => 4,  44 => 3,  42 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Lista de OTs{% endblock %} {% block header %}
{% set nombreUsuario = datos.userLogueado %}
{% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}} {% endblock %} {% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}
<h1>Listado de Ordenes de Trabajo</h1>
<a href=\"/ot/crear\">
    <input type=\"button\" value=\"Crear OT\">
</a>
<table>
    <th>Nº OT</th>
    <th>Fecha de Inicio</th>
    <th>Fecha de Fin</th>
    <th>Estado</th>
    <th>Tareas Asignadas</th>
    <th>Accion</th>
    {% for OT in datos.todasOT %}
    <tr>
        <td>{{ OT.idOT }}</td>
        <td>{{ OT.fechaInicio }}</td>
        <td>{{ OT.fechaFin }}</td>
        <td>{{ OT.estado }}</td>
        <td>{{ OT.tareasAsignadas }}</td>
        <td>
            <a href='/OT/verTareas?idOT={{ OT.id }}'>
                <input type=\"button\" value=\"VER TAREAS\"></a>
        </td>
    </tr>
    {% else %}
    <h2 class='error'>No hay OTs</h2> {% endfor %}
</table>
{% endblock %}", "OTVerTodos.html", "D:\\Descargas\\mantenimiento\\2019_TP4_PAW\\Mantenimiento\\app\\views\\OTVerTodos.html");
    }
}
