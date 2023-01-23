<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/aparna/templates/system/region--footer2.html.twig */
class __TwigTemplate_b653aaa91d419f003a6a8454070d7fdb5276e22bb398f4b04248a6ba271640b8 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"col-md-3 col-sm-4 links\" data-aos=\"fade-in\">
  <ul>
";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["f2_data_sl"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 4
            echo "    <li><a href=\"\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_menu_title", [], "any", false, false, true, 4), 0, [], "any", false, false, true, 4), "value", [], "any", false, false, true, 4), 4, $this->source), "html", null, true);
            echo " </a></li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "  </ul>
</div>
<div class=\"col-md-3 col-sm-4 links\" data-aos=\"fade-in\">
  <ul>
     <li><a href=\"#\">Blog</a></li>
     <li><a href=\"#\">News</a></li>
     <li><a href=\"#\">Careers</a></li>
     <li><a href=\"#\">Contact</a></li>
  </ul>
</div>

";
    }

    public function getTemplateName()
    {
        return "themes/custom/aparna/templates/system/region--footer2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 6,  47 => 4,  43 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"col-md-3 col-sm-4 links\" data-aos=\"fade-in\">
  <ul>
{% for key, item in f2_data_sl %}
    <li><a href=\"\">{{ item.field_menu_title.0.value }} </a></li>
{% endfor %}
  </ul>
</div>
<div class=\"col-md-3 col-sm-4 links\" data-aos=\"fade-in\">
  <ul>
     <li><a href=\"#\">Blog</a></li>
     <li><a href=\"#\">News</a></li>
     <li><a href=\"#\">Careers</a></li>
     <li><a href=\"#\">Contact</a></li>
  </ul>
</div>

", "themes/custom/aparna/templates/system/region--footer2.html.twig", "C:\\wamp64\\www\\sunergeo_dev\\themes\\custom\\aparna\\templates\\system\\region--footer2.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 3);
        static $filters = array("escape" => 4);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
