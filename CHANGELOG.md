## 1.0.2 (October 21, 2020)
  - Add more detailed configuration options in README
  
## 1.0.1 (October 21, 2020)
  - Add CI (travis.yml, updated vendor constraints)
  
## 1.0.0 (October 20, 2020)
  - Update symfony dependencies to 5.1
  - Introduce user context on all listeners
  - Replace philkra/elastic-apm-php-agent with nipwaayoni/elastic-apm-php-agent
  - Provide configuration options for the http client and logger

## 0.5.0 (June 25, 2019)
  - Enable or disable each service

## 0.4.0 (June 24, 2019)
  - Exclude any exception(s) or http status code(s) from errors

## 0.3.1 (June 24, 2019)
  - Catch guzzle client connector exception if occurs

## 0.3.0 (June 22, 2019)
  - Fix disabled apm logging
  - Fix exception capture bug for authentication required requests
  - Add logger as an optional and refactor dependencies move to interface
  - Refactor listeners and create agent factory
  - Add user context to request listener
  - Fix status result when error occured

## 0.2.0 (June 20, 2019)
  - Fix composer requirement for private repository branch name
  - Add README.md file

## 0.1.0 (June 20, 2019)
  - Finish transaction and error tracing
  - Install elastic apm php agent
  - Initial commit

