# Troubleshooting

## Alias Already Exists

In the unlikely case that you attempt to register more than one short code with the same alias, the system will throw an exception. Fixing this exception is pretty straightforward, providing that at least one of the offending short codes is within your project. If both of them come from packages, the problem is a bit trickier.

Assuming that at least one of the offending short codes is within your project, you can handle the exception in one of two ways:

### Register The Short Code in a Service Provider

When you register a short code in the service provider, you can set an alias for that short code. You can even namespace it if you like, which might be a good idea for package developers whose audience is other developers. However, if the short codes are designed to be used by non-technical people, prefixing might add some extra friction.

```php
public function register()
{
	// some-short-code
	Shorty::register(SomeShortCode::class); 
	// different-name
	Shorty::register(AnotherShortCode::class, 'different-name');
	// namespace::namespaced-code
	Shorty::register(NamespacedCode::class, null, 'namespace'); 
	
}
```


### Add a Property to the Class

The registration system uses reflection to see if there is a property on the class called `alias` and, if there is, it will use that instead of the slugged class name when registering.

```php
#[AsShortCode()]
class MyShortCode
{
	protected string $alias = 'shorty-rocks';

}
```

The class above will be aliased to `[shorty-rocks]` instead of the default `[my-short-code]` that would result from the automatic name generation routine using a slug of the class name.

### How To Handle a Collision In Your Vendor Folder

If there is a package in your vendor folder that is registering short codes that collide with short codes from another package in your vendor folder, you can disable the registration of short codes from one of the packages in a service provider that you do control and then manually register any codes from that package that you'll need as documented above.

```php

public function register()
{
	// By path (including vendor)
	Shorty::ignoreCodesFrom('vendor/some-vendor/some-package');
	// By namespace
	Shorty::ignoreCodesFrom('SomeVendor\SomeNamespace')
}
```

In both cases, all short codes that exist within the folder or namespace is ignored. This is a recursive operation, so you only need to provide the root level namespace or path of the package to ignore all short codes from the package, no matter where they sit in the package's file structure.