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
    <label for=\"idPedido\">Pedido</label>
    <input type=\"text\" name=\"idPedido\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "idPedido", array()), "html", null, true);
        echo "\" readonly>
    <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
    <input type=\"textarea\" name=\"descripcion\" autofocus required placeholder=\"Ingrese la descripcion..\">
    <label for=\"especializacion\">Especializacion</label><span class=\"asterisco\">*</span>
    <select name=\"especializacion\">
        ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "especializaciones", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["especializacion"]) {
            // line 35
            echo "        <option value=\"";
            echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['especializacion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "    </select>
    <label for=\"prioridad\">Prioridad</label><span class=\"asterisco\">*</span>
    <select name=\"prioridad\">
        ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "prioridades", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 41
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
        // line 43
        echo "    </select>
    <label for=\"estado\">Estado</label>
    <input type=\"text\" name=\"estado\" value=\"";
        // line 45
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
    <th>Accion</th>
    ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "todasTareas", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tareas"]) {
            // line 56
            echo "    <tr>
        <td>";
            // line 57
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "idTarea", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 58
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "descripcion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 59
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "especializacion", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 60
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "prioridad", array()), "html", null, true);
            echo "</td>
        <td>";
            // line 61
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "estado", array()), "html", null, true);
            echo "</td>
        <td><a href=\"/tarea/modificar/seleccionado?idPedido=";
            // line 62
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "idPedido", array()), "html", null, true);
            echo "&idTarea=";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "idTarea", array()), "html", null, true);
            echo "\"><input
                    type=\"button\" value=\"Modificar\"></a>
            <a href=\"#\"><input type=\"button\" value=\"Ver Insumos\"></a>
            <input type=\"button\" value=\"Eliminar\"
                onclick=\"confirmacion( '";
            // line 66
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "idPedido", array()), "html", null, true);
            echo "','";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tareas"], "idTarea", array()), "html", null, true);
            echo "' )\">
        </td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tareas'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "</table>
";
        // line 71
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "todasTareas", array())) == 0)) {
            // line 72
            echo "<h2 class='error'>No hay Tareas asignadas aún</h2>
";
        }
        // line 74
        echo "<script>
    function confirmacion(nPedido, nTarea) {
        var retorno = confirm(\"¿Esta seguro que desea eliminar la tarea?\");
        if (retorno) {
            location.replace(\"/pedido/tarea/eliminar?idPedido=\" + nPedido + \"&idTarea=\" + nTarea);
            alert(\"nose xq ahora falla la pagina pero elimina bien!\");
        }
    }
</script>
";
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
        return array (  198 => 74,  194 => 72,  192 => 71,  189 => 70,  177 => 66,  168 => 62,  164 => 61,  160 => 60,  156 => 59,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  128 => 45,  124 => 43,  113 => 41,  109 => 40,  104 => 37,  93 => 35,  89 => 34,  81 => 29,  63 => 15,  60 => 14,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
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
    <label for=\"idPedido\">Pedido</label>
    <input type=\"text\" name=\"idPedido\" value=\"{{ datos.idPedido }}\" readonly>
    <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
    <input type=\"textarea\" name=\"descripcion\" autofocus required placeholder=\"Ingrese la descripcion..\">
    <label for=\"especializacion\">Especializacion</label><span class=\"asterisco\">*</span>
    <select name=\"especializacion\">
        {% for especializacion in datos.especializaciones %}
        <option value=\"{{ especializacion }}\">{{ especializacion }}</option>
        {% endfor %}
    </select>
    <label for=\"prioridad\">Prioridad</label><span class=\"asterisco\">*</span>
    <select name=\"prioridad\">
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
    <th>Accion</th>
    {% for tareas in datos.todasTareas %}
    <tr>
        <td>{{ tareas.idTarea }}</td>
        <td>{{ tareas.descripcion }}</td>
        <td>{{ tareas.especializacion }}</td>
        <td>{{ tareas.prioridad }}</td>
        <td>{{ tareas.estado }}</td>
        <td><a href=\"/tarea/modificar/seleccionado?idPedido={{ datos.idPedido }}&idTarea={{ tareas.idTarea }}\"><input
                    type=\"button\" value=\"Modificar\"></a>
            <a href=\"#\"><input type=\"button\" value=\"Ver Insumos\"></a>
            <input type=\"button\" value=\"Eliminar\"
                onclick=\"confirmacion( '{{ datos.idPedido }}','{{ tareas.idTarea }}' )\">
        </td>
    </tr>
    {% endfor %}
</table>
{% if datos.todasTareas|length == 0 %}
<h2 class='error'>No hay Tareas asignadas aún</h2>
{% endif %}
<script>
    function confirmacion(nPedido, nTarea) {
        var retorno = confirm(\"¿Esta seguro que desea eliminar la tarea?\");
        if (retorno) {
            location.replace(\"/pedido/tarea/eliminar?idPedido=\" + nPedido + \"&idTarea=\" + nTarea);
            alert(\"nose xq ahora falla la pagina pero elimina bien!\");
        }
    }
</script>
{% endblock %}", "verTodasTareas.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\verTodasTareas.html");
    }
}
