<?php

/* index.html */
class __TwigTemplate_c46ab31beca99da74ea3202ea2c353a38e43691388ce6d6894d75c4fba6568c5 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "index.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
        echo "Ingreso";
    }

    public function block_head($context, array $blocks = array())
    {
        echo " ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<link rel=\"stylesheet\" href=\"/public/css/login.css\"> ";
    }

    // line 2
    public function block_main($context, array $blocks = array())
    {
        // line 3
        echo "

<div class=\"login\">
    <div class=\"divI\"><img class=\"imagen\" src=\"../app/views/sommer2.jpg\"></div>
    <h2 class=\"login-header\">Ingreso </h2>

    <form action=\"/login/validar\" method=\"POST\" class=\"login-container\">
        <p>
            <label class=\"name\" for=\"nombre\">Nombre de Usuario</label>
            <input type=\"text\" placeholder=\"Usuario\" name=\"nombre\">
        </p>
        <p>
            <label class=\"name\" for=\"contraseña\">Contraseña</label>
            <input type=\"password\" placeholder=\"Contraseña\" name=\"password\">
        </p>
        <p>
            <input type=\"submit\" value=\"Ingresar\">
        </p>
    </form>
</div>




";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 3,  47 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Ingreso{% endblock %} {% block head %} {{ parent() }}
<link rel=\"stylesheet\" href=\"/public/css/login.css\"> {% endblock %} {% block main %}


<div class=\"login\">
    <div class=\"divI\"><img class=\"imagen\" src=\"../app/views/sommer2.jpg\"></div>
    <h2 class=\"login-header\">Ingreso </h2>

    <form action=\"/login/validar\" method=\"POST\" class=\"login-container\">
        <p>
            <label class=\"name\" for=\"nombre\">Nombre de Usuario</label>
            <input type=\"text\" placeholder=\"Usuario\" name=\"nombre\">
        </p>
        <p>
            <label class=\"name\" for=\"contraseña\">Contraseña</label>
            <input type=\"password\" placeholder=\"Contraseña\" name=\"password\">
        </p>
        <p>
            <input type=\"submit\" value=\"Ingresar\">
        </p>
    </form>
</div>




{% endblock %}
", "index.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\index.html");
    }
}
