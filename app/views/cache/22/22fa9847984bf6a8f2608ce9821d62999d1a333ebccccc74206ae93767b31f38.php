<?php

/* partials/navAdminRol.html */
class __TwigTemplate_e94716bab1447eac83184beee02d8e5f65a40b9f202882bee4914a52576e08cb extends Twig_Template
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
        <li><a href=\"/usuario/altaRol\">Agregar Rol</a></li>
        <li><a href=\"/usuario/modificarRol\">Modificar Rol</a></li>
        <li><a href=\"/usuario/eliminarRol\">eliminar Rol</a></li>

       
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
        return "partials/navAdminRol.html";
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
        <li><a href=\"/usuario/altaRol\">Agregar Rol</a></li>
        <li><a href=\"/usuario/modificarRol\">Modificar Rol</a></li>
        <li><a href=\"/usuario/eliminarRol\">eliminar Rol</a></li>

       
        <li>
            <p class=\"salir\">
                <a href=\"/\"></a>
                Desconectar</p>
            <p class=\"user\">Usuario: Administrador</p>
        </li>
    </ol>
</nav>
", "partials/navAdminRol.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\partials\\navAdminRol.html");
    }
}
