<?php
/**
 * File containing the ezcTemplateEqualOperatorTstNode class
 *
 * @package Template
 * @version //autogen//
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
/**
 * Operator for comparing two values using PHPs ==.
 *
 * @package Template
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 * @version //autogen//
 */
class ezcTemplateEqualOperatorTstNode extends ezcTemplateOperatorTstNode
{
    /**
     * Initialise operator with source and cursor positions.
     *
     * @param ezcTemplateSource $source
     * @param ezcTemplateCursor $start
     * @param ezcTemplateCursor $end
     */
    public function __construct( ezcTemplateSourceCode $source, /*ezcTemplateCursor*/ $start, /*ezcTemplateCursor*/ $end )
    {
        parent::__construct( $source, $start, $end,
                             5, 4, self::NON_ASSOCIATIVE,
                             '==' );
    }
}
?>
