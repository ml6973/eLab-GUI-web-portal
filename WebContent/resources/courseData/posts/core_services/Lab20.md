---
layout: post
title: Lab 19 Command Line Interface - Cinder
categories: core_services
author: 
description: Cinder Command Line Interface
---

# Command Line Interface - CINDER 

## TABLE OF CONTENTS
* Introduction
* Cinder general commands
* Create cinder volume
* Attach volume
* Delete the volume
* Resize the volume
* Volume transfer

## Introduction
OpenStack Block Storage provides the software to create and manage a service that provisions storage in the form of block devices known as Cinder volumes. Block storage is a fundamental requirement for virtual infrastructures. Before block storage support was available, OpenStack virtual machines used so-called ephemeral storage, which meant the contents of the virtual machine were lost when that VM was shut down.

## Cinder General Commands
We will 1st check what version of cinder we have with this openstack setup. Let’s type the command ``` cinder --version```.
```sh
$cinder --version
```
As we have already created a volume using horizon dashboard, let’s check how it shows in CLI. Let’s do ``` cinder list```.
```sh
$cinder list 
```
OS images available to create a volume  ``` $nova image-list```
Let’s see what availability zone we have. Execute a command cinder availability 
```sh
$cinder availability-zone-list
```
So nova is the availability zone in which we will create our volume. 
We will use command glance image-list to check all the images available in this openstack.
```sh
$glance image-list
```
You can see we have 3 images which can be used to create a volume. We are going to use the 1st image. If you want to check more details about this image simply do glance image show followed by ID of the image which is b91db9eb... 
```sh
$glance image-show b91db9eb-95b7-4990-8622-9a5d576d3c61
```
## Create Cinder Volume 

Now we will create a cinder volume using CLI. The volume will be named as swan2. The command is cinder create followed by size of the volume and the image id which we got in previous command and finally the availability zone.
```sh
$cinder create 5 --display-name swan2 /
--image-id b91db9eb-95b7-4990-8622-9a5d576d3c61 --availability-zone nova
```
After executing this command, it will generate an output which gives all the details about this volume.
Cinder uses ``` default_volume_type``` which is defined in ``` cinder.conf``` during volume creation.
In our case, If you see the last line in the table about volume type, default volume type is ``` lvmdriver-1```  
Now we will check the cinder list again to check the cinder volume we just created 
```sh 
$cinder list
```
## Attach Volume
Here you will see that we have successfully created cinder volume swan2 
Now we will attach the volume we created to the instance. The syntax for this command is ``` nova volume-attach ``` followed by id of the server to which you want to attach the volume followed by id of the volume and the device name.
Let’s do cinder list and nova list to get the volume id and server id respectively
 ```sh
$cinder list   
$nova list  
$nova volume-attach 3e719d85-bla bla bla  16ea9c62  /dev/vdb
```
## Attach Volume
If you do cinder list you will see swan2 attached to a server and the status shows in-use. Now we will delete one of the volume, If you want to delete an already attached volume you 1st detach it from server using command nova volume-detach followed by id of the server and id of the volume. 
## Delete Volume
Now let’s use cinder delete command 
```sh
$cinder delete swan1
```
Now check if it’s successfully deleted or not by doing cinder list.
```sh
$cinder list 
```
## Resize the Volume
Now we will resize the volume, just like delete if you want to resize a volume which is already attached to a server then we need to detach it 1st using the similar command I just explained. Let’s resize the volume using command Cinder extend id of the volume as paramet followed by new size of the volume.
```sh
$cinder extend 88be01eb-5bad-4191-86ae-43f3f0b81c89 10   
```
Check if it is successfully detached or not by using command cinder list
```sh
$cinder list
```
The interesting feature about cinder is, You can transfer a volume from one owner to another by using the cinder transfer* commands. The volume donor,  creates a transfer request and sends the created transfer ID and authorization key to the volume recipient.
The command for this is cinder transfer-create followed by volume ID.
```sh
$cinder transfer-create 88be01eb-5bad-4191-86ae-43f3f0b81c89
```
## Volume Transfer
You can send the volume transfer ID and authorization key to the new owner, for example, by email. If you want to see pending transfers just do cinder transfer-list.
```sh
$cinder transfer-list 
```
To accept the transfer from someone just use the command cinder transfer-accept followed by transfer ID and authkey as parameters. If you want to delete any transfer we can just use command cinder transfer-delete followed by transfer ID.  
```sh
$cinder transfer-delete 821e18d3-87fb-47a4-b18a-7cd3a2c404bc
```

## Summary
In this tutorial you have learned how to use Openstack's Cinder services using comand line interface.

## Summary of Commands
cinder transfer-delete  
cinder transfer-list  
cinder transfer-create  
cinder list  
cinder extend  
cinder delete  
nova volume-attach  
cinder create  
cinder availability-zone-list  
cinder --version  
## References
[Openstack Document](http://docs.openstack.org/cli-reference/cinder.html)
