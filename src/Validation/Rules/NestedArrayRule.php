<?php

namespace Behance\NBD\Validation\Rules;

use Behance\NBD\Validation;

/**
 * Not to be confused with the callback mechanism the rules are extending, this validator
 * will statically call a parameterized class, method name as the validation
 */
class NestedArrayRule extends Validation\Abstracts\CallbackRuleAbstract {

  /**
   * {@inheritDoc}
   */
  public function __construct() {

    $closure = ( function( $data ) {
      return is_array( $data );
    } );

    $this->setClosure( $closure );

  } // __construct

} // NestedArrayRule
