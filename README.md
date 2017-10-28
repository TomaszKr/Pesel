# Pesel
Object Pesel
PESEL mean Personal Identificator for Poland

[![Build Status](https://travis-ci.org/TomaszKr/Pesel.svg?branch=master)](https://travis-ci.org/TomaszKr/Pesel)

## Getting Started

Used this object for everytime when your project has number PESEL and you must valiadtion it.

### Required

```
PHP >= 7.1
```

### Installing

Go to your project directory where the ``composer.json`` file is located and type:

```
composer install tomasz-kr/pesel
```

## Running the tests

```
phpunit --configuration phpunit.xml 
```

## Overview

Firstly, create object Pesel and add in constructor number Pesel:
```
$pesel = new PESEL("NUMBER");
```

Now, you can take information about:

* Correct format
```
$pesel->isCorrectLenght(); //boolean
```

* Correct only number
```
$pesel->isCorrectNumber(); //boolean
```

* Correct for number controls
```
$pesel->valid(); //boolean
```

* Correct for exist in this day
```
$pesel->isCorrectDateNow();
```

* Correct for all condition 
```
$pesel->isCorrect(); //boolean
```

* Birthday
```
$pesel->getBirthday()->format("Y-m-d");
```

* Gender
```
$pesel->setTextForMan("Man");
$pesel->setTextForWoman("Woman");
$pesel->whatGender(); //return man or woman
```

* Correct year between 2 years (min and max)
```
$pesel->isCorrectYear(); //boolean
```
Default:
> Min has 1st January 1800 

> Max has this days 

* Set max year
```
$pesel->setManYear(\DateTime $dateTime);
```

* Set min year 
```
$pesel->setMinYear(\DateTime $dateTime);
```

## Author
[Tomasz Król](http://tomaszkrol.eu)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE.md) file for details