<?php

namespace Behance\NBD\Validation\Rules;

/**
 * @group validation
 */
class UrlRuleTest extends \PHPUnit\Framework\TestCase {

  /**
   * @test
   * @dataProvider isValidDataProvider
   */
  public function isValid( $data, $expected ) {

    $rule = new UrlRule();

    $this->assertEquals( $expected, $rule->isValid( $data ) );

  } // isValid


  /**
   * @return array
   */
  public function isValidDataProvider() {

    return [
        // allowed
        [ 'www.google.com', true ],
        [ 'bob@behance.com', true ],
        [ 'mailto:dave@behance.com', true ],
        [ 'http://www.google.com', true ],
        [ 'https://www.google.com', true ],
        [ 'www.google.com?a=1&b=2#fun', true ],
        [ 'www.behance.net/job/Multimedia-Designer%2C-Senior', true ], // testing "%2C"
        // disallowed: protocol relative
        [ '//www.google.com', false ],
        [ '//www.google.co.uk', false ],
        // disallowed: non url encoded
        [ 'www.google.com?b=2|3', false ],
        // disallowed: archaic protocols
        [ 'magnet:www.google.com', false ],
        [ 'magnet://www.google.com', false ],
        [ 'ftp:www.google.com', false ],
        [ 'ftp://www.google.com', false ],
        [ 'wss:www.google.com', false ],
        [ 'wss://www.google.com', false ],
        [ 'ws:www.google.com', false ],
        [ 'ws://www.google.com', false ],
        // disallowed: xss
        [ 'javascript:alert("dave@behance.com")', false ],
        [ 'javascript:alert(1);www.google.com', false ],
        [ 'javascript:alert(1);x=\'@www.google.com\'', false ],
        [ 'javascript:alert(1);x=\'@www.google.com?\'', false ],
        [ ' javascript:alert("dave@behance.com")', false ],
        [ ' javascript:alert(1);www.google.com', false ],
        [ ' javascript:alert(1);x=\'@www.google.com\'', false ],
        [ ' javascript:alert(1);x=\'@www.google.com?\'', false ],
        [ 'java\0script:alert("dave@behance.com")', false ],
        [ 'java\0script:alert(1);www.google.com', false ],
        [ 'java\0script:alert(1);x=\'@www.google.com\'', false ],
        [ 'java\0script:alert(1);x=\'@www.google.com?\'', false ],
        [ 'java&#x0D;script:alert("dave@behance.com")', false ],
        [ 'java&#x0D;script:alert(1);www.google.com', false ],
        [ 'java&#x0D;script:alert(1);x=\'@www.google.com\'', false ],
        [ 'java&#x0D;script:alert(1);x=\'@www.google.com?\'', false ],
        // disallowed: non strings
        [ 123.0e26, false ],
        [ null, false ],
        [ false, false ],
        [ true, false ],
        [ ( new \stdClass() ), false ],
        [ ( function() {} ), false ],
    ];

  } // isValidDataProvider

} // UrlRuleTest
