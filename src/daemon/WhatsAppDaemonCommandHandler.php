<?php
/**
 * WhatsAppDaemonCommandHandler
 * @author Christiaan Baartse <anotherhero@gmail.com>
 */
final class WhatsAppDaemonCommandHandler
{
    /**
     * @var WhatsProt
     */
    private $wa;

    public function __construct(WhatsProt $wa)
    {
        $this->wa = $wa;
    }

    public function sendMessage($target, $message)
    {
        $this->wa->sendMessage($target, $message);
    }
}