<?php

/* base.html */
class __TwigTemplate_00dbe24a4e11b03d1d2d9dceef4a180f09f03b165eeb39fab4fac4f416ccea18 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'header' => array($this, 'block_header'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>

<head>
    ";
        // line 5
        $this->displayBlock('head', $context, $blocks);
        // line 10
        echo "</head>

<body>
    <header>";
        // line 13
        $this->displayBlock('header', $context, $blocks);
        echo "</header>
    <main>";
        // line 14
        $this->displayBlock('main', $context, $blocks);
        echo "</main>

</body>

</html>
";
    }

    // line 5
    public function block_head($context, array $blocks = array())
    {
        // line 6
        echo "    <meta charset=\"utf-8\">
    <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo " - Mantenimiento</title>
    <link rel=\"stylesheet\" href=\"/public/css/main.css\">
    <link rel=\"stylesheet\" href=\"/public/css/nav.css\"> ";
    }

    public function block_title($context, array $blocks = array())
    {
    }

    // line 13
    public function block_header($context, array $blocks = array())
    {
    }

    // line 14
    public function block_main($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function getDebugInfo()
    {
        return array (  76 => 14,  71 => 13,  60 => 7,  57 => 6,  54 => 5,  44 => 14,  40 => 13,  35 => 10,  33 => 5,  27 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>

<head>
    {% block head %}
    <meta charset=\"utf-8\">
    <title>{% block title %}{% endblock %} - Mantenimiento</title>
    <link rel=\"stylesheet\" href=\"/public/css/main.css\">
    <link rel=\"stylesheet\" href=\"/public/css/nav.css\"> {% endblock %}
</head>

<body>
    <header>{% block header %}{% endblock %}</header>
    <main>{% block main %}{% endblock %}</main>

</body>

</html>
", "base.html", "C:\\Users\\user\\Documents\\Mantenimiento\\app\\views\\base.html");
    }
}
