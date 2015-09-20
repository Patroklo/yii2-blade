# Yii2 Blade Layout

Routing and filtering extension system for Yii2 framework that emulates the Laravel routing system.

## What's Yii2 Blade Layout?

This module changes the route system definition of Yii2 in order to, instead of having to define the routes in the config file of the application now will be possible to make a series of files that hold the routes that the user will define for his web. This module lets the calling to a series of methods that will define the system routes in a more intuitive way that the basic Yii2 system getting it's inspiration from the routing system defined by Laravel.

Developed by Joseba Juániz ([@Patroklo](http://twitter.com/Patroklo))

[Spanish Readme version](https://github.com/Patroklo/yii2-blade/blob/master/README_spanish.md)

## Minimum requirements

* Yii2

## Future plans

* Pass manual parameters to the filters.
* Automatic system to make RESTFul Routes.

## License

This is free software. It is released under the terms of the following BSD License.

Copyright (c) 2014, by Cyneek
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions
are met:
1. Redistributions of source code must retain the above copyright
   notice, this list of conditions and the following disclaimer.
2. Redistributions in binary form must reproduce the above copyright
   notice, this list of conditions and the following disclaimer in the
   documentation and/or other materials provided with the distribution.
3. Neither the name of Cyneek nor the names of its contributors
   may be used to endorse or promote products derived from this software
   without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER "AS IS" AND ANY
EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

## Instalation

* Install [Yii 2](http://www.yiiframework.com/download)
* Install package via [composer](http://getcomposer.org/download/) `"cyneek/yii2-blade": "*"`
* Update config file _'config/web.php'_

```

...
'components' => [
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'blade' => [
                    'class' => '\cyneek\yii2\blade\ViewRenderer',
                    'cachePath' => '@runtime/blade_cache',
                ],
            ],
        ],
]
...
```
* Make a _blade_cache_ directory in your @runtime directory writable by the web user.
* Profit!

## Parameters

* *cachePath* [String/Required] Directory where Blade Layout system will store the view files once they are treated.
* viewPaths [String[]/Optional] Array holding a list of directories where views and layouts will be stored.
* extension [String/Optional] It you are going to use another extension than `.blade` for your views it should be stated here.

### Basic use
