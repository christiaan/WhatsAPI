<?php
/**
 * AbstractWhatsAppDaemonEventListener
 * @author Christiaan Baartse <anotherhero@gmail.com>
 */
abstract class AbstractWhatsAppDaemonEventListener implements WhatsAppEventListener
{
    /**
     * @var resource
     */
    private $output;

    /**
     * @param resource $output stream
     */
    public function __construct($output)
    {
        $this->output = $output;
    }

    public function listenTo(WhatsAppEvent $eventManager)
    {
        $eventManager->addEventListener($this);
    }

    protected function outputEvent($name, array $data)
    {
        fwrite($this->output, json_encode(array('name' => $name, 'data' => $data)) . "\n");
    }

    function onDaemonStop($signal)
    {
        $this->outputEvent(__FUNCTION__, compact('signal'));
    }

    function onDaemonError($message)
    {
        $this->outputEvent(__FUNCTION__, compact('message'));
    }
}