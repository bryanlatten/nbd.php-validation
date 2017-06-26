<?php

class NBD_Validation_Rules_PositiveIntegerRuleTest extends \PHPUnit\Framework\TestCase {

  /**
   * @test
   * @dataProvider isValidDataProvider
   */
  public function isValid( $data, $expected ) {

    $rule = new \Behance\NBD\Validation\Rules\PositiveIntegerRule();

    $this->assertEquals( $expected, $rule->isValid( $data ) );

  } // isValid

  /**
   * @return array
   */
  public function isValidDataProvider() {

    return [
        [ 1, true ],
        [ -1, false ],
        [ 10000, true ],
        [ PHP_INT_MAX, true ],
        [ -PHP_INT_MAX, false ],
        [ -10000, false ],
        [ 0, false ],
        [ "0", false ],
        [ "1", true ],
        [ "-", false ],
        [ 1.01, false ],
        [ -1.01, false ],
        [ "1.0", false ],
        [ "-1.0", false ],
        [ 1.43e26, false ],
        [ 1.0e26, false ],
        [ "1.43e26", false ],
        [ 'false', false ],
        [ 'true', false ],
        [ false, false ],
        [ true, false ],
        [ null, false ],
    ];

  } // isValidDataProvider

} // NBD_Validation_Rules_PositiveIntegerRuleTest
