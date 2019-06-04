<?php

/* formulario.create.html */
class __TwigTemplate_77f2e73b56e70dc8d2be45d4afdf3d1684f4b2345792ac2114e7e2527b4a1bd0 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "formulario.create.html", 1);
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
        echo "<h2>Crear Tarea</h2>
<form action=\"/turno/validar\" method=\"POST\" oninput=\"valor.value= parseInt(height.value)\">
    <fieldset>
        <legend>Datos personales</legend>
        <label for=\"name\">Nombre</label><span class=\"asterisco\">*</span>
        <input type=\"text\" name=\"name\" autofocus required autocomplete=\"name\">
        <label for=\"email\">E-Mail</label><span class=\"asterisco\">*</span>
        <input type=\"email\" name=\"email\" required autocomplete=\"email\">
        <label for=\"phone\">Telefono</label><span class=\"asterisco\">*</span>
        <input type=\"tel\" name=\"phone\" required autocomplete=\"phone\">
        <label for=\"age\">Edad</label>
        <input type=\"number\" name=\"age\" min=\"0\" max=\"150\" autocomplete=\"age\">
        <label for=\"calzado\">Talla de calzado</label>
        <input type=\"number\" name=\"calzado\" min=\"20\" max=\"45\">
        <label for=\"height\">Altura (cm) --> </label>
        <strong>
            <output name=\"valor\" for=\"height\">Utilice el deslizador</output>
        </strong>
        <input type=\"range\" name=\"height\" min=\"1\" max=\"300\" value=\"170\" class=\"altura\">
        <label for=\"birth\">Fecha de nacimiento</label><span class=\"asterisco\">*</span>
        <input type=\"date\" name=\"birth\" required>
        <label for=\"haircolor\">Color de pelo natural</label>
        <select name=\"haircolor\">
            ";
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["datos"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["colorPelo"] ?? null) : null));
        foreach ($context['_seq'] as $context["_key"] => $context["hair"]) {
            // line 39
            echo "            <option value=";
            echo twig_escape_filter($this->env, $context["hair"], "html", null, true);
            echo ">";
            echo twig_escape_filter($this->env, $context["hair"], "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hair'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "}
        </select>
    </fieldset>
    <fieldset>
        <legend>Datos sobre el turno</legend>
        <label for=\"adate\">Fecha</label><span class=\"asterisco\">*</span>
        <input type=\"date\" name=\"adate\" required>
        <label for=\"atime\">Hora (8:00 a 17:00)</label><span class=\"asterisco\">*</span>
        <select name=\"atime\" required>
            ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = ($context["datos"] ?? null)) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["horaTurnos"] ?? null) : null));
        foreach ($context['_seq'] as $context["_key"] => $context["hora"]) {
            // line 50
            echo "            <option value=";
            echo twig_escape_filter($this->env, $context["hora"], "html", null, true);
            echo ">";
            echo twig_escape_filter($this->env, $context["hora"], "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hora'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "}
        </select>
    </fieldset>
    <input type=\"submit\">
    <input type=\"reset\">
</form>
";
    }

    public function getTemplateName()
    {
        return "formulario.create.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 51,  118 => 50,  114 => 49,  103 => 40,  92 => 39,  88 => 38,  63 => 15,  60 => 14,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
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
<h2>Crear Tarea</h2>
<form action=\"/turno/validar\" method=\"POST\" oninput=\"valor.value= parseInt(height.value)\">
    <fieldset>
        <legend>Datos personales</legend>
        <label for=\"name\">Nombre</label><span class=\"asterisco\">*</span>
        <input type=\"text\" name=\"name\" autofocus required autocomplete=\"name\">
        <label for=\"email\">E-Mail</label><span class=\"asterisco\">*</span>
        <input type=\"email\" name=\"email\" required autocomplete=\"email\">
        <label for=\"phone\">Telefono</label><span class=\"asterisco\">*</span>
        <input type=\"tel\" name=\"phone\" required autocomplete=\"phone\">
        <label for=\"age\">Edad</label>
        <input type=\"number\" name=\"age\" min=\"0\" max=\"150\" autocomplete=\"age\">
        <label for=\"calzado\">Talla de calzado</label>
        <input type=\"number\" name=\"calzado\" min=\"20\" max=\"45\">
        <label for=\"height\">Altura (cm) --> </label>
        <strong>
            <output name=\"valor\" for=\"height\">Utilice el deslizador</output>
        </strong>
        <input type=\"range\" name=\"height\" min=\"1\" max=\"300\" value=\"170\" class=\"altura\">
        <label for=\"birth\">Fecha de nacimiento</label><span class=\"asterisco\">*</span>
        <input type=\"date\" name=\"birth\" required>
        <label for=\"haircolor\">Color de pelo natural</label>
        <select name=\"haircolor\">
            {% for hair in datos[\"colorPelo\"] %}
            <option value={{ hair }}>{{ hair }}</option>
            {% endfor %}}
        </select>
    </fieldset>
    <fieldset>
        <legend>Datos sobre el turno</legend>
        <label for=\"adate\">Fecha</label><span class=\"asterisco\">*</span>
        <input type=\"date\" name=\"adate\" required>
        <label for=\"atime\">Hora (8:00 a 17:00)</label><span class=\"asterisco\">*</span>
        <select name=\"atime\" required>
            {% for hora in datos[\"horaTurnos\"] %}
            <option value={{ hora }}>{{ hora }}</option>
            {% endfor %}}
        </select>
    </fieldset>
    <input type=\"submit\">
    <input type=\"reset\">
</form>
{% endblock %}", "formulario.create.html", "E:\\PATO\\UNIV\\2019\\PAW\\TP4\\2019_TP4_PAW-master\\2019_TP4_PAW\\app\\views\\formulario.create.html");
    }
}
