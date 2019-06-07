<?php

/* administracionUsuario.alta.html */
class __TwigTemplate_1751a5c985aeeb5acbf06895ba6fb7751b97fff84d54e520d1ef70472ac931bd extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "administracionUsuario.alta.html", 1);
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

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Gestion de usuarios";
    }

    // line 5
    public function block_header($context, array $blocks = array())
    {
        // line 6
        echo twig_include($this->env, $context, "partials/navAdminUsuarios.html");
        echo "
";
    }

    // line 9
    public function block_head($context, array $blocks = array())
    {
        // line 10
        $this->displayParentBlock("head", $context, $blocks);
        echo "
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
";
    }

    // line 13
    public function block_main($context, array $blocks = array())
    {
        // line 14
        echo "<form action=\"/usuario/validarUsuario\" method=\"POST\">
<label for=\"nombre\">Nombre</label>
<input type=\"text\" name=\"nombreUsuario\" placeholder=\"Usuario\"><br>
<label for=\"nombre\">Contraseña</label>
<input type=\"text\" name=\"password\" placeholder=\"contraseña\">
<select name=\"roles\" id=\"rol\"   >

           
           <!--aca van roles  q se toman de la bd para que aparezcan en el select-->   

           
           ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["nombresRoles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["nombre"]) {
            // line 26
            echo "            <option value={nombre.nombreRol}>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["nombre"], "nombreRol", array()), "html", null, true);
            echo "
         
            </option>
            
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nombre'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "}

</select>


<input type=\"submit\" value=\"Agregar\">
</form>



";
    }

    public function getTemplateName()
    {
        return "administracionUsuario.alta.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 30,  80 => 26,  76 => 25,  63 => 14,  60 => 13,  53 => 10,  50 => 9,  44 => 6,  41 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Gestion de usuarios{% endblock %}

{% block header %}
{{ include('partials/navAdminUsuarios.html') }}
{% endblock %}

{% block head %}
{{ parent() }}
<meta name=\"keywords\" content=\"PAW,2018,Templates,PHP\">
{% endblock %}
{% block main %}
<form action=\"/usuario/validarUsuario\" method=\"POST\">
<label for=\"nombre\">Nombre</label>
<input type=\"text\" name=\"nombreUsuario\" placeholder=\"Usuario\"><br>
<label for=\"nombre\">Contraseña</label>
<input type=\"text\" name=\"password\" placeholder=\"contraseña\">
<select name=\"roles\" id=\"rol\"   >

           
           <!--aca van roles  q se toman de la bd para que aparezcan en el select-->   

           
           {% for nombre in nombresRoles%}
            <option value={nombre.nombreRol}>{{nombre.nombreRol}}
         
            </option>
            
            {% endfor %}}

</select>


<input type=\"submit\" value=\"Agregar\">
</form>



{% endblock %}", "administracionUsuario.alta.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\Mantenimiento\\app\\views\\administracionUsuario.alta.html");
    }
}
