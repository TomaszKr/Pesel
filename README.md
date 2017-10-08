# Validation Pesel
Check it is correct number Pesel


## Getting Started

Used this validation for everytime when your project has number PESEL and you must valiadtion it.

### Required

```
PHP >= 7.1
```

### Installing

Go to your project directory where the ``composer.json`` file is located and type:

```
composer install tomaszkr/pesel
```

## Running the tests

```
./vendor/bin/phpunit  --bootstrap vendor/autoload.php tests
```

## Overview

Firstly, create object Pesel and add in constructor number Pesel:
```
$pesel = new PESEL("NUMBER");
```

Now, you can take information about:
* Correct format
```
$pesel->isCorrectLenght();
```
* Correct only number

```
$pesel->isCorrectNumber();
```
* Correct for number controls
```
$pesel->valid();
```
* Correct for exist in this day

```
$pesel->isCorrectDateNow();
```
* Correct for all condition 

```
$pesel->isCorrect();
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

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details