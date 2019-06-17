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
            <nav class=\"mainmenu show\">
                <ul>
                    <li class=\"m\">
                        <p little=\"imagenSommer\" onclick=\"muestra_oculta('mainmenu')\"> <img class=\"imagenMenu\"
                                src=\"/public/res/sommer4.jpg\">
                            <h4 class=\"tituloMenu\">Sistema de Mantenimiento</h4>
                        </p>


                    </li>
                    <li><a href=\"/home\">Home</a></li>

                    <li><a href=\"/pedido/verTodos\">Pedidos</a>

                    </li>
                    <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a>

                    </li>
                    <li><a href=\"/eventos/administracionEventos\">Eventos</a>

                    </li>
                    <li><a href=\"\">Tareas</a>

                    </li>




                    <li><a>Usuarios</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuarios/AdministracionUsuario\">Usuarios</a>

                            </li>
                            <li><a href=\"\">Personas</a>
                            </li>
                            <li><a href=\"/usuario/AdministracionRol\">Roles</a>

                            </li>
                            <li><a href=\"\">Permisos</a>

                            </li>
                        </ul>
                    </li>
                    <li><a href=\"/agente/administracionAgentes\">Agentes</a>

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
            </nav>
        </li>

        <li>
            <h4 class=\"titulo\">Sistema de Mantenimiento</h4>
        </li>
        <li>
            <h3 class=\"titulo1\">";
        // line 78
        echo twig_escape_filter($this->env, ($context["nombreP"] ?? null), "html", null, true);
        echo "</h3>
        </li>


        <li>
            <p class=\"user\">";
        // line 83
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
        return array (  110 => 83,  102 => 78,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"main-nav\">
    <ol>
        <li>
            <a little=\"imagenSommer\" onclick=\"muestra_oculta('mainmenu')\"> <img class=\"imagen\"
                    src=\"/public/res/sommer4.jpg\"></a>
            <nav class=\"mainmenu show\">
                <ul>
                    <li class=\"m\">
                        <p little=\"imagenSommer\" onclick=\"muestra_oculta('mainmenu')\"> <img class=\"imagenMenu\"
                                src=\"/public/res/sommer4.jpg\">
                            <h4 class=\"tituloMenu\">Sistema de Mantenimiento</h4>
                        </p>


                    </li>
                    <li><a href=\"/home\">Home</a></li>

                    <li><a href=\"/pedido/verTodos\">Pedidos</a>

                    </li>
                    <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a>

                    </li>
                    <li><a href=\"/eventos/administracionEventos\">Eventos</a>

                    </li>
                    <li><a href=\"\">Tareas</a>

                    </li>




                    <li><a>Usuarios</a>
                        <ul class=\"submenu\">
                            <li><a href=\"/usuarios/AdministracionUsuario\">Usuarios</a>

                            </li>
                            <li><a href=\"\">Personas</a>
                            </li>
                            <li><a href=\"/usuario/AdministracionRol\">Roles</a>

                            </li>
                            <li><a href=\"\">Permisos</a>

                            </li>
                        </ul>
                    </li>
                    <li><a href=\"/agente/administracionAgentes\">Agentes</a>

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
            </nav>
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
</nav>", "partials/nav.html", "E:\\PATO\\UNIV\\2019\\SIP\\Mantenimiento\\app\\views\\partials\\nav.html");
    }
}
