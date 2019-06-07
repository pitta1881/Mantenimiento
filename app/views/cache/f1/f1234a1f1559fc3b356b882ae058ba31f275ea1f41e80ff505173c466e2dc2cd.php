<?php

/* gestionUsuario.html */
class __TwigTemplate_cf32e24e5a8bb4ff2f84c1decafd5b401417ddb23126db87409050cc805bfbe6 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "gestionUsuario.html", 1);
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
        echo twig_include($this->env, $context, "partials/navUsuarios.html");
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
        echo "   <fieldset class=\"general div\">
    <legend>Gestion de Usuarios</legend>
   <nav>
    <ol> 
      
       <li> <a href=\"/usuario/AdministracionUsuario\">Administracion de Usuarios</a>
       </li>
    <!--faltan hacer estas-->
       <li> <a href=\"/usuario/AdministracionRol\">Administracion de Roles</a>
       </li>
     <li> <a href=\"/usuario/AdministracionPermisos\">Administracion de permisos</a>
       </li>
     <li> <a href=\"/usuario/AdministracionPersonas\">Administracion de Personas</a>
       </li>
     
    
       </ol>
       </nav>
</fieldset>
";
    }

    public function getTemplateName()
    {
        return "gestionUsuario.html";
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
{{ include('partials/navUsuarios.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}
     {% block main %}
   <fieldset class=\"general div\">
    <legend>Gestion de Usuarios</legend>
   <nav>
    <ol> 
      
       <li> <a href=\"/usuario/AdministracionUsuario\">Administracion de Usuarios</a>
       </li>
    <!--faltan hacer estas-->
       <li> <a href=\"/usuario/AdministracionRol\">Administracion de Roles</a>
       </li>
     <li> <a href=\"/usuario/AdministracionPermisos\">Administracion de permisos</a>
       </li>
     <li> <a href=\"/usuario/AdministracionPersonas\">Administracion de Personas</a>
       </li>
     
    
       </ol>
       </nav>
</fieldset>
{% endblock %}", "gestionUsuario.html", "D:\\Descargas\\mantenimiento\\2019_TP4_PAW\\Mantenimiento\\app\\views\\gestionUsuario.html");
    }
}