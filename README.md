# Yii2 Blade Layout

Blade layout extension system for Yii2 framework.

## What's Yii2 Blade Layout?

This module adds support to Blade Layout system in your Yii2 app installation.  

Developed by Joseba Juániz ([@Patroklo](http://twitter.com/Patroklo))

[Spanish Readme version](https://github.com/Patroklo/yii2-blade/blob/master/README_spanish.md)

## Minimum requirements

* Yii2

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

```php

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

* **cachePath** [String/Required] Directory where Blade Layout system will store the view files once they are treated. Should be writable by the web server user (for example www-data).
* **viewPaths** [String[]/Optional] Array holding a list of directories where views and layouts will be stored. This is not really necessary since the system will get the view paths once they are retrieved to the Blade Wrapper.
* **extension** [String/Optional] It you are going to use another extension than `.blade` for your view files, it should be stated here as well as in the array key of the renderers array.

### Using the `layout` parameter

It's possible to define the controller's parameter `layout` with a Blade file. But since the Yii2 view render system it's not 100% compatible with the Blade Layout rendering, you'll have to add a behavior to that controller called `BladeBehavior` that will integrate both systems. 

To add this behavior you'll only have to include:


```php
    public function behaviors()
    {
        return [
            ...
            'blade' => [
                'class' => BladeBehavior::className()
            ],
            ...
        ];
    }
```

Then the layout view file will be rendered before the views if both layout and view files have a blade file extension. If not, Yii2 normal rendering system will be used instead.

### Using the `$view` instead of `$this` 
The object `$this` can't be used in Blade templates due to compatibility problems with the Blade system callings.

So, instead of this object I made the `$view` object that has the same functionalities than the `$this` in a normal layout system.

For example , if you want to pass `$this->title` from content view to layout view, just use `$view->title` ,and in the layout view , you can get title by using `$this->title`.

### Blade template instructions

The Laravel framework documentation has an extensive guide about how to work with Blade template system. Everything should be compatible with this module since it uses the same libraries in the background.

[Link to the basic Blade documentation in Laravel homepage](https://laravel.com/docs/master/blade)