# Laravel Aws Secrets Manager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tigerheck/laravel-aws-secrets-manager.svg?style=flat-square)](https://packagist.org/packages/tigerheck/laravel-aws-secrets-manager)
[![Total Downloads](https://img.shields.io/packagist/dt/tigerheck/laravel-aws-secrets-manager.svg?style=flat-square)](https://packagist.org/packages/tigerheck/laravel-aws-secrets-manager)


**Add enviroments form Aws Secrets Manager to laravel config.**

## Install

Via Composer

``` bash
$ composer require tigerheck/laravel-aws-secrets-manager
```


## Configuration

Laravel Aws Secrets Manager requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="TigerHeck\AwsSecretsManager\AwsSecretsManagerServiceProvider"
```

Available env values:
``` php
ENABLE_SECRETS_MANAGER=true
AWS_SECRETS_TAG_NAME=stage
AWS_SECRETS_TAG_VALUE=production
```

### AWS Credentials

Since this package utilizes the PHP AWS SDK the following .env values are used or credentials set ~/.aws/credentials.

```
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
```
[https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials.html](https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials.html)

