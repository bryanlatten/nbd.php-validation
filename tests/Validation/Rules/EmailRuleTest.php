<?php

namespace Behance\NBD\Validation\Rules;

/**
 * @group validation
 */
class EmailRuleTest extends \PHPUnit\Framework\TestCase {

  /**
   * @test
   * @dataProvider isValidDataProvider
   */
  public function isValid( $data, $expected ) {

    $rule = new EmailRule();

    $this->assertEquals( $expected, $rule->isValid( $data ) );

  } // isValid


  /**
   * @return array
   */
  public function isValidDataProvider() {

    return [
        [ 'bob@behance.com', true ],
        [ 'bob$a@behance.com', true ],
        [ 'bob\'a@behance.com', true ],
        [ 'mark\'dunphy..246!#$%&*+-/=?^_`{|}~@adobe.behance.net', true ],
        [ 'bob"a@behance.com', false ],
        [ 'bob.goodness@behance.com', true ],
        [ 'bob@behance.co.uk', true ],
        [ 'bob+abc@behance.com', true ],
        [ 'bob\0@behance.com', false ],
        [ 'bob!@behance.com', true ],
        [ 'string', false ],
        [ 'javascript:test@behance.com', false ],
        [ 123.0e26, false ],
        [ null, false ],
        [ false, false ],
        [ true, false ],
        [ ( new \stdClass() ), false ],
        [ ( function() {} ), false ],
    ];

  } // isValidDataProvider

} // EmailRuleTest
