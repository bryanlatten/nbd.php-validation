<?php

namespace Behance\NBD\Validation\Rules;

use Behance\NBD\Validation\Abstracts\RegexRuleAbstract;

/**
 * Represents the container of a rule to be "run"
 */
class UrlRule extends RegexRuleAbstract {

  protected $_pattern = '/^((?:https?):\/\/)?(?:(?:(?:[\w\.\-\+!$&\'\(\)*\+,;=_]|%[0-9a-f]{2})+:)*(?:[\w\.\-\+%!$&\'\(\)*\+,;=_]|%[0-9a-f]{2})+@)?(?:[A-Za-z0-9\x{00A1}-\x{FFFF}_\-]+\.)(?:[A-Za-z0-9\x{00A1}-\x{FFFF}_\-\.])+(?::[0-9]+)?(?:[\/|\?](?:[\w#!:\.\?\+=&@$\'~*,;_\/\(\)\[\]\-]|%[0-9a-f]{2})*)?$/ui';

  /**
   * @inheritDoc
   */
  public function isValid( $data, array $context = null ) {

    if ( !parent::isValid( $data, $context ) ) {
      return false;
    }

    return in_array( parse_url( $data, PHP_URL_SCHEME ), [ '', 'http', 'https', 'mailto' ] );

  } // isValid

} // UrlRule
