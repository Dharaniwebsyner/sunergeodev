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

/* themes/custom/aparna/templates/system/region--footer1.html.twig */
class __TwigTemplate_e9b39399c107f3b268b48f0f40656304942fc1b4a98ae242d09f7612653967dd extends \Twig\Template
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
        echo "<div class=\"col-md-6 left\">
<div class=\"col-md-12\">
  <img class=\"f-logo\" src=\"";
        // line 3
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["f1_data_sl"] ?? null), 0, [], "any", false, false, true, 3), "field_site_image", [], "any", false, false, true, 3), 0, [], "any", false, false, true, 3), "entity", [], "any", false, false, true, 3), "uri", [], "any", false, false, true, 3), "value", [], "any", false, false, true, 3), 3, $this->source)]), "html", null, true);
        echo "\">
  <div class=\"loc\">
     <div class=\"block\"><img src=\"";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["f1_data_sl"] ?? null), 0, [], "any", false, false, true, 5), "field_location_one_footer", [], "any", false, false, true, 5), 0, [], "any", false, false, true, 5), "entity", [], "any", false, false, true, 5), "uri", [], "any", false, false, true, 5), "value", [], "any", false, false, true, 5), 5, $this->source)]), "html", null, true);
        echo "\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["f1_data_sl"] ?? null), 0, [], "any", false, false, true, 5), "field_location_one_title", [], "any", false, false, true, 5), 0, [], "any", false, false, true, 5), "value", [], "any", false, false, true, 5), 5, $this->source), "html", null, true);
        echo "</div>
     <div class=\"block ban\"><img src=\"";
        // line 6
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["f1_data_sl"] ?? null), 0, [], "any", false, false, true, 6), "field_location_two_footer", [], "any", false, false, true, 6), 0, [], "any", false, false, true, 6), "entity", [], "any", false, false, true, 6), "uri", [], "any", false, false, true, 6), "value", [], "any", false, false, true, 6), 6, $this->source)]), "html", null, true);
        echo "\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["f1_data_sl"] ?? null), 0, [], "any", false, false, true, 6), "field_location_two_title", [], "any", false, false, true, 6), 0, [], "any", false, false, true, 6), "value", [], "any", false, false, true, 6), 6, $this->source), "html", null, true);
        echo "</div>
     <div class=\"block\"><img src=\"";
        // line 7
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["f1_data_sl"] ?? null), 0, [], "any", false, false, true, 7), "field_location_three_footer", [], "any", false, false, true, 7), 0, [], "any", false, false, true, 7), "entity", [], "any", false, false, true, 7), "uri", [], "any", false, false, true, 7), "value", [], "any", false, false, true, 7), 7, $this->source)]), "html", null, true);
        echo "\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["f1_data_sl"] ?? null), 0, [], "any", false, false, true, 7), "field_location_three_title", [], "any", false, false, true, 7), 0, [], "any", false, false, true, 7), "value", [], "any", false, false, true, 7), 7, $this->source), "html", null, true);
        echo "</div>
  </div>
</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/aparna/templates/system/region--footer1.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 7,  54 => 6,  48 => 5,  43 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"col-md-6 left\">
<div class=\"col-md-12\">
  <img class=\"f-logo\" src=\"{{ file_url(f1_data_sl.0.field_site_image.0.entity.uri.value) }}\">
  <div class=\"loc\">
     <div class=\"block\"><img src=\"{{ file_url(f1_data_sl.0.field_location_one_footer.0.entity.uri.value)}}\">{{f1_data_sl.0.field_location_one_title.0.value}}</div>
     <div class=\"block ban\"><img src=\"{{ file_url(f1_data_sl.0.field_location_two_footer.0.entity.uri.value)}}\">{{f1_data_sl.0.field_location_two_title.0.value}}</div>
     <div class=\"block\"><img src=\"{{ file_url(f1_data_sl.0.field_location_three_footer.0.entity.uri.value)}}\">{{f1_data_sl.0.field_location_three_title.0.value}}</div>
  </div>
</div>
</div>
", "themes/custom/aparna/templates/system/region--footer1.html.twig", "F:\\websites\\aparnadev.devtpit.com\\themes\\custom\\aparna\\templates\\system\\region--footer1.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 3);
        static $functions = array("file_url" => 3);

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                ['file_url']
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
