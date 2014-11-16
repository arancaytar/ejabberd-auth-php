htpasswd
========

This plugin can parse an Apache authentication file
generated by htpasswd.

The following hash types are supported:

- APR-MD5 ("htpasswd [-m]", default method)
- SHA1 ("htpasswd -s")
- Blowfish ("htpasswd -B")
- DES ("htpasswd -d")
- Plaintext ("htpasswd -s")

Note that DES and Plaintext are mutually exclusive, because
the format is not readily distinguishable. Any hash that does
not match the MD5, SHA1 or Blowfish formats will be treated as
a DES hash or a plaintext password depending on configuration.

Installation
------------

This configuration must be entered into plugin_conf in config.php:

  'plugin_conf' => [
    'htpasswd_file' => '</path/to/htpasswd/file>',
    'plain' => FALSE, // optional
  ]