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
        <li>
<<<<<<< HEAD
            <p class=\"user\">Usuario: ";
        // line 11
=======
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario:";
        // line 13
>>>>>>> master
        echo twig_escape_filter($this->env, ($context["nombreUsuario"] ?? null), "html", null, true);
        echo "</p>
        </li>
        <li><a class=\"salir\" href=\"/\">Cerrar Sesión</a></li>
    </ol>
</nav>
";
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
<<<<<<< HEAD
        return array (  35 => 11,  23 => 1,);
=======
        return array (  37 => 13,  23 => 1,);
>>>>>>> master
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
        <li>
            <p class=\"user\">Usuario: {{ nombreUsuario }}</p>
        </li>
        <li><a class=\"salir\" href=\"/\">Cerrar Sesión</a></li>
    </ol>
</nav>
", "partials/nav.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\partials\\nav.html");
    }
}
