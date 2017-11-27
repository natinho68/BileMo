# BileMo ![SensioLabsInsight](https://insight.sensiolabs.com/projects/e2efb335-c954-4a02-9703-0bbcc7502379/mini.png)

This web app works with Symfony v3.3.9 and uses Twig v2.0 (Required php 7.0).

I built this project as part of my php learning with [OpenClassRooms](https://openclassrooms.com/).

The goal of this project was to create a products provider with API REST for a mobile phone e-commerce.

## Getting Started


### Prerequisites

* Local server environment or live server
* PHP v7.0
* MySQL v5.0 or higher


### Installing




* [Clone or download the repository](https://github.com/natinho68/BileMo.git) and put files into your environment


* Install all the project dependencies with ``` composer install ```

* Modify the database parameters if you need to in **app/config/parameters.yml**

```php
parameters:
    database_host: your_host
    database_port: your_port
    database_name: your_database_name
    database_user: your_database_username
    database_password: your_database_password
```
* Install the database structure and datas with ``` php bin/console app:load-datas ```

* Enjoy

## Built With

* [Composer](https://getcomposer.org/) - Used for dependency manager
* [Doctrine](https://github.com/doctrine/doctrine2) - Used for Object Relational Mapper
* [Twig](https://twig.sensiolabs.org/) - Used for template engine
* [Bootstrap](https://getbootstrap.com/) - Used for design and responsive
* [jQuery](https://rometools.github.io/rome/) - Used for animations
* [FOSUserBundle](https://symfony.com/doc/master/bundles/FOSUserBundle/index.html) - Used for users management
* [FOSRestBundle](https://symfony.com/doc/master/bundles/FOSRestBundle/index.html) - Used for rapidly develop RESTful API's & applications with Symfony
* [JMSSerializer](https://jmsyst.com/libs/serializer) - Used to (de-)serialize data of any complexity
* [CSAGuzzleBundle](https://github.com/csarrazi/CsaGuzzleBundle) - Used to perform HTTP requests very simply
* [NelmioApiDocBundle](https://github.com/nelmio/NelmioApiDocBundle) - Used to generate simply a documentation for APIs
* [PagerFanta](https://github.com/whiteoctober/Pagerfanta) - Used for pagination
* [HWIOAuthBundle](https://github.com/hwi/HWIOAuthBundle) - Used for OAuth Facebook integration
* [BazingaHateoasBundle](https://github.com/willdurand/BazingaHateoasBundle) - Used for Hateoas library integration


## Authors

[**Nathan MEYER**](https://github.com/natinho68)

See also [ismail1432](https://github.com/ismail1432) on whom I can rely on a lot on this project.
