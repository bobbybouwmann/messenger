<?php

namespace Bobbybouwmann\Messenger;

use Bobbybouwmann\Messenger\Exceptions\ButtonTypeException;

class Button
{
    public function build($title, $type = 'web_url', $data = '')
    {
        $method = camel_case('button' . $type);

        if (! method_exists($this, $method)) {
            throw new ButtonTypeException('Button type does not exists! Only web_url and postback are valid at the moment.');
        }

        return $this->{$method}($title, $data);
    }

    protected function buttonWebUrl($title, $url = '')
    {
        return [
            'type'  => 'web_url',
            'title' => $title,
            'url'   => $url,
        ];
    }

    protected function buttonPostback($title, $postback = '')
    {
        return [
            'type'    => 'postback',
            'title'   => $title,
            'payload' => $postback,
        ];
    }
}