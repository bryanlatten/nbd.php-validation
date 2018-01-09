<?php

namespace Behance\NBD\Validation\Rules;

use Behance\NBD\Validation\Abstracts\RegexRuleAbstract;

/**
 * Represents the container of a rule to be "run"
 */
class EmailRule extends RegexRuleAbstract {

  /**
   * @link https://stackoverflow.com/questions/2049502/what-characters-are-allowed-in-an-email-address
   */
  protected $_pattern = "/^[A-Za-z0-9_.%'!#$&*\/=?^`{}|~\+-]+@[A-Za-z0-9_\.-]+\.[A-Za-z0-9_-]+$/u";

} // EmailRule
