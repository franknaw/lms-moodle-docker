<?php

class __Mustache_c9c46fcf9b881115222c27e03cdf5f48 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '<h2>';
        $value = $this->resolveValue($context->find('title'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</h2>
';
        $buffer .= $indent . '    <p>';
        $value = $this->resolveValue($context->find('message'), $context);
        $buffer .= $value;
        $buffer .= '</p>
';
        $buffer .= $indent . '<h3>';
        $value = $this->resolveValue($context->find('ipinformation'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</h3>
';
        $buffer .= $indent . '    <p>';
        $value = $this->resolveValue($context->find('ip'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</p>
';
        $buffer .= $indent . '    <p>';
        $value = $this->resolveValue($context->find('geoinfo'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</p>
';
        $buffer .= $indent . '<h3>';
        $value = $this->resolveValue($context->find('uadescription'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</h3>
';
        $buffer .= $indent . '    <p>';
        $value = $this->resolveValue($context->find('ua'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</p>
';
        $buffer .= $indent . '    <p>';
        $value = $this->resolveValue($context->find('linkstring'), $context);
        $buffer .= $value;
        $buffer .= '</p>
';

        return $buffer;
    }
}
