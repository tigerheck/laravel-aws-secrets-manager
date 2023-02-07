<?php

namespace TigerHeck\AwsSecretsManager;

use Illuminate\Support\ServiceProvider;

class AwsSecretsManagerServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config' => config_path(),
        ], 'config');

    }
    
    public function register()
    {
        $this->registerAwsSecretsManager();
    }

    public function provides()
    {
        return ['aws_secrets_manager'];
    }

    protected function registerAwsSecretsManager()
    {
        // Load Secrets
        if (config('aws-secrets-manager.enable-secrets-manager')) {
            $secretsManager = new AwsSecretsManagerService();
            $secretsManager->loadSecrets();
        }
    }
}
