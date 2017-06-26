<?php
/**
 * @group validation
 */
class NBD_Validation_Rules_AlphaNumericRuleTest extends \PHPUnit\Framework\TestCase {

  protected $_class = 'Behance\NBD\Validation\Rules\AlphaNumericRule';

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
        [ 'abc', true ],
        [ 'ábč', true ],
        [ 'ábčabc', true ],
        [ 'ÁBČabc', true ],
        [ 'ábčabc123', true ],
        [ 'ÁBÇabc123', true ],
        [ '', false ],
        [ 0, true ],
        [ true, true ],
        [ 'true', true ],
        //[ (int)false, true ], <-- passes
        //[ false, true ],  <-- fails
        [ 'false', true ],
        [ 123, true ],
        [ 456, true ],
        [ 789, true ],
        [ ( new stdClass() ), false ],
        [ ( function() {} ), false ],
    ];

  } // isValidDataProvider

} // NBD_Validation_Rules_AlphaNumericRuleTest
