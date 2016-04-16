<?php

namespace Bobbybouwmann\Messenger;

class Attachment
{
    protected $buttons = [];

    protected $title;

    protected $subtitle;

    protected $imageUrl;

    public function __construct($title = '', $subtitle = '', $imageUrl = '')
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->imageUrl = $imageUrl;
    }

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function subtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function imageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function button($title, $type = 'web_url', $data = '')
    {
        $this->buttons[] = (new Button())->build($title, $type, $data);

        return $this;
    }

    public function build()
    {
        return [
            'title'     => $this->title,
            'subtitle'  => $this->subtitle,
            'image_url' => $this->imageUrl,
            'buttons'   => $this->buttons,
        ];
    }
}