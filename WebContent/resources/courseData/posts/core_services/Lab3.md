---
layout: post
title: Lab 3 Installing OpenStack (AIO) using DevStack
categories: core_services
author: 
description: Installing OpenStack (AIO) using DevStack
---
* * *
#### Lab 3: Installing OpenStack (AIO) using DevStack #
* * *

## Table of Contents

* Updating the Environment
* Cloning the Devstack Repository
* Creating the Devstack Configuration File
* Validating the OpenStack Installation
* Summary
* Summary of Commands
* References

## Updating the Environment
Once you accessed your instance, the first thing to do is to update our environment. To do so in an Ubuntu OS use:
```sh
$ sudo apt-get update
```
This procedure might take a while depending on the amount of packages to be be updated. After the update has been finished, proceed to install git, python-pip and vim by using the command:
```sh
$ sudo apt-get install -y git python-pip vim
```
Explain why should local.conf be created on devstack directory
Starting the OpenStack Liberty release, OpenStack requires Python 3 to properly install the cloud system since many services started targeting for Python 3. Once the installation process finishes, we need to upgrade python with the command:
```sh
$ sudo apt-get upgrade -y python
```
Now that we have upgraded python we are ready to clone DevStack’s repository. DevStack is a set of scripts and utilities to quickly deploy an dev OpenStack cloud. As an example let us clone the devstack repository from the liberty release using git by typing:

## Cloning the Devstack Repository
```sh
$ git clone https://github.com/openstack-dev/devstack.git -b stable/liberty
```
After cloning , access the cloned directory. In this case I have cloned the repository into ``` /home/cc/```. In order to access the directory, we can type the following command:
```sh
$ cd /home/cc/devstack
```
## Creating the Devstack Configuration File
In this directory we need to create the Devstack configuration file for the Devstack installer. To create it, we can use the command:
```sh
$ touch local.conf
```
The ``` local.conf``` file is a modified INI format file that introduces a meta-section header to carry additional information regarding the configuration files to be changed.
The header is similar to a normal INI section header but with double brackets ([[ ... ]]) and two internal fields separated by a pipe (|). Example:
```sh
'[[' <phase> '|' <config-file-name> ']]'
```
The <phase> can be one of a set of phase names defined by stack.sh. On the other hand the <config-file-name> is the configuration filename. The filename is evaluated in the stack.sh context so all environment variables are available and may be used. Using the project config file variables in the header is strongly suggested. If the path of the config file does not exist it is skipped.

The defined phases are:

local - extracts localrc from local.conf before stackrc is sourced   
post-config - runs after the layer 2 services are configured and before they are started   
extra - runs after services are started and before any files in extra.d are executed   
post-extra - runs after files in extra.d are executed   

The file is processed strictly in sequence; meta-sections may be specified more than once but if any settings are duplicated the last to appear in the file will be used.
Now that we have created our DevStack configuration file, let us proceed edit it and define the configuration of our OpenStack environment. To do so, let us start by accessing the file with our prefered editor. In this case I will use vi:
```sh
$ vi local.conf
```
Now we will start our configuration file with our header. In this case we will use the local phase and the localrc configuration file name:
```
[[local|localrc]]
```
Next we need to define the passwords for the admin tenant, database, rabbitmq, openstack services and a random service token. To define these we can input them by:

ADMIN_PASSWORD=secrete   
DATABASE_PASSWORD=secrete   
RABBIT_PASSWORD=secrete   
SERVICE_PASSWORD=secrete   
SERVICE_TOKEN=a682f596-76f3-11e3-b3b2-e716f9080d50
  
We define the base for the repositories:

GIT_BASE=https://git.openstack.org

Finally we define which services we want to enable or disable on our environment:

### Disable Nova Networks
disable_service n-net
### Enable Horizon Dashboard
enable_service horizon
### Enable Neutron
enable_service q-svc      
enable_service q-agt      
enable_service q-dhcp     
enable_service q-l3    
enable_service q-meta   
enable_service neutron   
### Enable Swift
enable_service s-proxy      
enable_service s-object   
enable_service s-container   
enable_service s-account   
SWIFT_HASH=8213897fads879789asdf789  
### Define the number of Swift Replicas
SWIFT_REPLICAS=3
### Enable Load Balancer as a Service
enable_service q-lbaas
### Enable Firewall as a Service
enable_service q-fwaas
### Enable VPN as a Service
enable_service q-vpn
### Use linux bridge as our Neutron Agent
Q_AGENT=linuxbridge

We save the changes we have made to our file and exit.

Back on the devtsack directory located at:
```sh
$ /home/<user_name>/devstack
```
We now list the files contained in this directory by using:
```sh
$ ls
```
You will be able to see the file named stack.sh. Let us start the installation of OpenStack using DevStack by running this file:
```sh
./devstack/stack.sh
```
This might take a few minutes depending on the instance or server you are using. At the end of the installation you will be able to see a message stating the host IP address, the horizon dashboard endpoint, the keystone service endpoint, the default users, the access password and the time it took to complete the installation:

This is your host IP address: 10.40.1.117   
This is your host IPv6 address: ::1   
Horizon is now available at http://10.40.1.117/dashboard   
Keystone is serving at http://10.40.1.117:5000/   
The default users are: admin and demo   
The password: secrete   
2016-07-21 20:40:39.758 | stack.sh completed in 1237 seconds.  

## Validating the OpenStack Installation

To verify if your openstack environment is working properly we will once again access the devstack folder and source the credentials for one of the default users and one of the default tenants.

As it was stated previously, the default users are admin and demo. Also, the default tenants are admin and demo. Since admin user has an admin role, it can have control over admin tenant and demo tenant; on the other hand, demo user can only have access to demo tenant.

To source the credentials for a particular user and tenant, you need to use the openrc file by using the source command:
``` sh
$ source openrc <user name> <tenant name>
```
An example to source the credentials for the admin user so it can perform actions in the demo tenant we can use:
```sh
$ source openrc admin demo
```
If we wanted to source the credentials for the admin user so it can perform actions in the admin tenant we would use:
```sh
$ source openrc admin admin
```
Let’s source the credentials for admin user and admin tenant.
Afterwards we will use the openstack client to obtain a catalog of openstack services available in this deployment. To do so, we can type the command:
``` sh
$ openstack catalog list
```
With this, we will obtain a list of services, the type of service and the endpoints of each one of these.

## Summary
Now that you have your own OpenStack testing environment you can start exploring different things such as:  
The functionality of a Cloud System   
Explore the functionality of each of the OpenStack services   
Experiment with the CLI   
Experiment with API calls   
Debug the system   
Change the code and submit bug fixes   

## Summary of Commands
Some of the commands we used in this lab were:
Edit your devstack configuration file
```sh
$ vi local.conf
```

Start installation
```sh
$ ./devstack/stack.sh
```

Source credentials
```sh
$ source openrc <user name> <tenant name>
```

Obtain the openstack catalog information
```sh
$ openstack catalog list
```

## References
http://docs.openstack.org/developer/devstack/
