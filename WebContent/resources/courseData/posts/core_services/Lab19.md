---
layout: post
title: Lab 19 Command Line Interface - Swift
categories: core_services
author: 
description: Swift Command Line Interface
---
* * *
#### Lab 19: Command Line Interface - Swift 
* * *

# Table of Contents

* Introduction
* Swift general commands
* Creating a container
* Uploading objects in the container
* Download objects from the container
* Container permissions
* Delete the objects and container

## Introduction
Swift is OpenStack’s highly available, distributed, eventually consistent object store service. Organizations can use Swift to store lots of data efficiently, safely, and cheaply.

Let us now begin exploring the Swift Command Line Interface. First you will need to access your openstack environment and source your credentials as admin user and admin tenant. In your terminal type
```sh
$ ssh -i ~/.ssh/cloud.key cc@129.114.110.44
$ cd ~/devstack
$ source openrc admin admin
```
Now that you are in the Openstack environment, we can proceed with using the nova command line interface.
To start off, let’s check the swift version first by using the command: 
```sh
$swift --version
``` 
To list all swift capabilities we can use the command: $swift capabilities  
This command displays cluster capabilities. The output includes the list of the activated Swift middlewares as well as relevant options for each ones. Additionally the command displays relevant options for the Swift core. 
We can also take a look at all the statistics of OpenStack swift using swift stat command:  
```sh
$ swift stat
```
It will show you number of containers and objects present in this project. We can observe that there is one container in our Swift Service, to find out the name of our container we can use the command 
```sh
$ swift list
```
To obtain the status of this particular container we can use the command:
```sh
$ swift stat UTSA
```
On the slides --  To see size in human readable form ``` $swift stat --lh ``` 
Let's now obtain a list of objects within this container using the command
```sh
$swift list UTSA
```
As you can see, we have one object named public-key. If you want to see the details like size of the file in the container, the time and the date we uploaded them. We simply use ``` $swift list UTSA --lh ```
Now we will create a new container using CLI command. The syntax for this command is swift post followed by whichever name of the container you want. I am creating a container named OCI.
```sh
$swift post OCI
```
Check whether we have created the container successfully or not. Let’s do swift list for that.
```sh
$swift list   
```
Now upload a file to the container we created, to perform this action we can use swift upload OCI which is our new container followed by the name of the file which you want to upload. 
```sh
$swift upload OCI setup.py
```
Now check the list of objects inside the OCI container using the command: 
```sh
$swift list OCI
```
If the file size is too large we can upload the file in chunks using command ``` swift upload -s``` chunk size followed by container name and file name.  
```sh
$swift upload  OCi -S <chunk size>   <name of the file>
```
If you want to skip uploading identical files 
```sh
$swift upload --skip-identical OCI setup.py 
```
Upload file that are changed since last upload 
```sh
$swift upload -c OCI setup.py 
```
If you want to download the file we just uploaded, swift has very simple command swift download, the name of the container followed by name of the file.    
```sh
$swift download OCI setup.py
```
To download all the contents within our containers in our tenant we can simply use
```sh
$swift download --all
```
To download the all the objects within a container
```sh
$swift download OCI
```
Below command gives permissions to read all the content of OCI container to all the users in demo projects.   
```sh
$swift post OCI -r “demo:*”
```
To give permissions to a specific user  
```sh
$swift post OCI -r “demo:user1”
```
To give permissions to a multiple projects / multiple user
```sh
$swift post OCI -r “demo:user1, demo:user2, demo1:, demo3:user1 ”
```
To give write permissions -- change -r to -w
```sh
$swift post OCI -w “demo:*”
$swift post OCI -w “demo:user1”
$swift post OCI -w “demo:user1, demo:user2, demo1:, demo3:user1 ”
```
If you want to delete any file or object you uploaded then simply use command swift delete, the name of the container followed by file name.
$swift delete OCI setup.py
So let’s verify this using swift list command. 
```sh
$swift list OCI
```
You will be able to see the file is now removed from the container.
Now let’s delete the container, we will use simple command swift delete and name of the container.
```sh
$swift delete OCI
```
## Summary
In this tutorial you have learned how to use Openstack service project Swift through command line interface.

## Summary of Commands
Some of the commands we used during this lab are:  
swift stat  
swift list  
swift post  
swift upload  
swift download  
swift delete  

## References:
* [Openstack Reference](http://docs.openstack.org/cli-reference/swift.html)



