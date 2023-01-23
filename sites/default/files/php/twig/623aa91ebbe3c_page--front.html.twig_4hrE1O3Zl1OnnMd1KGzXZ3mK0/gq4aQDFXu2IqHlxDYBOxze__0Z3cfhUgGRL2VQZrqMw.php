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

/* themes/custom/sunergeo/templates/system/page--front.html.twig */
class __TwigTemplate_219e60f32bf9f84e148b6513fb896b5a2ad8ad5f551a68d22962aec63a9cedf9 extends \Twig\Template
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
<body>
  <header>
    ";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 4), 4, $this->source), "html", null, true);
        echo "
    <div class=\"banner\" data-aos=\"fade-in\">
      <div class=\"bg\"></div>
      <img class=\"img-responsive\" src=\"";
        // line 7
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getUrl("<front>"));
        echo "themes/custom/sunergeo/images/banner.jpg\">
      <div class=\"text\" data-aos=\"fade-up\">
       <div class=\"container\">
        <div class=\"col-md-8\">
         <h1>We are Sunergeo</h1>
         <p>Sunergeo is a group company based out of Singapore with Web Synergies and its subsidiaries under its portfolio.</p>
       </div>
     </div>
   </div>
 </div>
</header>




<section class=\"inner-content home\" data-aos=\"fade-up\">
 <div class=\"container\">
  <div class=\"block-row news-release\" data-aos=\"fade-up\">
   <div class=\"title\">
    <h2>News Release</h2>

  </div>
  <div class=\"bg\">
    <div class=\"col-md-6 pic\">
     <a href=\"blog-inner.php\"><img class=\"img-responsive\" src=\"";
        // line 31
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getUrl("<front>"));
        echo "themes/custom/sunergeo/images/news-release-pic.jpg\"></a>
   </div>
   <div class=\"col-md-6 text\">
     <h3><a href=\"news-inner.php\">Yokogawa Invests in Web Synergies to Expand Digital Transformation Capabilities</a></h3>
     <div class=\"date\">20 July 2021</div>
     <p><strong>TOKYO, Japan and SINGAPORE – October 18th 2021</strong> – Yokogawa Electric Corporation (TOKYO: 6841) and Web Synergies (S) Pte Ltd announce that Yokogawa Electric has invested in Web Synergies, a Singapore-based company that provides IT and operational technology (OT)/IT solutions. </p>
     <a class=\"more\" href=\"news-inner.php\">Read More</a>
   </div>
 </div>
</div>
<div class=\"block-row contact-block\" data-aos=\"fade-up\">
 <div class=\"title\">
  <h2>Contact Us</h2>
</div>

<div class=\"col-md-10 form\" data-aos=\"fade-up\">
  <form>


   <div class=\"f-row phone\">
     <div class=\"col-sm-6 col\">
      <label>First Name <span class=\"mandatory\">*</span></label>
      <input class=\"form-control\" type=\"text\" placeholder=\"Input your name\" name=\"\">
    </div>
    <div class=\"col-sm-6 col\">
      <label>Last Name <span class=\"mandatory\">*</span></label>
      <input class=\"form-control\" type=\"text\" placeholder=\"Input your name\" name=\"\">
    </div>
  </div>

  <div class=\"f-row\">
    <label>Email Address <span class=\"mandatory\">*</span></label>
    <input class=\"form-control\" type=\"text\" placeholder=\"Input your Email\" name=\"\">
  </div>

  <div class=\"f-row phone\">
    <label>Phone Number <span class=\"mandatory\">*</span></label>
    <div class=\"col-md-3 col-sm-5 col\">
     <select class=\"form-control\"><option>Country Code</option></select>
   </div>
   <div class=\"col-md-9 col-sm-7 col\">
     <input class=\"form-control\" type=\"text\" placeholder=\"Input your phone number\" name=\"\">
   </div>
 </div>

 <div class=\"f-row\">
  <label>Prefered Contact Method <span class=\"mandatory\">*</span></label>
  <select class=\"form-control\"><option>Email</option></select>
