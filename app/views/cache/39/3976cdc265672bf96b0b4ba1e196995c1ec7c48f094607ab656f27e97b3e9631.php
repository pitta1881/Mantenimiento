<?php

/* tareaModificar.html */
class __TwigTemplate_f16102f93948a4cbf261779c0524e5bfea1ab846eafdb34e51068d8c62e29e42 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "tareaModificar.html", 1);
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
        echo "Crear Tarea Nueva";
    }

    // line 5
    public function block_header($context, array $blocks = array())
    {
        // line 6
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        // line 7
        $this->loadTemplate("partials/nav.html", "tareaModificar.html", 7)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
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
        echo "<h2>Modificar Tarea Nº ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "unaTarea", array()), "idTarea", array()), "html", null, true);
        echo " del Pedido Nº ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "unaTarea", array()), "idPedido", array()), "html", null, true);
        echo "</h2>
<form action=\"/tarea/modificar/guardar\" method=\"post\" id=\"formularioTarea\">
    <label for=\"idTarea\">Tarea</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"idTarea\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "unaTarea", array()), "idTarea", array()), "html", null, true);
        echo "\" readonly>
    <label for=\"idPedido\">Pedido</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"idPedido\" value=\"";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "unaTarea", array()), "idPedido", array()), "html", null, true);
        echo "\" readonly>
    <label for=\"descripcion\">Descripcion</label>
    <input type=\"textarea\" name=\"descripcion\" autofocus required value=\"";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "unaTarea", array()), "descripcion", array()), "html", null, true);
        echo "\">
    <label for=\"especializacion\">Especializacion</label>
    <select name=\"especializacion\">
        ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "especializaciones", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["especializacion"]) {
            // line 27
            echo "        ";
            if (($context["especializacion"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "unaTarea", array()), "especializacion", array()))) {
                // line 28
                echo "        <option value=\"";
                echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
                echo "\" selected>";
                echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
                echo "</option>
        ";
            } else {
                // line 30
                echo "        <option value=\"";
                echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
                echo "</option>
        ";
            }
            // line 32
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['especializacion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "    </select>
    <label for=\"prioridad\">Prioridad</label>
    <select name=\"prioridad\">
        ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "prioridades", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 38
            echo "        ";
            if (($context["prioridad"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "unaTarea", array()), "prioridad", array()))) {
                // line 39
                echo "        <option value=\"";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "\" selected>";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "</option>
        ";
            } else {
                // line 41
                echo "        <option value=\"";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "</option>
        ";
            }
            // line 43
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "    </select>
    <label for=\"estado\">Estado</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"estado\" value=\"";
        // line 46
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "unaTarea", array()), "estado", array()), "html", null, true);
        echo "\" readonly>
    <input type=\"submit\" value=\"Guardar Cambios\">
</form>
";
    }

    public function getTemplateName()
    {
        return "tareaModificar.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  158 => 46,  154 => 44,  148 => 43,  140 => 41,  132 => 39,  129 => 38,  125 => 37,  120 => 34,  113 => 32,  105 => 30,  97 => 28,  94 => 27,  90 => 26,  84 => 23,  79 => 21,  74 => 19,  65 => 16,  62 => 15,  55 => 11,  52 => 10,  46 => 7,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Crear Tarea Nueva{% endblock %}

{% block header %}
{% set nombreUsuario = datos.userLogueado %}
{% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h2>Modificar Tarea Nº {{ datos.unaTarea.idTarea }} del Pedido Nº {{ datos.unaTarea.idPedido }}</h2>
<form action=\"/tarea/modificar/guardar\" method=\"post\" id=\"formularioTarea\">
    <label for=\"idTarea\">Tarea</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"idTarea\" value=\"{{ datos.unaTarea.idTarea }}\" readonly>
    <label for=\"idPedido\">Pedido</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"idPedido\" value=\"{{ datos.unaTarea.idPedido }}\" readonly>
    <label for=\"descripcion\">Descripcion</label>
    <input type=\"textarea\" name=\"descripcion\" autofocus required value=\"{{ datos.unaTarea.descripcion }}\">
    <label for=\"especializacion\">Especializacion</label>
    <select name=\"especializacion\">
        {% for especializacion in datos.especializaciones %}
        {% if especializacion == datos.unaTarea.especializacion %}
        <option value=\"{{ especializacion }}\" selected>{{ especializacion }}</option>
        {% else %}
        <option value=\"{{ especializacion }}\">{{ especializacion }}</option>
        {% endif %}

        {% endfor %}
    </select>
    <label for=\"prioridad\">Prioridad</label>
    <select name=\"prioridad\">
        {% for prioridad in datos.prioridades %}
        {% if prioridad == datos.unaTarea.prioridad %}
        <option value=\"{{ prioridad }}\" selected>{{ prioridad }}</option>
        {% else %}
        <option value=\"{{ prioridad }}\">{{ prioridad }}</option>
        {% endif %}
        {% endfor %}
    </select>
    <label for=\"estado\">Estado</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"estado\" value=\"{{ datos.unaTarea.estado }}\" readonly>
    <input type=\"submit\" value=\"Guardar Cambios\">
</form>
{% endblock %}", "tareaModificar.html", "D:\\Descargas\\mantenimiento\\2019_TP4_PAW\\Mantenimiento\\app\\views\\tareaModificar.html");
    }
}
