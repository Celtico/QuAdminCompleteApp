<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Http
 */

namespace Zend\Http\Client\Adapter;

use Traversable;
use Zend\Http\Client\Adapter\AdapterInterface as HttpAdapter;
use Zend\Http\Client\Adapter\Exception as AdapterException;
use Zend\Http\Response;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\ErrorHandler;

/**
 * A sockets based (stream\socket\client) adapter class for Zend\Http\Client. Can be used
 * on almost every PHP environment, and does not require any special extensions.
 *
 * @category   Zend
 * @package    Zend_Http
 * @subpackage Client_Adapter
 */
class Socket implements HttpAdapter, StreamInterface
{
    /**
     * Map SSL transport wrappers to stream crypto method constants
     *
     * @var array
     */
    protected static $sslCryptoTypes = array(
            'ssl'   => STREAM_CRYPTO_METHOD_SSLv23_CLIENT,
            'sslv2' => STREAM_CRYPTO_METHOD_SSLv2_CLIENT,
            'sslv3' => STREAM_CRYPTO_METHOD_SSLv3_CLIENT,
            'tls'   => STREAM_CRYPTO_METHOD_TLS_CLIENT
    );

    /**
     * The socket for server connection
     *
     * @var resource|null
     */
    protected $socket = null;

    /**
     * What host/port are we connected to?
     *
     * @var array
     */
    protected $connected_to = array(null, null);

    /**
     * Stream for storing output
     *
     * @var resource
     */
    protected $out_stream = null;

    /**
     * Parameters array
     *
     * @var array
     */
    protected $config = array(
        'persistent'            => false,
        'ssltransport'          => 'ssl',
        'sslcert'               => null,
        'sslpassphrase'         => null,
        'sslverifypeer'         => true,
        'sslcapath'             => null,
        'sslallowselfsigned'    => false,
        'sslusecontext'         => false
    );

    /**
     * Request method - will be set by write() and might be used by read()
     *
     * @var string
     */
    protected $method = null;

    /**
     * Stream context
     *
     * @var resource
     */
    protected $context = null;

    /**
     * Adapter constructor, currently empty. Config is set using setOptions()
     *
     */
    public function __construct()
    {
    }

    /**
     * Set the configuration array for the adapter
     *
     * @param  array|Traversable $options
     * @throws AdapterException\InvalidArgumentException
     */
    public function setOptions($options = array())
    {
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        }
        if (!is_array($options)) {
            throw new AdapterException\InvalidArgumentException(
                'Array or Zend_Config object expected, got ' . gettype($options)
            );
        }

