<?php

/* partials/nav.html */
class __TwigTemplate_ee3de0f23f4b683d126b74fdfa5b74163b66d5bb24bc6848d221ae5a7618d234 extends Twig_Template
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
        <li><a href=\"/\">Home</a></li>
        <li><a href=\"/about\">Sobre nosotros</a></li>
        <li><a href=\"/pedido/crear\">Crear Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ver Pedidos</a></li>
    </ol>
</nav>";
    }

    public function getTemplateName()
    {
        return "partials/nav.html";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"main-nav\">
    <ol>
        <li><a href=\"/\">Home</a></li>
        <li><a href=\"/about\">Sobre nosotros</a></li>
        <li><a href=\"/pedido/crear\">Crear Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ver Pedidos</a></li>
    </ol>
</nav>", "partials/nav.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\version2\\Mantenimiento-master\\app\\views\\partials\\nav.html");
    }
}
