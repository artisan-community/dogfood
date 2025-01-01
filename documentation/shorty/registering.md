# Manually Registering Short Codes

Another alternative to keeping all of your short codes in the configured folder is to manually register them in a service provider. 

>**Info** We strongly encourage package maintainers who provide short codes in their packages to do this.

This is how you manually register short codes in your service provider:

```
public function register()
{
	Shorty::register(SomeShortCode::class); // some-short-code
	Shorty::register(AnotherShortCode::class, 'different-name') // different-name
}
```

You'll notice that the register() method takes two arguments. The first is the fully qualified classname (assume that we've included a use statement in the examples above). The second is an optional alias. If no alias is provided, the class name will be sluggified to create the alias. If there is a collision between short codes, the system will throw an exception.