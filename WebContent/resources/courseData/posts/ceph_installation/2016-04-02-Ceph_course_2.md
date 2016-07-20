---
layout: post
title: Course 2 Basic Packages Installation  
categories: ceph-install
author: Swanand Mhalagi
description: We begin by installing some packages for single node Ceph installation.
---

[More info about Ceph](http://docs.ceph.com/docs/master/start/quick-ceph-deploy/)





This video discribes single node Ceph installation on CentOS 7 Bare Metal Chameleon cloud server:

10.40.0.253 > Ceph Monitor  

There is no minimum system requirment for ceph installation, you can also use Virtual Machines if you dont have acces to Bare Metal server/s. The server we are using as Ceph Monitor is having CentOS 7 and 16 HDDs (a to p) which will act as Ceph OSD. 

Now login to server 10.40.0.253 (This is a private ip. You will have public ip if you are using server from Rackspace, Amezon or Google) 
  
Now login as root using below command 

```sh
$ sudo su -
```
  
Install bellow mentioned packages:

```sh$
# yum install epel-release -y
```
```sh$
# yum install boost-devel* -y
```
```sh$
# yum install lttn* -y
```
```sh$
# yum install librados* -y 
```
```sh$
# yum install libceph* -y
```
```sh$
# yum install librbd* -y
```
```sh$
# easy_install ceph-deploy
```
```sh$
# yum install xfsprogs xfsdump -y
```
```sh$
# yum install nano -y
```


* * *
