<?php

use Bobbybouwmann\Messenger\Message;
use Bobbybouwmann\Messenger\Messenger;

class MessengerTest extends TestCase
{
    /**
     * @var Messenger
     */
    protected $messenger;

    /**
     * @var Message
     */
    protected $message;

    /**
     * @var int
     */
    protected $recipient;

    function setUp()
    {
        parent::setUp();

        $this->messenger = new Messenger('random_access_token');
        $this->message = new Message('Some title');
        $this->recipient = 123456789;
    }

    /** @test */
    function it_creates_the_data_for_the_post_request()
    {
        $method = $this->getProtectedMethod(Messenger::class, 'createDataForRequest');

        $messageData = $this->message->buildMessage();

        $result = $method->invokeArgs($this->messenger, [$messageData, $this->recipient]);

        $this->assertEquals([
            'form_params' => [
                'recipient' => ['id' => 123456789],
                'message'   => ['text' => 'Some title'],
            ],
        ], $result);
    }
}