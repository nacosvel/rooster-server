# Nacosvel Rooster Server

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

## Quick Start

1.安装 Nacosvel Rooster Server 实现包
[https://packagist.org](https://packagist.org/providers/nacosvel/rooster-server-implementation)
> Nacosvel Rooster Server 基于跨框架的理念开发 `composer require nacosvel/rooster-server` 只是安装了 Nacosvel Rooster
> Server 的主包，需要具体的 [实现包]((https://packagist.org/providers/nacosvel/rooster-server-implementation))
> 来完成数据库操作及路由配置

2.发布配置文件
> 通过命令行 `php ns rooster-server:publish-database-config [<path>]`
> 可以指定将数据库配置文件发布到指定目录，默认根目录下的 `config` 文件夹
>
> ```bash
> php ns rooster-server:publish-database-config
> ```
> 数据库配置文件中的 `schema` 是指定数据库表名的映射关系，可以根据需求做修改

3.迁移数据库脚本
> 通过命令行 `php ns rooster-server:migration-database-scripts [<path>]`
> 可以指定将数据库脚本文件发布到指定目录，默认根目录下的 `database/scripts` 文件夹
>
> ```bash
> php ns rooster-server:migration-database-scripts
> ```

4.容器发现与交互

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

> 不同框架实现方式可能不一致，可以在服务提供者中实现容器发现功能。
> 具体操作查看 [nacosvel/container-interop](https://github.com/nacosvel/container-interop/blob/main/README.md)

5.自定义数据库配置

如果使用发布后的数据库配置文件，需要将配置数据通过当前框架的容器在服务提供者中进行绑定

```php
use Nacosvel\Container\Interop\Discover;
use Nacosvel\RoosterServer\Contracts\DatabaseConfigInterface;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(DatabaseConfigInterface::class, function () {
            return [];
            //return app('config')->get('rooster-server');
        });
        Discover::container();
    }

}
```

> 不同框架实现方式可能不一样，目的是将 Nacosvel Rooster Server 数据库配置绑定到
> `Nacosvel\RoosterServer\Contracts\DatabaseConfigInterface::class`
> 接口

## License

Nacosvel Rooster Server is made available under the MIT License (MIT). Please see [License File](LICENSE) for more
information.
