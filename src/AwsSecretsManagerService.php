<?php
namespace TigerHeck\AwsSecretsManager;

use Log;
use Config;
 
class AwsSecretsManagerService {
    private $listTagName;
    private $listTagValue;
    private $enabledEnvironments;
    private $debug;
    private $configVariables;
    private $region;
    private $version;
    private $profile;
    private $data;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->listTagName = config('aws-secrets-manager.tag-name');
        $this->listTagValue = config('aws-secrets-manager.tag-value');
        $this->enabledEnvironments = config('aws-secrets-manager.enabled-environments', []);
        $this->debug = config('aws-secrets-manager.debug', false);
        $this->configVariables = config('aws-secrets-manager.variables-config');
        $this->region = config('aws-secrets-manager.region');
        $this->version = config('aws-secrets-manager.version');
        $this->profile = config('aws-secrets-manager.profile');
    }

    public function loadSecrets()
    {
        if ($this->debug) {
            $start = microtime(true);
        }

        // Only run this if the evironment is enabled in the config
        if (in_array(config('app.env'), $this->enabledEnvironments)) {
            $this->getVariables();
        }

        if ($this->debug) {
            $time_elapsed_secs = microtime(true) - $start;
            error_log('Datastore secret request time: '.$time_elapsed_secs);
        }
    }

    protected function getVariables()
    {
        try {
            $client = \AWS::createSecretsManager([
		        'profile'   => $this->profile,
                'region'    => $this->region,
                'version'   => $this->version,
            ]);
            
            $result = $client->getSecretValue([
                $this->listTagName => $this->listTagValue,
            ]);
            
            $this->data = $result->get('SecretString');
            $this->data = json_decode($this->data);
            $this->setConfig($this->data);
            return $this->data;
            
        } catch (\Exception $e) {
            // dd($e);
            Log::error($e->getMessage());

            return [];
        }
    }

    protected function setConfig($data) {
        if(is_object($data)) {
            foreach($this->configVariables as $envKey => $configKey) {
                if(isset($data->{$envKey})) {
                    Config::set($configKey, $data->{$envKey});
                }
            }
        }
    }

}