</div>

<div class=\"f-row\">
  <label>Company <span class=\"mandatory\">*</span></label>
  <input class=\"form-control\" type=\"text\" placeholder=\"Input your Company\" name=\"\">
</div>

<div class=\"f-row\">
  <label>Your Message <span class=\"mandatory\">*</span></label>
  <input class=\"form-control\" type=\"textarea\" placeholder=\"Input your Company\" name=\"\">
</div>

<div class=\"f-row submit\">
  <button>Submit</button>
</div>


</form>
</div>

</div>

<div class=\"block-row contact-block\" data-aos=\"fade-up\">
 <div class=\"title\">
  <h2>Corporate Office</h2>
</div>



<div class=\"locations\" data-aos=\"fade-up\">

  <div class=\"col-md-6 block\">
   <p><img src=\"";
        // line 111
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getUrl("<front>"));
        echo "themes/custom/sunergeo/images/sig-icon.png\" data-aos=\"zoom-in\">
    <strong>Singapore</strong>
    Sunergeo Holding Pte Ltd<br>
    Blk 10 Ubi Crescent, #02-43/44 (Lobby C)<br>
    Ubi Techpark, Singapore 408564<br>
    Ph: +65 6603 5160<br>
    Fax: +65 6742 2608<br>
    <a href=\"mailto:info@sunergeoholding.com\">info@sunergeoholding.com</a>
  </p>
</div>

<div class=\"col-md-6 block map\">
  <iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15954.997544520053!2d103.8961912!3d1.3263137!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3b60d6922f00c72a!2sWeb%20Synergies%20(S)%20Pte%20Ltd!5e0!3m2!1sen!2sin!4v1645440463992!5m2!1sen!2sin\" width=\"100%\" height=\"250\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>
</div>


</div>



</div>
</div>
</section>
";
        // line 134
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 134), 134, $this->source), "html", null, true);
        echo "


<script>
 AOS.init({
   duration: 1200,
 })
