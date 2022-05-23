<?php

class __Mustache_db0a9f3941c2bcf4500a1ca298ea26d8 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        // 'hasvalue' section
        $value = $context->find('hasvalue');
        $buffer .= $this->sectionC6ba5ebd11ca2ac83617d2aebf93ab2a($context, $indent, $value);

        return $buffer;
    }

    private function sectionC6ba5ebd11ca2ac83617d2aebf93ab2a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div class="customfield customfield_{{type}} customfield_{{shortname}}">
        <span class="customfieldname">{{{name}}}</span><span class="customfieldseparator">: </span><span class="customfieldvalue">{{{value}}}</span>
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
                
                $buffer .= $indent . '    <div class="customfield customfield_';
                $value = $this->resolveValue($context->find('type'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ' customfield_';
                $value = $this->resolveValue($context->find('shortname'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                $buffer .= $indent . '        <span class="customfieldname">';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= $value;
                $buffer .= '</span><span class="customfieldseparator">: </span><span class="customfieldvalue">';
                $value = $this->resolveValue($context->find('value'), $context);
                $buffer .= $value;
                $buffer .= '</span>
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
