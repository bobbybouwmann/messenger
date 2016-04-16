<?php

use Bobbybouwmann\Messenger\Message;

class MessageTest extends TestCase
{
    /**
     * @var Message
     */
    protected $message;

    public function setUp()
    {
        parent::setUp();

        $this->message = new Message('Some title');
    }

    /** @test */
    function it_build_a_message_for_only_a_title()
    {
        $message = new Message('Some title');

        $actual = $message->buildTextMessage();
        $expected = ['text' => 'Some title'];

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    function it_creates_a_message_with_title_through_chaining()
    {
        $message = (new Message())->title('Some title');

        $actual = $message->buildTextMessage();
        $expected = ['text' => 'Some title'];

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    function it_throws_an_exception_if_the_type_does_not_exists()
    {
        $this->expectException(Exception::class);

        $this->message->button('Button', 'non_existing_type', 'https://google.com');
    }

    /** @test */
    function it_creates_a_message_with_one_web_url_button()
    {
        $this->message->button('Button', 'web_url', 'https://google.com');

        $property = $this->getProtectedProperty(Message::class, 'buttons');
        $buttons = $property->getValue($this->message);

        $this->assertCount(1, $buttons);
    }

    /** @test */
    function it_creates_a_message_with_a_postback_button()
    {
        $this->message->button('Button', 'postback', 'postback');

        $property = $this->getProtectedProperty(Message::class, 'buttons');
        $buttons = $property->getValue($this->message);

        $this->assertCount(1, $buttons);
    }

    /** @test */
    function it_creates_a_message_with_mulitple_buttons()
    {
        $data = [
            ['Button 1', 'web_url', 'https://google.com'],
            ['Button 2', 'postback', 'postback'],
            ['Button 3', 'web_url', 'https://github.com'],
        ];

        foreach ($data as $button) {
            $this->message->button($button[0], $button[1], $button[2]);
        }

        $property = $this->getProtectedProperty(Message::class, 'buttons');
        $buttons = $property->getValue($this->message);

        $this->assertCount(3, $buttons);
    }
}