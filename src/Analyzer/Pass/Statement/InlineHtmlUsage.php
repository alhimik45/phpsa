<?php

namespace PHPSA\Analyzer\Pass\Statement;

use PhpParser\Node\Stmt;
use PhpParser\Node;
use PHPSA\Analyzer\Pass;
use PHPSA\Context;

class InlineHtmlUsage implements Pass\AnalyzerPassInterface
{
    /**
     * @param Stmt\InlineHTML $stmt
     * @param Context $context
     * @return bool
     */
    public function pass(Stmt\InlineHTML $stmt, Context $context)
    {
        $context->notice('inline_html_usage', 'Do not use inline HTML', $stmt);

        return true;
    }

    /**
     * @return array
     */
    public function getRegister()
    {
        return [
            Stmt\InlineHTML::class,
        ];
    }
}
