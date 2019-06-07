<?php

/* base.html */
class __TwigTemplate_25442bba50c0709634eae9a9fa10ad78732f5c26077624f847ff900418fe88ba extends Twig_Template
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
            'footer' => array($this, 'block_footer'),
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
        // line 9
        echo "</head>

<body>
    <header>";
        // line 12
        $this->displayBlock('header', $context, $blocks);
        echo "</header>
    <main>";
        // line 13
        $this->displayBlock('main', $context, $blocks);
        echo "</main>
    <footer>";
        // line 14
        $this->displayBlock('footer', $context, $blocks);
        echo "</footer>
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
    <link rel=\"stylesheet\" href=\"/public/css/main.css\"> ";
    }

    public function block_title($context, array $blocks = array())
    {
    }

    // line 12
    public function block_header($context, array $blocks = array())
    {
    }

    // line 13
    public function block_main($context, array $blocks = array())
    {
    }

    // line 14
    public function block_footer($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function getDebugInfo()
    {
        return array (  84 => 14,  79 => 13,  74 => 12,  64 => 7,  61 => 6,  58 => 5,  49 => 14,  45 => 13,  41 => 12,  36 => 9,  34 => 5,  28 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>

<head>
    {% block head %}
    <meta charset=\"utf-8\">
    <title>{% block title %}{% endblock %} - Mantenimiento</title>
    <link rel=\"stylesheet\" href=\"/public/css/main.css\"> {% endblock %}
</head>

<body>
    <header>{% block header %}{% endblock %}</header>
    <main>{% block main %}{% endblock %}</main>
    <footer>{% block footer %}{% endblock %}</footer>
</body>

</html>
", "base.html", "C:\\Users\\cacu\\Desktop\\unlu\\seminario profesional\\sistema\\Mantenimiento\\app\\views\\base.html");
    }
}