</script>";
    }

    public function getTemplateName()
    {
        return "themes/custom/sunergeo/templates/system/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 134,  160 => 111,  77 => 31,  50 => 7,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
<body>
  <header>
    {{ page.header }}
    <div class=\"banner\" data-aos=\"fade-in\">
      <div class=\"bg\"></div>
      <img class=\"img-responsive\" src=\"{{ url('<front>') }}themes/custom/sunergeo/images/banner.jpg\">
      <div class=\"text\" data-aos=\"fade-up\">
       <div class=\"container\">
        <div class=\"col-md-8\">
         <h1>We are Sunergeo</h1>
         <p>Sunergeo is a group company based out of Singapore with Web Synergies and its subsidiaries under its portfolio.</p>
       </div>
     </div>
   </div>
 </div>
</header>




<section class=\"inner-content home\" data-aos=\"fade-up\">
 <div class=\"container\">
  <div class=\"block-row news-release\" data-aos=\"fade-up\">
   <div class=\"title\">
    <h2>News Release</h2>

  </div>
  <div class=\"bg\">
    <div class=\"col-md-6 pic\">
     <a href=\"blog-inner.php\"><img class=\"img-responsive\" src=\"{{ url('<front>') }}themes/custom/sunergeo/images/news-release-pic.jpg\"></a>
   </div>
   <div class=\"col-md-6 text\">
     <h3><a href=\"news-inner.php\">Yokogawa Invests in Web Synergies to Expand Digital Transformation Capabilities</a></h3>
     <div class=\"date\">20 July 2021</div>
     <p><strong>TOKYO, Japan and SINGAPORE – October 18th 2021</strong> – Yokogawa Electric Corporation (TOKYO: 6841) and Web Synergies (S) Pte Ltd announce that Yokogawa Electric has invested in Web Synergies, a Singapore-based company that provides IT and operational technology (OT)/IT solutions. </p>
     <a class=\"more\" href=\"news-inner.php\">Read More</a>
   </div>
 </div>
</div>
<div class=\"block-row contact-block\" data-aos=\"fade-up\">
 <div class=\"title\">
  <h2>Contact Us</h2>
</div>

<div class=\"col-md-10 form\" data-aos=\"fade-up\">
  <form>


   <div class=\"f-row phone\">
     <div class=\"col-sm-6 col\">
      <label>First Name <span class=\"mandatory\">*</span></label>
      <input class=\"form-control\" type=\"text\" placeholder=\"Input your name\" name=\"\">
    </div>
    <div class=\"col-sm-6 col\">
      <label>Last Name <span class=\"mandatory\">*</span></label>
      <input class=\"form-control\" type=\"text\" placeholder=\"Input your name\" name=\"\">
    </div>
  </div>

  <div class=\"f-row\">
    <label>Email Address <span class=\"mandatory\">*</span></label>
    <input class=\"form-control\" type=\"text\" placeholder=\"Input your Email\" name=\"\">
  </div>

  <div class=\"f-row phone\">
    <label>Phone Number <span class=\"mandatory\">*</span></label>
    <div class=\"col-md-3 col-sm-5 col\">
     <select class=\"form-control\"><option>Country Code</option></select>
   </div>
   <div class=\"col-md-9 col-sm-7 col\">
     <input class=\"form-control\" type=\"text\" placeholder=\"Input your phone number\" name=\"\">
   </div>
 </div>

 <div class=\"f-row\">
  <label>Prefered Contact Method <span class=\"mandatory\">*</span></label>
  <select class=\"form-control\"><option>Email</option></select>
</div>

<div class=\"f-row\">
  <label>Company <span class=\"mandatory\">*</span></label>
  <input class=\"form-control\" type=\"text\" placeholder=\"Input your Company\" name=\"\">
</div>

<div class=\"f-row\">
  <label>Your Message <span class=\"mandatory\">*</span></label>
  <input class=\"form-control\" type=\"textarea\" placeholder=\"Input your Company\" name=\"\">
</div>

<div class=\"f-row submit\">
  <button>Submit</button>
</div>


</form>
</div>

</div>

<div class=\"block-row contact-block\" data-aos=\"fade-up\">
 <div class=\"title\">
  <h2>Corporate Office</h2>
</div>



<div class=\"locations\" data-aos=\"fade-up\">

  <div class=\"col-md-6 block\">
   <p><img src=\"{{ url('<front>') }}themes/custom/sunergeo/images/sig-icon.png\" data-aos=\"zoom-in\">
    <strong>Singapore</strong>
    Sunergeo Holding Pte Ltd<br>
    Blk 10 Ubi Crescent, #02-43/44 (Lobby C)<br>
    Ubi Techpark, Singapore 408564<br>
    Ph: +65 6603 5160<br>
    Fax: +65 6742 2608<br>
    <a href=\"mailto:info@sunergeoholding.com\">info@sunergeoholding.com</a>
  </p>
</div>

<div class=\"col-md-6 block map\">
  <iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15954.997544520053!2d103.8961912!3d1.3263137!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3b60d6922f00c72a!2sWeb%20Synergies%20(S)%20Pte%20Ltd!5e0!3m2!1sen!2sin!4v1645440463992!5m2!1sen!2sin\" width=\"100%\" height=\"250\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>
</div>


</div>



</div>
</div>
</section>
{{ page.footer }}


<script>
 AOS.init({
   duration: 1200,
 })
</script>", "themes/custom/sunergeo/templates/system/page--front.html.twig", "C:\\wamp64\\www\\sunergeo_dev\\themes\\custom\\sunergeo\\templates\\system\\page--front.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 4);
        static $functions = array("url" => 7);

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
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
