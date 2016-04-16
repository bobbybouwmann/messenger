<?php

use Bobbybouwmann\Messenger\Attachment;

class AttachmentTest extends TestCase
{
    /**
     * @var Attachment
     */
    protected $attachment;

    function setUp()
    {
        parent::setUp();

        $this->attachment = new Attachment(
            'Some title', 'Some subtitle', 'http://dummyimage.com/300'
        );
    }

    /** @test */
    function it_create_a_basic_attachment()
    {
        $actual = $this->attachment->build();
        $expected = [
            'title'     => 'Some title',
            'subtitle'  => 'Some subtitle',
            'image_url' => 'http://dummyimage.com/300',
            'buttons'   => [],
        ];

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    function it_creates_an_attachment_using_chaining()
    {
        $attachment = new Attachment();

        $attachment->title('Some title');
        $attachment->subtitle('Some subtitle');
        $attachment->imageUrl('http://dummyimage.com/300');

        $actual = $attachment->build();
        $expected = [
            'title'     => 'Some title',
            'subtitle'  => 'Some subtitle',
            'image_url' => 'http://dummyimage.com/300',
            'buttons'   => [],
        ];

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    function it_creates_an_attachment_with_a_button()
    {
        $this->attachment->button('Button', 'postback', 'postback');

        $property = $this->getProtectedProperty(Attachment::class, 'buttons');
        $buttons = $property->getValue($this->attachment);

        $this->assertCount(1, $buttons);
    }
}