<?php
/**
 * @group validation
 */
class NBD_Validation_Rules_ContainedInRuleTest extends \PHPUnit\Framework\TestCase {

  protected $_class = 'Behance\NBD\Validation\Rules\ContainedInRule';

  /**
   * @test
   * @dataProvider isValidDataProvider
   */
  public function isValid( $input, $parameters, $expected_outcome ) {

    $name = $this->_class;
    $rule = new $name();

    $context['parameters'] = $parameters;

    $this->assertEquals( $expected_outcome, $rule->isValid( $input, $context ) );

  } // isValid


  /**
   * @test
   * @expectedException Behance\NBD\Validation\Exceptions\Validator\RuleRequirementException
   */
  public function invalidParameters() {

    $name = $this->_class;
    $rule = new $name();

    $rule->isValid( 123, [] );

  } // invalidParameters


  /**
   * @return array
   */
  public function isValidDataProvider() {

    return [
        [ 'abc', [ 'abc', 'def', 'ghi' ], true ],
        [ 'abc', [ 'def', 'abc', 'ghi' ], true ],
        [ 'abc', [ 'def', 'ghi', 'abc' ], true ],
        [ 'abc', [ 'abc' ], true ],
        [ 'abc', [ 'def', 'ghi' ], false ],
        [ 123, [ 'abc', 'def', 'ghi' ], false ],
        [ 123, [ 123, 'def', 'ghi' ], true ],
        [ 123, [ 'abc', 123, 'ghi' ], true ],
        [ 123, [ 'abc', 'def', 123 ], true ],
        [ [ 123 ], [ 'abc', 'def', 123 ], false ],
        [ new stdClass(), [ 'abc', 'def', 'ghi' ], false ],
        [ ( function() {} ), [ 'abc', 'def', 'ghi' ], false ],
    ];

  } // isValidDataProvider

} // NBD_Validation_Rules_ContainedInRuleTest
