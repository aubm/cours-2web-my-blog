<?php

namespace MyBlog\Handlers;

class HandlerParent
{
    protected function renderTemplate($template, array $template_vars = [])
    {
        extract($template_vars);
        include (TEMPLATES_DIR . '/' . $template);
    }
}