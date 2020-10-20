# Elastic APM Symfony Bundle

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

Step 3: Add the Bundle config file
----------------------------------

Then, add the bundle configuration yml file `elastic_apm.yml` into 
`app/config` directory:

```yml
elastic_apm:
    enabled: true # Activate the APM Agent, default is true
    serviceName: 'Symfony APM App' # The name of your service, required
    environment: dev # The environment of your service
    serverUrl: 'http://localhost:8200' # The URL for your APM service. The URL must be fully qualified, including the protocol and port.
    secretToken: null # The secret token required to send data to your APM service
```

Import new config file to `config.yml` into `app/config` directory:

```yml
imports:
    ...
    - { resource: elastic_apm.yml }
```

## Contributing

Contributions are welcome. Read the [contributing guide](.github/CONTRIBUTING.md) to get started.

### Contributors

A big thank you goes out to every [contributor](https://github.com/chq81/elastic-apm-bundle/graphs/contributors) 
of this repo, special thanks goes out to:

* [goksagun](https://github.com/goksagun)
