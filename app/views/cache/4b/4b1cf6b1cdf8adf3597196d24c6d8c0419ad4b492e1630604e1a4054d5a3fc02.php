<?php

/* partials/navUsuarios.html */
class __TwigTemplate_da370f9ef8be33144b7d964babb0df48b3f558c9aee849c4d70377f4f2ee1349 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<nav class=\"main-nav\">

    <ol>
        <li><img class=\"imagen\" src=\"../app/views/sommer2.jpg\"></li>
        <li><a href=\"/home\">Home</a></li>
       <li><a href=\"/about\">Sobre nosotros</a></li>
           
           <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario: Administrador</p>
        </li>
    </ol>
</nav>";
    }

    public function getTemplateName()
    {
        return "partials/navUsuarios.html";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"main-nav\">

    <ol>
        <li><img class=\"imagen\" src=\"../app/views/sommer2.jpg\"></li>
        <li><a href=\"/home\">Home</a></li>
       <li><a href=\"/about\">Sobre nosotros</a></li>
           
           <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario: Administrador</p>
        </li>
    </ol>
</nav>", "partials/navUsuarios.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\7.16\\Nueva carpeta\\Mantenimiento-master\\app\\views\\partials\\navUsuarios.html");
    }
}
