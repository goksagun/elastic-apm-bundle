# Symfony Elastic APM Bundle

This package is a continuation of the excellent work done by [goksagun](https://github.com/goksagun) at
[goksagun/elastic-apm-bundle](https://github.com/goksagun/elastic-apm-bundle).

Installation
============

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require chq81/elastic-apm-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require chq81/elastic-apm-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new Chq81\ElasticApmBundle\ElasticApmBundle(),
        ];

        // ...
    }

    // ...
}
```

### Step 3: Add the Bundle config file

Then, add the bundle configuration yml file `elastic_apm.yml` into 
`app/config` directory:

```yml
elastic_apm:
    enabled: true # Activate the APM Agent, default is true
    serviceName: 'Symfony APM App' # The name of your service, required
    serverUrl: 'http://localhost:8200' # The URL for your APM service, required The URL must be fully qualified, including the protocol and port.
    secretToken: null # The secret token required to send data to your APM service
    environment: dev # The environment of your service
```

Import new config file to `config.yml` into `app/config` directory:

```yml
imports:
    ...
    - { resource: elastic_apm.yml }
```

Configuration
=============

The following configurations options are provided:

| Option        | Default           | Example Value(s) | Mandatory | Description |
| ------------- |:-------------:|:-----:|:-----:|:-----:|
| enabled    | true | true, false | yes |  Activating the APM Agent
| serviceName | "Symfony APM Service" | | yes | The name of your service
| serverUrl | null | "http://localhost:8200" | yes | The URL for your APM service. The URL must be fully qualified, including the protocol and port.
| secretToken | null | "SOME_TOKEN" | no | The secret token required to send data to your APM service
| serviceVersion | null | 1.0 | no | The version of your deployed service
| frameworkName | null | "Symfony" | no | The name of the application framework
| frameworkVersion | null | "5.1.7", !php/const App\Kernel::VERSION | no | The version of the application framework
| environment | null | "dev", '%kernel.environment%' | no | The environment where your service is running
| hostname | null | "local-hostname" | no | The OS hostname on which the agent is running
| env | [] | ['DOCUMENT_ROOT', 'REMOTE_ADDR', 'REMOTE_USER'] | no | $_SERVER vars to send to the APM Server. Keys are case sensitive
| cookies | [] | ['my-cookie'] | no | Cookies to send to the APM Server. Keys are case sensitive
| httpClient | null | "Buzz\Browser" | no | The service reference to the HTTP client to use for APM requests. It needs to implement the Psr\Http\Client\ClientInterface. When left empty, the Http\Discovery\HttpClientDiscovery is used to find any installed http clients. 
| timeout | 10 | 10 | no | The timeout for the HTTP client
| logger | null | "monolog.logger" | no | The service reference to the Logger to use in all APM requests. It needs to implement the Psr\Log\LoggerInterface. When left empty, the Psr\Log\NullLogger is used.
| logLevel | INFO | DEBUG | no | The log level of the logger
| stackTraceLimit | 0 | 10 | no | The depth of a transaction stack trace. The default (0) is unlimited depth.
| transactionSampleRate | 1.0 | 1.0 | no | Transactions will be sampled at the given rate (1.0 being 100%). Sampling a transaction means that the context and child events will be included in the data sent to APM. Unsampled transactions are still reported to APM, including the overall transaction time, but will have no details. The default is to sample all (1.0) transactions.

Furthermore, it is possible to de-/activate the data capturing for transactions and errors. Per default, both are enabled.
For errors, status codes and exceptions can be excluded.
See the following example:
```
transactions: # Captures transactions
   enabled: true # Activating capturing of transactions, default is true
errors: # Captures errors
   enabled: true # Activating capturing of errors, default is true
       exclude:
           status_codes: [] # Status codes which should not be captured. The default is none.
           exceptions: [] # Exceptions which should not be captured. The default is none.
```

## Contributing

Contributions are welcome. Read the [contributing guide](.github/CONTRIBUTING.md) to get started.

### Contributors

A big thank you goes out to every [contributor](https://github.com/chq81/elastic-apm-bundle/graphs/contributors) 
of this repo, special thanks goes out to:

* [goksagun](https://github.com/goksagun)
