<?php

/* modificarPedido.html */
class __TwigTemplate_dffff815d87ccfdf4f2cd62f1f587fe9930fd48d311ddd2403314a368bc49975 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "modificarPedido.html", 1);
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
        echo "<h2>Modificar Pedido Nº ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "id", array()), "html", null, true);
        echo "</h2>
<form action=\"/pedido/modificar\" method=\"POST\">
    <fieldset>
        <legend>Datos Basicos</legend>
        <label for=\"id\">Numero de Pedido</label>
        <input type=\"text\" name=\"id\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "id", array()), "html", null, true);
        echo "\" readonly>
        <label for=\"fechaInicio\">Fecha</label>
        <input type=\"date\" name=\"fechaInicio\" value=\"";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "fechaInicio", array()), "html", null, true);
        echo "\"
            min=\"";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "fechaInicio", array()), "html", null, true);
        echo "\">
        <label for=\"estado\">Estado</label>
        <select name=\"estado\">
            ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "estados", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["estado"]) {
            // line 27
            echo "            ";
            if (($context["estado"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "estado", array()))) {
                // line 28
                echo "            <option value=";
                echo twig_escape_filter($this->env, $context["estado"], "html", null, true);
                echo " selected>";
                echo twig_escape_filter($this->env, $context["estado"], "html", null, true);
                echo " </option>
            ";
            } else {
                // line 30
                echo "            <option value=";
                echo twig_escape_filter($this->env, $context["estado"], "html", null, true);
                echo ">";
                echo twig_escape_filter($this->env, $context["estado"], "html", null, true);
                echo "</option>
            ";
            }
            // line 32
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "        </select>
        <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
        <input type=\"text\" name=\"descripcion\" autofocus required value=\"";
        // line 35
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "descripcion", array()), "html", null, true);
        echo "\">
        <label for=\"sector\">Sector</label>
        <select name=\"sector\">
            ";
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "sectores", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["sector"]) {
            // line 39
            echo "            ";
            if (($context["sector"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "sector", array()))) {
                // line 40
                echo "            <!--NO FUNCIONA, SEGURO EL TEMA DE LOS ESPACIOS-->
            <option value=";
                // line 41
                echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
                echo " selected>";
                echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
                echo "</option>
            ";
            } else {
                // line 43
                echo "            <option value=";
                echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
                echo ">";
                echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
                echo "</option>
            ";
            }
            // line 45
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sector'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "        </select>
    </fieldset>
    <fieldset>
        <legend>Prioridad<span class=\"asterisco\">*</span></legend>
        ";
        // line 50
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "prioridades", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 51
            echo "        ";
            if (($context["prioridad"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "prioridad", array()))) {
                // line 52
                echo "        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required checked
                value=\"";
                // line 53
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "</label>
        ";
            } else {
                // line 55
                echo "        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required
                value=\"";
                // line 56
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "</label>
        ";
            }
            // line 58
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        echo "    </fieldset>
    <input type=\"submit\">
    <input type=\"reset\">
</form>

";
    }

    public function getTemplateName()
    {
        return "modificarPedido.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 59,  190 => 58,  183 => 56,  180 => 55,  173 => 53,  170 => 52,  167 => 51,  163 => 50,  157 => 46,  151 => 45,  143 => 43,  136 => 41,  133 => 40,  130 => 39,  126 => 38,  120 => 35,  116 => 33,  110 => 32,  102 => 30,  94 => 28,  91 => 27,  87 => 26,  81 => 23,  77 => 22,  72 => 20,  63 => 15,  60 => 14,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
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
<h2>Modificar Pedido Nº {{ arrayDatos.miPedido.id }}</h2>
<form action=\"/pedido/modificar\" method=\"POST\">
    <fieldset>
        <legend>Datos Basicos</legend>
        <label for=\"id\">Numero de Pedido</label>
        <input type=\"text\" name=\"id\" value=\"{{ arrayDatos.miPedido.id }}\" readonly>
        <label for=\"fechaInicio\">Fecha</label>
        <input type=\"date\" name=\"fechaInicio\" value=\"{{ arrayDatos.miPedido.fechaInicio }}\"
            min=\"{{ arrayDatos.miPedido.fechaInicio }}\">
        <label for=\"estado\">Estado</label>
        <select name=\"estado\">
            {% for estado in arrayDatos.estados %}
            {% if estado == arrayDatos.miPedido.estado %}
            <option value={{ estado }} selected>{{ estado }} </option>
            {% else %}
            <option value={{ estado }}>{{ estado }}</option>
            {% endif %}
            {% endfor %}
        </select>
        <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
        <input type=\"text\" name=\"descripcion\" autofocus required value=\"{{ arrayDatos.miPedido.descripcion}}\">
        <label for=\"sector\">Sector</label>
        <select name=\"sector\">
            {% for sector in arrayDatos.sectores %}
            {% if sector == arrayDatos.miPedido.sector %}
            <!--NO FUNCIONA, SEGURO EL TEMA DE LOS ESPACIOS-->
            <option value={{ sector }} selected>{{ sector }}</option>
            {% else %}
            <option value={{ sector }}>{{ sector }}</option>
            {% endif %}
            {% endfor %}
        </select>
    </fieldset>
    <fieldset>
        <legend>Prioridad<span class=\"asterisco\">*</span></legend>
        {% for prioridad in arrayDatos.prioridades %}
        {% if prioridad == arrayDatos.miPedido.prioridad %}
        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required checked
                value=\"{{ prioridad }}\">{{ prioridad }}</label>
        {% else %}
        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required
                value=\"{{ prioridad }}\">{{ prioridad }}</label>
        {% endif %}
        {% endfor %}
    </fieldset>
    <input type=\"submit\">
    <input type=\"reset\">
</form>

{% endblock %}", "modificarPedido.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\modificarPedido.html");
    }
}
