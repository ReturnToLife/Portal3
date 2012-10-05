
return (to_life);
=================

/* The Student's Portal */

Usage
=====

Return (to_life); is the Epitech Official Students Portal.

## Requirement

* PHP >= 5.3
* libssh2-php
* Web Server
* MySQL

## Initialization

1. If you have not yet a web server, read the file `doc/install_apache_server.txt`
to know how to install an apache server.

2. Create a MySQL database using `return-to_life.sql`.
```shell
$> mysql -u yourlogin -p < return-to_life.sql
```

3. Get the latest version of Ionis-Users-Informations (SQL version):
```shell
$> wget https://github.com/db0company/Ionis-Users-Informations/blob/master/ionisinfo.class.php
```

4. Get the casts and right classes from the Web-Service:
```shell
$> cd src/class/
$> wget https://raw.github.com/db0company/Ionis-Users-Informations-Web-Service/master/ws/Cast.class.php
$> wget https://raw.github.com/db0company/Ionis-Users-Informations-Web-Service/master/ws/CastManager.class.php
$> wget https://raw.github.com/db0company/Ionis-Users-Informations-Web-Service/master/ws/Rights.class.php
$> cd ../..
```

5. Install bootstrap css and png files
```shell
$> wget http://twitter.github.com/bootstrap/assets/bootstrap.zip
$> unzip bootstrap.zip
$> rm bootstrap.zip
```

6. Install JQuery
```shell
$> cd js/
$> wget http://code.jquery.com/jquery-latest.min.js
$> mv jquery-latest.min.js jquery.min.js
$> cd ..
```

7. Edit the `conf.php` file.

Development
===========

## Coding Style

#### Variables names

* __Objects attributes :__ `theVariableName`, `blue`, `protocolName`
* __Internal function variables :__ like Objects attributes
* __Global variables :__ `categ_name` (def_include_dir)
* __Objects methods :__ like objects attributes
* __Objects getters/setters :__ `getTheVariableName`, `setProtocolName`, `isBlue` (boolean)
* __Global function names :__ `can_you_sleep`
* __Filenames :__ `src/include/tools.php`, `src/class/Portal.class.php` (classes), `src/nmsp/View.nmsp.php` (namespaces)

* Align functions names :
```PHP
private function        hello($arg)
```

* Braces at the end of the lines
* No useless parenthesis on `return` _(funny paradox with the name of the website :P)_
* Alignment with spaces, not tabs

```PHP
function foo($bar) {
  if ($bar == 5) {
    return 6;
  }
  return 8;
}
```

## Files & Directories

* __src__

  source code

* __src/include__

  general includes, countaining global functions, global variable

* __src/model__

  get informations to be shown

* __src/view__

  echo html

* __src/class__

  PHP Classes__

* __src/nmsp__

  PHP Namespaces

## Information

* src/include/def.php contain directories definitions

Copyright/License
=================

     Copyright 2012 Barbara Lepage
  
     Licensed under the Apache License, Version 2.0 (the "License");
     you may not use this file except in compliance with the License.
     You may obtain a copy of the License at
  
         http://www.apache.org/licenses/LICENSE-2.0
  
     Unless required by applicable law or agreed to in writing, software
     distributed under the License is distributed on an "AS IS" BASIS,
     WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
     See the License for the specific language governing permissions and
     limitations under the License.


### Author

* Made by __db0__
* Website: http://db0.fr/
* Contact: db0company@gmail.com


### Up to date

Latest version of this project is on GitHub:
* https://github.com/ReturnToLife/Portal

