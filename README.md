[![PHP version][*v-php]][@php]
[![Package version][*v]][@packagist]
[![Package downloads][*down]][@packagist]
[![License][*license]][@license]
[![Commitizen friendly][*commitizen]][@commitizen]
[![Semantic release][*semantic]][@semantic]
[![Gitter][*gitter]][@gitter]

A simple api-based server-side-rendering framework written in PHP.

## Table of Contents
<!-- MarkdownTOC autolink="true" bracket="round" -->

- [Installation](#installation)
- [Project Architecture](#project-architecture)
- [SSR Steps](#ssr-steps)
- [Api Config](#api-config)
- [Templates](#templates)
- [Server settings](#server-settings)

<!-- /MarkdownTOC -->

## Installation
```bash
# Install project
composer create-project boxsnake/simple-api-ssr <project_path> # via Composer

# Or, install latest project (may contain unstable features)
composer create-project boxsnake/simple-api-ssr <project_path> dev-master # (Option 1) via Composer
git clone https://github.com/boxsnake-php/simple-api-ssr <project_path>   # (Option 2) via Git

cd <project_path> # Change to project folder
composer install  # Install composer dependencies
npm install       # (Optional) For developers, install node.js dependencies
```

## Project Architecture
```bash
├───example                     # JSON examples
├───node_modules                # Node.js dependencies
├───public                      # Web host root
│   ├───index.php
│   └───assets                  # (Suggestive) Assets
│       ├───js                  # (Suggestive) Javascript source
│       ├───css                 # (Suggestive) CSS source
│       └───image               # (Suggestive) Images
├───src
│   ├───pages                   # Templates
│   ├───config                  # API configurations
│   └───utils                   # Simple-API-SSR utilities
└───vendor                      # Composer dependencies
```

## SSR Steps
* Fetch `service_name` from URL `https://<host>:<port>/<pathname>?service=<service_name>`.
* Load API config `<service_name>.json`.
* Fetch API data using config.
* Load template `<service_name>.<template_engine_name>.tpl`.
* Render template with API results, and then print out.

## Api Config
* __Location:__ `/src/config/`
* __Filename Scheme:__ `<service_name>.json`
* __Example:__
    ```javascript
    {
        "New": {                                  // This key is consistent with keys in results data
            "url": "https://fakeurl/fakepath/"    // (Required) API url
            "get": {                              // (Optional) Pass SSR GET params to API (via GET)
                "ssr_get_1": "api_get_1",
                "ssr_get_2": "api_get_2",
                ...
            },
            "post": {                             // (Optional) Pass SSR POST data to API (via POST)
                "ssr_post_1": "api_post_1",
                "ssr_post_2": "api_post_2",
                ...
            }
        },
        ...                                       // You can have multiple API sets
    }
    ```
* __Result Example:__
    ```javascript
    {
        "New": {                // Key defined in config
                                // This object is API result for `https://fakeurl/fakepath`
            "Foo": "bar"
        },
        ...
    }
    ```

## Templates
* __Location:__ `/src/pages/`
* __Filename Scheme:__ `<service_name>.<template_engine_name>.tpl`
* __Available Template Engines:__
    * _Smarty3_ (`smarty`)
* __Predefined Variables:__
    * `data` from API results
    * `get` from `$_GET`
    * `post` from `$_POST`

## Server settings
* __Host Path:__ `<project_path>/public/`
* (Option 1) __Host Standalone:__ [Apache][@host-sa-apache] / [Nginx][@host-sa-nginx]
* (Option 2) __Host with API (using alias):__ [Apache][@host-alias-apache] / [Nginx][@host-alias-nginx]

[*v]: https://img.shields.io/packagist/v/boxsnake/simple-api-ssr.svg
[*v-php]: https://img.shields.io/packagist/php-v/boxsnake/simple-api-ssr.svg
[*down]: https://img.shields.io/packagist/dt/boxsnake/simple-api-ssr.svg
[*license]: https://img.shields.io/github/license/boxsnake-php/simple-api-ssr.svg
[*commitizen]: https://img.shields.io/badge/commitizen-friendly-brightgreen.svg
[*semantic]: https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg
[*gitter]: https://img.shields.io/gitter/room/nwjs/nw.js.svg?logo=gitter-white

[@github]: https://github.com/boxsnake-php/simple-api-ssr
[@license]: https://github.com/boxsnake-php/simple-api-ssr/blob/master/LICENSE
[@php]: http://php.net/downloads.php
[@packagist]: https://packagist.org/packages/boxsnake/simple-api-ssr
[@commitizen]: http://commitizen.github.io/cz-cli/
[@semantic]: https://github.com/semantic-release/semantic-release
[@gitter]: https://gitter.im/boxsnake/simple-api-ssr?utm_source=share-link&utm_medium=link&utm_campaign=share-link
[@host-sa-apache]: https://httpd.apache.org/docs/2.4/vhosts/
[@host-sa-nginx]: https://www.nginx.com/resources/wiki/start/topics/examples/server_blocks/#two-server-blocks-serving-static-files
[@host-alias-apache]: https://httpd.apache.org/docs/2.4/mod/mod_alias.html#alias
[@host-alias-nginx]: http://nginx.org/en/docs/http/ngx_http_core_module.html#alias
