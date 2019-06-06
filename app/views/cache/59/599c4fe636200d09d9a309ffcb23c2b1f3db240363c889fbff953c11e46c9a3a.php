<?php

/* verTodasTareas.html */
class __TwigTemplate_8b1a74e8f677ea4332f5fcfb65108c335222aafeaf8ecd2546c287513564dba9 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "verTodasTareas.html", 1);
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
        echo "<h1>TAREAS CORRESPONDIENTES AL PEDIDO Nº ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "idPedido", array()), "html", null, true);
        echo " </h1>
<input type=\"button\" value=\"CREAR NUEVA TAREA\" onclick=\"mostrarFormulario()\">
<script>
    function mostrarFormulario() {
        var formularioTarea = document.getElementById('formularioTarea');
        if (formularioTarea.style.display == \"block\") {
            formularioTarea.style.display = \"none\";
        } else {
            formularioTarea.style.display = \"block\"
        }
    }
</script>
<form action=\"tarea/guardar\" method=\"post\" id=\"formularioTarea\" style=\"display: none\">
    <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
    <input type=\"textarea\" name=\"descripcion\" autofocus required placeholder=\"Ingrese la descripcion..\">
    <label for=\"especialidades\">Especialidad</label><span class=\"asterisco\">*</span>
    <select name=\"especialidades\">
        ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "especialidades", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["especialidad"]) {
            // line 33
            echo "        <option value=\"";
            echo twig_escape_filter($this->env, $context["especialidad"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["especialidad"], "html", null, true);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['especialidad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "    </select>
    <label for=\"prioridades\">Prioridad</label><span class=\"asterisco\">*</span>
    <select name=\"prioridades\">
        ";
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "prioridades", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 39
            echo "        <option value=\"";
            echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "    </select>
    <label for=\"estado\">Estado</label>
    <input type=\"text\" name=\"estado\" value=\"";
        // line 43
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "estados", array()), 0, array()), "html", null, true);
        echo "\" readonly>
    <input type=\"submit\" value=\"Crear Tarea\">
</form>
<table>
    <th>Nº Tarea</th>
    <th>Descripcion</th>
    <th>Especializacion</th>
    <th>Prioridad</th>
    <th>Estado</th>
    ";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "todasTareas", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tareas"]) {
            // line 53
            echo "    <tr>
        <td>";
            // line 54
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "id", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 55
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "descripcion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 56
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "especializacion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 57
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "prioridad", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 58
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "estado", array()), "html", null, true);
            echo "</td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tareas'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "</table>
";
        // line 62
        if ((twig_length_filter($this->env, ($context["tareas"] ?? null)) == 0)) {
            // line 63
            echo "<h2 class='error'>No hay Tareas asignadas aún</h2>
";
        }
    }

    public function getTemplateName()
    {
        return "verTodasTareas.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  172 => 63,  170 => 62,  167 => 61,  158 => 58,  154 => 57,  150 => 56,  146 => 55,  142 => 54,  139 => 53,  135 => 52,  123 => 43,  119 => 41,  108 => 39,  104 => 38,  99 => 35,  88 => 33,  84 => 32,  63 => 15,  60 => 14,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Lista de Tareas{% endblock %}

{% block header %}
{{ include('partials/nav.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h1>TAREAS CORRESPONDIENTES AL PEDIDO Nº {{ datos.idPedido }} </h1>
<input type=\"button\" value=\"CREAR NUEVA TAREA\" onclick=\"mostrarFormulario()\">
<script>
    function mostrarFormulario() {
        var formularioTarea = document.getElementById('formularioTarea');
        if (formularioTarea.style.display == \"block\") {
            formularioTarea.style.display = \"none\";
        } else {
            formularioTarea.style.display = \"block\"
        }
    }
</script>
<form action=\"tarea/guardar\" method=\"post\" id=\"formularioTarea\" style=\"display: none\">
    <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
    <input type=\"textarea\" name=\"descripcion\" autofocus required placeholder=\"Ingrese la descripcion..\">
    <label for=\"especialidades\">Especialidad</label><span class=\"asterisco\">*</span>
    <select name=\"especialidades\">
        {% for especialidad in datos.especialidades %}
        <option value=\"{{ especialidad }}\">{{ especialidad }}</option>
        {% endfor %}
    </select>
    <label for=\"prioridades\">Prioridad</label><span class=\"asterisco\">*</span>
    <select name=\"prioridades\">
        {% for prioridad in datos.prioridades %}
        <option value=\"{{ prioridad }}\">{{ prioridad }}</option>
        {% endfor %}
    </select>
    <label for=\"estado\">Estado</label>
    <input type=\"text\" name=\"estado\" value=\"{{ datos.estados.0 }}\" readonly>
    <input type=\"submit\" value=\"Crear Tarea\">
</form>
<table>
    <th>Nº Tarea</th>
    <th>Descripcion</th>
    <th>Especializacion</th>
    <th>Prioridad</th>
    <th>Estado</th>
    {% for tareas in datos.todasTareas %}
    <tr>
        <td>{{ tareas.id }}</td>
        <td>{{ tareas.descripcion }}</td>
        <td>{{ tareas.especializacion }}</td>
        <td>{{ tareas.prioridad }}</td>
        <td>{{ tareas.estado }}</td>
    </tr>
    {% endfor %}
</table>
{% if tareas|length == 0 %}
<h2 class='error'>No hay Tareas asignadas aún</h2>
{% endif %}
{% endblock %}", "verTodasTareas.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\verTodasTareas.html");
    }
}
