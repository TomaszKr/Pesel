# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [3.0.0] - 2026-05-18

### Fixed
- Fixed PHPUnit deprecation warnings by updating configuration schema to version 10.5
- Resolved assertEquals/assertSame usage in test files
- Corrected return type of getNumber() method from int to string
- Updated all dependencies to latest versions

### Changed
- Migrated phpunit.xml configuration to use latest schema
- Improved test suite configuration
- Updated Dockerfiles to include required zip packages for Composer

### Removed
- Removed deprecated configuration options that caused warnings

## [2.0.1] - 2025-01-15

### Fixed
- Minor bug fixes in date validation logic
- Improved error handling for invalid PESEL numbers

## [2.0.0] - 2024-12-01

### Added
- Support for PHP 8.x
- Enhanced data validation and error handling
- New methods for gender text customization

### Changed
- Refactored class structure for better maintainability
- Updated documentation and examples

### Removed
- Support for older PHP versions (PHP 7.4 and below)