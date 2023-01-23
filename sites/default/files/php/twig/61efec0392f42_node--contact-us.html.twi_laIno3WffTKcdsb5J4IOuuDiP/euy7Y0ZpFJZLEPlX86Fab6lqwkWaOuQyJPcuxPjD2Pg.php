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

/* themes/custom/aparna/templates/system/node--contact-us.html.twig */
class __TwigTemplate_b81d20c14d25bcaff141e73cd77056c1fbb261802c8a1883d10b766e5ca471d5 extends \Twig\Template
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
        echo "<section class=\"inner-content contact\">
         <div class=\"inner-banner\">
            <img src=\"";
        // line 3
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_contactus_banner", [], "any", false, false, true, 3), "entity", [], "any", false, false, true, 3), "uri", [], "any", false, false, true, 3), "value", [], "any", false, false, true, 3), 3, $this->source)]), "html", null, true);
        echo "\">
         </div>
         <div class=\"main-block-row search\" data-aos=\"fade-up\">
            <div class=\"container\">
               <div class=\"bg\">
                  <div class=\"col-md-6 left-col\">
                     <div class=\"heading\">
                        <h2><span class=\"normal\">";
        // line 10
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_contactus_heading", [], "any", false, false, true, 10), 10, $this->source), "html", null, true);
        echo "</span><br> 
                           <span class=\"blue\">";
        // line 11
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_sub_heading", [], "any", false, false, true, 11), 11, $this->source), "html", null, true);
        echo "</span>
                        </h2>
                     </div>
                     <div class=\"text\">
                        <p>";
        // line 15
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_discription", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
        echo "
                        </p>
                     </div>
                  </div>
                   <div class=\"col-md-6\">
                     ";
        // line 20
        $context["randomPassword"] = [];
        // line 21
        echo "                     ";
        $context["alpha"] = "abcdefghijklmnopqrstuvwxyz";
        // line 22
        echo "                     ";
        $context["numbers"] = "0123456789";
        // line 23
        echo "
                     ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(1, 10));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 25
            echo "                     ";
            $context["randomCharacter"] = twig_random($this->env, ((($this->sandbox->ensureToStringAllowed(($context["alpha"] ?? null), 25, $this->source) . twig_upper_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["alpha"] ?? null), 25, $this->source))) . $this->sandbox->ensureToStringAllowed(($context["numbers"] ?? null), 25, $this->source)) . "-_"));
            // line 26
            echo "                     ";
            $context["randomPassword"] = twig_array_merge($this->sandbox->ensureToStringAllowed(($context["randomPassword"] ?? null), 26, $this->source), [0 => ($context["randomCharacter"] ?? null)]);
            // line 27
            echo "                     ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "                     ";
        $context["randomPassword"] = twig_join_filter($this->sandbox->ensureToStringAllowed(($context["randomPassword"] ?? null), 28, $this->source));
        // line 29
        echo "                     <form method=\"post\" enctype=\"multipart/form-data\" action=\"http://aparnadev.devtpit.com/contact-us?cid=";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["randomPassword"] ?? null), 29, $this->source), "html", null, true);
        echo "\">
                        <div class=\"f-row\">
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"text\" name=\"firstname\" placeholder=\"First Name*\" required>
                           </div>
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"text\" name=\"lastname\" placeholder=\"Last Name*\" required>
                           </div>
                        </div>
                        <div class=\"f-row\">
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"email\" name=\"email\" placeholder=\"E-Mail Id*\" required>
                           </div>
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"number\"  name=\"mobile\" placeholder=\"Mobile Number*\" required>
                           </div>
                        </div>
                        <div class=\"f-row\">
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"number\"  name=\"age\" placeholder=\"Age\" required>
                           </div>
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"number\" name=\"pincode\" placeholder=\"Pincode*\" required>
                           </div>
                        </div>
                        <div class=\"f-row\">
                           <div class=\"col-md-6\">
                              <select class=\"form-control\" id='country' name='country' required>
                              
                                  <option value=\"\">Country *</option>
                                  <option value=\"India\" >India</option>
                                  <option value=\"United States\" >United States</option>
                                  <option value=\"Singapore\" >Singapore</option>
                                  <option value=\"Saudi Arabia\" >Saudi Arabia</option>
                                  <option value=\"United Kingdom\" >United Kingdom</option>
                                  <option value=\"Afghanistan\" >Afghanistan</option>
                                  <option value=\"Albania\" >Albania</option>
                                  <option value=\"Algeria\" >Algeria</option>
                                  <option value=\"Andorra\" >Andorra</option>
                                  <option value=\"Angola\" >Angola</option>
                                  <option value=\"Anguilla\" >Anguilla</option>
                                  <option value=\"Antigua & Barbuda\" >Antigua & Barbuda</option>
                                  <option value=\"Argentina\" >Argentina</option>
                                  <option value=\"Armenia\" >Armenia</option>
                                  <option value=\"Australia\" >Australia</option>
                                  <option value=\"Austria\" >Austria</option>
                                  <option value=\"Azerbaijan\" >Azerbaijan</option>
                                  <option value=\"Bahamas\" >Bahamas</option>
                                  <option value=\"Bahrain\" >Bahrain</option>
                                  <option value=\"Bangladesh\" >Bangladesh</option>
                                  <option value=\"Barbados\" >Barbados</option>
                                  <option value=\"Belarus\" >Belarus</option>
                                  <option value=\"Belgium\" >Belgium</option>
                                  <option value=\"Belize\" >Belize</option>
                                  <option value=\"Benin\" >Benin</option>
                                  <option value=\"Bermuda\" >Bermuda</option>
                                  <option value=\"Bhutan\" >Bhutan</option>
                                  <option value=\"Bolivia\" >Bolivia</option>
                                  <option value=\"Bosnia & Herzegovina\" >Bosnia & Herzegovina</option>
                                  <option value=\"Botswana\" >Botswana</option>
                                  <option value=\"Brazil\" >Brazil</option>
                                  <option value=\"Brunei Darussalam\" >Brunei Darussalam</option>
                                  <option value=\"Bulgaria\" >Bulgaria</option>
                                  <option value=\"Burkina Faso\" >Burkina Faso</option>
                                  <option value=\"Myanmar/Burma\" >Myanmar/Burma</option>
                                  <option value=\"Burundi\" >Burundi</option>
                                  <option value=\"Cambodia\" >Cambodia</option>
                                  <option value=\"Cameroon\" >Cameroon</option>
                                  <option value=\"Canada\" >Canada</option>
                                  <option value=\"Cape Verde\" >Cape Verde</option>
                                  <option value=\"Cayman Islands\" >Cayman Islands</option>
                                  <option value=\"Central African Republic\" >Central African Republic</option>
                                  <option value=\"Chad\" >Chad</option>
                                  <option value=\"Chile\" >Chile</option>
                                  <option value=\"China\" >China</option>
                                  <option value=\"Colombia\" >Colombia</option>
                                  <option value=\"Comoros\" >Comoros</option>
                                  <option value=\"Congo\" >Congo</option>
                                  <option value=\"Costa\" >Costa Rica</option>
                                  <option value=\"Croatia\" >Croatia</option>
                                  <option value=\"Cuba\" >Cuba</option>
                                  <option value=\"Cyprus\" >Cyprus</option>
                                  <option value=\"Czech Republic\" >Czech Republic</option>
                                  <option value=\"Democratic Republic of the Congo\" >Democratic Republic of the Congo</option>
                                  <option value=\"Denmark\" >Denmark</option>
                                  <option value=\"Djibouti\" >Djibouti</option>
                                  <option value=\"Dominican Republic\" >Dominican Republic</option>
                                  <option value=\"Dominica\" >Dominica</option>
                                  <option value=\"Ecuador\" >Ecuador</option>
                                  <option value=\"Egypt\" >Egypt</option>
                                  <option value=\"El Salvador\" >El Salvador</option>
                                  <option value=\"Equatorial Guinea\" >Equatorial Guinea</option>
                                  <option value=\"Eritrea\" >Eritrea</option>
                                  <option value=\"Estonia\" >Estonia</option>
                                  <option value=\"Ethiopia\" >Ethiopia</option>
                                  <option value=\"Fiji\" >Fiji</option>
                                  <option value=\"Finland\" >Finland</option>
                                  <option value=\"France\" >France</option>
                                  <option value=\"French Guiana\" >French Guiana</option>
                                  <option value=\"Gabon\" >Gabon</option>
                                  <option value=\"Gambia\" >Gambia</option>
                                  <option value=\"Georgia\" >Georgia</option>
                                  <option value=\"Germany\" >Germany</option>
                                  <option value=\"Ghana\" >Ghana</option>
                                  <option value=\"Great Britain\" >Great Britain</option>
                                  <option value=\"Greece\" >Greece</option>
                                  <option value=\"Grenada\" >Grenada</option>
                                  <option value=\"Guadeloupe\" >Guadeloupe</option>
                                  <option value=\"Guatemala\" >Guatemala</option>
                                  <option value=\"Guinea\" >Guinea</option>
                                  <option value=\"Guinea-Bissau\" >Guinea-Bissau</option>
                                  <option value=\"Guyana\" >Guyana</option>
                                  <option value=\"Haiti\" >Haiti</option>
                                  <option value=\"Honduras\" >Honduras</option>
                                  <option value=\"Hungary\" >Hungary</option>
                                  <option value=\"Iceland\" >Iceland</option>
                                  <option value=\"Indonesia\" >Indonesia</option>
                                  <option value=\"Iran\" >Iran</option>
                                  <option value=\"Iraq\" >Iraq</option>
                                  <option value=\"Israel and the Occupied Territories\" >Israel and the Occupied Territories</option>
                                  <option value=\"Italy\" >Italy</option>
                                  <option value=\"Ivory Coast (Cote d'Ivoire)\" >Ivory Coast (Cote d'Ivoire)</option>
                                  <option value=\"Jamaica\" >Jamaica</option>
                                  <option value=\"Japan\" >Japan</option>
                                  <option value=\"Jordan\" >Jordan</option>
                                  <option value=\"Kazakhstan\" >Kazakhstan</option>
                                  <option value=\"Kenya\" >Kenya</option>
                                  <option value=\"Kosovo\" >Kosovo</option>
                                  <option value=\"Kuwait\" >Kuwait</option>
                                  <option value=\"Kyrgyz Republic (Kyrgyzstan)\" >Kyrgyz Republic (Kyrgyzstan)</option>
                                  <option value=\"Laos\" >Laos</option>
                                  <option value=\"Latvia\" >Latvia</option>
                                  <option value=\"Lebanon\" >Lebanon</option>
                                  <option value=\"Lesotho\" >Lesotho</option>
                                  <option value=\"Liberia\" >Liberia</option>
                                  <option value=\"Libya\" >Libya</option>
                                  <option value=\"Liechtenstein\" >Liechtenstein</option>
                                  <option value=\"Lithuania\" >Lithuania</option>
                                  <option value=\"Luxembourg\" >Luxembourg</option>
                                  <option value=\"Republic of Macedonia\" >Republic of Macedonia</option>
                                  <option value=\"Madagascar\" >Madagascar</option>
                                  <option value=\"Malawi\" >Malawi</option>
                                  <option value=\"Malaysia\" >Malaysia</option>
                                  <option value=\"Maldives\" >Maldives</option>
                                  <option value=\"Mali\" >Mali</option>
                                  <option value=\"Malta\" >Malta</option>
                                  <option value=\"Martinique\" >Martinique</option>
                                  <option value=\"Mauritania\" >Mauritania</option>
                                  <option value=\"Mauritius\" >Mauritius</option>
                                  <option value=\"Mayotte\" >Mayotte</option>
                                  <option value=\"Mexico\" >Mexico</option>
                                  <option value=\"Moldova\" >Moldova, Republic of</option>
                                  <option value=\"Monaco\" >Monaco</option>
                                  <option value=\"Mongolia\" >Mongolia</option>
                                  <option value=\"Montenegro\" >Montenegro</option>
                                  <option value=\"Montserrat\" >Montserrat</option>
                                  <option value=\"Morocco\" >Morocco</option>
                                  <option value=\"Mozambique\" >Mozambique</option>
                                  <option value=\"Namibia\" >Namibia</option>
                                  <option value=\"Nepal\" >Nepal</option>
                                  <option value=\"Netherlands\" >Netherlands</option>
                                  <option value=\"New\" >New Zealand</option>
                                  <option value=\"Nicaragua\" >Nicaragua</option>
                                  <option value=\"Niger\" >Niger</option>
                                  <option value=\"Nigeria\" >Nigeria</option>
                                  <option value=\"Korea Democratic Republic of (North Korea)\" >Korea, Democratic Republic of (North Korea)</option>
                                  <option value=\"Norway\" >Norway</option>
                                  <option value=\"Oman\" >Oman</option>
                                  <option value=\"Pacific Islands\" >Pacific Islands</option>
                                  <option value=\"Pakistan\" >Pakistan</option>
                                  <option value=\"Panama\" >Panama</option>
                                  <option value=\"PapuaNew New Guinea\" >Papua New Guinea</option>
                                  <option value=\"Paraguay\" >Paraguay</option>
                                  <option value=\"Peru\" >Peru</option>
                                  <option value=\"Philippines\" >Philippines</option>
                                  <option value=\"Poland\" >Poland</option>
                                  <option value=\"Portugal\" >Portugal</option>
                                  <option value=\"Puerto\" >Puerto Rico</option>
                                  <option value=\"Qatar\" >Qatar</option>
                                  <option value=\"Reunion\" >Reunion</option>
                                  <option value=\"Romania\" >Romania</option>
                                  <option value=\"Russian Federation\" >Russian Federation</option>
                                  <option value=\"Rwanda\" >Rwanda</option>
                                  <option value=\"Saint Kitts and Nevis\" >Saint Kitts and Nevis</option>
                                  <option value=\"Saint Lucia\" >Saint Lucia</option>
                                  <option value=\"Saint Vincent & Grenadines\" >Saint Vincent's & Grenadines</option>
                                  <option value=\"Samoa\" >Samoa</option>
                                  <option value=\"Sao Tome and Principe\" >Sao Tome and Principe</option>
                                  <option value=\"Senegal\" >Senegal</option>
                                  <option value=\"Serbia\" >Serbia</option>
                                  <option value=\"Seychelles\" >Seychelles</option>
                                  <option value=\"Sierra Leone\" >Sierra Leone</option>
                                  <option value=\"Slovak Republic (Slovakia)\" >Slovak Republic (Slovakia)</option>
                                  <option value=\"Slovenia\" >Slovenia</option>
                                  <option value=\"Solomon Islands\" >Solomon Islands</option>
                                  <option value=\"Somalia\" >Somalia</option>
                                  <option value=\"South Africa\" >South Africa</option>
                                  <option value=\"Korea Republic of (South Korea)\" >Korea, Republic of (South Korea)</option>
                                  <option value=\"South Sudan\" >South Sudan</option>
                                  <option value=\"Spain\" >Spain</option>
                                  <option value=\"Sri Lanka\" >Sri Lanka</option>
                                  <option value=\"Sudan\" >Sudan</option>
                                  <option value=\"Suriname\" >Suriname</option>
                                  <option value=\"Swaziland\" >Swaziland</option>
                                  <option value=\"Sweden\" >Sweden</option>
                                  <option value=\"Switzerland\" >Switzerland</option>
                                  <option value=\"Syria\" >Syria</option>
                                  <option value=\"Tajikistan\" >Tajikistan</option>
                                  <option value=\"Tanzania\" >Tanzania</option>
                                  <option value=\"Thailand\" >Thailand</option>
                                  <option value=\"Timor Leste\" >Timor Leste</option>
                                  <option value=\"Togo\" >Togo</option>
                                  <option value=\"Trinidad & Tobago\" >Trinidad & Tobago</option>
                                  <option value=\"Tunisia\" >Tunisia</option>
                                  <option value=\"Turkey\" >Turkey</option>
                                  <option value=\"Turkmenistan\" >Turkmenistan</option>
                                  <option value=\"Turks & Caicos Islands\" >Turks & Caicos Islands</option>
                                  <option value=\"Uganda\" >Uganda</option>
                                  <option value=\"Ukraine\" >Ukraine</option>
                                  <option value=\"United Arab Emirates\" >United Arab Emirates</option>
                                  <option value=\"Uruguay\" >Uruguay</option>
                                  <option value=\"Uzbekistan\" >Uzbekistan</option>
                                  <option value=\"Venezuela\" >Venezuela</option>
                                  <option value=\"Vietnam\" >Vietnam</option>
                                  <option value=\"Virgin Islands (UK)\" >Virgin Islands (UK)</option>
                                  <option value=\"Virgin Islands (US)\" >Virgin Islands (US)</option>
                                  <option value=\"Yemen\" >Yemen</option>
                                  <option value=\"Zambia\" >Zambia</option>
                                  <option value=\"Zimbabwe\" >Zimbabwe</option>
                              </select>
                           </div>
                           <div class=\"col-md-6\">
                              <select class=\"form-control\" id='project' name='project' required>
                                 <option value=\"\">Select Project*</option>
                                 <option data-projectID=\"16255\" value=\"Aparna Kanopy YellowBells\">Aparna Kanopy YellowBells</option>
                                 <option data-projectID=\"12188\" value=\"Aparna Kanopy Marigold\">Aparna Kanopy Marigold</option>
                                 <option data-projectID=\"16005\" value=\"Aparna Sarovar Zicon\">Aparna Sarovar Zicon</option>
                                 <option data-projectID=\"15081\" value=\"Aparna Serenity\">Aparna Serenity</option>
                                 <option data-projectID=\"12905\" value=\"Aparna Cyberscape\">Aparna Cyberscape</option>
                                 <option data-projectID=\"11130\" value=\"Aparna Luxor Park\">Aparna Luxor Park</option>
                                 <option data-projectID=\"9046\" value=\"Aparna One\">Aparna One</option>
                                 <option data-projectID=\"11087\" value=\"Aparna Maple\">Aparna Maple</option>
                                 <option data-projectID=\"758\" value=\"Aparna Sarovar Zenith\">Aparna Sarovar Zenith</option>
                                 <option data-projectID=\"3915\" value=\"Aparna Amaravati One\">Aparna Amaravati One</option>
                                 <option data-projectID=\"13006\" value=\"Aparna Altius\">Aparna Altius</option>
                              </select>
                           </div>
                        </div>
                        <div class=\"f-row\">
                           <div class=\"col-md-12 text-center\" >
                              <div class=\"radio\">
                                 <input type=\"radio\" name=\"privacypolicy\" required><span>I agree to the Privacy policy.</span>
                              </div>
                           </div>
                        </div>
                        <div class=\"f-row text-center\">
                           <div class=\"col-md-12\">
                              <button class=\"blue-btn\" type=\"submit\">Submit</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"main-block-row blocks\" data-aos=\"fade-up\">
            <div class=\"container\">
               <div class=\"col-md-11 margin-auto\">
                  <div class=\"col-md-4 block\">
                     <div class=\"bg brd-none\">
                        <div class=\"icon\">
                           <img src=\"";
        // line 300
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_department_section_image1", [], "any", false, false, true, 300), "entity", [], "any", false, false, true, 300), "uri", [], "any", false, false, true, 300), "value", [], "any", false, false, true, 300), 300, $this->source)]), "html", null, true);
        echo "\">
                        </div>
                        <h3>";
        // line 302
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_heading", [], "any", false, false, true, 302), 302, $this->source), "html", null, true);
        echo "<br>";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_deparment_section_sub_hea", [], "any", false, false, true, 302), 302, $this->source), "html", null, true);
        echo "</h3>
                        <div class=\"text\">
                           <p><a href=\"mailto:sales@aparnaconstructions.com\">";
        // line 304
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_email1", [], "any", false, false, true, 304), 304, $this->source), "html", null, true);
        echo "</a></p>
                            <p>";
        // line 305
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_phone1", [], "any", false, false, true, 305), 305, $this->source), "html", null, true);
        echo "</p>
                           <p>";
        // line 306
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_descri1", [], "any", false, false, true, 306), 306, $this->source), "html", null, true);
        echo "
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class=\"col-md-4 block\">
                     <div class=\"bg\">
                        <div class=\"icon\">
                           <img src=\"";
        // line 314
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_department_section_image2", [], "any", false, false, true, 314), "entity", [], "any", false, false, true, 314), "uri", [], "any", false, false, true, 314), "value", [], "any", false, false, true, 314), 314, $this->source)]), "html", null, true);
        echo "\">
                        </div>
                        <h3>";
        // line 316
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_headng2", [], "any", false, false, true, 316), 316, $this->source), "html", null, true);
        echo "<br>
                           ";
        // line 317
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_deparment_section_sub_hea2", [], "any", false, false, true, 317), 317, $this->source), "html", null, true);
        echo "
                        </h3>
                        <div class=\"text\">
                           <p><a href=\"mailto:purchase@aparnaconstructions.com\">";
        // line 320
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_email2", [], "any", false, false, true, 320), 320, $this->source), "html", null, true);
        echo "</a></p>
                           <p>";
        // line 321
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_phone2", [], "any", false, false, true, 321), 321, $this->source), "html", null, true);
        echo "</p>
                           <p>";
        // line 322
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_descrip", [], "any", false, false, true, 322), 322, $this->source), "html", null, true);
        echo "
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class=\"col-md-4 block\">
                     <div class=\"bg brd-none\">
                        <div class=\"icon\">
                           <img src=\"";
        // line 330
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_department_section_image3", [], "any", false, false, true, 330), "entity", [], "any", false, false, true, 330), "uri", [], "any", false, false, true, 330), "value", [], "any", false, false, true, 330), 330, $this->source)]), "html", null, true);
        echo "\">
                        </div>
                        <h3>";
        // line 332
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_head3", [], "any", false, false, true, 332), 332, $this->source), "html", null, true);
        echo "<br>
                           ";
        // line 333
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_deparment_section_sub_hea3", [], "any", false, false, true, 333), 333, $this->source), "html", null, true);
        echo "</h3>
                        <div class=\"text\">
                           <a href=\"mailto:careers@aparnaconstructions.com\">";
        // line 335
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_email3", [], "any", false, false, true, 335), 335, $this->source), "html", null, true);
        echo "</a>
                            <p>";
        // line 336
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_phone3_", [], "any", false, false, true, 336), 336, $this->source), "html", null, true);
        echo "</p>
                           <p>";
        // line 337
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_department_section_des3", [], "any", false, false, true, 337), 337, $this->source), "html", null, true);
        echo "
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"main-block-row maps\" data-aos=\"fade-up\">
             ";
        // line 346
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["cm_data_fh"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 347
            echo "            <div class=\"block\">
                  <div class=\"col-md-4 col-left\">
                     <div class=\"text\">
                        <h3><img src=\"";
            // line 350
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_image_map", [], "any", false, false, true, 350), "entity", [], "any", false, false, true, 350), "uri", [], "any", false, false, true, 350), "value", [], "any", false, false, true, 350), 350, $this->source)]), "html", null, true);
            echo "\"> ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 350), "value", [], "any", false, false, true, 350), 350, $this->source), "html", null, true);
            echo "
                        </h3>
                        <h4><span>";
            // line 352
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_name", [], "any", false, false, true, 352), "value", [], "any", false, false, true, 352), 352, $this->source), "html", null, true);
            echo "</span>
                        </h4>
                        <p>";
            // line 354
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_address", [], "any", false, false, true, 354), "value", [], "any", false, false, true, 354), 354, $this->source));
            echo "
                        </p>
                        <p>";
            // line 356
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_phone_1", [], "any", false, false, true, 356), "value", [], "any", false, false, true, 356), 356, $this->source), "html", null, true);
            echo "</p>
                        <p>";
            // line 357
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_phone_2", [], "any", false, false, true, 357), "value", [], "any", false, false, true, 357), 357, $this->source), "html", null, true);
            echo "</p>
                        <p><a href=\"mailto:info@aparnaconstructions.com\">";
            // line 358
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "field_email_map", [], "any", false, false, true, 358), "value", [], "any", false, false, true, 358), 358, $this->source), "html", null, true);
            echo "</a></p>
                     </div>
                  </div>
                  <div class=\"col-md-2\"></div>
                  <div class=\"col-md-6 map\">
                     <iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15226.8309969392!2d78.4501207!3d17.4258074!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcb6732d16281c665!2sAPARNA%20CONSTRUCTIONS%20AND%20ESTATES%20Pvt.%20Ltd.!5e0!3m2!1sen!2sin!4v1640174112928!5m2!1sen!2sin\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>
                  </div>
            </div>
             ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 367
        echo "           <!--  <div class=\"block\">
                  <div class=\"col-md-4 col-left\">
                     <div class=\"text\">
                        <h3><img src=\"images/bang-icon.png\"> BANGALORE
                           OFFICE ADDRESS
                        </h3>
                        <h4><span>APARNA CONSTRUCTIONS
                           AND ESTATES PVT LTD.</span>
                        </h4>
                        <p>#31, 3rd Floor, Lotus Towers, Devraja URS Road, 
                           Race Course, Bengaluru – 560001, Karnataka.
                        </p>
                        <p>+91-79979 69000</p>
                        <p>080-29534119</p>
                        <p><a href=\"mailto:salesblr@aparnaconstructions.com\">salesblr@aparnaconstructions.com</a></p>
                     </div>
                  </div>
                  <div class=\"col-md-2\"></div>
                  <div class=\"col-md-6 map\">
                     <iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15551.232619992483!2d77.581455!3d12.984119!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6316a4b92a5de438!2sAparna%20Constructions%20and%20Estates%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1640175134630!5m2!1sen!2sin\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>
                  </div>
            </div> -->
         </div>
      </section>";
    }

    public function getTemplateName()
    {
        return "themes/custom/aparna/templates/system/node--contact-us.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  525 => 367,  510 => 358,  506 => 357,  502 => 356,  497 => 354,  492 => 352,  485 => 350,  480 => 347,  476 => 346,  464 => 337,  460 => 336,  456 => 335,  451 => 333,  447 => 332,  442 => 330,  431 => 322,  427 => 321,  423 => 320,  417 => 317,  413 => 316,  408 => 314,  397 => 306,  393 => 305,  389 => 304,  382 => 302,  377 => 300,  102 => 29,  99 => 28,  93 => 27,  90 => 26,  87 => 25,  83 => 24,  80 => 23,  77 => 22,  74 => 21,  72 => 20,  64 => 15,  57 => 11,  53 => 10,  43 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<section class=\"inner-content contact\">
         <div class=\"inner-banner\">
            <img src=\"{{ file_url(node.field_contactus_banner.entity.uri.value) }}\">
         </div>
         <div class=\"main-block-row search\" data-aos=\"fade-up\">
            <div class=\"container\">
               <div class=\"bg\">
                  <div class=\"col-md-6 left-col\">
                     <div class=\"heading\">
                        <h2><span class=\"normal\">{{ content.field_contactus_heading }}</span><br> 
                           <span class=\"blue\">{{ content.field_sub_heading }}</span>
                        </h2>
                     </div>
                     <div class=\"text\">
                        <p>{{ content.field_discription }}
                        </p>
                     </div>
                  </div>
                   <div class=\"col-md-6\">
                     {% set randomPassword = [] %}
                     {% set alpha = 'abcdefghijklmnopqrstuvwxyz' %}
                     {% set numbers = '0123456789' %}

                     {% for i in 1..10 %}
                     {% set randomCharacter = random(alpha ~ alpha|upper ~ numbers ~ '-_') %}
                     {% set randomPassword = randomPassword|merge([randomCharacter]) %}
                     {% endfor %}
                     {% set randomPassword = randomPassword|join %}
                     <form method=\"post\" enctype=\"multipart/form-data\" action=\"http://aparnadev.devtpit.com/contact-us?cid={{randomPassword}}\">
                        <div class=\"f-row\">
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"text\" name=\"firstname\" placeholder=\"First Name*\" required>
                           </div>
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"text\" name=\"lastname\" placeholder=\"Last Name*\" required>
                           </div>
                        </div>
                        <div class=\"f-row\">
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"email\" name=\"email\" placeholder=\"E-Mail Id*\" required>
                           </div>
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"number\"  name=\"mobile\" placeholder=\"Mobile Number*\" required>
                           </div>
                        </div>
                        <div class=\"f-row\">
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"number\"  name=\"age\" placeholder=\"Age\" required>
                           </div>
                           <div class=\"col-md-6\">
                              <input class=\"form-control\" type=\"number\" name=\"pincode\" placeholder=\"Pincode*\" required>
                           </div>
                        </div>
                        <div class=\"f-row\">
                           <div class=\"col-md-6\">
                              <select class=\"form-control\" id='country' name='country' required>
                              
                                  <option value=\"\">Country *</option>
                                  <option value=\"India\" >India</option>
                                  <option value=\"United States\" >United States</option>
                                  <option value=\"Singapore\" >Singapore</option>
                                  <option value=\"Saudi Arabia\" >Saudi Arabia</option>
                                  <option value=\"United Kingdom\" >United Kingdom</option>
                                  <option value=\"Afghanistan\" >Afghanistan</option>
                                  <option value=\"Albania\" >Albania</option>
                                  <option value=\"Algeria\" >Algeria</option>
                                  <option value=\"Andorra\" >Andorra</option>
                                  <option value=\"Angola\" >Angola</option>
                                  <option value=\"Anguilla\" >Anguilla</option>
                                  <option value=\"Antigua & Barbuda\" >Antigua & Barbuda</option>
                                  <option value=\"Argentina\" >Argentina</option>
                                  <option value=\"Armenia\" >Armenia</option>
                                  <option value=\"Australia\" >Australia</option>
                                  <option value=\"Austria\" >Austria</option>
                                  <option value=\"Azerbaijan\" >Azerbaijan</option>
                                  <option value=\"Bahamas\" >Bahamas</option>
                                  <option value=\"Bahrain\" >Bahrain</option>
                                  <option value=\"Bangladesh\" >Bangladesh</option>
                                  <option value=\"Barbados\" >Barbados</option>
                                  <option value=\"Belarus\" >Belarus</option>
                                  <option value=\"Belgium\" >Belgium</option>
                                  <option value=\"Belize\" >Belize</option>
                                  <option value=\"Benin\" >Benin</option>
                                  <option value=\"Bermuda\" >Bermuda</option>
                                  <option value=\"Bhutan\" >Bhutan</option>
                                  <option value=\"Bolivia\" >Bolivia</option>
                                  <option value=\"Bosnia & Herzegovina\" >Bosnia & Herzegovina</option>
                                  <option value=\"Botswana\" >Botswana</option>
                                  <option value=\"Brazil\" >Brazil</option>
                                  <option value=\"Brunei Darussalam\" >Brunei Darussalam</option>
                                  <option value=\"Bulgaria\" >Bulgaria</option>
                                  <option value=\"Burkina Faso\" >Burkina Faso</option>
                                  <option value=\"Myanmar/Burma\" >Myanmar/Burma</option>
                                  <option value=\"Burundi\" >Burundi</option>
                                  <option value=\"Cambodia\" >Cambodia</option>
                                  <option value=\"Cameroon\" >Cameroon</option>
                                  <option value=\"Canada\" >Canada</option>
                                  <option value=\"Cape Verde\" >Cape Verde</option>
                                  <option value=\"Cayman Islands\" >Cayman Islands</option>
                                  <option value=\"Central African Republic\" >Central African Republic</option>
                                  <option value=\"Chad\" >Chad</option>
                                  <option value=\"Chile\" >Chile</option>
                                  <option value=\"China\" >China</option>
                                  <option value=\"Colombia\" >Colombia</option>
                                  <option value=\"Comoros\" >Comoros</option>
                                  <option value=\"Congo\" >Congo</option>
                                  <option value=\"Costa\" >Costa Rica</option>
                                  <option value=\"Croatia\" >Croatia</option>
                                  <option value=\"Cuba\" >Cuba</option>
                                  <option value=\"Cyprus\" >Cyprus</option>
                                  <option value=\"Czech Republic\" >Czech Republic</option>
                                  <option value=\"Democratic Republic of the Congo\" >Democratic Republic of the Congo</option>
                                  <option value=\"Denmark\" >Denmark</option>
                                  <option value=\"Djibouti\" >Djibouti</option>
                                  <option value=\"Dominican Republic\" >Dominican Republic</option>
                                  <option value=\"Dominica\" >Dominica</option>
                                  <option value=\"Ecuador\" >Ecuador</option>
                                  <option value=\"Egypt\" >Egypt</option>
                                  <option value=\"El Salvador\" >El Salvador</option>
                                  <option value=\"Equatorial Guinea\" >Equatorial Guinea</option>
                                  <option value=\"Eritrea\" >Eritrea</option>
                                  <option value=\"Estonia\" >Estonia</option>
                                  <option value=\"Ethiopia\" >Ethiopia</option>
                                  <option value=\"Fiji\" >Fiji</option>
                                  <option value=\"Finland\" >Finland</option>
                                  <option value=\"France\" >France</option>
                                  <option value=\"French Guiana\" >French Guiana</option>
                                  <option value=\"Gabon\" >Gabon</option>
                                  <option value=\"Gambia\" >Gambia</option>
                                  <option value=\"Georgia\" >Georgia</option>
                                  <option value=\"Germany\" >Germany</option>
                                  <option value=\"Ghana\" >Ghana</option>
                                  <option value=\"Great Britain\" >Great Britain</option>
                                  <option value=\"Greece\" >Greece</option>
                                  <option value=\"Grenada\" >Grenada</option>
                                  <option value=\"Guadeloupe\" >Guadeloupe</option>
                                  <option value=\"Guatemala\" >Guatemala</option>
                                  <option value=\"Guinea\" >Guinea</option>
                                  <option value=\"Guinea-Bissau\" >Guinea-Bissau</option>
                                  <option value=\"Guyana\" >Guyana</option>
                                  <option value=\"Haiti\" >Haiti</option>
                                  <option value=\"Honduras\" >Honduras</option>
                                  <option value=\"Hungary\" >Hungary</option>
                                  <option value=\"Iceland\" >Iceland</option>
                                  <option value=\"Indonesia\" >Indonesia</option>
                                  <option value=\"Iran\" >Iran</option>
                                  <option value=\"Iraq\" >Iraq</option>
                                  <option value=\"Israel and the Occupied Territories\" >Israel and the Occupied Territories</option>
                                  <option value=\"Italy\" >Italy</option>
                                  <option value=\"Ivory Coast (Cote d'Ivoire)\" >Ivory Coast (Cote d'Ivoire)</option>
                                  <option value=\"Jamaica\" >Jamaica</option>
                                  <option value=\"Japan\" >Japan</option>
                                  <option value=\"Jordan\" >Jordan</option>
                                  <option value=\"Kazakhstan\" >Kazakhstan</option>
                                  <option value=\"Kenya\" >Kenya</option>
                                  <option value=\"Kosovo\" >Kosovo</option>
                                  <option value=\"Kuwait\" >Kuwait</option>
                                  <option value=\"Kyrgyz Republic (Kyrgyzstan)\" >Kyrgyz Republic (Kyrgyzstan)</option>
                                  <option value=\"Laos\" >Laos</option>
                                  <option value=\"Latvia\" >Latvia</option>
                                  <option value=\"Lebanon\" >Lebanon</option>
                                  <option value=\"Lesotho\" >Lesotho</option>
                                  <option value=\"Liberia\" >Liberia</option>
                                  <option value=\"Libya\" >Libya</option>
                                  <option value=\"Liechtenstein\" >Liechtenstein</option>
                                  <option value=\"Lithuania\" >Lithuania</option>
                                  <option value=\"Luxembourg\" >Luxembourg</option>
                                  <option value=\"Republic of Macedonia\" >Republic of Macedonia</option>
                                  <option value=\"Madagascar\" >Madagascar</option>
                                  <option value=\"Malawi\" >Malawi</option>
                                  <option value=\"Malaysia\" >Malaysia</option>
                                  <option value=\"Maldives\" >Maldives</option>
                                  <option value=\"Mali\" >Mali</option>
                                  <option value=\"Malta\" >Malta</option>
                                  <option value=\"Martinique\" >Martinique</option>
                                  <option value=\"Mauritania\" >Mauritania</option>
                                  <option value=\"Mauritius\" >Mauritius</option>
                                  <option value=\"Mayotte\" >Mayotte</option>
                                  <option value=\"Mexico\" >Mexico</option>
                                  <option value=\"Moldova\" >Moldova, Republic of</option>
                                  <option value=\"Monaco\" >Monaco</option>
                                  <option value=\"Mongolia\" >Mongolia</option>
                                  <option value=\"Montenegro\" >Montenegro</option>
                                  <option value=\"Montserrat\" >Montserrat</option>
                                  <option value=\"Morocco\" >Morocco</option>
                                  <option value=\"Mozambique\" >Mozambique</option>
                                  <option value=\"Namibia\" >Namibia</option>
                                  <option value=\"Nepal\" >Nepal</option>
                                  <option value=\"Netherlands\" >Netherlands</option>
                                  <option value=\"New\" >New Zealand</option>
                                  <option value=\"Nicaragua\" >Nicaragua</option>
                                  <option value=\"Niger\" >Niger</option>
                                  <option value=\"Nigeria\" >Nigeria</option>
                                  <option value=\"Korea Democratic Republic of (North Korea)\" >Korea, Democratic Republic of (North Korea)</option>
                                  <option value=\"Norway\" >Norway</option>
                                  <option value=\"Oman\" >Oman</option>
                                  <option value=\"Pacific Islands\" >Pacific Islands</option>
                                  <option value=\"Pakistan\" >Pakistan</option>
                                  <option value=\"Panama\" >Panama</option>
                                  <option value=\"PapuaNew New Guinea\" >Papua New Guinea</option>
                                  <option value=\"Paraguay\" >Paraguay</option>
                                  <option value=\"Peru\" >Peru</option>
                                  <option value=\"Philippines\" >Philippines</option>
                                  <option value=\"Poland\" >Poland</option>
                                  <option value=\"Portugal\" >Portugal</option>
                                  <option value=\"Puerto\" >Puerto Rico</option>
                                  <option value=\"Qatar\" >Qatar</option>
                                  <option value=\"Reunion\" >Reunion</option>
                                  <option value=\"Romania\" >Romania</option>
                                  <option value=\"Russian Federation\" >Russian Federation</option>
                                  <option value=\"Rwanda\" >Rwanda</option>
                                  <option value=\"Saint Kitts and Nevis\" >Saint Kitts and Nevis</option>
                                  <option value=\"Saint Lucia\" >Saint Lucia</option>
                                  <option value=\"Saint Vincent & Grenadines\" >Saint Vincent's & Grenadines</option>
                                  <option value=\"Samoa\" >Samoa</option>
                                  <option value=\"Sao Tome and Principe\" >Sao Tome and Principe</option>
                                  <option value=\"Senegal\" >Senegal</option>
                                  <option value=\"Serbia\" >Serbia</option>
                                  <option value=\"Seychelles\" >Seychelles</option>
                                  <option value=\"Sierra Leone\" >Sierra Leone</option>
                                  <option value=\"Slovak Republic (Slovakia)\" >Slovak Republic (Slovakia)</option>
                                  <option value=\"Slovenia\" >Slovenia</option>
                                  <option value=\"Solomon Islands\" >Solomon Islands</option>
                                  <option value=\"Somalia\" >Somalia</option>
                                  <option value=\"South Africa\" >South Africa</option>
                                  <option value=\"Korea Republic of (South Korea)\" >Korea, Republic of (South Korea)</option>
                                  <option value=\"South Sudan\" >South Sudan</option>
                                  <option value=\"Spain\" >Spain</option>
                                  <option value=\"Sri Lanka\" >Sri Lanka</option>
                                  <option value=\"Sudan\" >Sudan</option>
                                  <option value=\"Suriname\" >Suriname</option>
                                  <option value=\"Swaziland\" >Swaziland</option>
                                  <option value=\"Sweden\" >Sweden</option>
                                  <option value=\"Switzerland\" >Switzerland</option>
                                  <option value=\"Syria\" >Syria</option>
                                  <option value=\"Tajikistan\" >Tajikistan</option>
                                  <option value=\"Tanzania\" >Tanzania</option>
                                  <option value=\"Thailand\" >Thailand</option>
                                  <option value=\"Timor Leste\" >Timor Leste</option>
                                  <option value=\"Togo\" >Togo</option>
                                  <option value=\"Trinidad & Tobago\" >Trinidad & Tobago</option>
                                  <option value=\"Tunisia\" >Tunisia</option>
                                  <option value=\"Turkey\" >Turkey</option>
                                  <option value=\"Turkmenistan\" >Turkmenistan</option>
                                  <option value=\"Turks & Caicos Islands\" >Turks & Caicos Islands</option>
                                  <option value=\"Uganda\" >Uganda</option>
                                  <option value=\"Ukraine\" >Ukraine</option>
                                  <option value=\"United Arab Emirates\" >United Arab Emirates</option>
                                  <option value=\"Uruguay\" >Uruguay</option>
                                  <option value=\"Uzbekistan\" >Uzbekistan</option>
                                  <option value=\"Venezuela\" >Venezuela</option>
                                  <option value=\"Vietnam\" >Vietnam</option>
                                  <option value=\"Virgin Islands (UK)\" >Virgin Islands (UK)</option>
                                  <option value=\"Virgin Islands (US)\" >Virgin Islands (US)</option>
                                  <option value=\"Yemen\" >Yemen</option>
                                  <option value=\"Zambia\" >Zambia</option>
                                  <option value=\"Zimbabwe\" >Zimbabwe</option>
                              </select>
                           </div>
                           <div class=\"col-md-6\">
                              <select class=\"form-control\" id='project' name='project' required>
                                 <option value=\"\">Select Project*</option>
                                 <option data-projectID=\"16255\" value=\"Aparna Kanopy YellowBells\">Aparna Kanopy YellowBells</option>
                                 <option data-projectID=\"12188\" value=\"Aparna Kanopy Marigold\">Aparna Kanopy Marigold</option>
                                 <option data-projectID=\"16005\" value=\"Aparna Sarovar Zicon\">Aparna Sarovar Zicon</option>
                                 <option data-projectID=\"15081\" value=\"Aparna Serenity\">Aparna Serenity</option>
                                 <option data-projectID=\"12905\" value=\"Aparna Cyberscape\">Aparna Cyberscape</option>
                                 <option data-projectID=\"11130\" value=\"Aparna Luxor Park\">Aparna Luxor Park</option>
                                 <option data-projectID=\"9046\" value=\"Aparna One\">Aparna One</option>
                                 <option data-projectID=\"11087\" value=\"Aparna Maple\">Aparna Maple</option>
                                 <option data-projectID=\"758\" value=\"Aparna Sarovar Zenith\">Aparna Sarovar Zenith</option>
                                 <option data-projectID=\"3915\" value=\"Aparna Amaravati One\">Aparna Amaravati One</option>
                                 <option data-projectID=\"13006\" value=\"Aparna Altius\">Aparna Altius</option>
                              </select>
                           </div>
                        </div>
                        <div class=\"f-row\">
                           <div class=\"col-md-12 text-center\" >
                              <div class=\"radio\">
                                 <input type=\"radio\" name=\"privacypolicy\" required><span>I agree to the Privacy policy.</span>
                              </div>
                           </div>
                        </div>
                        <div class=\"f-row text-center\">
                           <div class=\"col-md-12\">
                              <button class=\"blue-btn\" type=\"submit\">Submit</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"main-block-row blocks\" data-aos=\"fade-up\">
            <div class=\"container\">
               <div class=\"col-md-11 margin-auto\">
                  <div class=\"col-md-4 block\">
                     <div class=\"bg brd-none\">
                        <div class=\"icon\">
                           <img src=\"{{ file_url(node.field_department_section_image1.entity.uri.value) }}\">
                        </div>
                        <h3>{{ content.field_department_section_heading }}<br>{{ content.field_deparment_section_sub_hea }}</h3>
                        <div class=\"text\">
                           <p><a href=\"mailto:sales@aparnaconstructions.com\">{{ content.field_department_section_email1 }}</a></p>
                            <p>{{ content.field_department_section_phone1 }}</p>
                           <p>{{ content.field_department_section_descri1 }}
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class=\"col-md-4 block\">
                     <div class=\"bg\">
                        <div class=\"icon\">
                           <img src=\"{{ file_url(node.field_department_section_image2.entity.uri.value) }}\">
                        </div>
                        <h3>{{ content.field_department_section_headng2 }}<br>
                           {{ content.field_deparment_section_sub_hea2 }}
                        </h3>
                        <div class=\"text\">
                           <p><a href=\"mailto:purchase@aparnaconstructions.com\">{{ content.field_department_section_email2 }}</a></p>
                           <p>{{ content.field_department_section_phone2 }}</p>
                           <p>{{ content.field_department_section_descrip }}
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class=\"col-md-4 block\">
                     <div class=\"bg brd-none\">
                        <div class=\"icon\">
                           <img src=\"{{ file_url(node.field_department_section_image3.entity.uri.value) }}\">
                        </div>
                        <h3>{{ content.field_department_section_head3 }}<br>
                           {{ content.field_deparment_section_sub_hea3 }}</h3>
                        <div class=\"text\">
                           <a href=\"mailto:careers@aparnaconstructions.com\">{{ content.field_department_section_email3 }}</a>
                            <p>{{ content.field_department_section_phone3_ }}</p>
                           <p>{{ content.field_department_section_des3 }}
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class=\"main-block-row maps\" data-aos=\"fade-up\">
             {% for key, item in cm_data_fh %}
            <div class=\"block\">
                  <div class=\"col-md-4 col-left\">
                     <div class=\"text\">
                        <h3><img src=\"{{ file_url(item.field_image_map.entity.uri.value) }}\"> {{item.title.value}}
                        </h3>
                        <h4><span>{{item.field_name.value}}</span>
                        </h4>
                        <p>{{item.field_address.value|raw}}
                        </p>
                        <p>{{item.field_phone_1.value}}</p>
                        <p>{{item.field_phone_2.value}}</p>
                        <p><a href=\"mailto:info@aparnaconstructions.com\">{{item.field_email_map.value}}</a></p>
                     </div>
                  </div>
                  <div class=\"col-md-2\"></div>
                  <div class=\"col-md-6 map\">
                     <iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15226.8309969392!2d78.4501207!3d17.4258074!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcb6732d16281c665!2sAPARNA%20CONSTRUCTIONS%20AND%20ESTATES%20Pvt.%20Ltd.!5e0!3m2!1sen!2sin!4v1640174112928!5m2!1sen!2sin\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>
                  </div>
            </div>
             {% endfor %}
           <!--  <div class=\"block\">
                  <div class=\"col-md-4 col-left\">
                     <div class=\"text\">
                        <h3><img src=\"images/bang-icon.png\"> BANGALORE
                           OFFICE ADDRESS
                        </h3>
                        <h4><span>APARNA CONSTRUCTIONS
                           AND ESTATES PVT LTD.</span>
                        </h4>
                        <p>#31, 3rd Floor, Lotus Towers, Devraja URS Road, 
                           Race Course, Bengaluru – 560001, Karnataka.
                        </p>
                        <p>+91-79979 69000</p>
                        <p>080-29534119</p>
                        <p><a href=\"mailto:salesblr@aparnaconstructions.com\">salesblr@aparnaconstructions.com</a></p>
                     </div>
                  </div>
                  <div class=\"col-md-2\"></div>
                  <div class=\"col-md-6 map\">
                     <iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15551.232619992483!2d77.581455!3d12.984119!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6316a4b92a5de438!2sAparna%20Constructions%20and%20Estates%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1640175134630!5m2!1sen!2sin\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>
                  </div>
            </div> -->
         </div>
      </section>", "themes/custom/aparna/templates/system/node--contact-us.html.twig", "F:\\websites\\aparnadev.devtpit.com\\themes\\custom\\aparna\\templates\\system\\node--contact-us.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 20, "for" => 24);
        static $filters = array("escape" => 3, "upper" => 25, "merge" => 26, "join" => 28, "raw" => 354);
        static $functions = array("file_url" => 3, "range" => 24, "random" => 25);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for'],
                ['escape', 'upper', 'merge', 'join', 'raw'],
                ['file_url', 'range', 'random']
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
