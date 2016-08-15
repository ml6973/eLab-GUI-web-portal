---
layout: post
title: Lab 18 Command Line Interface - Nova
categories: core_services
author: 
description: Nova Command Line Interface
---

# Command Line Interface - GLANCE 

## TABLE OF CONTENTS

* Creating and Managing Instances
* Nova Services
* Flavors
* Quotas
* Keypairs
* Security Groups
* Summary
* References

Welcome to the Glance Command Line Interface eLab. 

We assume you have the basic knowledge about openstack and its services. 

## Introduction 

Nova is an OpenStack project designed to provide power that is massively scalable, on demand, and self service access to compute resources. 
Let us now begin exploring the Nova cli. First you will need to access your openstack environment and source your credentials as admin user and admin tenant. 
In your terminal type 

```sh
$ ssh -i ~/.ssh/oci-openstack.pem cc@129.114.110.61
```
```sh
$ cd ~/devstack
```
```sh
$ source openrc admin admin
```

Now that you are in the Openstack environment, we can proceed with using the nova command line interface.
## Creating and Managing Instances
### Listing Instances
So let us see if we have any instances booted already. You can use the command:
```sh
$ nova list
```
As we see there are no entries in any of the columns. This is because we have not not booted any instance. So, let us now go ahead and boot a new instance. 

### Creating an Instance
To create an instance you can use the command:
```sh
$ nova boot ABC --flavor m1.tiny --image cirros-0.3.4-x86_64-uec
```
As you can see that we have specified some of the parameters like --flavor and --image for our instance. This are optional arguments. To get a full list of optional arguments you could use:
```sh
$ nova help boot
```
Basically you could use $ nova help (command) for getting the positional and optional arguments for any nova command.
To get a list of available images, you can use the command:
```sh
$ glance image-list
```
At any point of time, to get details on the instance that you created you can use the command:
```sh
$ nova show <instance ID>
```
### Manipulating an instance
To pause an instance, run the following command:
```sh
$ nova pause <name-of-the-instance>
```
This command stores the state of the VM in RAM. A paused instance continues to run in a frozen state.To unpause an instance, run the following command:
```sh
$ nova unpause <name-of-the-instance>
```
To stop or start an instance you can use the command:
```sh
$ nova stop <name-of-the-instance>
$ nova start <name-of-the-instance>
```
To suspend or resume an instance, you can use the command:
```sh
$ nova suspend <name-of-the-instance>
$ nova resume <name-of-the-instance>
```
You can change the size of the instance by changing its flavor, to perform this action, you can use the command
```sh
$ nova resize <name-of-the-instance> <size-to-be-resized-to>
```
To confirm the resize you can use the command:
```sh
$ nova resize-confirm <instance ID>
```
If by any reason the resized instance does not work for you as expected you can use the command:
```sh
$ nova resize-revert <instance ID> 
```
To view the console-log of an instance, you can use the command:
```sh
$ nova console-log <instance id>
```
If you ever want to check the credentials of the user logged in. You can use the command:
```sh
$ nova credentials
```
## Nova Services
To see the list of all the nova services, you can use the command:
```sh
$ nova service list
```
To get a list of hypervisors available, you can use the command:
```sh
$ nova hypervisor-list
```
To get a list of host, you can use the command:
```sh
$ nova host-list
```
## Flavors
When we created our instance “ABC”, we used a --flavor parameter m1.tiny. To get a list of all the flavors that you can use, you can type:
```sh
$ nova flavor-list
```
This table gives you the list of different flavors and also the amount of memory and disk it has. To get detailed information on a particular information, you can use the command:
```sh
$ nova flavor-show m1.tiny
```
We also specified the image when we created our instance. To get a list of the images we have, we can use the command:
You can also create your own flavor using the command:
``` sh
$ nova flavor-create <favor-name> <flavor-id> <RAM in MB> <Root Disk in GB> <VCPU>
```
You can also delete a flavor using the command:
``` sh
$ nova flavor-delete <flavor-id>
```
## Quotas
As an administrative user, you can use the nova quota-* commands to update the Compute service quotas for a specific tenant or tenant user, as well as update the quota defaults for a new tenant.
You can list all default quotas for all tenants by using the command:
``` sh
$ nova quota-defaults
```
You could list the currently set quota values for a tenant by using the command:
``` sh
$ nova quota-show --tenant admin
```

## Keypairs
You can print a list of keypairs for a user by using the command:
``` sh
$ nova keypair-list [--user <user-id>] <name>
```
You can also add and delete Keypairs with a new servers
``` sh
$ nova keypair-add [--pub-key <pub-key>] [--key-type <key-type>] <name>
$ nova keypair-delete <name>
```
## Deleting an instance
You can delete an instance by using the command:
``` sh
$ nova delete <name-of-instance>
```

## Summary
In this tutorial we have learnt used the nova CLI to  
Boot an instance   
Manipulate an instance  
View the nova services   
View and modify the security groups  
Delete an instance

##References   
[Openstack Document](http://docs.openstack.org/cli-reference/nova.html)
