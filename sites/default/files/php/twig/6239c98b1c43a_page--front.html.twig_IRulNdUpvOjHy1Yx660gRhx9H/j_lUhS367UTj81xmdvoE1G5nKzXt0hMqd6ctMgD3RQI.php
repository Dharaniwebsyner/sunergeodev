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

/* themes/custom/aparna/templates/system/page--front.html.twig */
class __TwigTemplate_dd1ac6ac23540cbda91043d88906b7eac2bed45257c6bbd86004b0305399f51f extends \Twig\Template
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
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["menu_data_s"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 22
            echo "                                        <a href=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_menu_url", [], "any", false, false, true, 22), 0, [], "any", false, false, true, 22), "value", [], "any", false, false, true, 22), 22, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 22), "value", [], "any", false, false, true, 22), 22, $this->source), "html", null, true);
            echo " </a>
                                         <img alt=\"\" height=\"2px;\" src=\"http://localhost:8080/aparna/themes/custom/aparna/images/line-white.png\">
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "                                 </div>

                                 <div class=\"bottom-nav\">
                                    <ul>
                                        ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["menus_data_s"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 30
            echo "                                        <li><a href=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_menu_two_url", [], "any", false, false, true, 30), 0, [], "any", false, false, true, 30), "value", [], "any", false, false, true, 30), 30, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 30), "value", [], "any", false, false, true, 30), 30, $this->source), "html", null, true);
            echo "</a></li>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "
                                    </ul>
                                 </div>
                              </div>
                           </div>


               </div>
               <div class=\"clearfix\"></div>
            </div>
         <div class=\"banner\">
            <div id=\"carousel\" class=\"carousel slide carousel-fade\" data-interval=\"3000\" data-ride=\"carousel\" data-pause=\"false\">
               <!-- Wrapper for slides -->
               <div class=\"carousel-inner\">
                  <div class=\"item active\"><img alt=\"\" class=\"pic\" src=\"http://aparnadev.devtpit.com/themes/custom/aparna/images/banner-home.jpg\"></div>
                  <div class=\"item\"><img alt=\"\" class=\"pic\" src=\"http://aparnadev.devtpit.com/themes/custom/aparna/images/banner-home2.jpg\"></div>
                  <div class=\"item\"><img alt=\"\" class=\"pic\" src=\"http://aparnadev.devtpit.com/themes/custom/aparna/images/banner-home.jpg\"></div>
                  <div class=\"item\"><img alt=\"\" class=\"pic\" src=\"http://aparnadev.devtpit.com/themes/custom/aparna/images/banner-home2.jpg\"></div>
               </div>

               <div class=\"h-search\">
                  <div class=\"search col-md-6 col-sm-8 col-xs-10 margin-auto\">
                     <button><i class=\"fa fa-search\" aria-hidden=\"true\"></i></button>
                     <input type=\"text\" name=\"\">
                  </div>
               </div>
            </div>
         </div>
      </header>
      <section class=\"home-content\">
         <div class=\"container\">
            <div class=\"home-block happy-customers\" data-aos=\"fade-up\">
               <div class=\"col-md-12 text-center\">
                  <div class=\"heading\">
                     <h2><span class=\"normal\">10,000+ </span><span class=\"blue\">Happy Customers</span></h2>
                  </div>
                     <div class=\"customers-pics\">
                        <div id=\"carousel2\" class=\"carousel slide carousel-fade\" data-interval=\"3000\" data-ride=\"carousel\" data-pause=\"false\">
                        <!-- Wrapper for slides -->
                           <div class=\"carousel-inner\">
                              ";
        // line 72
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["f_data_hc"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 73
            echo "                                 ";
            if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, true, 73)) {
                // line 74
                echo "                                    <div class=\"item active\">
                                 ";
            } else {
                // line 76
                echo "                                     <div class=\"item\">
                                 ";
            }
            // line 78
            echo "                                    <img alt=\"\" class=\"pic\" src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = twig_get_attribute($this->env, $this->source, $context["item"], "field_happy_cus_banner", [], "any", false, false, true, 78)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[0] ?? null) : null), "entity", [], "any", false, false, true, 78), "uri", [], "any", false, false, true, 78), "value", [], "any", false, false, true, 78), 78, $this->source)]), "html", null, true);
            echo "\"></div>
                              ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "
                           </div>
                        </div>
                     </div>
               </div>
            </div>
            <div class=\"home-block projects-slider\" data-aos=\"fade-up\">
               <div class=\"col-md-4\">
                  <div class=\"heading\">
                     <h2>Upcoming<br><span class=\"blue\">Projects</span></h2>
                  </div>
               </div>
               <div class=\"col-md-8\">
                  <div class=\"owl-slider\">
                     <div id=\"projects-slider\" class=\"owl-carousel\">
                        ";
        // line 95
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["f_data_up"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 96
            echo "                             <div class=\"item\" data-aos=\"flip-left\" data-aos-delay=\"100\">
                              <div class=\"bg\">
                                 <a href=\"";
            // line 98
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_up_project_link", [], "any", false, false, true, 98), "value", [], "any", false, false, true, 98), 98, $this->source), "html", null, true);
            echo "\">
                                    <div class=\"pic\"><img class=\"img-responsive\" src=\"";
            // line 99
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = twig_get_attribute($this->env, $this->source, $context["item"], "field_up_project_image", [], "any", false, false, true, 99)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144[0] ?? null) : null), "entity", [], "any", false, false, true, 99), "uri", [], "any", false, false, true, 99), "value", [], "any", false, false, true, 99), 99, $this->source)]), "html", null, true);
            echo "\"></div>
                                    <h3>";
            // line 100
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_up_project_title", [], "any", false, false, true, 100), "value", [], "any", false, false, true, 100), 100, $this->source), "html", null, true);
            echo "</h3>
                                 </a>
                              </div>
                           </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
        echo "                     </div>
                  </div>
               </div>
            </div>
            <div class=\"home-block projects-slider project-years\" data-aos=\"fade-up\">
               <div class=\"col-md-12 text-center\">
                  <div class=\"heading\">
                     <h2><span class=\"black\">1996 - 2021</span></h2>
                  </div>
                  <div id=\"projects-slider-year\" class=\"owl-carousel\">
                        ";
        // line 115
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["f_data_fh"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 116
            echo "                           <div class=\"item\" data-aos=\"flip-left\" data-aos-delay=\"100\">
                              <div class=\"bg\">
                                 <a href=\"javascript:void(0);\">
                                    <div class=\"pic\"><img class=\"img-responsive\" src=\"";
            // line 119
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = twig_get_attribute($this->env, $this->source, $context["item"], "field_project_banner", [], "any", false, false, true, 119)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b[0] ?? null) : null), "entity", [], "any", false, false, true, 119), "uri", [], "any", false, false, true, 119), "value", [], "any", false, false, true, 119), 119, $this->source)]), "html", null, true);
            echo "\"></div>
                                    <h3>";
            // line 120
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_project_year", [], "any", false, false, true, 120), "value", [], "any", false, false, true, 120), 120, $this->source), "html", null, true);
            echo "</h3>
                                    <div class=\"text\">
                                       <p>";
            // line 122
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_slice($this->env, strip_tags($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_project_description", [], "any", false, false, true, 122), "value", [], "any", false, false, true, 122), 122, $this->source)), 0, 75), "html", null, true);
            echo "</p>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        echo "                     </div>

                  <div class=\"clearfix\"></div>

               </div>
            </div>
         </div>
      </section>
<footer>
   <div class=\"container\">
      <div class=\"footer-links\" data-aos=\"fade-up\">
         <div class=\"row\">
            ";
        // line 140
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer1", [], "any", false, false, true, 140), 140, $this->source), "html", null, true);
        echo "
            <div class=\"col-md-6 right\">
               ";
        // line 142
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer2", [], "any", false, false, true, 142), 142, $this->source), "html", null, true);
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
        // line 159
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer6", [], "any", false, false, true, 159), 159, $this->source), "html", null, true);
        echo "
               ";
        // line 160
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer8", [], "any", false, false, true, 160), 160, $this->source), "html", null, true);
        echo "


              <!--  <div class=\"col-md-8 col-sm-6 \">
                  <p>Copyright © 2022. Aparna Constructions And Estates Pvt. Ltd. All rights reserved.</p>
               </div> -->
              <!--  <div class=\"col-md-4 col-sm-6\">
                  <ul>
                     <li><a target=\"_blank\" href=\"https://twitter.com/AparnaGroup\"><i class=\"fa fa-twitter\"></i> </a></li>
                     <li><a target=\"_blank\" href=\"https://www.facebook.com/AparnaGroup/\"><i class=\"fa fa-facebook\"></i> </a></li>
                     <li><a target=\"_blank\" href=\"https://www.linkedin.com/company/aparna-constructions-&-estates-pvt-ltd/\"><i class=\"fa fa-linkedin\"></i> </a></li>
                     <li><a target=\"_blank\" href=\"https://www.youtube.com/user/aparnaconstructions\"><i class=\"fa fa-youtube-play\"></i> </a></li>
                     <li><a target=\"_blank\" href=\"https://www.instagram.com/aparnaconstructions/?hl=en\"><i class=\"fa fa-instagram\"></i></a></li>
                  </ul>
               </div> -->
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
        return "themes/custom/aparna/templates/system/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  317 => 160,  313 => 159,  293 => 142,  288 => 140,  274 => 128,  262 => 122,  257 => 120,  253 => 119,  248 => 116,  244 => 115,  232 => 105,  221 => 100,  217 => 99,  213 => 98,  209 => 96,  205 => 95,  188 => 80,  171 => 78,  167 => 76,  163 => 74,  160 => 73,  143 => 72,  101 => 32,  90 => 30,  86 => 29,  80 => 25,  68 => 22,  64 => 21,  50 => 10,  39 => 1,);
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
                                    {% for key, item in menu_data_s %}
                                        <a href=\"{{ item.field_menu_url.0.value }}\">{{ item.title.value }} </a>
                                         <img alt=\"\" height=\"2px;\" src=\"http://localhost:8080/aparna/themes/custom/aparna/images/line-white.png\">
                                    {% endfor %}
                                 </div>

                                 <div class=\"bottom-nav\">
                                    <ul>
                                        {% for key, item in menus_data_s %}
                                        <li><a href=\"{{ item.field_menu_two_url.0.value }}\">{{ item.title.value }}</a></li>
                                    {% endfor %}

                                    </ul>
                                 </div>
                              </div>
                           </div>


               </div>
               <div class=\"clearfix\"></div>
            </div>
         <div class=\"banner\">
            <div id=\"carousel\" class=\"carousel slide carousel-fade\" data-interval=\"3000\" data-ride=\"carousel\" data-pause=\"false\">
               <!-- Wrapper for slides -->
               <div class=\"carousel-inner\">
                  <div class=\"item active\"><img alt=\"\" class=\"pic\" src=\"http://aparnadev.devtpit.com/themes/custom/aparna/images/banner-home.jpg\"></div>
                  <div class=\"item\"><img alt=\"\" class=\"pic\" src=\"http://aparnadev.devtpit.com/themes/custom/aparna/images/banner-home2.jpg\"></div>
                  <div class=\"item\"><img alt=\"\" class=\"pic\" src=\"http://aparnadev.devtpit.com/themes/custom/aparna/images/banner-home.jpg\"></div>
                  <div class=\"item\"><img alt=\"\" class=\"pic\" src=\"http://aparnadev.devtpit.com/themes/custom/aparna/images/banner-home2.jpg\"></div>
               </div>

               <div class=\"h-search\">
                  <div class=\"search col-md-6 col-sm-8 col-xs-10 margin-auto\">
                     <button><i class=\"fa fa-search\" aria-hidden=\"true\"></i></button>
                     <input type=\"text\" name=\"\">
                  </div>
               </div>
            </div>
         </div>
      </header>
      <section class=\"home-content\">
         <div class=\"container\">
            <div class=\"home-block happy-customers\" data-aos=\"fade-up\">
               <div class=\"col-md-12 text-center\">
                  <div class=\"heading\">
                     <h2><span class=\"normal\">10,000+ </span><span class=\"blue\">Happy Customers</span></h2>
                  </div>
                     <div class=\"customers-pics\">
                        <div id=\"carousel2\" class=\"carousel slide carousel-fade\" data-interval=\"3000\" data-ride=\"carousel\" data-pause=\"false\">
                        <!-- Wrapper for slides -->
                           <div class=\"carousel-inner\">
                              {% for key, item in f_data_hc %}
                                 {% if loop.first %}
                                    <div class=\"item active\">
                                 {% else %}
                                     <div class=\"item\">
                                 {% endif %}
                                    <img alt=\"\" class=\"pic\" src=\"{{ file_url(item.field_happy_cus_banner[0].entity.uri.value) }}\"></div>
                              {% endfor %}

                           </div>
                        </div>
                     </div>
               </div>
            </div>
            <div class=\"home-block projects-slider\" data-aos=\"fade-up\">
               <div class=\"col-md-4\">
                  <div class=\"heading\">
                     <h2>Upcoming<br><span class=\"blue\">Projects</span></h2>
                  </div>
               </div>
               <div class=\"col-md-8\">
                  <div class=\"owl-slider\">
                     <div id=\"projects-slider\" class=\"owl-carousel\">
                        {% for key, item in f_data_up %}
                             <div class=\"item\" data-aos=\"flip-left\" data-aos-delay=\"100\">
                              <div class=\"bg\">
                                 <a href=\"{{ item.field_up_project_link.value }}\">
                                    <div class=\"pic\"><img class=\"img-responsive\" src=\"{{ file_url(item.field_up_project_image[0].entity.uri.value) }}\"></div>
                                    <h3>{{ item.field_up_project_title.value }}</h3>
                                 </a>
                              </div>
                           </div>
                        {% endfor %}
                     </div>
                  </div>
               </div>
            </div>
            <div class=\"home-block projects-slider project-years\" data-aos=\"fade-up\">
               <div class=\"col-md-12 text-center\">
                  <div class=\"heading\">
                     <h2><span class=\"black\">1996 - 2021</span></h2>
                  </div>
                  <div id=\"projects-slider-year\" class=\"owl-carousel\">
                        {% for key, item in f_data_fh %}
                           <div class=\"item\" data-aos=\"flip-left\" data-aos-delay=\"100\">
                              <div class=\"bg\">
                                 <a href=\"javascript:void(0);\">
                                    <div class=\"pic\"><img class=\"img-responsive\" src=\"{{ file_url(item.field_project_banner[0].entity.uri.value) }}\"></div>
                                    <h3>{{ item.field_project_year.value }}</h3>
                                    <div class=\"text\">
                                       <p>{{ item.field_project_description.value | striptags |slice(0, 75)  }}</p>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        {% endfor %}
                     </div>

                  <div class=\"clearfix\"></div>

               </div>
            </div>
         </div>
      </section>
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


              <!--  <div class=\"col-md-8 col-sm-6 \">
                  <p>Copyright © 2022. Aparna Constructions And Estates Pvt. Ltd. All rights reserved.</p>
               </div> -->
              <!--  <div class=\"col-md-4 col-sm-6\">
                  <ul>
                     <li><a target=\"_blank\" href=\"https://twitter.com/AparnaGroup\"><i class=\"fa fa-twitter\"></i> </a></li>
                     <li><a target=\"_blank\" href=\"https://www.facebook.com/AparnaGroup/\"><i class=\"fa fa-facebook\"></i> </a></li>
                     <li><a target=\"_blank\" href=\"https://www.linkedin.com/company/aparna-constructions-&-estates-pvt-ltd/\"><i class=\"fa fa-linkedin\"></i> </a></li>
                     <li><a target=\"_blank\" href=\"https://www.youtube.com/user/aparnaconstructions\"><i class=\"fa fa-youtube-play\"></i> </a></li>
                     <li><a target=\"_blank\" href=\"https://www.instagram.com/aparnaconstructions/?hl=en\"><i class=\"fa fa-instagram\"></i></a></li>
                  </ul>
               </div> -->
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
", "themes/custom/aparna/templates/system/page--front.html.twig", "C:\\wamp64\\www\\sunergeo_dev\\themes\\custom\\aparna\\templates\\system\\page--front.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 21, "if" => 73);
        static $filters = array("escape" => 10, "slice" => 122, "striptags" => 122);
        static $functions = array("file_url" => 78);

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if'],
                ['escape', 'slice', 'striptags'],
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
