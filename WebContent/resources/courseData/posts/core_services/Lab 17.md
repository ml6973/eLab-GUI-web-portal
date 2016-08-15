---
layout: post
title: Lab 17 Command Line Interface - Keystone
categories: core_services
author: 
description: Keystone Command Line Interface
--- 
# Command Line Interface - KEYSTONE 

## TABLE OF CONTENTS

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

### Accessing your OpenStack environment
Let us first open a terminal window to connect to our OpenStack environment. In this case we have proceeded to install OpenStack using devstack in an all-in-one node. The three things you will require to connect to your environment are:  
User  
IP address of your OpenStack environment  
Private key corresponding to the public key provided during instance creation

In your terminal you can access your OpenStack environment by typing:

$ ssh ~/.ssh/cloud.key cc@129.114.110.19

### Authentication
Now that we have accessed our OpenStack environment, the first thing we need to do is to authenticate our OpenStack user credentials. To do so, lets change to the Devstack directory. In my case, I cloned this directory into my home folder:

$ cd ~/devstack  
Source credentials as an admin user and admin tenant by typing:  
$ source openrc admin admin

When you source your credentials, you are requesting keystone to provide you with a token that will allow you to work with the OpenStack Services Clients. These clients give you the ability to operate the command line interface for each one of these. In this case, let us use the keystone CLI to obtain information on the token being used for the admin user and admin tenant. Let us type:

$ keystone token-get

As we can observe on the output, the current used token has an expiration date, an ID, and is specific to a particular tenant and user. In this case admin and admin.

+-----------+----------------------------------+      
|  Property  |              Value               |  
+-----------+----------------------------------+  
|  expires    |       2016-07-05T21:48:05Z       |  
|     id          | 1dd3ac760e62499a9bd6a7e4c440be52 |  
| tenant_id  | a81bbfd1639b4fe7b1e450a4543b62ac |  
|  user_id    | 7715501ae459448ba5695cf6f659f39d |  
+-----------+----------------------------------+

### Tenants
By default, whenever installing OpenStack using devstack, a series of default tenants will be created. Within those, the admin tenant and demo tenant. We will focus our exercises on using the admin tenant to manipulate, create or delete other tenants. To get a list of tenants using keystone, we can use the command:

$ keystone tenant-list

In the output we will be able to obtain information for each tenant such as the tenant ID, tenant name, and information on whether the tenant is enabled or disabled for usage.

+----------------------------------+--------------------+---------+      
|                id                |        name        | enabled |   
+----------------------------------+--------------------+---------+   
| a81bbfd1639b4fe7b1e450a4543b62ac |       admin        |   True  |   
| ea90c53e3e4046ceb0d44dbad62a1c5d |      alt_demo      |   True  |   
| 25909d172093467187c5f76227f4f360 |        demo        |   True  |   
| b0e0db125e96421eb806766eec7f2cd6 | invisible_to_admin |   True  |       
| a0be7060d3894f5897660a91601259b9 |      service       |   True  |    
| 0644faa81fa1464380f4f821bd651fda |  swifttenanttest1  |   True  |   
| 8a50bcba63844f03be20fbe3748e4311 |  swifttenanttest2  |   True  | ----------------------------------+--------------------+---------+  

Let us say that we would like to obtain more information on the admin tenant. We can use the command:

$ keystone tenant-get <tenant ID>

You can also provide the <tenant name> instead of <tenant ID>.

This command will provide you with additional properties information of this tenant. As an example, whenever we requested a list of tenants, the description property was not displayed as it is in this case. This property is filled out by the admin during the creation of a tenant or while editing.

To create a new tenant (also known as project or account) you can use the command:

$ keystone tenant-create --name<tenant name>

The keystone tenant-create command only requires a tenant-name of your liking to create it; nevertheless, you can pass to this command additional parameters like description of the tenant or define to enable (or not) the tenant to be created by giving the options of true or false. As an example:

$ keystone tenant-create --name OCI2 --description “OCI tenant” --enabled true

If by any reason you would like to update the information on any tenant you can use the command:

$ keystone tenant-update <tenant ID>

