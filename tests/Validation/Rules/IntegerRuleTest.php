<?php
/**
 * @group validation
 */
class NBD_Validation_Rules_IntegerRuleTest extends \PHPUnit\Framework\TestCase {

  protected $_class = 'Behance\NBD\Validation\Rules\IntegerRule';

  /**
   * @test
   * @dataProvider isValidDataProvider
   */
  public function isValid( $data, $expected ) {

    $name = $this->_class;
    $rule = new $name();

    $this->assertEquals( $expected, $rule->isValid( $data ) );

  } // isValid


  /**
   * @return array
   */
  public function isValidDataProvider() {

    return [
        [ 1, true ],
        [ -1, true ],
        [ 10000, true ],
        [ PHP_INT_MAX, true ],
        [ -PHP_INT_MAX, true ],
        [ -10000, true ],
        [ 0, true ],
        [ "0", true ],
        [ "1", true ],
        [ "-", false ],
        [ 1.01, false ],
        [ -1.01, false ],
        [ "1.0", false ],
        [ "-1.0", false ],
        [ 1.43e26, false ],
        [ "1.43e26", false ],
        [ 'false', false ],
        [ 'true', false ]
    ];

  } // isValidDataProvider

} // NBD_Validation_Rules_IntegerRuleTest
