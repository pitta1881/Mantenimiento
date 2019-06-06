<?php

/* partials/navAdminPermisos.html */
class __TwigTemplate_e39cd0016bd3cf84bcb73283254d4143b827c0b4890fb8c5033aba3f3f424399 extends Twig_Template
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
        <li><a href=\"/usuario/asignarPermiso\">Asignar Permiso</a></li>
       
        <li><a href=\"/usuario/eliminarPermiso\">eliminar Permiso</a></li>

       
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
        return "partials/navAdminPermisos.html";
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
        <li><a href=\"/usuario/asignarPermiso\">Asignar Permiso</a></li>
       
        <li><a href=\"/usuario/eliminarPermiso\">eliminar Permiso</a></li>

       
        <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario: Administrador</p>
        </li>
    </ol>
</nav>
", "partials/navAdminPermisos.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\7.16\\Nueva carpeta\\Mantenimiento-master\\app\\views\\partials\\navAdminPermisos.html");
    }
}