        foreach ($options as $k => $v) {
            $this->config[strtolower($k)] = $v;
        }
    }

    /**
     * Retrieve the array of all configuration options
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the stream context for the TCP connection to the server
     *
     * Can accept either a pre-existing stream context resource, or an array
     * of stream options, similar to the options array passed to the
     * stream_context_create() PHP function. In such case a new stream context
     * will be created using the passed options.
     *
     * @since  Zend Framework 1.9
     *
     * @param  mixed $context Stream context or array of context options
     * @throws Exception\InvalidArgumentException
     * @return Socket
     */
    public function setStreamContext($context)
    {
        if (is_resource($context) && get_resource_type($context) == 'stream-context') {
            $this->context = $context;

        } elseif (is_array($context)) {
            $this->context = stream_context_create($context);

        } else {
            // Invalid parameter
            throw new AdapterException\InvalidArgumentException(
                "Expecting either a stream context resource or array, got " . gettype($context)
            );
        }

        return $this;
    }

    /**
     * Get the stream context for the TCP connection to the server.
     *
     * If no stream context is set, will create a default one.
     *
     * @return resource
     */
    public function getStreamContext()
    {
        if (! $this->context) {
            $this->context = stream_context_create();
        }

        return $this->context;
    }

    /**
     * Connect to the remote server
     *
     * @param string  $host
     * @param int     $port
     * @param boolean $secure
     * @throws AdapterException\RuntimeException
     */
    public function connect($host, $port = 80, $secure = false)
    {
        // If we are connected to the wrong host, disconnect first
        if (($this->connected_to[0] != $host || $this->connected_to[1] != $port)) {
            if (is_resource($this->socket)) {
                $this->close();
            }
        }

        // Now, if we are not connected, connect
        if (!is_resource($this->socket) || ! $this->config['keepalive']) {
            $context = $this->getStreamContext();

            if ($secure || $this->config['sslusecontext']) {
                if ($this->config['sslverifypeer'] !== null) {
                    if (!stream_context_set_option($context, 'ssl', 'verify_peer', $this->config['sslverifypeer'])) {
                        throw new AdapterException\RuntimeException('Unable to set sslverifypeer option');
                    }
                }

                if ($this->config['sslcapath']) {
                    if (!stream_context_set_option($context, 'ssl', 'capath', $this->config['sslcapath'])) {
                        throw new AdapterException\RuntimeException('Unable to set sslcapath option');
                    }
                }

                if ($this->config['sslallowselfsigned'] !== null) {
                    if (!stream_context_set_option($context, 'ssl', 'allow_self_signed', $this->config['sslallowselfsigned'])) {
                        throw new AdapterException\RuntimeException('Unable to set sslallowselfsigned option');
                    }
                }

                if ($this->config['sslcert'] !== null) {
                    if (!stream_context_set_option($context, 'ssl', 'local_cert', $this->config['sslcert'])) {
                        throw new AdapterException\RuntimeException('Unable to set sslcert option');
                    }
                }

                if ($this->config['sslpassphrase'] !== null) {
                    if (!stream_context_set_option($context, 'ssl', 'passphrase', $this->config['sslpassphrase'])) {
                        throw new AdapterException\RuntimeException('Unable to set sslpassphrase option');
                    }
                }
            }

            $flags = STREAM_CLIENT_CONNECT;
            if ($this->config['persistent']) {
                $flags |= STREAM_CLIENT_PERSISTENT;
            }

            ErrorHandler::start();
            $this->socket = stream_socket_client(
                $host . ':' . $port,
                $errno,
                $errstr,
                (int) $this->config['timeout'],
                $flags,
                $context
            );
            $error = ErrorHandler::stop();

            if (!$this->socket) {
                $this->close();
                throw new AdapterException\RuntimeException(
                    sprintf(
                        'Unable to connect to %s:%d%s',
                        $host,
                        $port,
                        ($error ? ' . Error #' . $error->getCode() . ': ' . $error->getMessage() : '')
                    ),
                    0,
                    $error
                );
            }

            // Set the stream timeout
            if (!stream_set_timeout($this->socket, (int) $this->config['timeout'])) {
                throw new AdapterException\RuntimeException('Unable to set the connection timeout');
            }

            if ($secure || $this->config['sslusecontext']) {
                if ($this->config['ssltransport'] && isset(self::$sslCryptoTypes[$this->config['ssltransport']])) {
                    $sslCryptoMethod = self::$sslCryptoTypes[$this->config['ssltransport']];
                } else {
                    $sslCryptoMethod = STREAM_CRYPTO_METHOD_SSLv3_CLIENT;
                }

                ErrorHandler::start();
                $test  = stream_socket_enable_crypto($this->socket, true, $sslCryptoMethod);
                $error = ErrorHandler::stop();
                if (!$test || $error) {
                    // Error handling is kind of difficult when it comes to SSL
                    $errorString = '';
                    while (($sslError = openssl_error_string()) != false) {
                        $errorString .= "; SSL error: $sslError";
                    }
                    $this->close();

                    if ((! $errorString) && $this->config['sslverifypeer']) {
                        // There's good chance our error is due to sslcapath not being properly set
                        if (! ($this->config['sslcapath'] && is_dir($this->config['sslcapath']))) {
                            $errorString = 'make sure the "sslcapath" option points to a valid SSL certificate directory';
                        }
                    }

                    if ($errorString) {
                        $errorString = ": $errorString";
                    }

                    throw new AdapterException\RuntimeException(sprintf(
                        'Unable to enable crypto on TCP connection %s%s',
                        $host,
                        $errorString
                    ), 0, $error);
                }

                $host = $this->config['ssltransport'] . "://" . $host;
            } else {
                $host = 'tcp://' . $host;
            }

            // Update connected_to
            $this->connected_to = array($host, $port);
        }
    }


    /**
     * Send request to the remote server
     *
     * @param string        $method
     * @param \Zend\Uri\Uri $uri
     * @param string        $http_ver
     * @param array         $headers
     * @param string        $body
     * @throws AdapterException\RuntimeException
     * @return string Request as string
     */
    public function write($method, $uri, $http_ver = '1.1', $headers = array(), $body = '')
    {
        // Make sure we're properly connected
        if (! $this->socket) {
            throw new AdapterException\RuntimeException('Trying to write but we are not connected');
        }

        $host = $uri->getHost();
        $host = (strtolower($uri->getScheme()) == 'https' ? $this->config['ssltransport'] : 'tcp') . '://' . $host;
        if ($this->connected_to[0] != $host || $this->connected_to[1] != $uri->getPort()) {
            throw new AdapterException\RuntimeException('Trying to write but we are connected to the wrong host');
        }

        // Save request method for later
        $this->method = $method;

        // Build request headers
        $path = $uri->getPath();
        if ($uri->getQuery()) $path .= '?' . $uri->getQuery();
        $request = "{$method} {$path} HTTP/{$http_ver}\r\n";
        foreach ($headers as $k => $v) {
            if (is_string($k)) $v = ucfirst($k) . ": $v";
            $request .= "$v\r\n";
        }

        if (is_resource($body)) {
            $request .= "\r\n";
        } else {
            // Add the request body
            $request .= "\r\n" . $body;
        }

        // Send the request
        ErrorHandler::start();
        $test  = fwrite($this->socket, $request);
        $error = ErrorHandler::stop();
        if (!$test) {
            throw new AdapterException\RuntimeException('Error writing request to server', 0, $error);
        }

        if (is_resource($body)) {
            if (stream_copy_to_stream($body, $this->socket) == 0) {
                throw new AdapterException\RuntimeException('Error writing request to server');
            }
        }

        return $request;
    }

    /**
     * Read response from server
     *
     * @throws AdapterException\RuntimeException
     * @return string
     */
    public function read()
    {
        // First, read headers only
        $response = '';
        $gotStatus = false;

        while (($line = fgets($this->socket)) !== false) {
            $gotStatus = $gotStatus || (strpos($line, 'HTTP') !== false);
            if ($gotStatus) {
                $response .= $line;
                if (rtrim($line) === '') break;
            }
        }

        $this->_checkSocketReadTimeout();

        $responseObj= Response::fromString($response);

        $statusCode = $responseObj->getStatusCode();

        // Handle 100 and 101 responses internally by restarting the read again
        if ($statusCode == 100 || $statusCode == 101) return $this->read();

        // Check headers to see what kind of connection / transfer encoding we have
        $headers = $responseObj->getHeaders();

        /**
         * Responses to HEAD requests and 204 or 304 responses are not expected
         * to have a body - stop reading here
         */
        if ($statusCode == 304 || $statusCode == 204 ||
            $this->method == \Zend\Http\Request::METHOD_HEAD) {

            // Close the connection if requested to do so by the server
            $connection = $headers->get('connection');
            if ($connection && $connection->getFieldValue() == 'close') {
                $this->close();
            }
            return $response;
        }

        // If we got a 'transfer-encoding: chunked' header
        $transfer_encoding = $headers->get('transfer-encoding');
        $content_length = $headers->get('content-length');
        if ($transfer_encoding !== false) {

            if (strtolower($transfer_encoding->getFieldValue()) == 'chunked') {

                do {
                    $line  = fgets($this->socket);
                    $this->_checkSocketReadTimeout();

                    $chunk = $line;

                    // Figure out the next chunk size
                    $chunksize = trim($line);
                    if (! ctype_xdigit($chunksize)) {
                        $this->close();
                        throw new AdapterException\RuntimeException('Invalid chunk size "' .
                            $chunksize . '" unable to read chunked body');
                    }

                    // Convert the hexadecimal value to plain integer
                    $chunksize = hexdec($chunksize);

                    // Read next chunk
                    $read_to = ftell($this->socket) + $chunksize;

                    do {
                        $current_pos = ftell($this->socket);
                        if ($current_pos >= $read_to) break;

                        if ($this->out_stream) {
                            if (stream_copy_to_stream($this->socket, $this->out_stream, $read_to - $current_pos) == 0) {
                              $this->_checkSocketReadTimeout();
                              break;
                             }
                        } else {
                            $line = fread($this->socket, $read_to - $current_pos);
                            if ($line === false || strlen($line) === 0) {
                                $this->_checkSocketReadTimeout();
                                break;
                            }
                                    $chunk .= $line;
                        }
                    } while (! feof($this->socket));

                    ErrorHandler::start();
                    $chunk .= fgets($this->socket);
                    ErrorHandler::stop();
                    $this->_checkSocketReadTimeout();

                    if (!$this->out_stream) {
                        $response .= $chunk;
                    }
                } while ($chunksize > 0);
            } else {
                $this->close();
                throw new AdapterException\RuntimeException('Cannot handle "' .
                    $transfer_encoding->getFieldValue() . '" transfer encoding');
            }

            // We automatically decode chunked-messages when writing to a stream
            // this means we have to disallow the Zend_Http_Response to do it again
            if ($this->out_stream) {
                $response = str_ireplace("Transfer-Encoding: chunked\r\n", '', $response);
            }
        // Else, if we got the content-length header, read this number of bytes
        } elseif ($content_length !== false) {

            // If we got more than one Content-Length header (see ZF-9404) use
            // the last value sent
            if (is_array($content_length)) {
                $content_length = $content_length[count($content_length) - 1];
            }
            $contentLength = $content_length->getFieldValue();

            $current_pos = ftell($this->socket);
            $chunk = '';

            for ($read_to = $current_pos + $contentLength;
                 $read_to > $current_pos;
                 $current_pos = ftell($this->socket)) {

                 if ($this->out_stream) {
                     if (stream_copy_to_stream($this->socket, $this->out_stream, $read_to - $current_pos) == 0) {
                          $this->_checkSocketReadTimeout();
                          break;
                     }
                 } else {
                    $chunk = fread($this->socket, $read_to - $current_pos);
                    if ($chunk === false || strlen($chunk) === 0) {
                        $this->_checkSocketReadTimeout();
                        break;
                    }

                    $response .= $chunk;
                }

                // Break if the connection ended prematurely
                if (feof($this->socket)) break;
            }

        // Fallback: just read the response until EOF
        } else {

            do {
                if ($this->out_stream) {
                    if (stream_copy_to_stream($this->socket, $this->out_stream) == 0) {
                          $this->_checkSocketReadTimeout();
                          break;
                     }
                } else {
                    $buff = fread($this->socket, 8192);
                    if ($buff === false || strlen($buff) === 0) {
                        $this->_checkSocketReadTimeout();
                        break;
                    } else {
                        $response .= $buff;
                    }
                }

            } while (feof($this->socket) === false);

            $this->close();
        }

        // Close the connection if requested to do so by the server
        $connection = $headers->get('connection');
        if ($connection && $connection->getFieldValue() == 'close') {
            $this->close();
        }

        return $response;
    }

    /**
     * Close the connection to the server
     *
     */
    public function close()
    {
        if (is_resource($this->socket)) {
            ErrorHandler::start();
            fclose($this->socket);
            ErrorHandler::stop();
        }
        $this->socket = null;
        $this->connected_to = array(null, null);
    }

    /**
     * Check if the socket has timed out - if so close connection and throw
     * an exception
     *
     * @throws AdapterException\TimeoutException with READ_TIMEOUT code
     */
    protected function _checkSocketReadTimeout()
    {
        if ($this->socket) {
            $info = stream_get_meta_data($this->socket);
            $timedout = $info['timed_out'];
            if ($timedout) {
                $this->close();
                throw new AdapterException\TimeoutException(
                    "Read timed out after {$this->config['timeout']} seconds",
                    AdapterException\TimeoutException::READ_TIMEOUT
                );
            }
        }
    }

    /**
     * Set output stream for the response
     *
     * @param resource $stream
     * @return \Zend\Http\Client\Adapter\Socket
     */
    public function setOutputStream($stream)
    {
        $this->out_stream = $stream;
        return $this;
    }

    /**
     * Destructor: make sure the socket is disconnected
     *
     * If we are in persistent TCP mode, will not close the connection
     *
     */
    public function __destruct()
    {
        if (! $this->config['persistent']) {
            if ($this->socket) $this->close();
        }
    }
}
