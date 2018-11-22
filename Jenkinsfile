node {
    stage("composer_install") {
        // Run `composer update` as a shell script
        sh 'php composer install'
    }
    stage("phpunit") {
        // Run PHPUnit
        sh 'vendor/bin/phpunit'
    }
}
