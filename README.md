[![][badge-version-php]][packagist-simple-api-ssr] [![][badge-version-packagist]][packagist-simple-api-ssr] [![][badge-download-month]][packagist-simple-api-ssr] [![][badge-license]][github-simple-api-ssr] [![][badge-commitizen-friendly]][github-commitizen] [![][badge-semantic-release]][github-semantic-release] [![][badge-gitter]][gitter]

A simple api-based server-side-rendering framework written in PHP.

## Installation
* Initialize project
    * via Composer
        ```bash
        composer create-project boxsnake/simple-api-ssr project_name
        ```
    * via Git
        ```bash
        git clone https://github.com/boxsnake-php/simple-api-ssr project_name
        ```
        **Note:** This may contain latest experimental unstable features
* Install dependencies
    * Composer dependencies
        ```bash
        composer install
        ```
    * Node.js dependencies (Optional for developers):
        ```bash
        npm install
        ```

## Project structure
```
project_name/
    |---- vendor/               # Composer dependencies
    |---- node_modules/         # Node.js dependencies
    |---- public/               # Web server root
    |---- src/
        |---- pages/            # Templates
        |---- config/           # Api configurations
        |---- utils/            # Utilities for simple-api-ssr framework
```

## How it works
For starters, it is better to demonstrate how the framework works.
Simply speaking, the framework does the following steps:
* Obtain `service` from HTTP request's GET params, and use it as service name
* Load api configurations using service name
* Fetch JSON-formatted api(s) via HTTP request, and store the result(s)
* Load template using service name
* Render template with api result(s), and output rendered page

## Api Configurations
* Api configurations are stored in `/src/config/`, with filename formatted `service_name.json`
* Api configuration content is exact a JSON file, which describes the api request attributes
* The configuration file is like:
    ```json
    {
        "data_1": {
            "url": "url_1",
            "get": {
                "param_1": "param_new_1"
            }
        },
        "data_2": {
            "url": "url_2"
        }
    }
    ```
* Configuration fields:

    | Field Name            | Type   | Optional         | Description                                                                                                                           |
    | --------------------- | :----: | :--------------: | ------------------------------------------------------------------------------------------------------------------------------------- |
    | `{mapping_name}`      | Object | ![yes][icon-yes] | A api configuration set, `{maaping_name}` can be any valid name, which is also used in templates.                                     |
    | `{mapping_name}.url`  | String | ![no][icon-no]   | Api url.                                                                                                                              |
    | `{mapping_name}.get`  | Object | ![yes][icon-yes] | GET params mapping. Object keys are GET param keys, and object values are GET param keys towards API url (in same configuration set). |
    | `{mapping_name}.post` | Object | ![yes][icon-yes] | POST data mapping. Object keys are POST data keys, and object values are POST data keys towards API url (in same configuration set).  |

## Templates
* Templates are stored in `/src/pages/`, with filename formatted `service_name.engine_name.tpl`
* `engine_name` in templates can be one of these: `smarty`.
* Predefined variables in templates:
    * `data`: Fetched api data using api configurations. The members of `data` are api results mapped using `{mapping_name}` (see [here](#api-configurations))
    * `get`: GET params from current request
    * `post`: POST data from current request

## Http server settings
* Host web server to `project_name/public` folder
* If this is a standalone project, host this as a virtual host will work, e.g:
    * Apache:
        ```xml
        <VirtualHost *:80>
            ServerName   simple-api-ssr.dev
            DocumentRoot /path/to/project_name/public/
            ...
        </VirtualHost>
        ```
    * Nginx:
        ```js
        server {
            listen      80;
            server_name simple-api-ssr.dev;
            index       index.html index.htm index.php;
            root        /path/to/project_name/public/;
            ...
        }
        ```
    * And then, you can access pages via `http://simple-api-ssr.dev/index.php?service=service_name` or `http://simple-api-ssr.dev/service_name`
* If this is bundled with some api projects, you may want to use this as a host alias, e.g:
    * Apache:
        ```xml
        <VirtualHost *:80>
            ServerName   some-api-service
            DocumentRoot /path/to/api/
            Alias        /some_ssr /path/to/project_name/public/
            ...
        </VirtualHost>
        ```
    * Nginx:
        ```js
        server {
            listen      80;
            server_name some-api-service;
            index       index.html index.html index.php;
            root        /path/to/api/;

            location /some_ssr {
                alias /path/to/project_name/public/
            }
        }
    * And then, you can access pages via `http://some-api-service/some_ssr/index.php?service=service_name` or `http://some-api-service/some_ssr/service_name`

[badge-version-php]: https://img.shields.io/packagist/php-v/boxsnake/simple-api-ssr.svg "PHP version"
[badge-version-packagist]: https://img.shields.io/packagist/v/boxsnake/simple-api-ssr.svg "release"
[badge-download-month]: https://img.shields.io/packagist/dm/boxsnake/simple-api-ssr.svg "# downloads"
[badge-license]: https://img.shields.io/github/license/boxsnake-php/simple-api-ssr.svg "license"
[badge-commitizen-friendly]: https://img.shields.io/badge/commitizen-friendly-brightgreen.svg "Commitizen friendly"
[badge-semantic-release]: https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg "semantic-release"
[badge-gitter]: https://img.shields.io/gitter/room/nwjs/nw.js.svg?logo=gitter-white "gitter"

[icon-yes]: https://raw.githubusercontent.com/boxsnake-nodejs/sequelize-autoload/master/images/icon-yes.png
[icon-no]: https://raw.githubusercontent.com/boxsnake-nodejs/sequelize-autoload/master/images/icon-no.png

[github-simple-api-ssr]: https://github.com/boxsnake-php/simple-api-ssr "simple-api-ssr"
[github-commitizen]: http://commitizen.github.io/cz-cli/ "Commitizen friendly"
[github-semantic-release]: https://github.com/semantic-release/semantic-release "Semantic Release"
[packagist-simple-api-ssr]: https://packagist.org/packages/boxsnake/simple-api-ssr "simple-api-ssr"
[gitter]: https://gitter.im/boxsnake/simple-api-ssr?utm_source=share-link&utm_medium=link&utm_campaign=share-link "Gitter - boxsnake/simple-api-ssr"
