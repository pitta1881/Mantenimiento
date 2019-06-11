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
        <li><a href=\"/home\"><img class=\"imagen\" src=\"../app/views/sommer4.jpg\"></a></li>

        <li>
            <h4 class=\"titulo\">Sistema de Mantenimiento</h4>
        </li>
        <li>
            <h3 class=\"titulo1\">TITULO PESTAÑA</h3>
        </li>
        <!-- <li><a href=\"/home\">Inicio</a></li>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/OT/verTodos\">Actividades</a></li>
        <li><a href=\"/OT/verTodos\">Tareas</a></li>-->
        <li>
            <p class=\"user\">";
        // line 18
        echo twig_escape_filter($this->env, ($context["nombreUsuario"] ?? null), "html", null, true);
        echo " |<a href=\"/cerrarSesion\">Cerrar Sesión</a></p>
        </li>
        <!--   <li>
            <p><a class=\"salir\" href=\"/\">Cerrar Sesión</a></p>
        </li> -->
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
        return array (  42 => 18,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"main-nav\">

    <ol>
        <li><a href=\"/home\"><img class=\"imagen\" src=\"../app/views/sommer4.jpg\"></a></li>

        <li>
            <h4 class=\"titulo\">Sistema de Mantenimiento</h4>
        </li>
        <li>
            <h3 class=\"titulo1\">TITULO PESTAÑA</h3>
        </li>
        <!-- <li><a href=\"/home\">Inicio</a></li>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/OT/verTodos\">Actividades</a></li>
        <li><a href=\"/OT/verTodos\">Tareas</a></li>-->
        <li>
            <p class=\"user\">{{ nombreUsuario }} |<a href=\"/cerrarSesion\">Cerrar Sesión</a></p>
        </li>
        <!--   <li>
            <p><a class=\"salir\" href=\"/\">Cerrar Sesión</a></p>
        </li> -->
    </ol>
</nav>", "partials/nav.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\partials\\nav.html");
    }
}
