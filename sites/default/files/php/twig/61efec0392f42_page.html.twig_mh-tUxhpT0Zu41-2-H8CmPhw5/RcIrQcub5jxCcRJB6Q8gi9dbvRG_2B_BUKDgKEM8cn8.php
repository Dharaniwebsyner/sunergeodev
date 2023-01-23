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

/* themes/custom/aparna/templates/system/page.html.twig */
class __TwigTemplate_7314dd198b6a14b2c2583836ef6d227ba4fc4932991bcaa844014330b3b52083 extends \Twig\Template
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
   <head>
      <title>Best Gated Communities in Hyderabad for Sale | Aparna Constructions</title>

   </head>
   <body>
      <header>
            <div class=\"header\">
               <div class=\"container\">
                  ";
        // line 10
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 10), 10, $this->source), "html", null, true);
        echo "
                  <div class=\"col-sm-8 col-xs-8\">
                              <div class=\"click-nav\" onclick=\"openNav()\">
                                 <span class=\"icon-bar\"></span>
                                 <span class=\"icon-bar\"></span>
                                 <span class=\"icon-bar\"></span>
                              </div>
                              <div id=\"mySidenav\" class=\"sidenav\">
                                 <div class=\"nav-links\">
                                    <a href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>
                                    ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["mn_data_s"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 21
            echo "                                        <a href=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_menu_url", [], "any", false, false, true, 21), 0, [], "any", false, false, true, 21), "value", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 21), "value", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
            echo " </a>
                                         <img alt=\"\" height=\"2px;\" src=\"http://localhost:8080/aparna/themes/custom/aparna/images/line-white.png\">
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "                                 </div>

                                 <div class=\"bottom-nav\">
                                    <ul>
                                       ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["mns_data_s"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 29
            echo "                                          <li><a href=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_menu_two_url", [], "any", false, false, true, 29), 0, [], "any", false, false, true, 29), "value", [], "any", false, false, true, 29), 29, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 29), "value", [], "any", false, false, true, 29), 29, $this->source), "html", null, true);
            echo "</a></li>
                                       ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "                                    </ul>
                                 </div>
                              </div>
                  </div>
               </div>
               <div class=\"clearfix\"></div>
            </div>
      </header>
         ";
        // line 39
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 39), 39, $this->source), "html", null, true);
        echo "
<footer>
   <div class=\"container\">
      <div class=\"footer-links\" data-aos=\"fade-up\">
         <div class=\"row\">
            ";
        // line 44
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer1", [], "any", false, false, true, 44), 44, $this->source), "html", null, true);
        echo "
            <div class=\"col-md-6 right\">
               ";
        // line 46
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer2", [], "any", false, false, true, 46), 46, $this->source), "html", null, true);
        echo "
               <div class=\"col-md-6 col-sm-4 subscribe\" data-aos=\"fade-in\">
                  <h3>SUBSCRIBE <span>GET NEWSLETTERS</span></h3>
                  <form>
                     <input type=\"text\" placeholder=\"Your Name\" name=\"\">
                     <button class=\"blue-btn\">Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class=\"clearfix\"></div>
   </div>
   <div class=\"bottom\">
      <div class=\"container\">
         <div class=\"row\">
            <div class=\"col-md-12\">
               ";
        // line 63
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer6", [], "any", false, false, true, 63), 63, $this->source), "html", null, true);
        echo "
               ";
        // line 64
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer8", [], "any", false, false, true, 64), 64, $this->source), "html", null, true);
        echo "
            </div>
         </div>
      </div>
   </div>
</footer>
<script>
   AOS.init({
     duration: 1000,
   })
</script>
   </body>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/aparna/templates/system/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  147 => 64,  143 => 63,  123 => 46,  118 => 44,  110 => 39,  100 => 31,  89 => 29,  85 => 28,  79 => 24,  67 => 21,  63 => 20,  50 => 10,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
   <head>
      <title>Best Gated Communities in Hyderabad for Sale | Aparna Constructions</title>

   </head>
   <body>
      <header>
            <div class=\"header\">
               <div class=\"container\">
                  {{ page.header }}
                  <div class=\"col-sm-8 col-xs-8\">
                              <div class=\"click-nav\" onclick=\"openNav()\">
                                 <span class=\"icon-bar\"></span>
                                 <span class=\"icon-bar\"></span>
                                 <span class=\"icon-bar\"></span>
                              </div>
                              <div id=\"mySidenav\" class=\"sidenav\">
                                 <div class=\"nav-links\">
                                    <a href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>
                                    {% for key, item in mn_data_s %}
                                        <a href=\"{{ item.field_menu_url.0.value }}\">{{ item.title.value }} </a>
                                         <img alt=\"\" height=\"2px;\" src=\"http://localhost:8080/aparna/themes/custom/aparna/images/line-white.png\">
                                    {% endfor %}
                                 </div>

                                 <div class=\"bottom-nav\">
                                    <ul>
                                       {% for key, item in mns_data_s %}
                                          <li><a href=\"{{ item.field_menu_two_url.0.value }}\">{{ item.title.value }}</a></li>
                                       {% endfor %}
                                    </ul>
                                 </div>
                              </div>
                  </div>
               </div>
               <div class=\"clearfix\"></div>
            </div>
      </header>
         {{ page.content }}
<footer>
   <div class=\"container\">
      <div class=\"footer-links\" data-aos=\"fade-up\">
         <div class=\"row\">
            {{ page.footer1 }}
            <div class=\"col-md-6 right\">
               {{ page.footer2 }}
               <div class=\"col-md-6 col-sm-4 subscribe\" data-aos=\"fade-in\">
                  <h3>SUBSCRIBE <span>GET NEWSLETTERS</span></h3>
                  <form>
                     <input type=\"text\" placeholder=\"Your Name\" name=\"\">
                     <button class=\"blue-btn\">Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class=\"clearfix\"></div>
   </div>
   <div class=\"bottom\">
      <div class=\"container\">
         <div class=\"row\">
            <div class=\"col-md-12\">
               {{ page.footer6 }}
               {{ page.footer8 }}
            </div>
         </div>
      </div>
   </div>
</footer>
<script>
   AOS.init({
     duration: 1000,
   })
</script>
   </body>
", "themes/custom/aparna/templates/system/page.html.twig", "F:\\websites\\aparnadev.devtpit.com\\themes\\custom\\aparna\\templates\\system\\page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 20);
        static $filters = array("escape" => 10);
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
