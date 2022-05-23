<?php

class __Mustache_dcac6dc0f2c89b2d54ec3fedd9f455d8 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class="progress active" style="height: 25px; width: ';
        // 'width' section
        $value = $context->find('width');
        $buffer .= $this->sectionFcf75ec27eda417cbef7a5637c10d802($context, $indent, $value);
        // 'width' inverted section
        $value = $context->find('width');
        if (empty($value)) {
            
            $buffer .= '500';
        }
        $buffer .= 'px;">
';
        $buffer .= $indent . '    <div id="';
        $value = $this->resolveValue($context->find('backupid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '_bar"
';
        $buffer .= $indent . '         class="progress-bar progress-bar-striped progress-bar-animated"
';
        $buffer .= $indent . '         style="width: 100%"
';
        $buffer .= $indent . '         role="progressbar"
';
        $buffer .= $indent . '         aria-valuemin="0"
';
        $buffer .= $indent . '         aria-valuemax="100"
';
        $buffer .= $indent . '         aria-valuenow="0"
';
        $buffer .= $indent . '         ';
        // 'operation' section
        $value = $context->find('operation');
        $buffer .= $this->sectionC62c17ee99ce974edf70d3a39c9ce92c($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '         ';
        // 'backupid' section
        $value = $context->find('backupid');
        $buffer .= $this->section7f866747faf16811f40ac009be6578d5($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '         ';
        // 'restoreid' section
        $value = $context->find('restoreid');
        $buffer .= $this->sectionF41b6a868fd7e41788a3e855570604ae($context, $indent, $value);
        $buffer .= '>
';
        $buffer .= $indent . '        ';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->sectionBc20d725dfa8026fd2b1e92402a983d5($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function sectionFcf75ec27eda417cbef7a5637c10d802(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{width}}';
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
                
                $value = $this->resolveValue($context->find('width'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC62c17ee99ce974edf70d3a39c9ce92c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'data-operation="{{operation}}"';
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
                
                $buffer .= 'data-operation="';
                $value = $this->resolveValue($context->find('operation'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '"';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section7f866747faf16811f40ac009be6578d5(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'data-backupid="{{backupid}}"';
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
                
                $buffer .= 'data-backupid="';
                $value = $this->resolveValue($context->find('backupid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '"';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionF41b6a868fd7e41788a3e855570604ae(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'data-restoreid="{{restoreid}}"';
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
                
                $buffer .= 'data-restoreid="';
                $value = $this->resolveValue($context->find('restoreid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '"';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionBc20d725dfa8026fd2b1e92402a983d5(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' asyncprocesspending, backup ';
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
                
                $buffer .= ' asyncprocesspending, backup ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
