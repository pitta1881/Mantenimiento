<?php

/* index.home.html */
class __TwigTemplate_9a2bc674f6ec0fdf199e6943fdb36a90b018f490149d6d4cf023a2e9c37057c8 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "index.home.html", 1);
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
        echo "Home";
    }

    public function block_header($context, array $blocks = array())
    {
        echo " ";
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

    // line 2
    public function block_main($context, array $blocks = array())
    {
        // line 3
        echo "<fieldset class=\"Insumos div\">
    <legend>Insumos</legend>
    <input type=\"button\" value=\"Gestion de Insumos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Compra\">
</fieldset>
<fieldset class=\"general div\">
    <legend>General</legend>
    <input type=\"button\" value=\"Gestion de Pedidos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>

<fieldset class=\"Otros div\">
    <legend>Otros</legend>
   <nav>
    <ol> 
      
       <li> <a href=\"/usuario/gestionUsuario\">Gestion de Usuarios</a></li>
           
           <!--faltan hacer estas-->
             <li> <a href=\"/usuario/gestionAgentes\">Gestion de Agentes</a></li>
              <li> <a href=\"/usuario/gestionEspecialidades\">Gestion de Especialidades</a></li>
              <li> <a href=\"/usuario/gestionSectores\">Gestion de sectores</a></li>
              <li> <a href=\"/usuario/gestionInformes\">Gestion de Informes</a></li>
              
              
       </ol>
</nav>
</fieldset>

";
    }

    public function getTemplateName()
    {
        return "index.home.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 3,  55 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Home{% endblock %} {% block header %} {{ include('partials/nav.html') }} {% endblock %} {% block head %} {{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}
<fieldset class=\"Insumos div\">
    <legend>Insumos</legend>
    <input type=\"button\" value=\"Gestion de Insumos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Compra\">
</fieldset>
<fieldset class=\"general div\">
    <legend>General</legend>
    <input type=\"button\" value=\"Gestion de Pedidos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>

<fieldset class=\"Otros div\">
    <legend>Otros</legend>
   <nav>
    <ol> 
      
       <li> <a href=\"/usuario/gestionUsuario\">Gestion de Usuarios</a></li>
           
           <!--faltan hacer estas-->
             <li> <a href=\"/usuario/gestionAgentes\">Gestion de Agentes</a></li>
              <li> <a href=\"/usuario/gestionEspecialidades\">Gestion de Especialidades</a></li>
              <li> <a href=\"/usuario/gestionSectores\">Gestion de sectores</a></li>
              <li> <a href=\"/usuario/gestionInformes\">Gestion de Informes</a></li>
              
              
       </ol>
</nav>
</fieldset>

{% endblock %}
", "index.home.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\7.16\\Nueva carpeta\\Mantenimiento-master\\app\\views\\index.home.html");
    }
}
