# phppgadmin
the premier web-based administration tool for postgresql

This is a fork of [phpPgAdmin](https://github.com/phppgadmin/phppgadmin) that implements **a lot of changes**

### v6.0.0-alpha1

- the app was fully refactored adding:
    - namespaces
    - proper (yet arbitrary :sad:) folder hierarchy
    - separate files for separate classes
- stripes the use of require and include to the bare minimum
- drops support for PHP < 5.4.
- provides full composer compatibility
- PSR-4 autoloading
- makes requirement checks for PHP version and ext-pgsql


### v6.0.0-alpha2

- most entrypoints were moved to `src/views` and do now instance a controller, then call one of its methods depending on the `action` parameter
- due to this, entrypoint logic was moved into controller classes in  `src/controllers`
- usage of global variables is being replaced by member properties and usage of `use` where is due.
- usage of global functions is being replaced by anonymous fuctions 
- usage of explicit includes/requires is being replaced by composer's autoloader (except for `src/lib.inc.php`)
- global decorator functions are being replaced by static methods of the Decorator class. 
