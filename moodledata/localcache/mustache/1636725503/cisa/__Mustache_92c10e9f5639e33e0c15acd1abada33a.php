<?php

class __Mustache_92c10e9f5639e33e0c15acd1abada33a extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<nav class="fixed-top navbar navbar-light bg-white navbar-expand moodle-has-zindex" aria-label="';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section56921b827c2b8b95c7f96896948f473a($context, $indent, $value);
        $buffer .= '">
';
        $buffer .= $indent . '
';
        // 'output.should_display_navbar_logo' section
        $value = $context->findDot('output.should_display_navbar_logo');
        $buffer .= $this->sectionCe55e522206f5e4331e86e7dbc9d6725($context, $indent, $value);
        $buffer .= $indent . '        <span class="site-name d-none d-md-inline">';
        $value = $this->resolveValue($context->find('sitename'), $context);
        $buffer .= $value;
        $buffer .= '</span>
';
        $buffer .= $indent . '
';
        // 'output.secure_layout_language_menu' section
        $value = $context->findDot('output.secure_layout_language_menu');
        $buffer .= $this->section3384d02e4e904e66a53da767a2266876($context, $indent, $value);
        // 'output.secure_layout_login_info' section
        $value = $context->findDot('output.secure_layout_login_info');
        $buffer .= $this->sectionAaec208d900134c81498e98395890521($context, $indent, $value);
        $buffer .= $indent . '</nav>
';

        return $buffer;
    }

    private function section56921b827c2b8b95c7f96896948f473a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'navigation';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'navigation';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionCe55e522206f5e4331e86e7dbc9d6725(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <span class="logo d-none d-sm-inline">
                <img src="{{output.get_compact_logo_url}}" alt="{{sitename}}">
            </span>
        ';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '            <span class="logo d-none d-sm-inline">
';
                $buffer .= $indent . '                <img src="';
                $value = $this->resolveValue($context->findDot('output.get_compact_logo_url'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" alt="';
                $value = $this->resolveValue($context->find('sitename'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                $buffer .= $indent . '            </span>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section3384d02e4e904e66a53da767a2266876(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <ul class="navbar-nav d-none d-md-flex">
            <!-- language_menu -->
            {{{ . }}}
        </ul>
        ';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        <ul class="navbar-nav d-none d-md-flex">
';
                $buffer .= $indent . '            <!-- language_menu -->
';
                $buffer .= $indent . '            ';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= $value;
                $buffer .= '
';
                $buffer .= $indent . '        </ul>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionAaec208d900134c81498e98395890521(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <div class="ml-auto">
            {{{ . }}}
        </div>
        ';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        <div class="ml-auto">
';
                $buffer .= $indent . '            ';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= $value;
                $buffer .= '
';
                $buffer .= $indent . '        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
