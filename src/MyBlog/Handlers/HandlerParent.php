<?php

namespace MyBlog\Handlers;

class HandlerParent
{
    protected function renderTemplate($template, array $template_vars = [])
    {
        extract($template_vars);

        $template_path = TEMPLATES_DIR . '/' . $template;
        include (TEMPLATES_DIR . '/layout.html.php');
    }
}