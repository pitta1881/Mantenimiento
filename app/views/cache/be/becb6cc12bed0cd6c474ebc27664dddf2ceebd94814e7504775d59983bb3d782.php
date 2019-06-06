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
        <li><img class=\"imagen\" src=\"../app/views/sommer2.jpg\"></li>
        <li><a href=\"/home\">Home</a></li>
        <li><a href=\"/about\">Sobre nosotros</a></li>
        <li><a href=\"/pedido/verTodos\">Usuarios</a></li>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/pedido/verTodos\">Tareas</a></li>

        <li><a href=\"/pedido/crear\">Crear Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ver Pedidos</a></li>
        <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario: Administrador</p>
        </li>
    </ol>
</nav>
";
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
        <li><img class=\"imagen\" src=\"../app/views/sommer2.jpg\"></li>
        <li><a href=\"/home\">Home</a></li>
        <li><a href=\"/about\">Sobre nosotros</a></li>
        <li><a href=\"/pedido/verTodos\">Usuarios</a></li>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/pedido/verTodos\">Tareas</a></li>

        <li><a href=\"/pedido/crear\">Crear Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ver Pedidos</a></li>
        <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario: Administrador</p>
        </li>
    </ol>
</nav>
", "partials/nav.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\7.16\\Nueva carpeta\\Mantenimiento-master\\app\\views\\partials\\nav.html");
    }
}
