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
        echo "<h2>Modificar Tarea Nº ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "unaTarea", array()), "idTarea", array()), "html", null, true);
        echo " del Pedido Nº ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "unaTarea", array()), "idPedido", array()), "html", null, true);
        echo "</h2>
<form action=\"/tarea/modificar/guardar\" method=\"post\" id=\"formularioTarea\">
    <label for=\"idTarea\">Tarea</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"idTarea\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "unaTarea", array()), "idTarea", array()), "html", null, true);
        echo "\" readonly>
    <label for=\"idPedido\">Pedido</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"idPedido\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "unaTarea", array()), "idPedido", array()), "html", null, true);
        echo "\" readonly>
    <label for=\"descripcion\">Descripcion</label>
    <input type=\"textarea\" name=\"descripcion\" autofocus required value=\"";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "unaTarea", array()), "descripcion", array()), "html", null, true);
        echo "\">
    <label for=\"especializacion\">Especializacion</label>
    <select name=\"especializacion\">
        ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "especializaciones", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["especializacion"]) {
            // line 26
            echo "        ";
            if (($context["especializacion"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "unaTarea", array()), "especializacion", array()))) {
                // line 27
                echo "        <option value=\"";
                echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
                echo "\" selected>";
                echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
                echo "</option>
        ";
            } else {
                // line 29
                echo "        <option value=\"";
                echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["especializacion"], "html", null, true);
                echo "</option>
        ";
            }
            // line 31
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['especializacion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "    </select>
    <label for=\"prioridad\">Prioridad</label>
    <select name=\"prioridad\">
        ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "prioridades", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 37
            echo "        ";
            if (($context["prioridad"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "unaTarea", array()), "prioridad", array()))) {
                // line 38
                echo "        <option value=\"";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "\" selected>";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "</option>
        ";
            } else {
                // line 40
                echo "        <option value=\"";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "</option>
        ";
            }
            // line 42
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "    </select>
    <label for=\"estado\">Estado</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"estado\" value=\"";
        // line 45
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "unaTarea", array()), "estado", array()), "html", null, true);
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
        return array (  156 => 45,  152 => 43,  146 => 42,  138 => 40,  130 => 38,  127 => 37,  123 => 36,  118 => 33,  111 => 31,  103 => 29,  95 => 27,  92 => 26,  88 => 25,  82 => 22,  77 => 20,  72 => 18,  63 => 15,  60 => 14,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Crear Tarea Nueva{% endblock %}

{% block header %}
{{ include('partials/nav.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}

{% block main %}
<h2>Modificar Tarea Nº {{ arrayDatos.unaTarea.idTarea }} del Pedido Nº {{ arrayDatos.unaTarea.idPedido }}</h2>
<form action=\"/tarea/modificar/guardar\" method=\"post\" id=\"formularioTarea\">
    <label for=\"idTarea\">Tarea</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"idTarea\" value=\"{{ arrayDatos.unaTarea.idTarea }}\" readonly>
    <label for=\"idPedido\">Pedido</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"idPedido\" value=\"{{ arrayDatos.unaTarea.idPedido }}\" readonly>
    <label for=\"descripcion\">Descripcion</label>
    <input type=\"textarea\" name=\"descripcion\" autofocus required value=\"{{ arrayDatos.unaTarea.descripcion }}\">
    <label for=\"especializacion\">Especializacion</label>
    <select name=\"especializacion\">
        {% for especializacion in arrayDatos.especializaciones %}
        {% if especializacion == arrayDatos.unaTarea.especializacion %}
        <option value=\"{{ especializacion }}\" selected>{{ especializacion }}</option>
        {% else %}
        <option value=\"{{ especializacion }}\">{{ especializacion }}</option>
        {% endif %}

        {% endfor %}
    </select>
    <label for=\"prioridad\">Prioridad</label>
    <select name=\"prioridad\">
        {% for prioridad in arrayDatos.prioridades %}
        {% if prioridad == arrayDatos.unaTarea.prioridad %}
        <option value=\"{{ prioridad }}\" selected>{{ prioridad }}</option>
        {% else %}
        <option value=\"{{ prioridad }}\">{{ prioridad }}</option>
        {% endif %}
        {% endfor %}
    </select>
    <label for=\"estado\">Estado</label><span class=\"asterisco\">*</span>
    <input type=\"text\" name=\"estado\" value=\"{{ arrayDatos.unaTarea.estado }}\" readonly>
    <input type=\"submit\" value=\"Guardar Cambios\">
</form>
{% endblock %}", "tareaModificar.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\tareaModificar.html");
    }
}
