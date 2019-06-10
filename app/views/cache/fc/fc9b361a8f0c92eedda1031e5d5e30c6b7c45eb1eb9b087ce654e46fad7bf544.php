<?php

/* index.home.html */
class __TwigTemplate_a6fa914c302a557bd4774038499bc6652d6accc479e0031d6bd45d0c450a8a88 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "index.home.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'header' => array($this, 'block_header'),
            'head' => array($this, 'block_head'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function block_title($context, array $blocks = array())
    {
        echo "Home";
    }

    public function block_header($context, array $blocks = array())
    {
        echo " ";
        $context["nombreUsuario"] = twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "userLogueado", array());
        echo " ";
        $this->loadTemplate("partials/nav.html", "index.home.html", 1)->display(array("nombreUsuario" => ($context["nombreUsuario"] ?? null)));
        echo "} ";
    }

    public function block_head($context, array $blocks = array())
    {
        echo " ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> ";
    }

    // line 2
    public function block_main($context, array $blocks = array())
    {
        // line 3
        echo "


<nav class=\"main-menu\">
    <ul>
        <li>
            <a href=\"http://justinfarrow.com\"><i class=\"fa fa-home fa-2x\"></i><span class=\"nav-text\">Dashboard</span></a>
        </li>
        <li class=\"has-subnav\">
            <a href=\"#\">
                <i class=\"fa fa-laptop fa-2x\"></i>
                <span class=\"nav-text\">
                            Stars Components
                        </span>
            </a>

        </li>
        <li class=\"has-subnav\">
            <a href=\"#\">
                <i class=\"fa fa-list fa-2x\"></i>
                <span class=\"nav-text\">
                            Forms
                        </span>
            </a>

        </li>
        <li class=\"has-subnav\">
            <a href=\"#\">
                <i class=\"fa fa-folder-open fa-2x\"></i>
                <span class=\"nav-text\">
                            Pages
                        </span>
            </a>

        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-bar-chart-o fa-2x\"></i>
                <span class=\"nav-text\">
                            Graphs and Statistics
                        </span>
            </a>
        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-font fa-2x\"></i>
                <span class=\"nav-text\">
                           Quotes
                        </span>
            </a>
        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-table fa-2x\"></i>
                <span class=\"nav-text\">
                            Tables
                        </span>
            </a>
        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-map-marker fa-2x\"></i>
                <span class=\"nav-text\">
                            Maps
                        </span>
            </a>
        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-info fa-2x\"></i>
                <span class=\"nav-text\">
                            Documentation
                        </span>
            </a>
        </li>
    </ul>

    <ul class=\"logout\">
        <li>
            <a href=\"#\">
                <i class=\"fa fa-power-off fa-2x\"></i>
                <span class=\"nav-text\">
                            Logout
                        </span>
            </a>
        </li>
    </ul>
</nav>


<!--<nav class=\"Otros\">
    <ul>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/OT/verTodos\">Actividades</a></li>
        <li><a href=\"/OT/verTodos\">Tareas</a></li>
        <li><a href=\"/usuario/gestionUsuario\">Usuarios</a></li>
        <li><a href=\"/agente/administracionAgentes\">Agentes</a></li>
        <li><a href=\"/OT/verTodos\">Especialidades</a></li>
        <li><a href=\"/OT/verTodos\">Sectores</a></li>
        <li><a href=\"/OT/verTodos\">Informes</a></li>
        <li><a href=\"/pedido/verTodos\">Insumos</a></li>
        <li><a href=\"/OT/verTodos\">Ordenes de Compra</a></li>
    </ul>
</nav>-->

<ul class=\"contenido\">

    <li>
        <h4>Pedidos Activos:";
        // line 112
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "cantidadPedidos", array()), "html", null, true);
        echo " </h4>

    </li>
    <li>
        <h4>Tareas sin Asignar:";
        // line 116
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "tareasSinAsignar", array()), "html", null, true);
        echo "</h4>

    </li>
    <li>
        <h4>Agentes Disponibles: ";
        // line 120
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "agentesDisponibles", array()), "html", null, true);
        echo "</h4>

    </li>
    <li>
        <h4>Ordenes de Trabajo Activas:";
        // line 124
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["datos"] ?? null), "otActivas", array()), "html", null, true);
        echo " </h4>

    </li>

