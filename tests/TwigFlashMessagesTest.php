<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Slim\Flash\Messages;
use Slim\Twig\FlashMessages;
use Slim\Views\Twig;

final class TwigFlashMessagesTest extends TestCase
{
    private array $storage = [];
    private Messages $flashMessages;
    private Twig $twigView;

    protected function setUp() : void
    {
        $this->storage = ['slimFlash' => []];
        $this->flashMessages = new Messages($this->storage);


        if (method_exists(Twig::class, 'create') === false)
        {
            $this->twigView = Twig::create("tests/templates", [
                "cache" => false,
            ]);
        } else {
            $this->twigView = new Twig("tests/templates", [
                "cache" => false,
            ]);
        }

        $this->twigView->addExtension(new FlashMessages($this->flashMessages));

        $this->flashMessages->addMessageNow('user1', 'message1');
        $this->flashMessages->addMessageNow('user1', 'message2');
        $this->flashMessages->addMessageNow('user2', 'message1');
    }

    public function testAssertInstanceOf(): void
    {
        $this->assertInstanceOf(
            Messages::class,
            $this->flashMessages
        );

        $this->assertInstanceOf(
            Twig::class,
            $this->twigView
        );
    }

    public function testAssertFileExists()
    {
        $this->assertFileExists(
            "tests/templates/get_messages.html.twig",
        );

        $this->assertFileExists(
            "tests/templates/get_message.html.twig",
        );

        $this->assertFileExists(
            "tests/templates/get_first_message.html.twig",
        );

        $this->assertFileExists(
            "tests/templates/has_message.html.twig",
        );

        $this->assertFileExists(
            "tests/templates/clear_messages.html.twig",
        );

        $this->assertFileExists(
            "tests/templates/clear_message.html.twig",
        );
    }

    public function testTwigGetMessages(): void
    {
        $this->assertEquals(
            'user1:message1user1:message2user2:message1',
            $this->twigView->fetch('get_messages.html.twig')
        );
    }

    public function testTwigGetMessage(): void
    {
        $this->assertEquals(
            '0:message11:message2',
            $this->twigView->fetch('get_message.html.twig')
        );
    }

    public function testTwigGetFirstMessage(): void
    {
        $this->assertEquals(
            'message1',
            $this->twigView->fetch('get_first_message.html.twig')
        );
    }

    public function testTwigHasMessage(): void
    {
        $this->assertEquals(
            'OK',
            $this->twigView->fetch('has_message.html.twig')
        );
    }

    public function testTwigClearMessages(): void
    {
        $this->assertEquals(
            '',
            $this->twigView->fetch('clear_messages.html.twig')
        );
    }

    public function testTwigClearMessage(): void
    {
        $this->assertEquals(
            'user2:message1',
            $this->twigView->fetch('clear_message.html.twig')
        );
    }
}