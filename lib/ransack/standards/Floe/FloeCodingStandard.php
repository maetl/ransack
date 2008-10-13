<?php
/**
 * Floe Coding Standard.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    maetl <maetl@coretxt.net.nz>
 * @license   MIT License
 * @version   CVS: $Id: coding-standard-tutorial.xml,v 1.7 2008/07/07 06:37:28 squiz Exp $
 * @link      http://code.google.com/p/floe/
 */

if (class_exists('PHP_CodeSniffer_Standards_CodingStandard', true) === false) {
    throw new PHP_CodeSniffer_Exception('Class PHP_CodeSniffer_Standards_CodingStandard not found');
}

/**
 * MyStandard Coding Standard.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    maetl <maetl@coretxt.net.nz>
 * @license   MIT License
 * @version   Release: @package_version@
 * @link      http://code.google.com/p/floe/
 */
class PHP_CodeSniffer_Standards_Floe_FloeCodingStandard extends PHP_CodeSniffer_Standards_CodingStandard
{

	/**
	 * Return a list of external sniffs to include with this standard.
	 *
	 * @return array
	 */
	public function getIncludedSniffs() {
	    return array(
				'Generic/Sniffs/Metrics/NestingLevelSniff.php',
	            'Generic/Sniffs/Functions/OpeningFunctionBraceKernighanRitchieSniff.php',
				'Generic/Sniffs/Formatting/NoSpaceAfterCastSniff.php',
				'PEAR/Sniffs/Functions/FunctionCallArgumentSpacingSniff.php',
				'Squiz/Sniffs/WhiteSpace/OperatorSpacingSniff.php',
				//'Squiz/Sniffs/NamingConventions/ValidFunctionNameSniff.php'
				//'Squiz/Sniffs/WhiteSpace/SuperfluousWhitespaceSniff.php',
				//'Squiz/Sniffs/NamingConventions/ValidVariableNameSniff.php'
	           );

	}//end getIncludedSniffs()


}//end class
?>