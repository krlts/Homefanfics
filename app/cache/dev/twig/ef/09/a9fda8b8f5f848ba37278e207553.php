<?php

/* HffBlogBundle:Citas:listar.html.twig */
class __TwigTemplate_ef09a9fda8b8f5f848ba37278e207553 extends Twig_Template
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
        echo "<h1>Listado de Citas</h1>
<table border=\"1\">
    <tr>
        <th>ID</th>
        <th>Cita</th>
        <th>Autor</th>
    </tr>
    ";
        // line 8
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "citas"));
        foreach ($context['_seq'] as $context["_key"] => $context["cita"]) {
            // line 9
            echo "    <tr>
        <td>";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "cita"), "id"), "html", null, true);
            echo "</td>
        <td>";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "cita"), "texto"), "html", null, true);
            echo "</td>
        <td>";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "cita"), "autor"), "html", null, true);
            echo "</td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cita'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 15
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "HffBlogBundle:Citas:listar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 15,  43 => 12,  39 => 11,  35 => 10,  32 => 9,  28 => 8,  19 => 1,);
    }
}
