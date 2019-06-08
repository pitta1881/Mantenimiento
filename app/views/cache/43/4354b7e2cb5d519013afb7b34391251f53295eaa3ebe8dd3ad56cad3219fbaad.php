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
        <li><a href=\"/home\">Inicio</a></li>
        <li><a href=\"/pedido/verTodos\">Usuarios</a></li>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/pedido/verTodos\">Tareas</a></li>
        <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario:";
        // line 14
        echo twig_escape_filter($this->env, ($context["nombreUsuario"] ?? null), "html", null, true);
        echo "</p>
        </li>
    </ol>
</nav>";
    }

    public function getTemplateName()
    {
        return "partials/nav.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 14,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"main-nav\">

    <ol>
        <li><img class=\"imagen\" src=\"../app/views/sommer2.jpg\"></li>
        <li><a href=\"/home\">Inicio</a></li>
        <li><a href=\"/pedido/verTodos\">Usuarios</a></li>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/pedido/verTodos\">Tareas</a></li>
        <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario:{{ nombreUsuario }}</p>
        </li>
    </ol>
</nav>", "partials/nav.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\partials\\nav.html");
    }
}
