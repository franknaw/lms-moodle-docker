<?php

class __Mustache_32bc55951d2be25bafc4302fab73b556 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        // 'istrackeduser' section
        $value = $context->find('istrackeduser');
        $buffer .= $this->section549c433ca77bc1890c13a701e259b34b($context, $indent, $value);
        // 'istrackeduser' inverted section
        $value = $context->find('istrackeduser');
        if (empty($value)) {
            
            $buffer .= $indent . '    <span class="badge badge-secondary rounded mb-1" role="listitem">
';
            $buffer .= $indent . '        <span class="font-weight-normal">';
            $value = $this->resolveValue($context->find('description'), $context);
            $buffer .= call_user_func($this->mustache->getEscape(), $value);
            $buffer .= '</span>
';
            $buffer .= $indent . '    </span>
';
        }

        return $buffer;
    }

    private function section9585d79f2064844c36246dac1d81a2a2(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{!
            }}title="{{.}}" {{!
            }}aria-label="{{.}}" {{!
        }}';
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
                
                $buffer .= 'title="';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" ';
                $buffer .= 'aria-label="';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section4ee307b8c48447630945c918a4d275a7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'completion_automatic:done, core_course';
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
                
                $buffer .= 'completion_automatic:done, core_course';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section716b7a77cb2092267d49a47b4bb95655(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <span class="badge badge-success rounded mb-1" role="listitem" {{!
        }}{{#accessibledescription}}{{!
            }}title="{{.}}" {{!
            }}aria-label="{{.}}" {{!
        }}{{/accessibledescription}}>
        <strong>{{#str}}completion_automatic:done, core_course{{/str}}</strong> <span class="font-weight-normal">{{description}}</span>
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
                
                $buffer .= $indent . '    <span class="badge badge-success rounded mb-1" role="listitem" ';
                // 'accessibledescription' section
                $value = $context->find('accessibledescription');
                $buffer .= $this->section9585d79f2064844c36246dac1d81a2a2($context, $indent, $value);
                $buffer .= '>
';
                $buffer .= $indent . '        <strong>';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section4ee307b8c48447630945c918a4d275a7($context, $indent, $value);
                $buffer .= '</strong> <span class="font-weight-normal">';
                $value = $this->resolveValue($context->find('description'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</span>
';
                $buffer .= $indent . '    </span>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC8543523334d2fb6475b6b6e248a6f0f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'completion_automatic:failed, core_course';
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
                
                $buffer .= 'completion_automatic:failed, core_course';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC9561df98558293e3740bf6749e76c46(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <span class="badge badge-danger rounded mb-1" role="listitem" {{!
        }}{{#accessibledescription}}{{!
            }}title="{{.}}" {{!
            }}aria-label="{{.}}" {{!
        }}{{/accessibledescription}}>
        <strong>{{#str}}completion_automatic:failed, core_course{{/str}}</strong> <span class="font-weight-normal">{{description}}</span>
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
                
                $buffer .= $indent . '    <span class="badge badge-danger rounded mb-1" role="listitem" ';
                // 'accessibledescription' section
                $value = $context->find('accessibledescription');
                $buffer .= $this->section9585d79f2064844c36246dac1d81a2a2($context, $indent, $value);
                $buffer .= '>
';
                $buffer .= $indent . '        <strong>';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionC8543523334d2fb6475b6b6e248a6f0f($context, $indent, $value);
                $buffer .= '</strong> <span class="font-weight-normal">';
                $value = $this->resolveValue($context->find('description'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</span>
';
                $buffer .= $indent . '    </span>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section599533857fc3ed42fa4108b4c0e2f019(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'completion_automatic:todo, core_course';
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
                
                $buffer .= 'completion_automatic:todo, core_course';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6dad238c2caf06ee259b4678a19d112d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <span class="badge badge-secondary rounded mb-1" role="listitem" {{!
        }}{{#accessibledescription}}{{!
            }}title="{{.}}" {{!
            }}aria-label="{{.}}" {{!
        }}{{/accessibledescription}}>
        <strong>{{#str}}completion_automatic:todo, core_course{{/str}}</strong> <span class="font-weight-normal">{{description}}</span>
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
                
                $buffer .= $indent . '    <span class="badge badge-secondary rounded mb-1" role="listitem" ';
                // 'accessibledescription' section
                $value = $context->find('accessibledescription');
                $buffer .= $this->section9585d79f2064844c36246dac1d81a2a2($context, $indent, $value);
                $buffer .= '>
';
                $buffer .= $indent . '        <strong>';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section599533857fc3ed42fa4108b4c0e2f019($context, $indent, $value);
                $buffer .= '</strong> <span class="font-weight-normal">';
                $value = $this->resolveValue($context->find('description'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</span>
';
                $buffer .= $indent . '    </span>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section549c433ca77bc1890c13a701e259b34b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    {{#statuscomplete}}
    <span class="badge badge-success rounded mb-1" role="listitem" {{!
        }}{{#accessibledescription}}{{!
            }}title="{{.}}" {{!
            }}aria-label="{{.}}" {{!
        }}{{/accessibledescription}}>
        <strong>{{#str}}completion_automatic:done, core_course{{/str}}</strong> <span class="font-weight-normal">{{description}}</span>
    </span>
    {{/statuscomplete}}
    {{#statuscompletefail}}
    <span class="badge badge-danger rounded mb-1" role="listitem" {{!
        }}{{#accessibledescription}}{{!
            }}title="{{.}}" {{!
            }}aria-label="{{.}}" {{!
        }}{{/accessibledescription}}>
        <strong>{{#str}}completion_automatic:failed, core_course{{/str}}</strong> <span class="font-weight-normal">{{description}}</span>
    </span>
    {{/statuscompletefail}}
    {{#statusincomplete}}
    <span class="badge badge-secondary rounded mb-1" role="listitem" {{!
        }}{{#accessibledescription}}{{!
            }}title="{{.}}" {{!
            }}aria-label="{{.}}" {{!
        }}{{/accessibledescription}}>
        <strong>{{#str}}completion_automatic:todo, core_course{{/str}}</strong> <span class="font-weight-normal">{{description}}</span>
    </span>
    {{/statusincomplete}}
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
                
                // 'statuscomplete' section
                $value = $context->find('statuscomplete');
                $buffer .= $this->section716b7a77cb2092267d49a47b4bb95655($context, $indent, $value);
                // 'statuscompletefail' section
                $value = $context->find('statuscompletefail');
                $buffer .= $this->sectionC9561df98558293e3740bf6749e76c46($context, $indent, $value);
                // 'statusincomplete' section
                $value = $context->find('statusincomplete');
                $buffer .= $this->section6dad238c2caf06ee259b4678a19d112d($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
