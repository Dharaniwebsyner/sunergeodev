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

/* themes/custom/aparna/templates/system/node--projects.html.twig */
class __TwigTemplate_d36b268eefd855e217caea80c5ea205a3751a732c770e6b7f646932a9e515c20 extends \Twig\Template
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
        echo "   <section class=\"inner-content project-inner\">
      <!-- Project Banner Section -->
      <div class=\"inner-banner\">
         <img alt=\"\" class=\"pic img-responsive\" src=\"";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_project_banner_head", [], "any", false, false, true, 4), "entity", [], "any", false, false, true, 4), "uri", [], "any", false, false, true, 4), "value", [], "any", false, false, true, 4), 4, $this->source)]), "html", null, true);
        echo "\">
         <div class=\"project-logo\" data-aos=\"fade-down\">
            <div class=\"bg\">
               <img src=\"";
        // line 7
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_project_logo", [], "any", false, false, true, 7), "entity", [], "any", false, false, true, 7), "uri", [], "any", false, false, true, 7), "value", [], "any", false, false, true, 7), 7, $this->source)]), "html", null, true);
        echo "\">
               <h3>";
        // line 8
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_project_logo_title_1", [], "any", false, false, true, 8), "value", [], "any", false, false, true, 8), 8, $this->source), "html", null, true);
        echo " <span>";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_project_logo_title_2", [], "any", false, false, true, 8), "value", [], "any", false, false, true, 8), 8, $this->source), "html", null, true);
        echo "</span></h3>
            </div>
         </div>
      </div>

      <div class=\"col-md-12 projects-filters\" data-aos=\"fade-up\">
         <ul>
            <li><a href=\"#overview\">Overview</a></li>
            <li><a href=\"#floorPlans\">Floor Plans</a></li>
            <li><a href=\"#specifications\">Specifications</a></li>
            <li><a href=\"#location\">Location</a></li>
            <li><a href=\"#constructionUpdates\">Construction Updates</a></li>
            <li><a href=\"#faqs\">FAQs</a></li>
         </ul>
      </div>

      <!-- Project Gallery Section -->
      ";
        // line 25
        if ((twig_length_filter($this->env, ($context["construction"] ?? null)) > 1)) {
            // line 26
            echo "         <div class=\"main-block-row project-inner-slider\" data-aos=\"fade-up\" >
            <div class=\"container\">
               <div class=\"col-md-12\">
                  <div class=\"heading text-center\">
                     <h2>Embrace the <span class=\"blue\">Premium</span></h2>
                  </div>
               </div>
            </div>
            <div class=\"clearfix\"></div>
            <div class=\"owl-slider\">
               <div id=\"project-slider-inner\" class=\"owl-carousel\">
                  ";
            // line 37
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["project_gallery"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 38
                echo "                  ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "field_project_images", [], "any", false, false, true, 38));
                foreach ($context['_seq'] as $context["key"] => $context["item1"]) {
                    // line 39
                    echo "                  <div class=\"item\">
                     <div class=\"bg\">
                        <div class=\"pic\"><img class=\"img-responsive\" src=\"";
                    // line 41
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item1"], "entity", [], "any", false, false, true, 41), "uri", [], "any", false, false, true, 41), "value", [], "any", false, false, true, 41), 41, $this->source)]), "html", null, true);
                    echo "\"></div>
                     </div>
                  </div>
                  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['item1'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 45
                echo "                  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo "               </div>
            </div>
         </div>
      ";
        }
        // line 50
        echo "
      <!-- Project Overview Section -->
      <div class=\"main-block-row welcome-text\" data-aos=\"fade-up\" id=\"overview\">
         <div class=\"container\">
            <div class=\"col-md-6\">
               <div class=\"heading m-b-none\">
                  <h2>Embrace the <span class=\"blue\">Premium</span></h2>
               </div>
               <div class=\"text\">
                  <p>";
        // line 59
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_project_descri", [], "any", false, false, true, 59), "value", [], "any", false, false, true, 59), 59, $this->source), "html", null, true);
        echo "</p>
               </div>
               ";
        // line 61
        if ((twig_length_filter($this->env, ($context["project_overview_list"] ?? null)) > 1)) {
            // line 62
            echo "               <div class=\"list\">
                  <ul>
                     ";
            // line 64
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["project_overview_list"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 65
                echo "                     <li><img src=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_pro_overview_d_image", [], "any", false, false, true, 65), "entity", [], "any", false, false, true, 65), "uri", [], "any", false, false, true, 65), "value", [], "any", false, false, true, 65), 65, $this->source)]), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 65), "value", [], "any", false, false, true, 65), 65, $this->source), "html", null, true);
                echo "</li>
                     ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            echo "                  </ul>
               </div>
               ";
        }
        // line 70
        echo "            </div>
            ";
        // line 71
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_project_overview_img", [], "any", false, false, true, 71), "entity", [], "any", false, false, true, 71), "uri", [], "any", false, false, true, 71), "value", [], "any", false, false, true, 71)) > 1)) {
            // line 72
            echo "            <div class=\"col-md-6 pic\">
               <div class=\"bg\">
                  <img class=\"img-responsive\" src=\"";
            // line 74
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_project_overview_img", [], "any", false, false, true, 74), "entity", [], "any", false, false, true, 74), "uri", [], "any", false, false, true, 74), "value", [], "any", false, false, true, 74), 74, $this->source)]), "html", null, true);
            echo "\">
               </div>
            </div>
            ";
        }
        // line 78
        echo "         </div>
      </div>

      <!-- Amenities Gallery Section -->
      <div class=\"main-block-row amenities\" data-aos=\"fade-up\">
         <div class=\"col-md-12\">
            <div class=\"heading text-center\">
               <h2><span>Amenities</span></h2>
            </div>
         </div>
         <div class=\"block-row\">
            <div class=\"col-md-6 col pic\">
               <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal1\">
                  <div class=\"bg\"><img class=\"img-responsive\" src=\"";
        // line 91
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 91), "field_am_image_one", [], "any", false, false, true, 91), "entity", [], "any", false, false, true, 91), "uri", [], "any", false, false, true, 91), "value", [], "any", false, false, true, 91), 91, $this->source)]), "html", null, true);
        echo "\"></div>
                  <h3>";
        // line 92
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 92), "field_am_title_one", [], "any", false, false, true, 92), "value", [], "any", false, false, true, 92), 92, $this->source), "html", null, true);
        echo "</h3>
               </a>
            </div>
            <div class=\"col-md-6 col\">
               <div class=\"col-md-12 pic\">
                  <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal2\">
                     <div class=\"bg\"><img class=\"img-responsive\" src=\"";
        // line 98
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 98), "field_am_image_two", [], "any", false, false, true, 98), "entity", [], "any", false, false, true, 98), "uri", [], "any", false, false, true, 98), "value", [], "any", false, false, true, 98), 98, $this->source)]), "html", null, true);
        echo "\"></div>
                     <h3>";
        // line 99
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 99), "field_am_title_two", [], "any", false, false, true, 99), "value", [], "any", false, false, true, 99), 99, $this->source), "html", null, true);
        echo "</h3>
                  </a>
               </div>
               <div class=\"col-md-12 col\">
                  <div class=\"col-md-6 pic\">
                     <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal3\">
                        <div class=\"bg\"><img class=\"img-responsive\" src=\"";
        // line 105
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 105), "field_am_image_three", [], "any", false, false, true, 105), "entity", [], "any", false, false, true, 105), "uri", [], "any", false, false, true, 105), "value", [], "any", false, false, true, 105), 105, $this->source)]), "html", null, true);
        echo "\"></div>
                        <h3>";
        // line 106
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 106), "field_am_title_three", [], "any", false, false, true, 106), "value", [], "any", false, false, true, 106), 106, $this->source), "html", null, true);
        echo "</h3>
                     </a>
                  </div>
                  <div class=\"col-md-6 pic\">
                     <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal4\">
                        <div class=\"bg\"><img class=\"img-responsive\" src=\"";
        // line 111
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 111), "field_am_image_four", [], "any", false, false, true, 111), "entity", [], "any", false, false, true, 111), "uri", [], "any", false, false, true, 111), "value", [], "any", false, false, true, 111), 111, $this->source)]), "html", null, true);
        echo "\"></div>
                        <h3>";
        // line 112
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 112), "field_am_title_four", [], "any", false, false, true, 112), "value", [], "any", false, false, true, 112), 112, $this->source), "html", null, true);
        echo "</h3>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"block-row\">
            <div class=\"col-md-6 col\">
               <div class=\"col-md-12 pic\">
                  <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal5\">
                     <div class=\"bg\"><img class=\"img-responsive\" src=\"";
        // line 122
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 122), "field_am_image_five", [], "any", false, false, true, 122), "entity", [], "any", false, false, true, 122), "uri", [], "any", false, false, true, 122), "value", [], "any", false, false, true, 122), 122, $this->source)]), "html", null, true);
        echo "\"></div>
                     <h3>";
        // line 123
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 123), "field_am_title_five", [], "any", false, false, true, 123), "value", [], "any", false, false, true, 123), 123, $this->source), "html", null, true);
        echo "</h3>
                  </a>
               </div>
               <div class=\"col-md-12 col\">
                  <div class=\"col-md-6 pic\">
                     <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal6\">
                        <div class=\"bg\"><img class=\"img-responsive\" src=\"";
        // line 129
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 129), "field_am_image_six", [], "any", false, false, true, 129), "entity", [], "any", false, false, true, 129), "uri", [], "any", false, false, true, 129), "value", [], "any", false, false, true, 129), 129, $this->source)]), "html", null, true);
        echo "\"></div>
                        <h3>";
        // line 130
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 130), "field_am_title_six", [], "any", false, false, true, 130), "value", [], "any", false, false, true, 130), 130, $this->source), "html", null, true);
        echo "</h3>
                     </a>
                  </div>
                  <div class=\"col-md-6 pic\">
                     <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal7\">
                        <div class=\"bg\"><img class=\"img-responsive\" src=\"";
        // line 135
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 135), "field_am_image_seven", [], "any", false, false, true, 135), "entity", [], "any", false, false, true, 135), "uri", [], "any", false, false, true, 135), "value", [], "any", false, false, true, 135), 135, $this->source)]), "html", null, true);
        echo "\"></div>
                        <h3>";
        // line 136
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 136), "field_am_title_seven", [], "any", false, false, true, 136), "value", [], "any", false, false, true, 136), 136, $this->source), "html", null, true);
        echo "</h3>
                     </a>
                  </div>
               </div>
            </div>
            <div class=\"col-md-6 col pic\">
               <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal8\">
                  <div class=\"bg\"><img class=\"img-responsive\" src=\"";
        // line 143
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 143), "field_am_image_eight", [], "any", false, false, true, 143), "entity", [], "any", false, false, true, 143), "uri", [], "any", false, false, true, 143), "value", [], "any", false, false, true, 143), 143, $this->source)]), "html", null, true);
        echo "\"></div>
                  <h3>";
        // line 144
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 144), "field_am_title_eight", [], "any", false, false, true, 144), "value", [], "any", false, false, true, 144), 144, $this->source), "html", null, true);
        echo "</h3>
               </a>
            </div>
         </div>
      </div>

      <!-- Map Section -->
      <div class=\"main-block-row map-view\" data-aos=\"fade-up\" id=\"location\">
         <img class=\"img-responsive\" src=\"";
        // line 152
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null), 152, $this->source), "html", null, true);
        echo "/images/map-view.jpg\">
      </div>

      <!-- Project Floor Map Section -->
      <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
      <style>.myDiv{display:none;text-align:center;}</style>

      <div class=\"main-block-row floors-view\" data-aos=\"fade-in\" id=\"floorPlans\">
         <div class=\"container\">
            <form>
               <div class=\"col-md-3 col-sm-4 f-col\">
                    <select class=\"form-control select\" id=\"myselection\">
                        ";
        // line 164
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pfm_data"] ?? null));
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
            // line 165
            echo "                           ";
            if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, true, 165)) {
                // line 166
                echo "                              <option value=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], 0, [], "any", false, false, true, 166), "nid", [], "any", false, false, true, 166), 166, $this->source), "html", null, true);
                echo "\" selected=\"\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"], 166, $this->source), "html", null, true);
                echo "</option>
                           ";
            } else {
                // line 168
                echo "                              <option value=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], 0, [], "any", false, false, true, 168), "nid", [], "any", false, false, true, 168), 168, $this->source), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"], 168, $this->source), "html", null, true);
                echo "</option>
                           ";
            }
            // line 170
            echo "                        ";
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
        // line 171
        echo "                  </select>
               </div>
            </form>
            <div class=\"col-md-12\">
               <div class=\"clearfix\"></div>
               <div  class=\"view\">
                  ";
        // line 177
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pfm_data"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item1"]) {
            echo "<div class=\"myDiv pic\" id=\"show";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item1"], 0, [], "any", false, false, true, 177), "nid", [], "any", false, false, true, 177), 177, $this->source), "html", null, true);
            echo "\">
                     <img id=\"imageFullScreen";
            // line 178
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item1"], 0, [], "any", false, false, true, 178), "nid", [], "any", false, false, true, 178), 178, $this->source), "html", null, true);
            echo "\" src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item1"], 0, [], "any", false, false, true, 178), "image", [], "any", false, false, true, 178), 178, $this->source)]), "html", null, true);
            echo "\" alt=\"Manager\"/>
                  </div>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item1'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 181
        echo "                  <div class=\"btns\">
                     <img id=\"zoomInButton\" class=\"zoomButton\" src=\"";
        // line 182
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null), 182, $this->source), "html", null, true);
        echo "/images/zoomin.png\" title=\"zoom in\" alt=\"zoom in\" /><br>
                     <img id=\"zoomOutButton\" class=\"zoomButton\" src=\"";
        // line 183
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null), 183, $this->source), "html", null, true);
        echo "/images/zoomout.png\" title=\"zoom out\" alt=\"zoom out\" />
                  </div>
               </div>
            </div>

            <script>
               \$( document ).ready(function() {
                  var myselection = \$(\"#myselection option:selected\").val();
                  \$(\"#show\"+myselection).show();
                  \$(document).ready(function(){
                     \$('#myselection').on('change', function(){
                        var demovalue = \$(this).val();
                        \$(\"div.myDiv\").hide();
                        \$(\"#show\"+demovalue).show();


                           \$('#imageFullScreen'+demovalue).smartZoom({'containerClass':'zoomableContainer'});
                           \$('#topPositionMap,#leftPositionMap,#rightPositionMap,#bottomPositionMap').bind(\"click\", moveButtonClickHandler);
                           \$('#zoomInButton,#zoomOutButton').bind(\"click\", zoomButtonClickHandler);
                           function zoomButtonClickHandler(e){
                           var scaleToAdd = 0.8;
                           if(e.target.id == 'zoomOutButton')
                           scaleToAdd = -scaleToAdd;
                           \$('#imageFullScreen'+demovalue).smartZoom('zoom', scaleToAdd);
                           }
                           function moveButtonClickHandler(e){
                           var pixelsToMoveOnX = 0;
                           var pixelsToMoveOnY = 0;
                           switch(e.target.id){
                           case \"leftPositionMap\":
                           pixelsToMoveOnX = 50;
                           break;
                           case \"rightPositionMap\":
                           pixelsToMoveOnX = -50;
                           break;
                           case \"topPositionMap\":
                           pixelsToMoveOnY = 50;
                           break;
                           case \"bottomPositionMap\":
                           pixelsToMoveOnY = -50;
                           break;
                           }
                           \$('#imageFullScreen'+demovalue).smartZoom('pan', pixelsToMoveOnX, pixelsToMoveOnY);
                           }

                     });
                  });
               });
            </script>

         </div>
      </div>

         <!-- Project Banner Section O1 -->
         <div class=\"main-block-row\" data-aos=\"fade-up\">
            <div class=\"container\">
               <div class=\"col-md-12 p-ban-block\">
                  <div class=\"pic\"><img class=\"img-responsive\" src=\"";
        // line 240
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_section_7_image", [], "any", false, false, true, 240), "entity", [], "any", false, false, true, 240), "uri", [], "any", false, false, true, 240), "value", [], "any", false, false, true, 240), 240, $this->source)]), "html", null, true);
        echo "\"></div>
                  <div class=\"text col-md-5\">
                     <div class=\"heading\">
                        <h2><span class=\"white\"> ";
        // line 243
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_section_7_heading_one", [], "any", false, false, true, 243), "value", [], "any", false, false, true, 243), 243, $this->source), "html", null, true);
        echo " </span> <br><span class=\"blue\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_section_7_heading_two", [], "any", false, false, true, 243), "value", [], "any", false, false, true, 243), 243, $this->source), "html", null, true);
        echo "</span></h2>
                     </div>
                     <p>";
        // line 245
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_section_7_content", [], "any", false, false, true, 245), "value", [], "any", false, false, true, 245), 245, $this->source), "html", null, true);
        echo " </p>
                  </div>
               </div>
            </div>
         </div>

         <!-- Project Banner Section 02 -->
         <div class=\"main-block-row\" data-aos=\"fade-up\">
            <div class=\"container\">
               <div class=\"col-md-12 p-ban-block\">
                  <div class=\"pic\"><img class=\"img-responsive\" src=\"";
        // line 255
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_section_8_image", [], "any", false, false, true, 255), "entity", [], "any", false, false, true, 255), "uri", [], "any", false, false, true, 255), "value", [], "any", false, false, true, 255), 255, $this->source)]), "html", null, true);
        echo "\"></div>
                  <div class=\"text col-md-5\">
                     <div class=\"heading\">
                        <h2><span class=\"white\">";
        // line 258
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_section_8_heading_one", [], "any", false, false, true, 258), "value", [], "any", false, false, true, 258), 258, $this->source), "html", null, true);
        echo " </span> <br><span class=\"blue\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_section_8_heading_two", [], "any", false, false, true, 258), "value", [], "any", false, false, true, 258), 258, $this->source), "html", null, true);
        echo "</span></h2>
                     </div>
                     <p>";
        // line 260
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_section_8_content", [], "any", false, false, true, 260), "value", [], "any", false, false, true, 260), 260, $this->source), "html", null, true);
        echo " </p>
                  </div>
               </div>
            </div>
         </div>

      <!-- Construction Updates Section -->
      ";
        // line 267
        if ((twig_length_filter($this->env, ($context["construction"] ?? null)) > 1)) {
            // line 268
            echo "         <div class=\"main-block-row\" data-aos=\"fade-up\" id=\"constructionUpdates\">
            <div class=\"container\">
               <div class=\"col-md-12\">
                  <div class=\"heading text-center\">
                     <h2>Construction <span class=\"blue\">Updates</span></h2>
                  </div>
               </div>
               <div class=\"updates\">
                  <div class=\"col-md-3 col-sm-4 left-col\">
                     <div class=\"bg\">
                        <ul>
                           ";
            // line 279
            $context["i"] = 1;
            // line 280
            echo "                           ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["construction"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 281
                echo "                           <li class=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["i"] ?? null) == 1)) ? ("active") : ("")));
                echo "\"><a data-toggle=\"tab\" href=\"#menu";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["i"] ?? null), 281, $this->source), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"], 281, $this->source), "html", null, true);
                echo "</a></li>
                           ";
                // line 282
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 283
                echo "                           ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 284
            echo "                        </ul>
                     </div>
                  </div>
                  <div class=\"col-md-9 col-sm-8 right-col\">
                     ";
            // line 288
            $context["j"] = 1;
            // line 289
            echo "                     ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["construction"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 290
                echo "                     <div id=\"menu";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["j"] ?? null), 290, $this->source), "html", null, true);
                echo "\" class=\"tab-pane fade ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["j"] ?? null) == 1)) ? ("active in") : ("")));
                echo "\" data-aos=\"fade-up\">
                        ";
                // line 291
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["item"]);
                foreach ($context['_seq'] as $context["key"] => $context["item1"]) {
                    // line 292
                    echo "                        <div class=\"bg\">
                           <div class=\"pic\"> <img class=\"img-responsive\" src=\"";
                    // line 293
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item1"], "image", [], "any", false, false, true, 293), 293, $this->source)]), "html", null, true);
                    echo "\"></div>
                           <div class=\"text\">
                            <p>";
                    // line 295
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item1"], "description", [], "any", false, false, true, 295), 295, $this->source));
                    echo "</p>
                         </div>
                      </div>
                      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['item1'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 299
                echo "                   </div>
                   ";
                // line 300
                $context["j"] = (($context["j"] ?? null) + 1);
                // line 301
                echo "                   ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 302
            echo "                </div>
             </div>
          </div>
         </div>
         <div class=\"clearfix\"></div>
       ";
        }
        // line 308
        echo "
       <!-- Specifications Section -->
       ";
        // line 310
        if ((twig_length_filter($this->env, ($context["sp_data_res"] ?? null)) > 1)) {
            // line 311
            echo "       <div class=\"main-block-row faqs m-b-none\" data-aos=\"fade-up\" id=\"specifications\">
         <div class=\"container\">
            <div class=\"col-md-12\">
               <div class=\"heading text-center\">
                  <h2><span class=\"blue\">Specifications</h2>
                  </div>
               </div>
               <div class=\"clearfix\"></div>
               <div class=\"col-md-12\">
                  <div class=\"list col-md-10 margin-auto\">
                     <div class=\"panel-group\" id=\"accordion\">
                        ";
            // line 322
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sp_data_res"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 323
                echo "                        <div class=\"panel panel-default\">
                           <div class=\"panel-heading\">
                              <h4 class=\"panel-title\">
                                 <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#Scollapse";
                // line 326
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"], 326, $this->source), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 326), 326, $this->source), "html", null, true);
                echo "</a>
                              </h4>
                           </div>
                           <div id=\"Scollapse";
                // line 329
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"], 329, $this->source), "html", null, true);
                echo "\" class=\"panel-collapse collapse\">
                              <div class=\"panel-body\">
                                ";
                // line 331
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "description", [], "any", false, false, true, 331), 331, $this->source));
                echo "
                             </div>
                          </div>
                       </div>
                       ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 336
            echo "                    </div>
                 </div>
              </div>
           </div>
        </div>
      ";
        }
        // line 342
        echo "
        <!-- Frequently Asked Questions Section -->
      ";
        // line 344
        if ((twig_length_filter($this->env, ($context["faq_data_res"] ?? null)) > 1)) {
            // line 345
            echo "        <div class=\"main-block-row faqs\" data-aos=\"fade-up\" id=\"faqs\">
         <div class=\"container\">
            <div class=\"col-md-12\">
               <div class=\"heading text-center\">
                  <h2><i class=\"fa fa-commenting-o\" aria-hidden=\"true\"></i>
                     <span class=\"blue\">Frequently Asked</span> Questions";
            // line 350
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["phone"] ?? null), 350, $this->source), "html", null, true);
            echo "
                  </h2>
               </div>
            </div>
            <div class=\"clearfix\"></div>

            <div class=\"col-md-12\">
               <div class=\"list col-md-10 margin-auto\">
                  <div class=\"panel-group testing\" id=\"Saccordion\">
                     ";
            // line 359
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["faq_data_res"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 360
                echo "                     <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                           <h4 class=\"panel-title\">
                              <a data-toggle=\"collapse\" data-parent=\"#Saccordion\" href=\"#collapse";
                // line 363
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"], 363, $this->source), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 363), 363, $this->source), "html", null, true);
                echo "</a>
                           </h4>
                        </div>
                        <div id=\"collapse";
                // line 366
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"], 366, $this->source), "html", null, true);
                echo "\" class=\"panel-collapse collapse\">
                           <div class=\"panel-body\">";
                // line 367
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "description", [], "any", false, false, true, 367), 367, $this->source));
                echo "
                           </div>
                        </div>
                     </div>
                     ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 372
            echo "
                  </div>
               </div>
            </div>

         </div>
      </div>
      ";
        }
        // line 380
        echo "
      <!-- Modal -->
      <div class=\"modal fade project-info-popup\" id=\"myModal_";
        // line 382
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["id"] ?? null), 382, $this->source), "html", null, true);
        echo "\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">Tennis Court</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                  </div>
               </div>
            </div>
         </div>
      </div>
            <div class=\"modal fade project-info-popup\" id=\"myModal1\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">";
        // line 404
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 404), "field_am_title_one", [], "any", false, false, true, 404), "value", [], "any", false, false, true, 404), 404, $this->source), "html", null, true);
        echo "</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     ";
        // line 408
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 408), "field_description_one", [], "any", false, false, true, 408), "value", [], "any", false, false, true, 408), 408, $this->source));
        echo "
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal2\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">";
        // line 421
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 421), "field_am_title_two", [], "any", false, false, true, 421), "value", [], "any", false, false, true, 421), 421, $this->source), "html", null, true);
        echo "</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     ";
        // line 425
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 425), "field_am_description_two", [], "any", false, false, true, 425), "value", [], "any", false, false, true, 425), 425, $this->source));
        echo "
                  </div>
               </div>
            </div>
         </div>
      </div>

       <div class=\"modal fade project-info-popup\" id=\"myModal3\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">";
        // line 438
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 438), "field_am_title_three", [], "any", false, false, true, 438), "value", [], "any", false, false, true, 438), 438, $this->source), "html", null, true);
        echo "</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     ";
        // line 442
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 442), "field_am_description_three", [], "any", false, false, true, 442), "value", [], "any", false, false, true, 442), 442, $this->source));
        echo "
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal4\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">";
        // line 455
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 455), "field_am_title_four", [], "any", false, false, true, 455), "value", [], "any", false, false, true, 455), 455, $this->source), "html", null, true);
        echo "</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     ";
        // line 459
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 459), "field_am_description_four", [], "any", false, false, true, 459), "value", [], "any", false, false, true, 459), 459, $this->source));
        echo "
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal5\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">";
        // line 472
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 472), "field_am_title_five", [], "any", false, false, true, 472), "value", [], "any", false, false, true, 472), 472, $this->source), "html", null, true);
        echo "</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     ";
        // line 476
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 476), "field_am_description_five", [], "any", false, false, true, 476), "value", [], "any", false, false, true, 476), 476, $this->source));
        echo "
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal6\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">";
        // line 489
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 489), "field_am_title_six", [], "any", false, false, true, 489), "value", [], "any", false, false, true, 489), 489, $this->source), "html", null, true);
        echo "</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     ";
        // line 493
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 493), "field_am_description_six", [], "any", false, false, true, 493), "value", [], "any", false, false, true, 493), 493, $this->source));
        echo "
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal7\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">";
        // line 506
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 506), "field_am_title_seven", [], "any", false, false, true, 506), "value", [], "any", false, false, true, 506), 506, $this->source), "html", null, true);
        echo "</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     ";
        // line 510
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 510), "field_am_description_seven", [], "any", false, false, true, 510), "value", [], "any", false, false, true, 510), 510, $this->source));
        echo "
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal8\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">";
        // line 523
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 523), "field_am_title_eight", [], "any", false, false, true, 523), "value", [], "any", false, false, true, 523), 523, $this->source), "html", null, true);
        echo "</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     ";
        // line 527
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["project_amenities"] ?? null), 0, [], "any", false, false, true, 527), "field_am_description_eight", [], "any", false, false, true, 527), "value", [], "any", false, false, true, 527), 527, $this->source));
        echo "
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         function getPopupModal(id) {
            // alert('test');
            \$('#myModal'+_id).modal('toggle');

         }
      </script>
   </section>";
    }

    public function getTemplateName()
    {
        return "themes/custom/aparna/templates/system/node--projects.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  940 => 527,  933 => 523,  917 => 510,  910 => 506,  894 => 493,  887 => 489,  871 => 476,  864 => 472,  848 => 459,  841 => 455,  825 => 442,  818 => 438,  802 => 425,  795 => 421,  779 => 408,  772 => 404,  747 => 382,  743 => 380,  733 => 372,  722 => 367,  718 => 366,  710 => 363,  705 => 360,  701 => 359,  689 => 350,  682 => 345,  680 => 344,  676 => 342,  668 => 336,  657 => 331,  652 => 329,  644 => 326,  639 => 323,  635 => 322,  622 => 311,  620 => 310,  616 => 308,  608 => 302,  602 => 301,  600 => 300,  597 => 299,  587 => 295,  582 => 293,  579 => 292,  575 => 291,  568 => 290,  563 => 289,  561 => 288,  555 => 284,  549 => 283,  547 => 282,  538 => 281,  533 => 280,  531 => 279,  518 => 268,  516 => 267,  506 => 260,  499 => 258,  493 => 255,  480 => 245,  473 => 243,  467 => 240,  407 => 183,  403 => 182,  400 => 181,  389 => 178,  381 => 177,  373 => 171,  359 => 170,  351 => 168,  343 => 166,  340 => 165,  323 => 164,  308 => 152,  297 => 144,  293 => 143,  283 => 136,  279 => 135,  271 => 130,  267 => 129,  258 => 123,  254 => 122,  241 => 112,  237 => 111,  229 => 106,  225 => 105,  216 => 99,  212 => 98,  203 => 92,  199 => 91,  184 => 78,  177 => 74,  173 => 72,  171 => 71,  168 => 70,  163 => 67,  152 => 65,  148 => 64,  144 => 62,  142 => 61,  137 => 59,  126 => 50,  120 => 46,  114 => 45,  104 => 41,  100 => 39,  95 => 38,  91 => 37,  78 => 26,  76 => 25,  54 => 8,  50 => 7,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("   <section class=\"inner-content project-inner\">
      <!-- Project Banner Section -->
      <div class=\"inner-banner\">
         <img alt=\"\" class=\"pic img-responsive\" src=\"{{ file_url(node.field_project_banner_head.entity.uri.value) }}\">
         <div class=\"project-logo\" data-aos=\"fade-down\">
            <div class=\"bg\">
               <img src=\"{{ file_url(node.field_project_logo.entity.uri.value) }}\">
               <h3>{{node.field_project_logo_title_1.value}} <span>{{node.field_project_logo_title_2.value}}</span></h3>
            </div>
         </div>
      </div>

      <div class=\"col-md-12 projects-filters\" data-aos=\"fade-up\">
         <ul>
            <li><a href=\"#overview\">Overview</a></li>
            <li><a href=\"#floorPlans\">Floor Plans</a></li>
            <li><a href=\"#specifications\">Specifications</a></li>
            <li><a href=\"#location\">Location</a></li>
            <li><a href=\"#constructionUpdates\">Construction Updates</a></li>
            <li><a href=\"#faqs\">FAQs</a></li>
         </ul>
      </div>

      <!-- Project Gallery Section -->
      {% if construction|length > 1  %}
         <div class=\"main-block-row project-inner-slider\" data-aos=\"fade-up\" >
            <div class=\"container\">
               <div class=\"col-md-12\">
                  <div class=\"heading text-center\">
                     <h2>Embrace the <span class=\"blue\">Premium</span></h2>
                  </div>
               </div>
            </div>
            <div class=\"clearfix\"></div>
            <div class=\"owl-slider\">
               <div id=\"project-slider-inner\" class=\"owl-carousel\">
                  {% for key, item in project_gallery %}
                  {% for key, item1 in item.field_project_images %}
                  <div class=\"item\">
                     <div class=\"bg\">
                        <div class=\"pic\"><img class=\"img-responsive\" src=\"{{ file_url(item1.entity.uri.value) }}\"></div>
                     </div>
                  </div>
                  {% endfor %}
                  {% endfor %}
               </div>
            </div>
         </div>
      {% endif %}

      <!-- Project Overview Section -->
      <div class=\"main-block-row welcome-text\" data-aos=\"fade-up\" id=\"overview\">
         <div class=\"container\">
            <div class=\"col-md-6\">
               <div class=\"heading m-b-none\">
                  <h2>Embrace the <span class=\"blue\">Premium</span></h2>
               </div>
               <div class=\"text\">
                  <p>{{ node.field_project_descri.value }}</p>
               </div>
               {% if project_overview_list|length > 1  %}
               <div class=\"list\">
                  <ul>
                     {% for key, item in project_overview_list %}
                     <li><img src=\"{{ file_url(item.field_pro_overview_d_image.entity.uri.value) }}\">{{ item.title.value }}</li>
                     {% endfor %}
                  </ul>
               </div>
               {% endif %}
            </div>
            {% if node.field_project_overview_img.entity.uri.value|length > 1  %}
            <div class=\"col-md-6 pic\">
               <div class=\"bg\">
                  <img class=\"img-responsive\" src=\"{{ file_url(node.field_project_overview_img.entity.uri.value) }}\">
               </div>
            </div>
            {% endif %}
         </div>
      </div>

      <!-- Amenities Gallery Section -->
      <div class=\"main-block-row amenities\" data-aos=\"fade-up\">
         <div class=\"col-md-12\">
            <div class=\"heading text-center\">
               <h2><span>Amenities</span></h2>
            </div>
         </div>
         <div class=\"block-row\">
            <div class=\"col-md-6 col pic\">
               <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal1\">
                  <div class=\"bg\"><img class=\"img-responsive\" src=\"{{ file_url(project_amenities.0.field_am_image_one.entity.uri.value) }}\"></div>
                  <h3>{{ project_amenities.0.field_am_title_one.value }}</h3>
               </a>
            </div>
            <div class=\"col-md-6 col\">
               <div class=\"col-md-12 pic\">
                  <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal2\">
                     <div class=\"bg\"><img class=\"img-responsive\" src=\"{{ file_url(project_amenities.0.field_am_image_two.entity.uri.value) }}\"></div>
                     <h3>{{ project_amenities.0.field_am_title_two.value }}</h3>
                  </a>
               </div>
               <div class=\"col-md-12 col\">
                  <div class=\"col-md-6 pic\">
                     <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal3\">
                        <div class=\"bg\"><img class=\"img-responsive\" src=\"{{ file_url(project_amenities.0.field_am_image_three.entity.uri.value) }}\"></div>
                        <h3>{{ project_amenities.0.field_am_title_three.value }}</h3>
                     </a>
                  </div>
                  <div class=\"col-md-6 pic\">
                     <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal4\">
                        <div class=\"bg\"><img class=\"img-responsive\" src=\"{{ file_url(project_amenities.0.field_am_image_four.entity.uri.value) }}\"></div>
                        <h3>{{ project_amenities.0.field_am_title_four.value }}</h3>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"block-row\">
            <div class=\"col-md-6 col\">
               <div class=\"col-md-12 pic\">
                  <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal5\">
                     <div class=\"bg\"><img class=\"img-responsive\" src=\"{{ file_url(project_amenities.0.field_am_image_five.entity.uri.value) }}\"></div>
                     <h3>{{ project_amenities.0.field_am_title_five.value }}</h3>
                  </a>
               </div>
               <div class=\"col-md-12 col\">
                  <div class=\"col-md-6 pic\">
                     <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal6\">
                        <div class=\"bg\"><img class=\"img-responsive\" src=\"{{ file_url(project_amenities.0.field_am_image_six.entity.uri.value) }}\"></div>
                        <h3>{{ project_amenities.0.field_am_title_six.value }}</h3>
                     </a>
                  </div>
                  <div class=\"col-md-6 pic\">
                     <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal7\">
                        <div class=\"bg\"><img class=\"img-responsive\" src=\"{{ file_url(project_amenities.0.field_am_image_seven.entity.uri.value) }}\"></div>
                        <h3>{{ project_amenities.0.field_am_title_seven.value }}</h3>
                     </a>
                  </div>
               </div>
            </div>
            <div class=\"col-md-6 col pic\">
               <a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal8\">
                  <div class=\"bg\"><img class=\"img-responsive\" src=\"{{ file_url(project_amenities.0.field_am_image_eight.entity.uri.value) }}\"></div>
                  <h3>{{ project_amenities.0.field_am_title_eight.value }}</h3>
               </a>
            </div>
         </div>
      </div>

      <!-- Map Section -->
      <div class=\"main-block-row map-view\" data-aos=\"fade-up\" id=\"location\">
         <img class=\"img-responsive\" src=\"{{ directory }}/images/map-view.jpg\">
      </div>

      <!-- Project Floor Map Section -->
      <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
      <style>.myDiv{display:none;text-align:center;}</style>

      <div class=\"main-block-row floors-view\" data-aos=\"fade-in\" id=\"floorPlans\">
         <div class=\"container\">
            <form>
               <div class=\"col-md-3 col-sm-4 f-col\">
                    <select class=\"form-control select\" id=\"myselection\">
                        {% for key, item in pfm_data %}
                           {% if loop.first %}
                              <option value=\"{{ item.0.nid }}\" selected=\"\">{{ key }}</option>
                           {% else %}
                              <option value=\"{{ item.0.nid }}\">{{ key }}</option>
                           {% endif %}
                        {% endfor %}
                  </select>
               </div>
            </form>
            <div class=\"col-md-12\">
               <div class=\"clearfix\"></div>
               <div  class=\"view\">
                  {% for key, item1 in pfm_data %}<div class=\"myDiv pic\" id=\"show{{item1.0.nid}}\">
                     <img id=\"imageFullScreen{{item1.0.nid}}\" src=\"{{ file_url(item1.0.image) }}\" alt=\"Manager\"/>
                  </div>
                  {% endfor %}
                  <div class=\"btns\">
                     <img id=\"zoomInButton\" class=\"zoomButton\" src=\"{{ directory }}/images/zoomin.png\" title=\"zoom in\" alt=\"zoom in\" /><br>
                     <img id=\"zoomOutButton\" class=\"zoomButton\" src=\"{{ directory }}/images/zoomout.png\" title=\"zoom out\" alt=\"zoom out\" />
                  </div>
               </div>
            </div>

            <script>
               \$( document ).ready(function() {
                  var myselection = \$(\"#myselection option:selected\").val();
                  \$(\"#show\"+myselection).show();
                  \$(document).ready(function(){
                     \$('#myselection').on('change', function(){
                        var demovalue = \$(this).val();
                        \$(\"div.myDiv\").hide();
                        \$(\"#show\"+demovalue).show();


                           \$('#imageFullScreen'+demovalue).smartZoom({'containerClass':'zoomableContainer'});
                           \$('#topPositionMap,#leftPositionMap,#rightPositionMap,#bottomPositionMap').bind(\"click\", moveButtonClickHandler);
                           \$('#zoomInButton,#zoomOutButton').bind(\"click\", zoomButtonClickHandler);
                           function zoomButtonClickHandler(e){
                           var scaleToAdd = 0.8;
                           if(e.target.id == 'zoomOutButton')
                           scaleToAdd = -scaleToAdd;
                           \$('#imageFullScreen'+demovalue).smartZoom('zoom', scaleToAdd);
                           }
                           function moveButtonClickHandler(e){
                           var pixelsToMoveOnX = 0;
                           var pixelsToMoveOnY = 0;
                           switch(e.target.id){
                           case \"leftPositionMap\":
                           pixelsToMoveOnX = 50;
                           break;
                           case \"rightPositionMap\":
                           pixelsToMoveOnX = -50;
                           break;
                           case \"topPositionMap\":
                           pixelsToMoveOnY = 50;
                           break;
                           case \"bottomPositionMap\":
                           pixelsToMoveOnY = -50;
                           break;
                           }
                           \$('#imageFullScreen'+demovalue).smartZoom('pan', pixelsToMoveOnX, pixelsToMoveOnY);
                           }

                     });
                  });
               });
            </script>

         </div>
      </div>

         <!-- Project Banner Section O1 -->
         <div class=\"main-block-row\" data-aos=\"fade-up\">
            <div class=\"container\">
               <div class=\"col-md-12 p-ban-block\">
                  <div class=\"pic\"><img class=\"img-responsive\" src=\"{{ file_url(node.field_section_7_image.entity.uri.value) }}\"></div>
                  <div class=\"text col-md-5\">
                     <div class=\"heading\">
                        <h2><span class=\"white\"> {{ node.field_section_7_heading_one.value }} </span> <br><span class=\"blue\">{{ node.field_section_7_heading_two.value }}</span></h2>
                     </div>
                     <p>{{ node.field_section_7_content.value }} </p>
                  </div>
               </div>
            </div>
         </div>

         <!-- Project Banner Section 02 -->
         <div class=\"main-block-row\" data-aos=\"fade-up\">
            <div class=\"container\">
               <div class=\"col-md-12 p-ban-block\">
                  <div class=\"pic\"><img class=\"img-responsive\" src=\"{{ file_url(node.field_section_8_image.entity.uri.value) }}\"></div>
                  <div class=\"text col-md-5\">
                     <div class=\"heading\">
                        <h2><span class=\"white\">{{ node.field_section_8_heading_one.value }} </span> <br><span class=\"blue\">{{ node.field_section_8_heading_two.value }}</span></h2>
                     </div>
                     <p>{{ node.field_section_8_content.value }} </p>
                  </div>
               </div>
            </div>
         </div>

      <!-- Construction Updates Section -->
      {% if construction|length > 1  %}
         <div class=\"main-block-row\" data-aos=\"fade-up\" id=\"constructionUpdates\">
            <div class=\"container\">
               <div class=\"col-md-12\">
                  <div class=\"heading text-center\">
                     <h2>Construction <span class=\"blue\">Updates</span></h2>
                  </div>
               </div>
               <div class=\"updates\">
                  <div class=\"col-md-3 col-sm-4 left-col\">
                     <div class=\"bg\">
                        <ul>
                           {% set i = 1 %}
                           {% for key, item in construction %}
                           <li class=\"{{ i == 1 ? 'active' : ''}}\"><a data-toggle=\"tab\" href=\"#menu{{ i }}\">{{ key }}</a></li>
                           {% set i = i+1 %}
                           {% endfor %}
                        </ul>
                     </div>
                  </div>
                  <div class=\"col-md-9 col-sm-8 right-col\">
                     {% set j = 1 %}
                     {% for key, item in construction %}
                     <div id=\"menu{{ j }}\" class=\"tab-pane fade {{ j == 1 ? 'active in' : ''}}\" data-aos=\"fade-up\">
                        {% for key, item1 in item %}
                        <div class=\"bg\">
                           <div class=\"pic\"> <img class=\"img-responsive\" src=\"{{ file_url(item1.image) }}\"></div>
                           <div class=\"text\">
                            <p>{{ item1.description |raw }}</p>
                         </div>
                      </div>
                      {% endfor %}
                   </div>
                   {% set j = j+1 %}
                   {% endfor %}
                </div>
             </div>
          </div>
         </div>
         <div class=\"clearfix\"></div>
       {% endif %}

       <!-- Specifications Section -->
       {% if sp_data_res|length > 1  %}
       <div class=\"main-block-row faqs m-b-none\" data-aos=\"fade-up\" id=\"specifications\">
         <div class=\"container\">
            <div class=\"col-md-12\">
               <div class=\"heading text-center\">
                  <h2><span class=\"blue\">Specifications</h2>
                  </div>
               </div>
               <div class=\"clearfix\"></div>
               <div class=\"col-md-12\">
                  <div class=\"list col-md-10 margin-auto\">
                     <div class=\"panel-group\" id=\"accordion\">
                        {% for key, item in sp_data_res %}
                        <div class=\"panel panel-default\">
                           <div class=\"panel-heading\">
                              <h4 class=\"panel-title\">
                                 <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#Scollapse{{ key }}\">{{ item.title }}</a>
                              </h4>
                           </div>
                           <div id=\"Scollapse{{ key }}\" class=\"panel-collapse collapse\">
                              <div class=\"panel-body\">
                                {{ item.description |raw }}
                             </div>
                          </div>
                       </div>
                       {% endfor %}
                    </div>
                 </div>
              </div>
           </div>
        </div>
      {% endif %}

        <!-- Frequently Asked Questions Section -->
      {% if faq_data_res|length > 1  %}
        <div class=\"main-block-row faqs\" data-aos=\"fade-up\" id=\"faqs\">
         <div class=\"container\">
            <div class=\"col-md-12\">
               <div class=\"heading text-center\">
                  <h2><i class=\"fa fa-commenting-o\" aria-hidden=\"true\"></i>
                     <span class=\"blue\">Frequently Asked</span> Questions{{ phone }}
                  </h2>
               </div>
            </div>
            <div class=\"clearfix\"></div>

            <div class=\"col-md-12\">
               <div class=\"list col-md-10 margin-auto\">
                  <div class=\"panel-group testing\" id=\"Saccordion\">
                     {% for key, item in faq_data_res %}
                     <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                           <h4 class=\"panel-title\">
                              <a data-toggle=\"collapse\" data-parent=\"#Saccordion\" href=\"#collapse{{ key }}\">{{item.title}}</a>
                           </h4>
                        </div>
                        <div id=\"collapse{{ key }}\" class=\"panel-collapse collapse\">
                           <div class=\"panel-body\">{{item.description | raw}}
                           </div>
                        </div>
                     </div>
                     {% endfor %}

                  </div>
               </div>
            </div>

         </div>
      </div>
      {% endif %}

      <!-- Modal -->
      <div class=\"modal fade project-info-popup\" id=\"myModal_{{ id }}\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">Tennis Court</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                  </div>
               </div>
            </div>
         </div>
      </div>
            <div class=\"modal fade project-info-popup\" id=\"myModal1\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">{{ project_amenities.0.field_am_title_one.value }}</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     {{ project_amenities.0.field_description_one.value | raw }}
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal2\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">{{ project_amenities.0.field_am_title_two.value }}</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     {{ project_amenities.0.field_am_description_two .value | raw  }}
                  </div>
               </div>
            </div>
         </div>
      </div>

       <div class=\"modal fade project-info-popup\" id=\"myModal3\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">{{ project_amenities.0.field_am_title_three.value }}</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     {{ project_amenities.0.field_am_description_three .value | raw  }}
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal4\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">{{ project_amenities.0.field_am_title_four.value }}</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     {{ project_amenities.0.field_am_description_four .value | raw }}
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal5\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">{{ project_amenities.0.field_am_title_five.value }}</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     {{ project_amenities.0.field_am_description_five .value | raw  }}
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal6\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">{{ project_amenities.0.field_am_title_six.value }}</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     {{ project_amenities.0.field_am_description_six .value | raw }}
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal7\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">{{ project_amenities.0.field_am_title_seven.value }}</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     {{ project_amenities.0.field_am_description_seven .value | raw }}
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class=\"modal fade project-info-popup\" id=\"myModal8\" role=\"dialog\">
         <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
               <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  <h4 class=\"modal-title\">{{ project_amenities.0.field_am_title_eight.value }}</h4>
               </div>
               <div class=\"modal-body\">
                  <div class=\"text\">
                     {{ project_amenities.0.field_am_description_eight .value | raw  }}
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         function getPopupModal(id) {
            // alert('test');
            \$('#myModal'+_id).modal('toggle');

         }
      </script>
   </section>", "themes/custom/aparna/templates/system/node--projects.html.twig", "F:\\websites\\aparnadev.devtpit.com\\themes\\custom\\aparna\\templates\\system\\node--projects.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 25, "for" => 37, "set" => 279);
        static $filters = array("escape" => 4, "length" => 25, "raw" => 295);
        static $functions = array("file_url" => 4);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
                ['escape', 'length', 'raw'],
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
