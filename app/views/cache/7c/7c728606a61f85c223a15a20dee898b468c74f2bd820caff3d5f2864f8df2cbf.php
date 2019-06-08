<?php

/* partials/navUsuarios.html */
class __TwigTemplate_8b7346d55849db5b230d9c7ccba8f0c08d8dfc7f503ae3a182cfe3ea60dc7ea3 extends Twig_Template
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
</nav>", "partials/navUsuarios.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\partials\\navUsuarios.html");
    }
}
