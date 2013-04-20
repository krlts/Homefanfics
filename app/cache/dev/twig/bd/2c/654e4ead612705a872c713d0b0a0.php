<?php

/* HffBlogBundle:Autores:listar.html.twig */
class __TwigTemplate_bd2c654e4ead612705a872c713d0b0a0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h1>Listado de Autores</h1>
<table border=\"1\">
    <tr>
        <th>ID</th>
        <th>Autor</th>
    </tr>
    ";
        // line 7
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "autores"));
        foreach ($context['_seq'] as $context["_key"] => $context["autor"]) {
            // line 8
            echo "    <tr>
        <td>";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "autor"), "id"), "html", null, true);
            echo "</td>
        <td>";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "autor"), "nombre"), "html", null, true);
            echo "</td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['autor'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 13
        echo "</table>";
    }

    public function getTemplateName()
    {
        return "HffBlogBundle:Autores:listar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 13,  38 => 10,  34 => 9,  31 => 8,  27 => 7,  19 => 1,);
    }
}
