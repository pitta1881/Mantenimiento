<?php

/* pedidoModificar.html */
class __TwigTemplate_ea88369093cb7f3a84bafbebd40b6edb4ba1c3db5411b0e61f379210b62695bf extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "pedidoModificar.html", 1);
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
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "userLogueado", array());
        // line 7
        $this->loadTemplate("partials/nav.html", "pedidoModificar.html", 7)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
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
        echo "<h2>Modificar Pedido Nº ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "id", array()), "html", null, true);
        echo "</h2>
<form action=\"/pedido/modificar\" method=\"POST\">
    <fieldset>
        <legend>Datos Basicos</legend>
        <label for=\"id\">Numero de Pedido</label>
        <input type=\"text\" name=\"id\" value=\"";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "id", array()), "html", null, true);
        echo "\" readonly>
        <label for=\"nombreUsuario\">Usuario Creador</label>
        <input type=\"text\" name=\"nombreUsuario\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "nombreUsuario", array()), "html", null, true);
        echo "\" readonly>
        <label for=\"fechaInicio\">Fecha</label>
        <input type=\"date\" name=\"fechaInicio\" value=\"";
        // line 25
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "fechaInicio", array()), "html", null, true);
        echo "\"
            min=\"";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "fechaInicio", array()), "html", null, true);
        echo "\">
        <label for=\"estado\">Estado</label>
        <select name=\"estado\">
            ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "estados", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["estado"]) {
            // line 30
            echo "            ";
            if (($context["estado"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "estado", array()))) {
                // line 31
                echo "            <option value=";
                echo twig_escape_filter($this->env, $context["estado"], "html", null, true);
                echo " selected>";
                echo twig_escape_filter($this->env, $context["estado"], "html", null, true);
                echo " </option>
            ";
            } else {
                // line 33
                echo "            <option value=";
                echo twig_escape_filter($this->env, $context["estado"], "html", null, true);
                echo ">";
                echo twig_escape_filter($this->env, $context["estado"], "html", null, true);
                echo "</option>
            ";
            }
            // line 35
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "        </select>
        <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
        <input type=\"text\" name=\"descripcion\" autofocus required value=\"";
        // line 38
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "descripcion", array()), "html", null, true);
        echo "\">
        <label for=\"sector\">Sector</label>
        <select name=\"sector\">
            ";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "sectores", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["sector"]) {
            // line 42
            echo "            ";
            if (($context["sector"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "sector", array()))) {
                // line 43
                echo "            <!--NO FUNCIONA, SEGURO EL TEMA DE LOS ESPACIOS-->
            <option value=";
                // line 44
                echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
                echo " selected>";
                echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
                echo "</option>
            ";
            } else {
                // line 46
                echo "            <option value=";
                echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
                echo ">";
                echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
                echo "</option>
            ";
            }
            // line 48
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sector'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "        </select>
    </fieldset>
    <fieldset>
        <legend>Prioridad<span class=\"asterisco\">*</span></legend>
        ";
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "prioridades", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 54
            echo "        ";
            if (($context["prioridad"] == twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "miPedido", array()), "prioridad", array()))) {
                // line 55
                echo "        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required checked
                value=\"";
                // line 56
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "</label>
        ";
            } else {
                // line 58
                echo "        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required
                value=\"";
                // line 59
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
                echo "</label>
        ";
            }
            // line 61
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        echo "    </fieldset>
    <input type=\"submit\">
    <input type=\"reset\">
</form>

";
    }

    public function getTemplateName()
    {
        return "pedidoModificar.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  203 => 62,  197 => 61,  190 => 59,  187 => 58,  180 => 56,  177 => 55,  174 => 54,  170 => 53,  164 => 49,  158 => 48,  150 => 46,  143 => 44,  140 => 43,  137 => 42,  133 => 41,  127 => 38,  123 => 36,  117 => 35,  109 => 33,  101 => 31,  98 => 30,  94 => 29,  88 => 26,  84 => 25,  79 => 23,  74 => 21,  65 => 16,  62 => 15,  55 => 11,  52 => 10,  46 => 7,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Crear Tarea Nueva{% endblock %}

{% block header %}
{% set nombreUsuario = arrayDatos.userLogueado %}
{% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}}
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
        <label for=\"nombreUsuario\">Usuario Creador</label>
        <input type=\"text\" name=\"nombreUsuario\" value=\"{{ arrayDatos.miPedido.nombreUsuario }}\" readonly>
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

{% endblock %}", "pedidoModificar.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\pedidoModificar.html");
    }
}
