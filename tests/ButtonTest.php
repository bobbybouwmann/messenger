<?php

use Bobbybouwmann\Messenger\Button;
use Bobbybouwmann\Messenger\Exceptions\ButtonTypeException;

class ButtonTest extends TestCase
{
    /**
     * @var Button
     */
    protected $button;

    function setUp()
    {
        parent::setUp();

        $this->button = new Button();
    }

    /** @test */
    function it_creates_a_web_url_button()
    {
        $actual = $this->button->build('Button', 'web_url', 'https://google.com');
        $expected = [
            'type'  => 'web_url',
            'title' => 'Button',
            'url'   => 'https://google.com',
        ];

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    function it_creates_a_postback_button()
    {
        $actual = $this->button->build('Button', 'postback', 'postback');
        $expected = [
            'type'    => 'postback',
            'title'   => 'Button',
            'payload' => 'postback',
        ];

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    function it_throws_an_exception_for_unsupported_button_types()
    {
        $this->expectException(ButtonTypeException::class);

        $this->button->build('Button', 'unsupported_type', '');
    }
}