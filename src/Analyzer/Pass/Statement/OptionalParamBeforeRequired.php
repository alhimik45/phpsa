<?php

/**
 * @author Medvedev Alexandr https://github.com/lexty <alexandr.mdr@gmail.com>
 */
namespace PHPSA\Analyzer\Pass\Statement;

use PhpParser\Node\Stmt;
use PHPSA\Analyzer\Pass;
use PHPSA\Context;

class OptionalParamBeforeRequired implements Pass\AnalyzerPassInterface
{
    /**
     * @param Stmt $func
     * @param Context $context
     * @return bool
     */
    public function pass(Stmt $func, Context $context)
    {
        $prevIsOptional = false;
        foreach ($func->getParams() as $param) {
            if ($prevIsOptional && $param->default === null) {
                $context->notice('optional-param-before-required', 'Optional parameter before required one is always required.', $func);
                return true;
            }
            $prevIsOptional = $param->default !== null;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getRegister()
    {
        return [
            Stmt\Function_::class,
            Stmt\ClassMethod::class,
        ];
    }
}
