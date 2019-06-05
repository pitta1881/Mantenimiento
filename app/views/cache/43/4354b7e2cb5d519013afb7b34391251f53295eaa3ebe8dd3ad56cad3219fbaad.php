<?php

/* partials/nav.html */
class __TwigTemplate_bbe4a72da1951c38efd61304b56a292c1648b28f164ba0c9e609b234455e055b extends Twig_Template
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
        <li><a href=\"/\">Home</a></li>
        <li><a href=\"/about\">Sobre nosotros</a></li>
        <li><a href=\"/pedido/verTodos\">Usuarios</a></li>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/pedido/verTodos\">Tareas</a></li>

        <li><a href=\"/pedido/crear\">Crear Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ver Pedidos</a></li>
        <li>
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
        <li><a href=\"/\">Home</a></li>
        <li><a href=\"/about\">Sobre nosotros</a></li>
        <li><a href=\"/pedido/verTodos\">Usuarios</a></li>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/pedido/verTodos\">Tareas</a></li>

        <li><a href=\"/pedido/crear\">Crear Pedidos</a></li>
        <li><a href=\"/pedido/verTodos\">Ver Pedidos</a></li>
        <li>
            <p class=\"user\">Usuario: Administrador</p>
        </li>
    </ol>
</nav>
", "partials/nav.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\partials\\nav.html");
    }
}
