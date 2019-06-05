<?php

/* crearPedido.html */
class __TwigTemplate_a961314eb9c2536bc4399168424b893a05382145ac84cb41cdebdd43a08f9708 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "crearPedido.html", 1);
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
        echo twig_include($this->env, $context, "partials/nav.html");
        echo " ";
    }

    public function block_head($context, array $blocks = array())
    {
        echo " ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> ";
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "<h1>Crear Pedido</h1>
<form action=\"/pedido/validar\" method=\"POST\">
    <fieldset class=\"basicosPedido\">
        <legend>Datos Basicos</legend>
        <label for=\"fechaInicio\">Fecha</label>
        <input type=\"text\" name=\"fechaInicio\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "diaHoy", array()), "html", null, true);
        echo "\" readonly>
        <br>
        <label for=\"estado\">Estado</label>
        <input type=\"text\" name=\"estado\" value=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "estados", array()), 0, array()), "html", null, true);
        echo "\" readonly>
        <br>
        <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
        <input type=\"textarea\" name=\"descripcion\" autofocus required placeholder=\"Ingrese la descripcion..\">
        <br>
        <label for=\"sector\">Sector</label>
        <select name=\"sector\">
            ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "sectores", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["sector"]) {
            // line 20
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
        // line 22
        echo "        </select>
    </fieldset>
    <fieldset class=\"prioridad\">
        <legend>Prioridad<span class=\"asterisco\">*</span></legend>
        ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arrayDatos"] ?? null), "prioridades", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 27
            echo "        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required
                value=";
            // line 28
            echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
            echo ">";
            echo twig_escape_filter($this->env, $context["prioridad"], "html", null, true);
            echo "</label>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "    </fieldset>
    <input type=\"submit\">
    <input type=\"reset\">
</form>
";
    }

    public function getTemplateName()
    {
        return "crearPedido.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 30,  109 => 28,  106 => 27,  102 => 26,  96 => 22,  85 => 20,  81 => 19,  71 => 12,  65 => 9,  58 => 4,  55 => 3,  42 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Crear Tarea Nueva{% endblock %} {% block header %}
{{ include('partials/nav.html') }} {% endblock %} {% block head %} {{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}
<h1>Crear Pedido</h1>
<form action=\"/pedido/validar\" method=\"POST\">
    <fieldset class=\"basicosPedido\">
        <legend>Datos Basicos</legend>
        <label for=\"fechaInicio\">Fecha</label>
        <input type=\"text\" name=\"fechaInicio\" value=\"{{ arrayDatos.diaHoy }}\" readonly>
        <br>
        <label for=\"estado\">Estado</label>
        <input type=\"text\" name=\"estado\" value=\"{{ arrayDatos.estados.0 }}\" readonly>
        <br>
        <label for=\"descripcion\">Descripcion</label><span class=\"asterisco\">*</span>
        <input type=\"textarea\" name=\"descripcion\" autofocus required placeholder=\"Ingrese la descripcion..\">
        <br>
        <label for=\"sector\">Sector</label>
        <select name=\"sector\">
            {% for sector in arrayDatos.sectores %}
            <option value=\"{{ sector }}\">{{ sector }}</option>
            {% endfor %}
        </select>
    </fieldset>
    <fieldset class=\"prioridad\">
        <legend>Prioridad<span class=\"asterisco\">*</span></legend>
        {% for prioridad in arrayDatos.prioridades %}
        <label class=\"labelRadioInput\"><input type=\"radio\" name=\"prioridad\" class=\"radioInput\" required
                value={{ prioridad }}>{{ prioridad }}</label>
        {% endfor %}
    </fieldset>
    <input type=\"submit\">
    <input type=\"reset\">
</form>
{% endblock %}", "crearPedido.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\crearPedido.html");
    }
}
