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

/* themes/custom/aparna/templates/system/region--footer8.html.twig */
class __TwigTemplate_d7bd621959ca911d9a97f6ad0dd5c63fa0c7f7fde3c951cf8a248678dc47019b extends \Twig\Template
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
        echo "
<div class=\"col-md-4 col-sm-6\">
\t<ul>
\t";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["f_data_sl"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            if ((twig_first($this->env, $context["key"]) != "#")) {
                // line 5
                echo "\t\t\t";
                if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_select_network", [], "any", false, false, true, 5), "value", [], "any", false, false, true, 5) == "Twitter")) {
                    // line 6
                    echo "\t\t\t\t\t<li><a target=\"_blank\" href=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_account_url", [], "any", false, false, true, 6), 0, [], "any", false, false, true, 6), "url", [], "any", false, false, true, 6), 6, $this->source), "html", null, true);
                    echo "\"><i class=\"fa fa-twitter\"></i> </a></li>
\t\t\t";
                } elseif ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,                 // line 7
$context["item"], "field_select_network", [], "any", false, false, true, 7), "value", [], "any", false, false, true, 7) == "Facebook")) {
                    // line 8
                    echo "\t\t\t\t\t<li><a target=\"_blank\" href=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_account_url", [], "any", false, false, true, 8), 0, [], "any", false, false, true, 8), "url", [], "any", false, false, true, 8), 8, $this->source), "html", null, true);
                    echo "\"><i class=\"fa fa-facebook\"></i> </a></li>
\t\t\t";
                } elseif ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,                 // line 9
$context["item"], "field_select_network", [], "any", false, false, true, 9), "value", [], "any", false, false, true, 9) == "Instagram")) {
                    // line 10
                    echo "\t\t\t\t\t<li><a target=\"_blank\" href=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_account_url", [], "any", false, false, true, 10), 0, [], "any", false, false, true, 10), "url", [], "any", false, false, true, 10), 10, $this->source), "html", null, true);
                    echo "\"><i class=\"fa fa-instagram\"></i></a></li>
\t\t\t";
                } elseif ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,                 // line 11
$context["item"], "field_select_network", [], "any", false, false, true, 11), "value", [], "any", false, false, true, 11) == "Youtube")) {
                    // line 12
                    echo "\t\t\t\t\t<li><a target=\"_blank\" href=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_account_url", [], "any", false, false, true, 12), 0, [], "any", false, false, true, 12), "url", [], "any", false, false, true, 12), 12, $this->source), "html", null, true);
                    echo "\"><i class=\"fa fa-youtube-play\"></i> </a></li>
\t\t\t";
                } elseif ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,                 // line 13
$context["item"], "field_select_network", [], "any", false, false, true, 13), "value", [], "any", false, false, true, 13) == "LinkedIn")) {
                    // line 14
                    echo "\t\t\t\t\t<li><a target=\"_blank\" href=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_account_url", [], "any", false, false, true, 14), 0, [], "any", false, false, true, 14), "url", [], "any", false, false, true, 14), 14, $this->source), "html", null, true);
                    echo "\"><i class=\"fa fa-linkedin\"></i> </a></li>
\t\t\t";
                }
                // line 16
                echo "\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "\t</ul>
</div>";
    }

    public function getTemplateName()
    {
        return "themes/custom/aparna/templates/system/region--footer8.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 17,  86 => 16,  80 => 14,  78 => 13,  73 => 12,  71 => 11,  66 => 10,  64 => 9,  59 => 8,  57 => 7,  52 => 6,  49 => 5,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
<div class=\"col-md-4 col-sm-6\">
\t<ul>
\t{% for key, item in f_data_sl if key|first != '#' %}
\t\t\t{% if item.field_select_network.value == \"Twitter\" %}
\t\t\t\t\t<li><a target=\"_blank\" href=\"{{ item.field_account_url.0.url }}\"><i class=\"fa fa-twitter\"></i> </a></li>
\t\t\t{% elseif item.field_select_network.value == \"Facebook\" %}
\t\t\t\t\t<li><a target=\"_blank\" href=\"{{ item.field_account_url.0.url }}\"><i class=\"fa fa-facebook\"></i> </a></li>
\t\t\t{% elseif item.field_select_network.value == \"Instagram\" %}
\t\t\t\t\t<li><a target=\"_blank\" href=\"{{ item.field_account_url.0.url }}\"><i class=\"fa fa-instagram\"></i></a></li>
\t\t\t{% elseif item.field_select_network.value == \"Youtube\" %}
\t\t\t\t\t<li><a target=\"_blank\" href=\"{{ item.field_account_url.0.url }}\"><i class=\"fa fa-youtube-play\"></i> </a></li>
\t\t\t{% elseif item.field_select_network.value == \"LinkedIn\" %}
\t\t\t\t\t<li><a target=\"_blank\" href=\"{{ item.field_account_url.0.url }}\"><i class=\"fa fa-linkedin\"></i> </a></li>
\t\t\t{% endif %}
\t{% endfor %}
\t</ul>
</div>", "themes/custom/aparna/templates/system/region--footer8.html.twig", "F:\\websites\\aparnadev.devtpit.com\\themes\\custom\\aparna\\templates\\system\\region--footer8.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 4, "if" => 5);
        static $filters = array("first" => 4, "escape" => 6);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if'],
                ['first', 'escape'],
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
