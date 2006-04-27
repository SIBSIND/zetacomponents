<?php
/**
 * File containing the ezcTemplateAstNodeGenerator class
 *
 * @package Template
 * @version //autogen//
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 * @access private
 */
/**
 * Iterates the AST tree and outputs the result as text.
 *
 * Implements the ezcTemplateTstNodeVisitor interface for visiting the nodes
 * and generating the appropriate ast nodes for them.
 *
 * @package Template
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 * @version //autogen//
 * @access private
 */
class ezcTemplateAstTreeOutput extends ezcTemplateTreeOutput implements ezcTemplateAstNodeVisitor
{
    /**
     * Initialize with correct node class name and regex for extraction.
     * The extraction will remove the prefix <i>ezcTemplate</i> and the suffix
     * <i>AstNode</i>.
     */
    public function __construct()
    {
        parent::__construct( 'ezcTemplateAstNode', "#^ezcTemplate(.+)AstNode#" );
    }

    /**
     * Convenience function for outputting a node.
     * Instantiates the ezcTemplateAstTreeOutput class and calls accept() on
     * $node, the resulting text is returned.
     *
     * @param ezcTemplateAstNode $node
     * @return string
     */
    static public function output( ezcTemplateAstNode $node )
    {
        $treeOutput = new ezcTemplateAstTreeOutput();
        $node->accept( $treeOutput );
        return $treeOutput->text . "\n";
    }

    public function visitLiteralAstNode( ezcTemplateLiteralAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitConstantAstNode( ezcTemplateConstantAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitEolCommentAstNode( ezcTemplateEolCommentAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitBlockCommentAstNode( ezcTemplateBlockCommentAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitVariableAstNode( ezcTemplateVariableAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitDynamicVariableAstNode( ezcTemplateDynamicVariableAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitDynamicStringAstNode( ezcTemplateDynamicStringAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitArrayFetchOperatorAstNode( ezcTemplateArrayFetchOperatorAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitUnaryOperatorAstNode( ezcTemplateOperatorAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitBinaryOperatorAstNode( ezcTemplateOperatorAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitFunctionCallAstNode( ezcTemplateFunctionCallAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitDynamicFunctionCallAstNode( ezcTemplateDynamicFunctionCallAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitBodyAstNode( ezcTemplateBodyAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitGenericStatementAstNode( ezcTemplateGenericStatementAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitIfAstNode( ezcTemplateIfAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitWhileAstNode( ezcTemplateWhileAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitDoWhileAstNode( ezcTemplateDoWhileAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitForAstNode( ezcTemplateForAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitForeachAstNode( ezcTemplateForeachAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitBreakAstNode( ezcTemplateBreakAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitContinueAstNode( ezcTemplateContinueAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitReturnAstNode( ezcTemplateReturnAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitRequireAstNode( ezcTemplateRequireAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitRequireOnceAstNode( ezcTemplateRequireOnceAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitIncludeAstNode( ezcTemplateIncludeAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitIncludeOnceAstNode( ezcTemplateIncludeOnceAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitSwitchAstNode( ezcTemplateSwitchAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitCaseAstNode( ezcTemplateCaseAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitDefaultAstNode( ezcTemplateDefaultAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitConditionBodyAstNode( ezcTemplateConditionBodyAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitOutputAstNode( ezcTemplateOutputAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitTryAstNode( ezcTemplateTryAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitCatchAstNode( ezcTemplateCatchAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitEchoAstNode( ezcTemplateEchoAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitPrintAstNode( ezcTemplatePrintAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitIssetAstNode( ezcTemplateIssetAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitUnsetAstNode( ezcTemplateUnsetAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitEmptyAstNode( ezcTemplateEmptyAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitParenthesisAstNode( ezcTemplateParenthesisAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitCurlyBracesAstNode( ezcTemplateCurlyBracesAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitTypeCastAstNode( ezcTemplateTypeCastAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    public function visitNopAstNode( ezcTemplateNopAstNode $node )
    {
        $this->text .= $this->outputNode( $node );
    }

    /**
     * Extracts position data from the specified node and set in the out parameters.
     * Ast nodes has no position so it always returns false.
     *
     * @param Object $node The node to examine.
     * @param int    $startLine   The starting line for the node.
     * @param int    $startColumn The starting column for the node.
     * @param int    $endLine     The starting line for the node.
     * @param int    $endColumn   The starting column for the node.
     * @return bool True if the extraction was succesful.
     */
    protected function extractNodePosition( $node, &$startLine, &$startColumn, &$endLine, &$endColumn )
    {
        return false;
    }

    /**
     * Extracts the properties from the specified node and returns it as an array.
     * The properties are taken using get_object_vars().
     *
     * @param Object $node The node to examine.
     * @return array(name=>value)
     */
    protected function extractNodeProperties( $node )
    {
        return get_object_vars( $node );
    }
}
?>
