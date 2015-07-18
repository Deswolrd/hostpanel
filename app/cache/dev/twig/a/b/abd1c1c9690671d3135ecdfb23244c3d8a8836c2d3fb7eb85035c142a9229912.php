<?php

/* TwigBundle:Exception:exception_full.html.twig */
class __TwigTemplate_abd1c1c9690671d3135ecdfb23244c3d8a8836c2d3fb7eb85035c142a9229912 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("TwigBundle::layout.html.twig", "TwigBundle:Exception:exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TwigBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_4069761a3c40dfe7cd75fb9f258d969c92be814a4a7bcdf8b5ad8e13028ea314 = $this->env->getExtension("native_profiler");
        $__internal_4069761a3c40dfe7cd75fb9f258d969c92be814a4a7bcdf8b5ad8e13028ea314->enter($__internal_4069761a3c40dfe7cd75fb9f258d969c92be814a4a7bcdf8b5ad8e13028ea314_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4069761a3c40dfe7cd75fb9f258d969c92be814a4a7bcdf8b5ad8e13028ea314->leave($__internal_4069761a3c40dfe7cd75fb9f258d969c92be814a4a7bcdf8b5ad8e13028ea314_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_c325fea25eee9ccbc80a1e05a196a174c72a19d871aa10565c7d83a9d582ee35 = $this->env->getExtension("native_profiler");
        $__internal_c325fea25eee9ccbc80a1e05a196a174c72a19d871aa10565c7d83a9d582ee35->enter($__internal_c325fea25eee9ccbc80a1e05a196a174c72a19d871aa10565c7d83a9d582ee35_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_c325fea25eee9ccbc80a1e05a196a174c72a19d871aa10565c7d83a9d582ee35->leave($__internal_c325fea25eee9ccbc80a1e05a196a174c72a19d871aa10565c7d83a9d582ee35_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_d168f849287782f934d33fe7d0ed685cdd0ff6f55ffd7c8a43f8593e81c979ba = $this->env->getExtension("native_profiler");
        $__internal_d168f849287782f934d33fe7d0ed685cdd0ff6f55ffd7c8a43f8593e81c979ba->enter($__internal_d168f849287782f934d33fe7d0ed685cdd0ff6f55ffd7c8a43f8593e81c979ba_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_d168f849287782f934d33fe7d0ed685cdd0ff6f55ffd7c8a43f8593e81c979ba->leave($__internal_d168f849287782f934d33fe7d0ed685cdd0ff6f55ffd7c8a43f8593e81c979ba_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_6c0912eba80262d489abc67d269c55630f83c81f132bad1c0b118a711bd0932b = $this->env->getExtension("native_profiler");
        $__internal_6c0912eba80262d489abc67d269c55630f83c81f132bad1c0b118a711bd0932b->enter($__internal_6c0912eba80262d489abc67d269c55630f83c81f132bad1c0b118a711bd0932b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("TwigBundle:Exception:exception.html.twig", "TwigBundle:Exception:exception_full.html.twig", 12)->display($context);
        
        $__internal_6c0912eba80262d489abc67d269c55630f83c81f132bad1c0b118a711bd0932b->leave($__internal_6c0912eba80262d489abc67d269c55630f83c81f132bad1c0b118a711bd0932b_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
