---
layout: post
title: Lab 16 Command Line Interface - Keystone
categories: core_services
author: 
description: Keystone Command Line Interface
---
* * *
#### Lab 16 Command Line Interface - Keystone 
* * *

# Table of Contents

* Introduction
* Accessing your OpenStack environment
* Authentication
* Tenants
* Roles
* Users
* Summary
* Summary of Commands
* References

## Introduction
Welcome to the command Line Interface - keystone Lab. 

## Accessing your OpenStack environment
Let us first open a terminal window to connect to our OpenStack environment. In this case we have proceeded to install OpenStack using devstack in an all-in-one node. The three things you will require to connect to your environment are:  
User  
IP address of your OpenStack environment  
Private key corresponding to the public key provided during instance creation

In your terminal you can access your OpenStack environment by typing:
``` sh
$ ssh ~/.ssh/cloud.key cc@129.114.110.19
```

## Authentication
Now that we have accessed our OpenStack environment, the first thing we need to do is to authenticate our OpenStack user credentials. To do so, lets change to the Devstack directory. In my case, I cloned this directory into my home folder:
```sh
$ cd ~/devstack  
```
Source credentials as an admin user and admin tenant by typing:  
```sh
$ source openrc admin admin
```
When you source your credentials, you are requesting keystone to provide you with a token that will allow you to work with the OpenStack Services Clients. These clients give you the ability to operate the command line interface for each one of these. In this case, let us use the keystone CLI to obtain information on the token being used for the admin user and admin tenant. Let us type:
```sh
$ keystone token-get
```
As we can observe on the output, the current used token has an expiration date, an ID, and is specific to a particular tenant and user. In this case admin and admin.

## Tenants
By default, whenever installing OpenStack using devstack, a series of default tenants will be created. Within those, the admin tenant and demo tenant. We will focus our exercises on using the admin tenant to manipulate, create or delete other tenants. To get a list of tenants using keystone, we can use the command:
```sh
$ keystone tenant-list
```
In the output we will be able to obtain information for each tenant such as the tenant ID, tenant name, and information on whether the tenant is enabled or disabled for usage.

Let us say that we would like to obtain more information on the admin tenant. We can use the command:
``` sh
$ keystone tenant-get <tenant ID>
```
You can also provide the <tenant name> instead of <tenant ID>.

This command will provide you with additional properties information of this tenant. As an example, whenever we requested a list of tenants, the description property was not displayed as it is in this case. This property is filled out by the admin during the creation of a tenant or while editing.

To create a new tenant (also known as project or account) you can use the command:
``` sh
$ keystone tenant-create --name<tenant name>
```
The keystone tenant-create command only requires a tenant-name of your liking to create it; nevertheless, you can pass to this command additional parameters like description of the tenant or define to enable (or not) the tenant to be created by giving the options of true or false. As an example:
```sh
$ keystone tenant-create --name OCI2 --description “OCI tenant” --enabled true
```
If by any reason you would like to update the information on any tenant you can use the command:
```sh
$ keystone tenant-update <tenant ID>
```
There are different parameters that can be used to update the tenant such as the tenant’s name, the tenant’s description, or set the enabled flag to true or false. As an example let us update our recently created tenant
```sh
$ keystone tenant-update --name my-new-tenant --description "" --enabled false <tenant ID>
```
## Roles
By default, whenever installing OpenStack using devstack, a series of default roles will be created. Within those, the admin role, user role, and service role. To get a list of tenants using keystone, we use the command:
```sh
$ keystone role-list
```
The keystone service has its own role access policies. These policies determine which user can access which objects in which way, and are defined in the service's policy.json file.
Whenever an API call to an OpenStack service is made, the service's policy engine uses the appropriate policy definitions to determine if the call can be accepted. Any changes to policy.json are effective immediately, which allows new policies to be implemented while the service is running.

The keystone policy file can be found in:
``` sh
$ /etc/keystone/policy.json
```
Let’s say that we would like to create a new role. We can use the command:
```sh
$ keystone role-create --name my-role
```
If we want to get detailed information about the role we just created, we can use the command:
```sh
$ keystone role-get <role ID>
```
This information is the same one that is displayed when you just created the role.
To delete the role we can use the command:
```sh
$ keystone role-delete <role ID>
```
## Users
In this section you will learn how to manage operations on users which include listing users, creating users, getting user information, deleting users, change a user’s password, list user’s roles, add a role to a user, remove a role from the user, and update a user’s information.

To obtain a list of current users we can use the command:
```sh
$ keystone user-list
```
In a default OpenStack installation using devstack, multiple users will be created such as an admin user, demo user, and users for the installed OpenStack services.
Let's see how you can create a new user. To create a new user let us type the command:
```sh
$ keystone user-create
```
You will notice that this command will give us an error since it requires us to pass additional arguments. The only required argument this keystone command requests is the --name. Arguments such as tenant, pass, email, enabled are optional. Lets us look a little bit deeper into this commands and see how they work.

Let us assume that we want to create a new user that is assigned to the demo tenant, give the password of mypassword and we want this user to be enabled immediately. To perform such action we need to use the command:
```sh
$ keystone user-create --name new-user --tenant demo --pass mypassword --enabled true
```
By pressing enter, a box containing different information properties of the new user will be shown. These properties are email, enabled, user ID, user name, tenant ID and the name of the user. If we wanted to get this same information for any other user we could use the command:
```sh
$ keystone user-get 006c14e6546e4cdc91d1ed9be45a7a7e
```
To give a new password to the user we can use:
```sh
$ keystone user-password-update --pass newpassword 006c14e6546e4cdc91d1ed9be45a7a7e
```
To list the roles assigned to a particular user we can use the command:
```sh
$ keystone user-role-list
```
To add a new role to a user we can type the command:   
```sh
$ keystone user-role-add --user new-user --role Member --tenant demo
```
To remove a role from a user, we can use:    
```sh
$ keystone user-role-remove --user new-user --role Member --tenant demo
```
To update a user’s information, you can use:    
```sh
$ keystone user-update --name super-user --email new_email@oci.com --enabled false 006c14e6546e4cdc91d1ed9be45a7a7e
```
To validate the update of this information, we can use:  
```sh
$ keystone user-get 006c14e6546e4cdc91d1ed9be45a7a7e
```
Finally, to delete a user, we can use the command:   
```sh
$ keystone user-delete 006c14e6546e4cdc91d1ed9be45a7a7e
```
To validate that the user has been deleted we can use the command:   
```sh
$ keystone user-list
```
We can observe that super-user is no longer listed

## Summary
In this lab, we covered how to use Keystone’s command line interface to list, update, create and delete tenants, roles and users.

## Summary of Commands    
$ keystone token-get   
$ keystone tenant-list   
$ keystone tenant-create   
$ keystone tenant-update   
$ keystone role-list   
$ keystone role-create   
$ keystone role-get   
$ keystone role-delete   
$ keystone user-list   
$ keystone user-create   
$ keystone user-get   
$ keystone user-password-update   
$ keystone user-role-list   
$ keystone user-role-add   
$ keystone user-role-remove   
$ keystone user-update   
$ keystone user-delete   

## References
* [Openstack Document](http://docs.openstack.org/ops-guide/ops_users.html#customizing-authorization)  
* [Openstack Config file](http://docs.openstack.org/kilo/config-reference/content/policy-json-file.html)
