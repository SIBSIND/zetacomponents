<?php
/**
 * File containing the ezcConsoleParameter class.
 *
 * @package ConsoleTools
 * @version //autogen//
 * @copyright Copyright (C) 2005 eZ systems as. All rights reserved.
 * @license LGPL {@link http://www.gnu.org/copyleft/lesser.html}
 */

/**
 * Class for handling console parameters.
 * This class allows the complete handling of parameters submitted
 * to a console based application.
 * 
 * @package ConsoleTools
 * @version //autogen//
 * @copyright Copyright (C) 2005 eZ systems as. All rights reserved.
 * @license LGPL {@link http://www.gnu.org/copyleft/lesser.html}
 */
class ezcConsoleParameter
{

    const TYPE_NONE     = 10;
    const TYPE_INT      = 11;
    const TYPE_STRING   = 12;

    private $paramDefs = array();

    private $paramValues = array();

    /**
     * Create
     *
     * @var array(string)
     * @var array(string)
     *
     * @todo No settings/options so far. Are there any??
     */
    public function __construct( $settings, $options = array() ) {
        
    }

    /**
     * Register a new parameter.
     * Register a new parameter to be recognized by the parser. The short option 
     * is a single character, the long option can be any string containing
     * [a-z-]+. Via the options array several options can be defined for a parameter:
     *
     * <code>
     * array(
     *  'type'      => TYPE_NONE,       // option does not expect a value by default, use TYPE_* constants
     *  'default'   => null,            // no default value by default
     *  'short'     => '',             // no short description by default
     *  'long'      => '',              // no help text by default
     *  'depends'   => array(),         // no depending options by default
     *  'excludes'  => array(),         // no excluded options by default
     * );
     * </code>
     *
     * Attention: Already existing parameter will be overwriten! If an already existing alias is
     * attempted to be registered, the alias will be deleted and replaced by the new
     * parameter.
     *
     * @see ezcConsoleParameter::unregisterParam()
     *
     * @param string Short parameter (e.g. 'o'/'a'/'h'), will be '-o'/'-a'/'-h'.
     * @param string Long version of parameter (e.g. 'my-param'), will be '--my-param'.
     * @param array(string) See description.
     *
     * @return void
     */
    public function registerParam( $short, $long, $options = array() ) {
        
    }

    /**
     * Register an alias to a parameter.
     * Registers a new alias for an existing parameter. Aliases may
     * then be used as if they were real parameters.
     *
     * @see ezcConsoleParameter::unregisterAlias()
     *
     * @param string Shortcut of the alias
     * @param string Long version of the alias
     * @param strung Reference to an existing param
     *
     * @return void
     */
    public function registerAlias( $short, $long, $refShort ) {
        
    }

    /**
     * Remove a parameter to be no more supported.
     * Using this function you will remove a parameter. Depending on the second option
     * Dependencies to this parameter are handled. Per default, just all dependencies
     * to that actual parameter are removed (false value). Setting it to true
     * will completely unregister all parameters that depend on the current one.
     *
     * @see ezcConsoleParameter::registerParam()
     *
     * @param string Short option name for the parameter to be removed.
     * @param bool Handling of dependencies while unregistering. See description!
     *
     * @return void
     *
     * @throws ezcConsoleParameterException If requesting a nonexistant parameter {@see ezcConsoleParameterException::CODE_EXISTANCE}.
     */
    public function unregisterParam( $short, $deps = false ) {
        
    }
    
    /**
     * Remove an alias  to be no more supported.
     * Unregisteres an existing alias.
     *
     * @see ezcConsoleParameter::registerAlias()
     * 
     * @param string Short option name for the parameter to be removed.
     * @param bool Handling of dependencies while unregistering. See description!
     *
     * @return void
     *
     * @throws ezcConsoleParameterException If requesting a nonexistant alias {@see ezcConsoleParameterException::CODE_EXISTANCE}.
     */
    public function unregisterAlias( $short ) {
        
    }

    /**
     * Process the input parameters.
     * Actually process the input parameters according to the actual settings.
     * 
     * Per default this method uses $argc and $argv for processing. You can 
     * override this setting with your own input, if necessary, using the
     * parameters of this method. (Attention, first argument is always the pro
     * gram name itself!)
     *
     * All exceptions thrown by this method contain an additional attribute "param"
     * which specifies the parameter on which the error occured.
     * 
     * @param int Number of arguments
     * @param array(int -> string) The arguments
     *
     * @throws ezcConsoleParameterDependecyException If dependencies are unmet {@see ezcConsoleParameterException::CODE_DEPENDENCY}.
     * @throws ezcConsoleParameterExclusionException If exclusion rules are unmet {@see ezcConsoleParameterException::CODE_EXCLUSION}.
     * @throws ezcConsoleParameterTypeException If type rules are unmet {@see ezcConsoleParameterException::CODE_TYPE}.
     * 
     * @see ezcConsoleParameterException
     */ 
    public function processParams( $args = null, $argNum = null ) {
        
    }
    
    /**
     * Receive the data for a specific parameter.
     * Returns the data sumbitted for a specific parameter.
     *
     * @param string The parameter shortcut
     * @return mixed String value of the parameter or false if not set.
     *
     * @throws ezcConsoleParameterException If requesting a nonexistant parameter {@see ezcConsoleParameterException::CODE_EXISTANCE}.
     */
    public function getParam( $short ) {
        
    }

    /**
     * Receive help info on parameters.
     * If given a parameter shortcut, returns an array of several help information:
     *
     * <code>
     * array(
     *  'short' => <string>,
     *  'long'  => <string>,
     *  'usage' => <string>, // Autogenerated from the rules set for the parameter
     *  'alias' => <string>, // Info on the aliases of a parameter
     * );
     * </code>
     *
     * If no parameter shortcut given, returns an array of above described arrays
     * with a key for every parameter shortcut defined.
     * 
     * @param string Short cut value of the parameter.
     * @return array(string) See description.
     * 
     * @throws ezcConsoleParameterException If requesting a nonexistant parameter {@see ezcConsoleParameterException::CODE_EXISTANCE}.
     */
    public function getHelp( $short = null ) {

    }
}
