<?php

namespace Austin\Site;

use Composer\Script\Event;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class Application
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Application constructor.
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    /**
     * Starts application
     */
    private function start()
    {
        $this->logger->info("Application starting...");
    }

    /**
     * Starts application in static way.
     *
     * Used from external scripts or tools, as example from composer scripts.
     *
     * @param Event $event
     * @throws \Exception
     */
    public static function startApplication(Event $event)
    {
        $logger = new Logger('main');
        $logger->pushHandler(new ErrorLogHandler(ErrorLogHandler::OPERATING_SYSTEM, Logger::DEBUG));
        $app = new Application($logger);
        $app->start();
    }
}