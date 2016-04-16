<?php

use Util\Network\Http;

class HttpTest extends TestCase
{
    const PORT = 1984;
    const URL  = 'http://localhost:' . self::PORT;

    private $php_pid = null;

    public function setUp()
    {
        parent::setUp();
        $this->php_pid = shell_exec('php -S localhost:' . self::PORT . ' -t ' .
            __DIR__ . '/server > /dev/null 2>&1 & echo $!');
        sleep(1);
    }

    public function makeHttp()
    {
        return new Http;
    }

    public function testRequestBody()
    {
        $r = $this->makeHttp()->post(self::URL . '/echo.php');
        $this->assertEquals(200, $r->status_code);
        $this->assertEquals('', $r->body);
        $this->assertEquals('', $r);

        $r = $this->makeHttp()->post(self::URL . '/echo.php', ['foo' => 'bar']);
        $this->assertEquals(200, $r->status_code);
        $this->assertEquals('foo=bar', $r->body);
        $this->assertEquals('foo=bar', $r);

        $r = $this->makeHttp()->get(self::URL . '/echo.php', ['foo' => 'bar']);
        $this->assertEquals('{"foo":"bar"}', $r);

        $r = $this->makeHttp()->get(self::URL . '/echo.php', 'foo=bar');
        $this->assertEquals('{"foo":"bar"}', $r);

        $r = $this->makeHttp()->get(self::URL . '/echo.php?a=b', ['foo' => 'bar']);
        $this->assertEquals('{"a":"b","foo":"bar"}', $r);

        $r = $this->makeHttp()->post(self::URL . '/404.php');
        $this->assertEquals(404, $r->status_code);
    }

    public function testFailedResponse()
    {
        $r = $this->makeHttp()->post(self::URL . '/failure.php', ['foo' => 'bar']);
        $this->assertEquals(500, $r->status_code);
        $this->assertEquals('Failure', $r);
    }

    protected function tearDown()
    {
        parent::tearDown();
        if ($this->php_pid !== null) {
            shell_exec('kill -9 ' . $this->php_pid);
        }
    }
}
