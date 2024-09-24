# Nacosvel Rooster

Nacosvel Rooster is an open-source distributed transaction solution dedicated to providing high-performance and
easy-to-use distributed transaction services in microservice architectures.

[![GitHub Tag](https://img.shields.io/github/v/tag/nacosvel/rooster-server)](https://github.com/nacosvel/rooster-server/tags)
[![Total Downloads](https://img.shields.io/packagist/dt/nacosvel/rooster-server?style=flat-square)](https://packagist.org/packages/nacosvel/rooster-server)
[![Packagist Version](https://img.shields.io/packagist/v/nacosvel/rooster-server)](https://packagist.org/packages/nacosvel/rooster-server)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/nacosvel/rooster-server)](https://github.com/nacosvel/rooster-server)
[![Packagist License](https://img.shields.io/github/license/nacosvel/rooster-server)](https://github.com/nacosvel/rooster-server)

## Installation

You can install the package via [Composer](https://getcomposer.org/):

```bash
composer require nacosvel/rooster-server
```

## 文档

因为不同框架容器对象不同，需要借助 `nacosvel/container-interop` 完成容器交互。

```php
use Nacosvel\Container\Interop\Discover;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Discover::container();
    }

}
```

> 不同框架实现方式可能不一致，基本都是在框架容器服务提供者中完成容易发现功能。
> 具体操作查看 [nacosvel/container-interop](https://github.com/nacosvel/container-interop/blob/main/README.md)

如果你当前使用的框架容器已经有 `DB` 数据库管理对象并可以通过`容器['db']`方式获取，可以跳过本章节。

```php
use App\Support\DatabaseManager;
use Illuminate\Support\ServiceProvider;
use Nacosvel\Container\Interop\Discover;
use Nacosvel\RoosterServer\Contracts\DatabaseManagerInterface;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(DatabaseManagerInterface::class, function () {
            return new DatabaseManager($this->app['db']);
        });
        Discover::container();
    }

}
```

> 自定义 `App\Support\DatabaseManager` 数据库管理对象，并实现 `Nacosvel\RoosterServer\Contracts\DatabaseManagerInterface`
> 接口，然后绑定到容器。

## License

Nacosvel Rooster is made available under the MIT License (MIT). Please see [License File](LICENSE) for more information.
