# Yii2 Blade Layout

Extensión de Blade para el framework Yii2.

## ¿Qué es Yii2 Blade Layout?

Este módulo añade soporte al sistema de Blade Layout en nuestra aplicación de Yii2.

Desarrollado by Joseba Juániz ([@Patroklo](http://twitter.com/Patroklo))

[English Readme version](https://github.com/Patroklo/yii2-blade/blob/master/README.md)

## Minimum requirements

* Yii2


## Licencia

Esto es software libre. Está liberado bajo los términos de la siguiente licencia BSD

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


## Instalación

* Instalar [Yii 2](http://www.yiiframework.com/download)
* Instalar el paque vía [composer](http://getcomposer.org/download/) `"cyneek/yii2-blade": "*"`
* Modificar el fichero config  _'config/web.php'_

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


* Crear un directorio llamado _blade_cache_ en la raíz de @runtime que pueda ser editado por el usuario web.
* Profit!

## Parameters

* **cachePath** [String/Obligatorio] Directorio donde el sistema Blade almacenará las vistas una vez han sido tratads. Tiene que ser editable por el usuario web (por ejemplo www-data).
* **viewPaths** [String[]/Opcional] Array con una lista de directorios donde las vistas y layouts residen. No es necesario realmente ya que el sistema obtiene los directorios de las propias vistas y layouts y se añaden automáticamente al Wrapper de Blade.
* **extension** [String/Opcional] Si vas a usar una extensión para las vistas diferente de `.blade`, debería estar aquí también definido además de en el key del array `renderers`.

### Usando el parámetro `layout`

Es posible definir en el parámetro `layout` de los controllers un fichero de tipo Blade. Pero ya que el sistema de renderizado de vistas de Yii2 no es 100% compatible con el de Blade, tendrás que añadir un behavior al controller llamado `BladeBehavior` que se encargará de integrar ambos sistemas.

Para añadir este behavior tan sólo hay que incluir en el controller:

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

Entonces el fichero layout será renderizado antes que las vistas que contiene, a diferencia del sistema estandar de Yii2, que las renderiza al final.

### Usando `$view` en lugar de `$this` 

La variable `$this` que se refiere al propio objeto de la vista no puede ser en los templates de Blade a causa de problemas de compatibilidad con el sistema de llamadas de Blade.
  
Por ello, en lugar de esta variable, he creado en su lugar `$view` que tiene las mismas funcionalidades que `$this` en un sistema de layout normal.

Por ejemplo, si queremos pasar `$this->title` de una vista a nuestro layout, deberíamos usar en su lugar `$view->title`, y en el layout se podría seguir utilizando `$this->title`.