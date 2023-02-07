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

        $this->bootAwsSecretsManager();

    }
    
    public function register()
    {
        
    }

    protected function bootAwsSecretsManager()
    {
        // Load Secrets
        if (config('aws-secrets-manager.enable-secrets-manager')) {
            $secretsManager = new AwsSecretsManagerService();
            $secretsManager->loadSecrets();
        }
    }
}
