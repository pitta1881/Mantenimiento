<?php

/* partials/navAdminPersona.html */
class __TwigTemplate_46841e0b3fca3a85513aa861165e8cc6d3ae488c071673d35ba3b68bf37a8eb2 extends Twig_Template
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
        <li><a href=\"/usuario/gestionUsuario\">Gestion Usuarios</a></li>
        <li><a href=\"/usuario/altaPersona\">Agregar Persona</a></li>
        <li><a href=\"/usuario/modificarPersona\">Modificar Persona</a></li>
        <li><a href=\"/usuario/eliminarPersona\">Eliminar Persona</a></li>

       
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
        return "partials/navAdminPersona.html";
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
        <li><a href=\"/usuario/gestionUsuario\">Gestion Usuarios</a></li>
        <li><a href=\"/usuario/altaPersona\">Agregar Persona</a></li>
        <li><a href=\"/usuario/modificarPersona\">Modificar Persona</a></li>
        <li><a href=\"/usuario/eliminarPersona\">Eliminar Persona</a></li>

       
        <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario: Administrador</p>
        </li>
    </ol>
</nav>
", "partials/navAdminPersona.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\partials\\navAdminPersona.html");
    }
}
