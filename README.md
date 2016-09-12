Symfony2 Word bundle
============

This bundle permits you to create, modify and read word objects.

[![Build Status](https://travis-ci.org/Bilbous/WordBundle.png)](https://travis-ci.org/Bilbous/WordBundle)
[![Total Downloads](https://poser.pugx.org/Bilbous/WordBundle/downloads.png)](https://packagist.org/packages/Bilbous/WordBundle)
[![Latest Stable Version](https://poser.pugx.org/Bilbous/WordBundle/v/stable.png)](https://packagist.org/packages/Bilbous/WordBundle)
[![Latest Unstable Version](https://poser.pugx.org/Bilbous/WordBundle/v/unstable.png)](https://packagist.org/packages/Bilbous/WordBundle)

## License

[![License](https://poser.pugx.org/Bilbous/WordBundle/license.png)](LICENSE)

## Version 2

New Symfony

### Version 1.*

Old Symfony

## Installation

**1**  Add to composer.json to the `require` key

``` shell
    $composer require bilbous/wordbundle
``` 

**2** Register the bundle in ``app/AppKernel.php``

``` php
    $bundles = array(
        // ...
        new Bilbous\WordBundle\BilbousWordBundle(),
    );
```

## TL;DR

- Create an empty object:

``` php
$phpWordObject = $this->get('phpword')->createPHPWordObject();
```

- Create an object from a file:

``` php
$phpWordObject = $this->get('phpword')->createPHPWordObject('file.docx');
```

## Contributors

the [list of contributors](https://github.com/Bilbous/WordBundle/graphs/contributors)

## Contribute

1. fork the project
2. clone the repo
3. get the coding standard fixer: `wget http://cs.sensiolabs.org/get/php-cs-fixer.phar`
4. before the PullRequest you should run the coding standard fixer with `php php-cs-fixer.phar fix -v .`


