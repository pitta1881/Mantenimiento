<?php

/* partials/navAdminUsuarios.html */
class __TwigTemplate_24a1dbf2738e6ca0ab71e55912b53e20fa12f70209de00ccc458219b0a6442c8 extends Twig_Template
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
        <li><a href=\"/usuario/altaUsuario\">Agregar Usuario</a></li>
        <li><a href=\"/usuario/modificarUsuario\">Modificar Usuario</a></li>
        <li><a href=\"/usuario/eliminarUsuario\">Eliminar Usuario</a></li>

       
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
        return "partials/navAdminUsuarios.html";
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
        <li><a href=\"/usuario/altaUsuario\">Agregar Usuario</a></li>
        <li><a href=\"/usuario/modificarUsuario\">Modificar Usuario</a></li>
        <li><a href=\"/usuario/eliminarUsuario\">Eliminar Usuario</a></li>

       
        <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario: Administrador</p>
        </li>
    </ol>
</nav>
", "partials/navAdminUsuarios.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\7.16\\Nueva carpeta\\Mantenimiento-master\\app\\views\\partials\\navAdminUsuarios.html");
    }
}
