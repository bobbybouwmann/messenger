<?php

namespace Bobbybouwmann\Messenger;

class Message
{
    protected $attachments = [];

    protected $buttons = [];

    protected $title;

    public function __construct($title = '')
    {
        $this->title = $title;
    }

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function button($title, $type = 'web_url', $data = '')
    {
        $this->buttons[] = (new Button())->build($title, $type, $data);

        return $this;
    }

    public function attachment(Attachment $attachment)
    {
        $this->attachments[] = $attachment->build();

        return $this;
    }

    public function attachments($attachments = [])
    {
        foreach ($attachments as $attachment) {
            if ($attachment instanceof Attachment) {
                $this->attachments[] = $attachment->build();
            }
        }

        return $this;
    }

    public function buildMessage()
    {
        if (! count($this->attachments) && ! count($this->buttons)) {
            return $this->buildTextMessage();
        }

        if (! count($this->attachments) && count($this->buttons)) {
            return $this->buildButtonsMessage();
        }

        return $this->buildAttachmentMessage();
    }

    public function buildTextMessage()
    {
        return [
            'text' => $this->title
        ];
    }

    public function buildButtonsMessage()
    {
        return [
            'attachment' => [
                'type'    => 'template',
                'payload' => [
                    'template_type' => 'button',
                    'text'          => $this->title,
                    'buttons'       => $this->buttons,
                ],
            ],
        ];
    }

    public function buildAttachmentMessage()
    {
        return [
            'attachment' => [
                'type'    => 'template',
                'payload' => [
                    'template_type' => 'generic',
                    'elements'      => $this->attachments,
                ],
            ]
        ];
    }
}