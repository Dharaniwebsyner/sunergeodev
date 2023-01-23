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

/* themes/custom/sunergeo/templates/system/page--user--login.html.twig */
class __TwigTemplate_1be241e38ac786472a37d65628db2e0a2c26a7f7a72ca4a4576d61382d25464c extends \Twig\Template
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
        echo "   <section class=\"ftco-section\">
      <div class=\"container\">
         <div class=\"row justify-content-center\">
            <div class=\"col-md-6 text-center mb-5\">
               <h2 class=\"heading-section\">User Login</h2>
            </div>
         </div>
         <div class=\"row\">
               <div class=\"col-3\"></div>
               <div class=\"col-6\">
                   ";
        // line 11
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 11), 11, $this->source), "html", null, true);
        echo "

               </div>
               <div class=\"col-3\"></div>
         </div>

      </div>
   </section>";
    }

    public function getTemplateName()
    {
        return "themes/custom/sunergeo/templates/system/page--user--login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 11,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("   <section class=\"ftco-section\">
      <div class=\"container\">
         <div class=\"row justify-content-center\">
            <div class=\"col-md-6 text-center mb-5\">
               <h2 class=\"heading-section\">User Login</h2>
            </div>
         </div>
         <div class=\"row\">
               <div class=\"col-3\"></div>
               <div class=\"col-6\">
                   {{ page.content }}

               </div>
               <div class=\"col-3\"></div>
         </div>

      </div>
   </section>", "themes/custom/sunergeo/templates/system/page--user--login.html.twig", "C:\\wamp64\\www\\sunergeo_dev\\themes\\custom\\sunergeo\\templates\\system\\page--user--login.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 11);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
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
