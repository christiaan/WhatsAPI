<?php
/**
 * WhatsAppDaemon
 * @author Christiaan Baartse <anotherhero@gmail.com>
 */
final class WhatsAppDaemon
{
    /** @var resource */
    private $input;
    /** @var string */
    private $phoneNumber;
    /** @var string */
    private $password;
    /** @var string */
    private $screenName;

    /** @var WhatsProt */
    private $wa;
    /** @var WhatsAppDaemonEventListener */
    private $eventListener;
    /** @var WhatsAppDaemonCommandHandler  */
    private $commandHandler;
    /** @var bool */
    private $running;
    /** @var string */
    private $inputBuffer;

    /**
     * @param resource $input a valid stream from which the input is read
     * @param resource $output a valid stream to which the output is written
     * @param string $phoneNumber
     * @param string $password
     * @param string $screenName
     */
    public function __construct($input, $output, $phoneNumber, $password, $screenName)
    {
        $this->input = $input;
        $this->phoneNumber = $phoneNumber;
        $this->password = $password;
        $this->screenName = $screenName;

        $this->wa = new WhatsProt($this->phoneNumber, null, 'WhatsApp', false);
        $eventListener = new WhatsAppDaemonEventListener($output);
        $eventListener->listenTo($this->wa);
        $this->eventListener = $eventListener;

        $this->commandHandler = new WhatsAppDaemonCommandHandler($this->wa);

        $that = $this;
        $signalHandler = function($signal) use($eventListener, $that) {
            $this->running = false;
            $eventListener->onDaemonStop($signal);
        };
        pcntl_signal(SIGTERM, $signalHandler);
        pcntl_signal(SIGINT, $signalHandler);

        $this->inputBuffer = '';
    }

    public function run()
    {
        $this->running = true;
        $this->wa->connect();

        // Now loginWithPassword function sends Nickname and (Available) Presence
        $this->wa->loginWithPassword($this->password);

        while ($this->running) {
            pcntl_signal_dispatch();
            $this->pollInput();

            $this->wa->pollMessage();
            $this->wa->getMessages(); // Drain the messages queue (we're using dispatched events so we don't care)
        }

        while ($this->wa->pollMessage());
        $this->wa->disconnect();
    }

    private function pollInput()
    {
        $read = array($this->input);

        if (false === ($num_changed_streams = stream_select($read, $write = NULL, $except = NULL, 0))) {
            throw new RuntimeException("\$ 001 Socket Error : UNABLE TO WATCH STDIN.\n");
        } elseif ($num_changed_streams > 0) {
            $this->inputBuffer .= fgets($this->input, 1024);
            while (strpos($this->inputBuffer, "\n") !== false) {
                list($commandMessage, $this->inputBuffer) = explode("\n", 2);
                $this->handleCommandMessage($commandMessage);
            }
        }
    }

    private function handleCommandMessage($commandMessage)
    {
        $json = json_decode($commandMessage, true);
        if (is_array($json) && count($json) === 2) {
            $method = $json[0];
            $arguments = $json[1];
            $handler = array($this->commandHandler, $method);
            if (!is_callable($handler)) {
                $this->eventListener->onDaemonError('Unknown command: ' . $method);
            }
            call_user_func_array($handler, $arguments);
        }
    }
}