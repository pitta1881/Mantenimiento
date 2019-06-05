<?php

/* index.html */
class __TwigTemplate_e15bd203d026064179201107d9dc6c622d52c651137ac3b12c160c375ae64ee0 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "index.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
        echo "Login";
    }

    // line 5
    public function block_head($context, array $blocks = array())
    {
        // line 6
        $this->displayParentBlock("head", $context, $blocks);
        echo "
 <link rel=\"stylesheet\" href=\"/public/css/login.css\">
";
    }

    // line 10
    public function block_main($context, array $blocks = array())
    {
        // line 11
        echo "

<div class=\"login\">
  <div class=\"login-triangle\"></div>
  
  <h2 class=\"login-header\">Log in</h2>

  <form action=\"/login/validar\" method=\"POST\" class=\"login-container\">
    <p><input type=\"text\" placeholder=\"Usuario\" name=\"nombre\"></p>
    <p><input type=\"password\" placeholder=\"Contraseña\" name=\"contraseña\"></p>
    <p><input type=\"submit\" value=\"Log in\"></p>
  </form>
</div>




";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 11,  50 => 10,  43 => 6,  40 => 5,  34 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html\" %}

{% block title %}Login{% endblock %}

{% block head %}
{{ parent() }}
 <link rel=\"stylesheet\" href=\"/public/css/login.css\">
{% endblock %}

{% block main %}


<div class=\"login\">
  <div class=\"login-triangle\"></div>
  
  <h2 class=\"login-header\">Log in</h2>

  <form action=\"/login/validar\" method=\"POST\" class=\"login-container\">
    <p><input type=\"text\" placeholder=\"Usuario\" name=\"nombre\"></p>
    <p><input type=\"password\" placeholder=\"Contraseña\" name=\"contraseña\"></p>
    <p><input type=\"submit\" value=\"Log in\"></p>
  </form>
</div>




{% endblock %}", "index.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\version2\\Mantenimiento-master\\app\\views\\index.html");
    }
}
