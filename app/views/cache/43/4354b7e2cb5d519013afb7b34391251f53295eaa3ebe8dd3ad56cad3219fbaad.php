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
        <li>
            <a little=\"imagenSommer\" onclick=\"muestra_oculta('mainmenu')\"> <img class=\"imagen\"
                    src=\"/public/res/sommer4.jpg\"></a>

            <ul class=\"mainmenu show\">
                <li><a href=\"/home\">Home</a></li>

                <li><a href=\"/pedido/verTodos\">Pedidos</a>

                </li>
                <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a>

                </li>
                <li><a href=\"/eventos/administracionEventos\">Eventos</a>

                </li>
                <li><a href=\"\">Tareas</a>

                </li>
<<<<<<< Updated upstream
                <ul>
                    <li><a href=\"\">Usuarios</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuario/altaUsuario\">Agregar</a></li>
                            <li><a href=\"/usuario/modificarUsuario\">Modificar</a></li>
                            <li><a href=\"/usuario/eliminarUsuario\">Eliminar</a></li>

                        </ul>
                    </li>
                    <li><a href=\"\">Personas</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuario/altaPersona\">Agregar</a></li>
                            <li><a href=\"/usuario/modificarPersona\">Modificar</a></li>
                            <li><a href=\"/usuario/eliminarPersona\">Eliminar</a></li>
                        </ul>
                    </li>
                    <li><a href=\"\">Roles</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuario/altaRol\">Agregar</a></li>
                            <li><a href=\"/usuario/modificarRol\">Modificar</a></li>
                            <li><a href=\"/usuario/eliminarRol\">Eliminar</a></li>
                        </ul>
                    </li>
                    <li><a href=\"\">Permisos</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuario/asignarPermiso\">Agregar</a></li>
                            <li><a href=\"\">Modificar</a></li>
                            <li><a href=\"/usuario/eliminarPermiso\">Eliminar</a></li>
                        </ul>
                    </li>
                </ul>
        </li>
        <li><a href=\"/agente/administracionAgentes\">Agentes</a>
=======
                <li><a>Usuarios</a>
                    <ul class=\"submenu\">
                        <li><a href=\"/usuario/AdministracionUsuario\">Usuarios</a>

                        </li>
                        <li><a href=\"\">Personas</a>
                        </li>
                        <li><a href=\"\">Roles</a>

                        </li>
                        <li><a href=\"\">Permisos</a>

                        </li>
                    </ul>
                </li>
                <li><a href=\"/agente/administracionAgentes\">Agentes</a>
>>>>>>> Stashed changes

        </li>
        <li><a href=\"/especializacion/administracionEspecializacion\">Especializaciones</a>

        </li>
        <li><a href=\"/sectores/administracionSectores\">Sectores</a>

        </li>
        <li><a href=\"\">Informes</a>

        </li>
        <li><a href=\"/insumos/administracionInsumos\">Insumos</a>

        </li>
        <li><a href=\"\">Ordenes de Compra</a>

        </li>
        <li><a href=\"/cerrarSesion\">Cerrar Sesion</a>

        </li>



        </ul>

        </li>

        <li>
            <h4 class=\"titulo\">Sistema de Mantenimiento</h4>
        </li>
        <li>
            <h3 class=\"titulo1\">";
        // line 68
        echo twig_escape_filter($this->env, ($context["nombreP"] ?? null), "html", null, true);
        echo "</h3>
        </li>


        <li>
            <p class=\"user\">";
        // line 73
        echo twig_escape_filter($this->env, ($context["nombreUsuario"] ?? null), "html", null, true);
        echo " |<a href=\"/cerrarSesion\">Cerrar Sesión</a></p>
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
        return array (  100 => 73,  92 => 68,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"main-nav\">
    <ol>
        <li>
            <a little=\"imagenSommer\" onclick=\"muestra_oculta('mainmenu')\"> <img class=\"imagen\"
                    src=\"/public/res/sommer4.jpg\"></a>

            <ul class=\"mainmenu show\">
                <li><a href=\"/home\">Home</a></li>

                <li><a href=\"/pedido/verTodos\">Pedidos</a>

                </li>
                <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a>

                </li>
                <li><a href=\"/eventos/administracionEventos\">Eventos</a>

                </li>
                <li><a href=\"\">Tareas</a>

                </li>
<<<<<<< Updated upstream
                <ul>
                    <li><a href=\"\">Usuarios</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuario/altaUsuario\">Agregar</a></li>
                            <li><a href=\"/usuario/modificarUsuario\">Modificar</a></li>
                            <li><a href=\"/usuario/eliminarUsuario\">Eliminar</a></li>

                        </ul>
                    </li>
                    <li><a href=\"\">Personas</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuario/altaPersona\">Agregar</a></li>
                            <li><a href=\"/usuario/modificarPersona\">Modificar</a></li>
                            <li><a href=\"/usuario/eliminarPersona\">Eliminar</a></li>
                        </ul>
                    </li>
                    <li><a href=\"\">Roles</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuario/altaRol\">Agregar</a></li>
                            <li><a href=\"/usuario/modificarRol\">Modificar</a></li>
                            <li><a href=\"/usuario/eliminarRol\">Eliminar</a></li>
                        </ul>
                    </li>
                    <li><a href=\"\">Permisos</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuario/asignarPermiso\">Agregar</a></li>
                            <li><a href=\"\">Modificar</a></li>
                            <li><a href=\"/usuario/eliminarPermiso\">Eliminar</a></li>
                        </ul>
                    </li>
                </ul>
        </li>
        <li><a href=\"/agente/administracionAgentes\">Agentes</a>
=======
                <li><a>Usuarios</a>
                    <ul class=\"submenu\">
                        <li><a href=\"/usuario/AdministracionUsuario\">Usuarios</a>

                        </li>
                        <li><a href=\"\">Personas</a>
                        </li>
                        <li><a href=\"\">Roles</a>

                        </li>
                        <li><a href=\"\">Permisos</a>

                        </li>
                    </ul>
                </li>
                <li><a href=\"/agente/administracionAgentes\">Agentes</a>
>>>>>>> Stashed changes

        </li>
        <li><a href=\"/especializacion/administracionEspecializacion\">Especializaciones</a>

        </li>
        <li><a href=\"/sectores/administracionSectores\">Sectores</a>

        </li>
        <li><a href=\"\">Informes</a>

        </li>
        <li><a href=\"/insumos/administracionInsumos\">Insumos</a>

        </li>
        <li><a href=\"\">Ordenes de Compra</a>

        </li>
        <li><a href=\"/cerrarSesion\">Cerrar Sesion</a>

        </li>



        </ul>

        </li>

        <li>
            <h4 class=\"titulo\">Sistema de Mantenimiento</h4>
        </li>
        <li>
            <h3 class=\"titulo1\">{{ nombreP }}</h3>
        </li>


        <li>
            <p class=\"user\">{{ nombreUsuario }} |<a href=\"/cerrarSesion\">Cerrar Sesión</a></p>
        </li>

    </ol>
</nav>", "partials/nav.html", "D:\\Descargas\\mantenimiento\\2019_TP4_PAW\\Mantenimiento\\app\\views\\partials\\nav.html");
    }
}
