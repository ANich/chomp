Chomp
================
Chomp is a Library for extending consumption-only RESTful APIs.

[![Build Status](https://travis-ci.org/ANich/chomp.svg)](https://travis-ci.org/ANich/chomp)

#### Installation via Composer
``` 
$ composer require anich/chomp dev-master
```

#### Basic Usage
```php
// YourResource.php
<?php

namespace Your\Namespace;

class YourResource extends \ANich\Chomp\Resource
{
    protected $baseUri = 'http://link/to/your/api.com/api/v1/resources/';
}

// OtherFile.php
<?php

require('vendor/autoload.php');

$chomp = new Chomp;
$resource = $chomp->get('\Your\Namespace\YourResource', '1');

echo $resource->id; // 1
echo $resource->title; // Lorem Title.
echo $resource->body; // Lorem ipsum dolor sit amet, consectetur...
```

#### Modifiers
```php
// YourResource.php
<?php

namespace Your\Namespace;

class YourResource extends \ANich\Chomp\Resource
{
    protected $baseUri = 'http://link/to/your/api.com/api/v1/resources/';
    
    public function titleModifier($title);
    {
    	return 'Title: '.$title;
	}
}

// OtherFile.php
<?php

require('vendor/autoload.php');

$chomp = new Chomp;
$resource = $chomp->get('\Your\Namespace\YourResource', '1');

echo $resource->title; // Title: Lorem Title.
```
(Name your modifiers: fieldModifier)


#### Running Tests
``` 
vendor/bin/phpunit tests
```
or 
```
composer test
```

#### Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md)

#### Changelog
Please see [CHANGELOG](CHANGELOG.md)

#### License
This library is licensed under the MIT license. Please see [LICENSE](LICENSE.md)
