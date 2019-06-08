<?php

/* index.home.html */
class __TwigTemplate_a6fa914c302a557bd4774038499bc6652d6accc479e0031d6bd45d0c450a8a88 extends Twig_Template
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
        // line 2
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        // line 3
        $this->loadTemplate("partials/nav.html", "index.home.html", 3)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
        echo "}
";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        echo " ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> ";
    }

    // line 5
    public function block_main($context, array $blocks = array())
    {
        // line 6
        echo "<fieldset class=\"Insumos div\">
    <legend>Insumos</legend>

    <input type=\"button\" value=\"Gestion de Insumos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Compra\">
</fieldset>
<fieldset class=\"general div\">
    <legend>General</legend>
    <a href=\"/pedido/verTodos\">
        <input type=\"button\" value=\"Gestion de Pedidos\">
    </a>

    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>

<fieldset class=\"Otros div\">
    <legend>Otros</legend>
    <nav>
        <a href=\"/usuario/gestionUsuario\">
            <input type=\"button\" value=\"Gestion de Usuarios\">
        </a>
        <!--faltan hacer estas-->
        <a href=\"/usuario/gestionAgentes\">
            <input type=\"button\" value=\"Gestion de Agentes\">
        </a>
        <a href=\"/usuario/gestionEspecialidades\">
            <input type=\"button\" value=\"Gestion de Especialidades\">
        </a>
        <a href=\"/usuario/gestionSectores\">
            <input type=\"button\" value=\"Gestion de sectores\">
        </a>
        <a href=\"/usuario/gestionInformes\">
            <input type=\"button\" value=\"Gestion de Informes\">
        </a>



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
        return array (  62 => 6,  59 => 5,  50 => 4,  44 => 3,  42 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Home{% endblock %} {% block header %}
{% set nombreUsuario = datos.userLogueado %}
{% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}}
{% endblock %} {% block head %} {{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}
<fieldset class=\"Insumos div\">
    <legend>Insumos</legend>

    <input type=\"button\" value=\"Gestion de Insumos\">
    <input type=\"button\" value=\"Gestion de Ordenes de Compra\">
</fieldset>
<fieldset class=\"general div\">
    <legend>General</legend>
    <a href=\"/pedido/verTodos\">
        <input type=\"button\" value=\"Gestion de Pedidos\">
    </a>

    <input type=\"button\" value=\"Gestion de Ordenes de Trabajo\">
    <input type=\"button\" value=\"Gestion de Actividades\">
    <input type=\"button\" value=\"Gestion de Tareas\">
</fieldset>

<fieldset class=\"Otros div\">
    <legend>Otros</legend>
    <nav>
        <a href=\"/usuario/gestionUsuario\">
            <input type=\"button\" value=\"Gestion de Usuarios\">
        </a>
        <!--faltan hacer estas-->
        <a href=\"/usuario/gestionAgentes\">
            <input type=\"button\" value=\"Gestion de Agentes\">
        </a>
        <a href=\"/usuario/gestionEspecialidades\">
            <input type=\"button\" value=\"Gestion de Especialidades\">
        </a>
        <a href=\"/usuario/gestionSectores\">
            <input type=\"button\" value=\"Gestion de sectores\">
        </a>
        <a href=\"/usuario/gestionInformes\">
            <input type=\"button\" value=\"Gestion de Informes\">
        </a>



    </nav>
</fieldset>

{% endblock %}", "index.home.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\index.home.html");
    }
}
