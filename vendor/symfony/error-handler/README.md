ErrorHandler Component
======================

The ErrorHandler component provides tools to manage errors and ease debugging PHP code.

Getting Started
---------------

<<<<<<< HEAD
```bash
composer require symfony/error-handler
=======
```
$ composer require symfony/error-handler
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
```

```php
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\ErrorHandler\DebugClassLoader;

Debug::enable();

// or enable only one feature
//ErrorHandler::register();
//DebugClassLoader::enable();

// If you want a custom generic template when debug is not enabled
// HtmlErrorRenderer::setTemplate('/path/to/custom/error.html.php');

$data = ErrorHandler::call(static function () use ($filename, $datetimeFormat) {
    // if any code executed inside this anonymous function fails, a PHP exception
    // will be thrown, even if the code uses the '@' PHP silence operator
    $data = json_decode(file_get_contents($filename), true);
    $data['read_at'] = date($datetimeFormat);
    file_put_contents($filename, json_encode($data));

    return $data;
});
```

Resources
---------

 * [Contributing](https://symfony.com/doc/current/contributing/index.html)
 * [Report issues](https://github.com/symfony/symfony/issues) and
   [send Pull Requests](https://github.com/symfony/symfony/pulls)
   in the [main Symfony repository](https://github.com/symfony/symfony)