There are different parameters that can be used to update the tenant such as the tenant’s name, the tenant’s description, or set the enabled flag to true or false. As an example let us update our recently created tenant

$ keystone tenant-update --name my-new-tenant --description "" --enabled false <tenant ID>

### Roles
By default, whenever installing OpenStack using devstack, a series of default roles will be created. Within those, the admin role, user role, and service role. To get a list of tenants using keystone, we use the command:

$ keystone role-list

The output will display a list of current roles and their corresponding ID


+----------------------------------+---------------+         
|                id                |      name     |    
+----------------------------------+---------------+    
| 1935a82f744d4874a183d238924bf61e |     Member    |    
| aaeb3a5a6602414bb4d1ea6f8ad7ab96 | ResellerAdmin |    
| 9fe2ff9ee4384b1894a90878d3e92bab |    _member_   |    
| b7ae6c37713f401ead7ee8925871a3a8 |     admin     |    
| aa78bb120b8f49d5a3e44324bd4ea1a9 |  anotherrole  |    
| 197d8b6be4834060916812feb18384ed |    service    |    
+----------------------------------+---------------+

The keystone service has its own role access policies. These policies determine which user can access which objects in which way, and are defined in the service's policy.json file.

Whenever an API call to an OpenStack service is made, the service's policy engine uses the appropriate policy definitions to determine if the call can be accepted. Any changes to policy.json are effective immediately, which allows new policies to be implemented while the service is running.

The keystone policy file can be found in:

$ /etc/keystone/policy.json

Let’s say that we would like to create a new role. We can use the command:

$ keystone role-create --name my-role

If we want to get detailed information about the role we just created, we can use the command:

$ keystone role-get <role ID>

This information is the same one that is displayed when you just created the role.

To delete the role we can use the command:

$ keystone role-delete <role ID>

### Users
In this section you will learn how to manage operations on users which include listing users, creating users, getting user information, deleting users, change a user’s password, list user’s roles, add a role to a user, remove a role from the user, and update a user’s information.

To obtain a list of current users we can use the command:

$ keystone user-list

In a default OpenStack installation using devstack, multiple users will be created such as an admin user, demo user, and users for the installed OpenStack services.

Let's see how you can create a new user. To create a new user let us type the command:

$ keystone user-create

You will notice that this command will give us an error since it requires us to pass additional arguments. The only required argument this keystone command requests is the --name. Arguments such as tenant, pass, email, enabled are optional. Lets us look a little bit deeper into this commands and see how they work.

Let us assume that we want to create a new user that is assigned to the demo tenant, give the password of mypassword and we want this user to be enabled immediately. To perform such action we need to use the command:

$ keystone user-create --name new-user --tenant demo --pass mypassword --enabled true

By pressing enter, a box containing different information properties of the new user will be shown. These properties are email, enabled, user ID, user name, tenant ID and the name of the user. If we wanted to get this same information for any other user we could use the command:

$ keystone user-get 006c14e6546e4cdc91d1ed9be45a7a7e

To give a new password to the user we can use:

$ keystone user-password-update --pass newpassword 006c14e6546e4cdc91d1ed9be45a7a7e

To list the roles assigned to a particular user we can use the command:   
$ keystone user-role-list

To add a new role to a user we can type the command:   
$ keystone user-role-add --user new-user --role Member --tenant demo

To remove a role from a user, we can use:    
$ keystone user-role-remove --user new-user --role Member --tenant demo

To update a user’s information, you can use:    
$ keystone user-update --name super-user --email new_email@oci.com --enabled false 006c14e6546e4cdc91d1ed9be45a7a7e

To validate the update of this information, we can use:  
$ keystone user-get 006c14e6546e4cdc91d1ed9be45a7a7e

Finally, to delete a user, we can use the command:   
$ keystone user-delete 006c14e6546e4cdc91d1ed9be45a7a7e

To validate that the user has been deleted we can use the command:   
$ keystone user-list

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
[Openstack Document](http://docs.openstack.org/ops-guide/ops_users.html#customizing-authorization)  
[Openstack Config file](http://docs.openstack.org/kilo/config-reference/content/policy-json-file.html)
