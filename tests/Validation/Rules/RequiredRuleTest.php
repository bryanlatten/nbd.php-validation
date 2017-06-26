<?php
/**
 * @group validation
 */
class NBD_Validation_Rules_RequiredRuleTest extends \PHPUnit\Framework\TestCase {

  protected $_class = 'Behance\NBD\Validation\Rules\RequiredRule';

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
        [ '', true ],
        [ 0, true ],
        [ true, true ],
        [ 'true', true ],
        [ false, true ],
        [ 'false', true ],
        [ 123, true ],
        [ ( new stdClass() ), true ],
        [ ( function() {} ), true ],
        [ null, false ],
    ];

  } // isValidDataProvider

} // NBD_Validation_Rules_RequiredRuleTest
