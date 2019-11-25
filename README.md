# Workflower with laravel. A Bussines Process Implementation with PHP

## Introduction

This project is an example of the integration of https://github.com/phpmentors-jp/workflower  BPMN 2.0 workflow engine for PHP with Laravel 5.8 Framework.

I used https://github.com/77web/workflower-bundle-playground example as a basis.

**IMPORTANT!!!** The phpmentor's source code has a fatal bug in the workflow deserializer method. That is the reason why i use a project's fork https://packagist.org/packages/tecnoenvio-koala/workflower.

The bpmn file can be viewed and edited with comunda modeler.

## The workflow example

![documentation/img/pullrequest_process.png](documentation/img/pullrequest_process.png)

In this example we create pullrequest. Participate two roles dev and reviwer. We have three task and one service task

The service tasks is not sopported by de visual editor but you can view and edit directly in the sourcecode.

## Screenshots

![lista de pullrequest creados](documentation/img/index.png)

![documentation/img/index.png](documentation/img/create.png)

![documentation/img/index.png](documentation/img/review.png)

![](documentation/img/fix.png)