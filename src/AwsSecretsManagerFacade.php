<?php
namespace TigerHeck\AwsSecretsManager;
 
class AwsSecretsManagerFacade {
    protected static function getFacadeAccessor()
    {
        return 'aws_secrets_manager';
    }
}