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

/* themes/custom/sunergeo/templates/system/region--header.html.twig */
class __TwigTemplate_8c9be544b1a8887bdf34e86b53bcac8be0fad3758cea47b9de7b96b3df7fd3af extends \Twig\Template
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
        echo "<div class=\"header\">
   <div class=\"container\">
               <div class=\"logo col-md-5\">
               <a href=\"index.php\"><img class=\"img-responsive\" src=\"";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getUrl("<front>"));
        echo "/themes/custom/sunergeo/images/logo.png\"></a>
            </div>
            <nav class=\"navbar\">
               <div class=\"container-fluid\">
                  <div class=\"navbar-header\">
                     <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\">
                     <span class=\"sr-only\">Toggle navigation</span>
                     <span class=\"icon-bar\"></span>
                     <span class=\"icon-bar\"></span>
                     <span class=\"icon-bar\"></span>
                     </button>
                  </div>
                  <div id=\"navbar\" class=\"navbar-collapse collapse\">
                     <ul class=\"nav navbar-nav\">
                        <li><a href=\"index.php\">Home</a></li>
                        <li><a href=\"corporate-information.php\">Corporate Info</a></li>
                        <li><a href=\"news.php\">News</a></li>
                        <li><a href=\"sustainability.php\">Sustainability</a></li>
                        <li><a href=\"contact-us.php\">Contact Us</a></li>
                     </ul>
                  </div>
               </div>
            </nav>
           </div>
</div>";
    }

    public function getTemplateName()
    {
        return "themes/custom/sunergeo/templates/system/region--header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"header\">
   <div class=\"container\">
               <div class=\"logo col-md-5\">
               <a href=\"index.php\"><img class=\"img-responsive\" src=\"{{ url('<front>') }}/themes/custom/sunergeo/images/logo.png\"></a>
            </div>
            <nav class=\"navbar\">
               <div class=\"container-fluid\">
                  <div class=\"navbar-header\">
                     <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\">
                     <span class=\"sr-only\">Toggle navigation</span>
                     <span class=\"icon-bar\"></span>
                     <span class=\"icon-bar\"></span>
                     <span class=\"icon-bar\"></span>
                     </button>
                  </div>
                  <div id=\"navbar\" class=\"navbar-collapse collapse\">
                     <ul class=\"nav navbar-nav\">
                        <li><a href=\"index.php\">Home</a></li>
                        <li><a href=\"corporate-information.php\">Corporate Info</a></li>
                        <li><a href=\"news.php\">News</a></li>
                        <li><a href=\"sustainability.php\">Sustainability</a></li>
                        <li><a href=\"contact-us.php\">Contact Us</a></li>
                     </ul>
                  </div>
               </div>
            </nav>
           </div>
</div>", "themes/custom/sunergeo/templates/system/region--header.html.twig", "C:\\wamp64\\www\\sunergeo_dev\\themes\\custom\\sunergeo\\templates\\system\\region--header.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array();
        static $functions = array("url" => 4);

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
