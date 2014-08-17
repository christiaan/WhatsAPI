<?php
/**
 * WhatsAppDaemon
 * @author Christiaan Baartse <anotherhero@gmail.com>
 */
final class WhatsAppDaemon
{
    /** @var resource */
    private $input;
    /** @var resource */
    private $output;
    /** @var string */
    private $phoneNumber;
    /** @var WhatsProt */
    private $wa;
    /** @var string */
    private $screenName;
    /** @var bool */
    private $running;

    /** @var string */
    private $inputBuffer;

    /**
     * @param resource $input a valid stream from which the input is read
     * @param resource $output a valid stream to which the output is written
     * @param string $phoneNumber
     * @param string $screenName
     */
    public function __construct($input, $output, $phoneNumber, $screenName)
    {
        $this->input = $input;
        $this->output = $output;
        $this->phoneNumber = $phoneNumber;

        $this->wa = new WhatsProt($this->phoneNumber, null, 'WhatsApp', false);
        $this->eventListener = new WhatsAppDaemonEventListener($output);
        $this->wa->eventManager()->addEventListener($this->eventListener);
        pcntl_signal(SIGTERM, array($this, 'signalHandler'));
        pcntl_signal(SIGINT, array($this, 'signalHandler'));
        $this->screenName = $screenName;

        $this->inputBuffer = '';
    }

    public function signalHandler($signal)
    {
        $this->running = false;
    }

    public function register($mode = 'sms')
    {
        if ($mode !== 'sms' && $mode !== 'voice') {
            throw new InvalidArgumentException("Invalid value given for mode: {$mode}, should be either 'sms' or 'voice'");
        }
        $this->wa->codeRequest($mode);
    }

    public function activate($code)
    {
        $this->wa->codeRegister($code);
    }

    public function run($password)
    {
        $this->running = true;
        $this->wa->connect();

        // Now loginWithPassword function sends Nickname and (Available) Presence
        $this->wa->loginWithPassword($password);

        while ($this->running) {
            pcntl_signal_dispatch();
            $this->processInput();

            $this->wa->pollMessage();
            $this->wa->getMessages(); // Drain the messages queue (we're using dispatched events so we don't care)
        }

        while ($this->wa->pollMessage());
        $this->wa->disconnect();
    }

    private function processInput()
    {
        $read = array($this->input);

        if (false === ($num_changed_streams = stream_select($read, $write = NULL, $except = NULL, 0))) {
            throw new \RuntimeException("\$ 001 Socket Error : UNABLE TO WATCH STDIN.\n");
        } elseif ($num_changed_streams > 0) {
            $this->inputBuffer .= fgets($this->input, 1024);
            while (strpos($this->inputBuffer, "\n") !== false) {
                list($inputMessage, $this->inputBuffer) = explode("\n", 2);
                $this->handleInputMessage($inputMessage);
            }
        }
    }

    private function handleInputMessage($inputMessage)
    {
        $json = json_decode($inputMessage, true);
        if ($json) {

        }
    }
}