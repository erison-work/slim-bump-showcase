# Slim bump showcase

During the migration process, you may wish to make minor changes to your code base and revert them if necessary.

The aim of this project is to show you how you could make [Slim 2][slim2] compatible with [Slim 3][slim3].

I have made minor modifications to return PSR7 responses to Slim actions.

> [!TIP]
> If you are in the process of migrating and require a version with full support for `requests` and `responses` like **slim 3**, contact me at [slim@erison.work](slim@erison.work).

> [!CAUTION]
> You **SHOULD NOT** use this package in production.

It isn't full implemented, in this repository you could have an idea how you could make your [Slim 2][slim2] compatible with [Slim 3][slim3]

```
composer require erison-work/slim-bump-showcase
```
Changing you action it will be compatible with slim 2 and 3.
```diff
<?php

require dirname(__DIR__).'/vendor/autoload.php';

- use Slim\Slim;
+ use ErisonWork\SlimBumpShowcase\App;

- $app = new Slim();
+ $app = new App();

//It works on slim 2/3
$app->get('/', function () {
-   echo "Hello index";
+  $response = new GuzzleHttp\Psr7\Response();
+
+    $response->getBody()->write(sprintf('Hello Slim %s ', App::VERSION));
+
+   return $response;
});

//It will return not found on slim 3
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->run();

```

Bump to slim 3

```
composer require slim/slim:^3.0
```


[slim2]: https://github.com/slimphp/Slim/tree/2.x
[slim3]: https://github.com/slimphp/Slim/tree/3.x
