<?php

/* pedidoCrear.html */
class __TwigTemplate_c4b22470c6ce39fb642dda5abc8ea568d096add81bb897c2b557664dd6258004 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "pedidoCrear.html", 1);
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
        echo "Crear Tarea Nueva";
    }

    public function block_header($context, array $blocks = array())
    {
        // line 2
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        // line 3
        $this->loadTemplate("partials/nav.html", "pedidoCrear.html", 3)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
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
        echo "<h1>Crear Pedido</h1>
<form action=\"/pedido/validar\" method=\"POST\">
    <fieldset class=\"basicosPedido\">
        <legend>Datos Basicos</legend>
        <label for=\"nombreUsuario\">Usuario Creador</label>
        <input type=\"text\" name=\"nombreUsuario\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array()), "html", null, true);
        echo "\" readonly>
        <label for=\"fechaInicio\">Fecha</label>
        <input type=\"text\" name=\"fechaInicio\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "diaHoy", array()), "html", null, true);
        echo "\" readonly>
        <br>
        <label for=\"estado\">Estado</label>
        <input type=\"text\" name=\"estado\" value=\"";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "estados", array()), 0, array()), "html", null, true);
        echo "\" readonly>
        <br>
        <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
        <input type=\"textarea\" name=\"descripcion\" autofocus required placeholder=\"Ingrese la descripcion..\">
        <br>
        <label for=\"sector\">Sector</label>
        <select name=\"sector\">
            ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "sectores", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["sector"]) {
            // line 24
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["sector"], "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sector'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "        </select>
    </fieldset>
    <fieldset class=\"prioridad\">
        <legend>Prioridad<span class=\"asterisco\">*</span></legend>
        ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "prioridades", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 31
            echo "        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required
                value=";
            // line 32
            echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
            echo ">";
            echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
            echo "</label>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "    </fieldset>
    <input type=\"submit\">
    <input type=\"reset\">
</form>
";
    }

    public function getTemplateName()
    {
        return "pedidoCrear.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  126 => 34,  116 => 32,  113 => 31,  109 => 30,  103 => 26,  92 => 24,  88 => 23,  78 => 16,  72 => 13,  67 => 11,  60 => 6,  57 => 5,  51 => 4,  44 => 3,  42 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Crear Tarea Nueva{% endblock %} {% block header %}
{% set nombreUsuario = datos.userLogueado %}
{% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}} {% endblock %} {% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}
<h1>Crear Pedido</h1>
<form action=\"/pedido/validar\" method=\"POST\">
    <fieldset class=\"basicosPedido\">
        <legend>Datos Basicos</legend>
        <label for=\"nombreUsuario\">Usuario Creador</label>
        <input type=\"text\" name=\"nombreUsuario\" value=\"{{ datos.userLogueado }}\" readonly>
        <label for=\"fechaInicio\">Fecha</label>
        <input type=\"text\" name=\"fechaInicio\" value=\"{{ datos.diaHoy }}\" readonly>
        <br>
        <label for=\"estado\">Estado</label>
        <input type=\"text\" name=\"estado\" value=\"{{ datos.estados.0 }}\" readonly>
        <br>
        <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
        <input type=\"textarea\" name=\"descripcion\" autofocus required placeholder=\"Ingrese la descripcion..\">
        <br>
        <label for=\"sector\">Sector</label>
        <select name=\"sector\">
            {% for sector in datos.sectores %}
            <option value=\"{{ sector }}\">{{ sector }}</option>
            {% endfor %}
        </select>
    </fieldset>
    <fieldset class=\"prioridad\">
        <legend>Prioridad<span class=\"asterisco\">*</span></legend>
        {% for prioridad in datos.prioridades %}
        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required
                value={{ prioridad }}>{{ prioridad }}</label>
        {% endfor %}
    </fieldset>
    <input type=\"submit\">
    <input type=\"reset\">
</form>
{% endblock %}", "pedidoCrear.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\pedidoCrear.html");
    }
}
