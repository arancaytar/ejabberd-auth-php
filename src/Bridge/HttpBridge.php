<?php

namespace Ermarian\EjabberdAuth\Bridge;

use Curl\Curl;

use Ermarian\EjabberdAuth\BridgeInterface;

class HttpBridge implements BridgeInterface {

  /**
   * @var string
   */
  protected static $endpoint = '';

  /**
   * @var string
   */
  protected $url;

  /**
   * HttpBridge constructor.
   *
   * @param string $url
   *   The base target URL.
   */
  public function __construct($url) {
    $this->url = $url;
  }

  /**
   * Factory method for initializing the plugin from config.
   *
   * @param array $config
   *
   * @return static
   */
  public static function create(array $config) {
    $url = $config['url'];
    if ($endpoint = static::$endpoint) {
      $url = rtrim($url, '/') . '/' . $endpoint;
    }
    return new static($url);
  }

  /**
   * Check whether a user exists.
   *
   * @param string $username
   * @param string $server
   *
   * @return bool
   *
   * @throws \ErrorException
   */
  public function isuser($username, $server) {
    $request = new Curl($this->url);
    $response = $request->post([
      'command' => 'isuser',
      'user'    => $username,
      'domain'  => $server,
    ]);
    return $response && $response->result === TRUE;
  }

  /**
   * Authenticate a user.
   *
   * @param string $username
   * @param string $server
   * @param string $password
   *
   * @return bool
   *
   * @throws \ErrorException
   */
  public function auth($username, $server, $password) {
    $request = new Curl($this->url);
    $response = $request->post([
      'command' => 'auth',
      'user'    => $username,
      'password'=> $password,
      'domain'  => $server,
    ]);
    return $response->result === TRUE;
  }

}
