
# Shorty for Laravel

Shorty is a Laravel package that enables WordPress-like short-codes. The short codes are invokable PHP classes that return a string. The documentation for this package uses the package itself. Here's a simple example of a short code:

`The current moment represented as a unix timestamp is [now]`

The current moment represented as a unix timestamp is [now]

```php
class NowShortCode
{
	#[AsShortCode('now')]
	public function __invoke(): string
	{
		return (string)now();
	}
}
```

## Using Short Codes

From the end-user's perspective, Shorty's short codes are very much like Wordpress short codes. The alias of the short code as well as the parameters it accepts are up to the developer of the short code to document. We've created two sets of short codes that go with this package. One set is a standard set of short codes that provide commonly used strings. Another is a premium set of codes that are designed to pair with [Scalpels](https://scalpels.app), our collection of premium tools for Laravel developers.