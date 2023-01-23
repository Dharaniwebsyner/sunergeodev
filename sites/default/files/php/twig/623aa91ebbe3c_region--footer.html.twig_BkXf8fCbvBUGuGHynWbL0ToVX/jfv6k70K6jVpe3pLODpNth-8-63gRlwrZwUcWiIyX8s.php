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

/* themes/custom/sunergeo/templates/system/region--footer.html.twig */
class __TwigTemplate_2907c9477220f61d932b9048e3c7eb30608b4723c0320982554c0d6472189863 extends \Twig\Template
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
        echo "<footer>
        <div class=\"container\">
        \t <div class=\"bottom\">
               <div class=\"col-sm-6 col-xs-6 left\">
                  <img src=\"";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getUrl("<front>"));
        echo "themes/custom/sunergeo/images/logo.png\">
               </div>
               <div class=\"col-sm-6 col-xs-6 right\">
                  <p>Copyright &#169; 2022 Sunergeo </p>
               </div>
         </div>
        </div>
</footer>";
    }

    public function getTemplateName()
    {
        return "themes/custom/sunergeo/templates/system/region--footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 5,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<footer>
        <div class=\"container\">
        \t <div class=\"bottom\">
               <div class=\"col-sm-6 col-xs-6 left\">
                  <img src=\"{{ url('<front>') }}themes/custom/sunergeo/images/logo.png\">
               </div>
               <div class=\"col-sm-6 col-xs-6 right\">
                  <p>Copyright &#169; 2022 Sunergeo </p>
               </div>
         </div>
        </div>
</footer>", "themes/custom/sunergeo/templates/system/region--footer.html.twig", "C:\\wamp64\\www\\sunergeo_dev\\themes\\custom\\sunergeo\\templates\\system\\region--footer.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array();
        static $functions = array("url" => 5);

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
                ['url']
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
