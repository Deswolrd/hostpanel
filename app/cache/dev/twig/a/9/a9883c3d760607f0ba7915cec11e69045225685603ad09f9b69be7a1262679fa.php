<?php

/* default/index.html.twig */
class __TwigTemplate_a9883c3d760607f0ba7915cec11e69045225685603ad09f9b69be7a1262679fa extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_b402db7b5ed29ce3d3fc985136252fd8d0cbf38797553c4033f639cad9321435 = $this->env->getExtension("native_profiler");
        $__internal_b402db7b5ed29ce3d3fc985136252fd8d0cbf38797553c4033f639cad9321435->enter($__internal_b402db7b5ed29ce3d3fc985136252fd8d0cbf38797553c4033f639cad9321435_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/index.html.twig"));

        // line 1
        echo "﻿<!doctype html>
<html>
<head>
<meta charset=\"utf-8\">
<title>Панель управления сайтами</title>
<script src=\"jquery-ui/external/jquery/jquery.js\"></script>
<script src=\"jquery-ui/jquery-ui.js\"></script>
<link rel=\"stylesheet\" href=\"stylesheet.css\">
<link rel=\"stylesheet\" href=\"jquery-ui/jquery-ui.css\">
<script>
var siteList = [";
        // line 11
        echo (isset($context["xfiles"]) ? $context["xfiles"] : $this->getContext($context, "xfiles"));
        echo "];
</script>
</head>

<body onLoad=\"initiate()\">

<div id=\"header\"><p align=\"right\">Панель управления сайтами</p>
<a href=\"#\" id=\"dialog-link\" class=\"openBtn ui-state-default ui-corner-all\"><span class=\"ui-icon ui-icon-plus\"></span>Создать сайт</a>
<a href=\"#\" id=\"restart\" class=\"openBtn ui-state-default ui-corner-all\"><span class=\"ui-icon ui-icon-clock\"></span>Перезапустить сервер</a>
</div>

<div id=\"content\">

</div>

<div id=\"previewDiv\">
<span id=\"hintSpan\">Добро пожаловать в панель управления сайтами!<br><br>Выберите сайт из списка слева для просмотра или создайте новый с помощью кнопки <b>создать сайт</b></span></span>
<div id=\"previewFrameDiv\" style=\"position:absolute; left: 0px; right: 0px; display:none\">
<iframe id=\"previewFrame\" frameborder=\"0\"></iframe>
</div>
</div>

<div id=\"dialog\" title=\"Создание сайта\">
\t<p>
    <table border=\"0\">
    <tr><td>
    Введите имя сайта:
    </td><td colspan=\"2\">
    <input name=\"sitename\" id=\"sitename\" type=\"text\">
    </td></tr>
    <tr><td>
    Введите имя хоста:
    </td><td colspan=\"2\">
    <input name=\"sitehost\" id=\"sitehost\" type=\"text\">
    </td></tr>
    <tr><td>
    Порт:
    </td><td width=\"100\">
    <input name=\"siteport\" class=\"smallTextInput\" id=\"siteport\" type=\"text\">
    </td><td>
    </td></tr>
    </table>
    </p>
</div>
<script src=\"index.js\"></script>
</body>

</html>";
        
        $__internal_b402db7b5ed29ce3d3fc985136252fd8d0cbf38797553c4033f639cad9321435->leave($__internal_b402db7b5ed29ce3d3fc985136252fd8d0cbf38797553c4033f639cad9321435_prof);

    }

    public function getTemplateName()
    {
        return "default/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 11,  22 => 1,);
    }
}
