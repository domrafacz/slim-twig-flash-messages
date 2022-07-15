<?php
declare(strict_types=1);

namespace Slim\Twig;

use Slim\Flash\Messages;
use \Twig\Extension\AbstractExtension;
use \Twig\TwigFunction;

class FlashMessages extends AbstractExtension
{
    /**
     * @var Messages
     */
    private Messages $flashMessages;

    /**
     * @param Messages $flashMessages
     */
    public function __construct(Messages &$flashMessages)
    {
        $this->flashMessages = $flashMessages;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('flash_get_messages', [$this, 'getMessages']),
            new TwigFunction('flash_get_message', [$this, 'getMessage']),
            new TwigFunction('flash_get_first_message', [$this, 'getFirstMessage']),
            new TwigFunction('flash_has_message', [$this, 'hasMessage']),
            new TwigFunction('flash_clear_messages', [$this, 'clearMessages']),
            new TwigFunction('flash_clear_message', [$this, 'clearMessage']),
        ];
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->flashMessages->getMessages() ?? array();
    }

    /**
     * @param string|null $key
     * @return array
     */
    public function getMessage(string $key = null): array
    {
        return $this->flashMessages->getMessage($key) ?? array();
    }

    /**
     * @param string|null $key
     * @return string|null
     */
    public function getFirstMessage(string $key = null): ?string
    {
        return $this->flashMessages->getFirstMessage($key);
    }

    /**
     * @param string|null $key
     * @return bool
     */
    public function hasMessage(string $key = null): bool
    {
        return $this->flashMessages->hasMessage($key);
    }

    /**
     * @return void
     */
    public function clearMessages() : void
    {
        $this->flashMessages->clearMessages();
    }

    /**
     * @param string|null $key
     * @return void
     */
    public function clearMessage(string $key = null) : void
    {
        $this->flashMessages->clearMessage($key);
    }
}
