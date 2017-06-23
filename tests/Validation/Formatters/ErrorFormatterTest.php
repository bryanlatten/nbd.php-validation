<?php

use Behance\NBD\Validation\Formatters;
use Behance\NBD\Validation\Rules;

/**
 * @group validation
 */
class NBD_Validation_Formatters_ErrorFormattersTest extends \PHPUnit\Framework\TestCase {

  private $_rule;

  protected function setUp() {

    $this->_rule = new Rules\IntegerRule();

  } // setUp

  /**
   * @test
   */
  public function getterSetter() {

    $context = [ 'abc' => 123 ];
    $class   = new Formatters\ErrorFormatter( $this->_rule, $context );

    $this->assertSame( $this->_rule, $class->getRule() );
    $this->assertEquals( $context, $class->getContext() );

  } // getterSetter


  /**
   * @test
   * @dataProvider renderProvider
   */
  public function renderContext( $template, array $context, $rendered, $constructor_context ) {

    $this->_rule->setErrorTemplate( $template );

    $params = [ $this->_rule ];

    if ( $constructor_context && !empty( $context ) ) {
      $params[] = $context;
    }

    $class = new Formatters\ErrorFormatter( $this->_rule, $context );

    if ( $constructor_context ) {
      $this->assertEquals( $rendered, $class->render() );
    }
    else {
      $this->assertEquals( $rendered, $class->render( $context ) );
    }

  } // renderContext


  /**
   * @test
   */
  public function renderContextOverrides() {

    $value0 = Formatters\ErrorFormatter::FIELDNAME_DEFAULT;
    $value1 = 'value1';
    $value2 = 'value2';

    $constructor_context = [ 'fieldname' => $value1 ];
    $render_context      = [ 'fieldname' => $value2 ];

    $template  = '%fieldname% had a problem';

    $rendered0 = "{$value0} had a problem";
    $rendered1 = "{$value1} had a problem";
    $rendered2 = "{$value2} had a problem";

    $this->_rule->setErrorTemplate( $template );

    $default = new Formatters\ErrorFormatter( $this->_rule );
    $class   = new Formatters\ErrorFormatter( $this->_rule, $constructor_context );

    // Default context takes precedence
    $this->assertEquals( $rendered0, $default->render() );

    // Constructor context takes precendence
    $this->assertEquals( $rendered1, $class->render() );

    // Render context takes precedence
    $this->assertEquals( $rendered2, $class->render( $render_context ) );

  } // renderContextOverrides


  /**
   * @return array
   */
  public function renderProvider() {

    $key     = 'abc';
    $value   = 'anything';

    $message = "This is a message about %key% with %value%";
    $partial = "This is a message about {$key} with %value%";
    $full    = "This is a message about {$key} with {$value}";

    return [
        'Unrendered'     => [ $message, [], $message, false ],
        'Unrendered'     => [ $message, [], $message, true ],
        'Partial render' => [ $message, [ 'key' => $key ], $partial, true ],
        'Partial render' => [ $message, [ 'key' => $key ], $partial, true ],
        'Full render'    => [ $message, [ 'key' => $key, 'value' => $value ], $full, false ],
        'Full render'    => [ $message, [ 'key' => $key, 'value' => $value ], $full, true ],
        'Full render with non-string' => [ $message, [ 'key' => $key, 'value' => $value, 'object' => ( function() {} ) ], $full, true ],
    ];

  } // renderProvider

} // NBD_Validation_Formatters_ErrorFormattersTest
