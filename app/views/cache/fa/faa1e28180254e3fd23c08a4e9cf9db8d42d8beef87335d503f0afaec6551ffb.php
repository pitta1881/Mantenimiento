<?php

/* administracionRol.alta.html */
class __TwigTemplate_363085e6a48740ace4263f689197309d30ad1156c9e61ece7cba734bec731462 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "administracionRol.alta.html", 1);
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
        echo "Gestion de usuarios";
    }

    // line 5
    public function block_header($context, array $blocks = array())
    {
        // line 6
        echo twig_include($this->env, $context, "partials/navAdminRol.html");
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

    // line 13
    public function block_main($context, array $blocks = array())
    {
        // line 14
        echo "<!--   descomentar al hacer
<form action=\"/usuario/validarRol\" method=\"POST\">
<label for=\"nombre\">Nombre</label>
<input type=\"text\" name=\"nombreUsuario\" placeholder=\"Usuario\"><br>
<label for=\"nombre\">Descripcion</label>
<input type=\"text\" name=\"descripcion\" placeholder=\"descripcion\">
<input type=\"submit\" value=\"Agregar\">
</form>       -->
";
    }

    public function getTemplateName()
    {
        return "administracionRol.alta.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 14,  60 => 13,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Gestion de usuarios{% endblock %}

{% block header %}
{{ include('partials/navAdminRol.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}
{% block main %}
<!--   descomentar al hacer
<form action=\"/usuario/validarRol\" method=\"POST\">
<label for=\"nombre\">Nombre</label>
<input type=\"text\" name=\"nombreUsuario\" placeholder=\"Usuario\"><br>
<label for=\"nombre\">Descripcion</label>
<input type=\"text\" name=\"descripcion\" placeholder=\"descripcion\">
<input type=\"submit\" value=\"Agregar\">
</form>       -->
{% endblock %}", "administracionRol.alta.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\7.16\\Nueva carpeta\\Mantenimiento-master\\app\\views\\administracionRol.alta.html");
    }
}