</ul>

<div class=\"contenido1\">
    <h4>Especialidades mas frecuentes</h4>

</div>

<div class=\"contenido2\">
    <h4>Proximos Eventos</h4>

</div>



";
    }

    public function getTemplateName()
    {
        return "index.home.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  192 => 124,  185 => 120,  178 => 116,  171 => 112,  60 => 3,  57 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %} {% block title %}Home{% endblock %} {% block header %} {% set nombreUsuario = datos.userLogueado %} {% include 'partials/nav.html' with {nombreUsuario:nombreUsuario} only %}} {% endblock %} {% block head %} {{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\"> {% endblock %} {% block main %}



<nav class=\"main-menu\">
    <ul>
        <li>
            <a href=\"http://justinfarrow.com\"><i class=\"fa fa-home fa-2x\"></i><span class=\"nav-text\">Dashboard</span></a>
        </li>
        <li class=\"has-subnav\">
            <a href=\"#\">
                <i class=\"fa fa-laptop fa-2x\"></i>
                <span class=\"nav-text\">
                            Stars Components
                        </span>
            </a>

        </li>
        <li class=\"has-subnav\">
            <a href=\"#\">
                <i class=\"fa fa-list fa-2x\"></i>
                <span class=\"nav-text\">
                            Forms
                        </span>
            </a>

        </li>
        <li class=\"has-subnav\">
            <a href=\"#\">
                <i class=\"fa fa-folder-open fa-2x\"></i>
                <span class=\"nav-text\">
                            Pages
                        </span>
            </a>

        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-bar-chart-o fa-2x\"></i>
                <span class=\"nav-text\">
                            Graphs and Statistics
                        </span>
            </a>
        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-font fa-2x\"></i>
                <span class=\"nav-text\">
                           Quotes
                        </span>
            </a>
        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-table fa-2x\"></i>
                <span class=\"nav-text\">
                            Tables
                        </span>
            </a>
        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-map-marker fa-2x\"></i>
                <span class=\"nav-text\">
                            Maps
                        </span>
            </a>
        </li>
        <li>
            <a href=\"#\">
                <i class=\"fa fa-info fa-2x\"></i>
                <span class=\"nav-text\">
                            Documentation
                        </span>
            </a>
        </li>
    </ul>

    <ul class=\"logout\">
        <li>
            <a href=\"#\">
                <i class=\"fa fa-power-off fa-2x\"></i>
                <span class=\"nav-text\">
                            Logout
                        </span>
            </a>
        </li>
    </ul>
</nav>


<!--<nav class=\"Otros\">
    <ul>
        <li><a href=\"/pedido/verTodos\">Pedidos</a></li>
        <li><a href=\"/OT/verTodos\">Ordenes de Trabajo</a></li>
        <li><a href=\"/OT/verTodos\">Actividades</a></li>
        <li><a href=\"/OT/verTodos\">Tareas</a></li>
        <li><a href=\"/usuario/gestionUsuario\">Usuarios</a></li>
        <li><a href=\"/agente/administracionAgentes\">Agentes</a></li>
        <li><a href=\"/OT/verTodos\">Especialidades</a></li>
        <li><a href=\"/OT/verTodos\">Sectores</a></li>
        <li><a href=\"/OT/verTodos\">Informes</a></li>
        <li><a href=\"/pedido/verTodos\">Insumos</a></li>
        <li><a href=\"/OT/verTodos\">Ordenes de Compra</a></li>
    </ul>
</nav>-->

<ul class=\"contenido\">

    <li>
        <h4>Pedidos Activos:{{ datos.cantidadPedidos}} </h4>

    </li>
    <li>
        <h4>Tareas sin Asignar:{{ datos.tareasSinAsignar}}</h4>

    </li>
    <li>
        <h4>Agentes Disponibles: {{ datos.agentesDisponibles}}</h4>

    </li>
    <li>
        <h4>Ordenes de Trabajo Activas:{{ datos.otActivas}} </h4>

    </li>

</ul>

<div class=\"contenido1\">
    <h4>Especialidades mas frecuentes</h4>

</div>

<div class=\"contenido2\">
    <h4>Proximos Eventos</h4>

</div>



{% endblock %}
", "index.home.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\index.home.html");
    }
}
