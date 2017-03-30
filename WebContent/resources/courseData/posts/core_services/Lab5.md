---
layout: post
title: Lab 5 Horizon Dashboard - Nova as an Admin
categories: core_services
author: 
description: Horizon Dashboard - Nova as an Admin
---

* * *
#### Lab 5: Horizon Dashboard - Nova as an Admin #
* * *

# Table of Contents
* Introduction
* Accessing the Horizon Dashboard
* Creating and Managing Instances
* Creating and Managing Flavors
* Quota
* Deleting an Instance
* Summary
* References

## Introduction

Welcome to the tutorial on Horizon Dashboard Nova. The openstack cloud operating system uses Nova to offer on-demand computing resources. It is OpenStack’s compute service project which is used for managing and hosting cloud computing systems. Nova is built using a component based architecture and it enables additions of new features with ease. When it comes to small deliveries/deployments, Nova along with its components share a centralized SQL based database. Whereas for bigger deployments, a system that aggregates data across the multiple stores needs to be used. 

Let us now familiarize with the Nova Service in the Horizon Dashboard:

## Accessing Horizon Dashboard
To access the horizon dashboard, type the IP address on your browser bar. Provide the credentials to the login page:

Username: admin
Password: secrete

Afterwards, click connect button. 

## Creating and Managing Instances
List Instances
Once you are in horizon dashboard, Follow the navigation:
Admin → System → Instances

The Instances screen will have the list of instances that are available currently. The table has Instance details: Project, Host, Name, Image name, IP Address, Size, Status of the instance, task, power state, time since created and also an action field that provides you an option to edit. 

Here the instance screen doesn't have any entry which means the instances are yet to be created. 

Now let us see the procedure to create an instance. 

### Create an Instance
Follow the navigation  

Project →  Compute → Instances

to reach the instance screen. 

To create an instance, click on the ‘Launch Instance’ button to launch an instance. 

In the screen that pops up, provide the details of the instance that you wish to create. Give a name for your instance. 

A flavor represents the hardware configuration of server. In the next field, choose a flavor from the drop down. 

The instance boot source is chosen as boot from image. And then choose the image in the next field from the drop down.

The Network tab is auto populated with the available network. 

Click on Launch button to launch an instance.

Once created, the success message that appears on the top right corner confirms the successful creation of the instance. 

### Edit Instance

To edit a created instance, we can use the Edit Instance button at the right side of the screen. 

It allows you to edit the name of the instance, and also the security groups. To save the changes, click on save button.


To view the end points, follow the navigation: 

Compute → Access & Security → API Access tab 

The access & security screen has the service name and its corresponding end point specified in here.

The hypervisor list can be found by navigating to :

Admin → System → Hypervisor

## Creating and Managing Flavors
 Flavor denotes the size of the instance to be launched. Server compute, memory and storage capacity of computing instances are defined using flavor. 
Follow the navigation: 

Admin → System → Flavor


### Create Flavor
To create a flavor, click on the button create flavor available at the top right corner of screen. 

Now let us provide the flavor name and other fields that are required to describe a flavor in the screen that has popped up. 

Click on create flavor button to create a flavor. 

### Delete Flavor

To delete a flavor, Click on the check box beside the flavor name. 

Click on the Delete Flavor button towards the top right corner of the screen. 

In the resulting pop up screen, confirm the name of the flavor that you need to delete. Click on the Delete Flavor button to delete the flavor. 

With the success deletion message , we can confirm that the flavor was deleted successfully.

## Quota
OpenStack services helps limit the resources for a tenant/project or even for a user. To access the Quotas for admin, follow the navigation: 

Identity → Projects -->Click Manage Members button for a particular project or you can click create project button on top right corner. 

Once clicked select the tab Quota from the new screen that has popped up. 

Let us take a look at the default quota fields:


**cores**: This represents the number of instance cores (VCPUs) allowed per project/ tenant.

**fixed-ips**: Fixed IPs are the number of fixed IP addresses allowed per project/tenant. Fixed IP number should be always equal to or greater than the number of  instances that are allowed per project/tenant.

**floating-ips**: This is the number of floating IP addresses per project/tenant.

**injected-file-content-bytes**: Is the number of content bytes allowed per injected file.

**injected-file-path-bytes**: Represents the injected file path length.

**injected-files**: This is the number of injected files per project.

**instances**: This is the number of instances allowed for a tenant.

**key-pairs**: Key- Pairs is associated with user. It denotes the number of key pairs allowed for a single user.

**metadata-items**: It is the number of metadata items for a single  instance.

**ram**: It represents the Megabytes of instance ram allowed per project / tenant.

**security-groups**: This is the number of security groups per tenant.

**security-group-rules**: Security group rules is the number of rules given for a single security group. 

## Deleting an Instance

Now let us see how to delete an instance. 
Choose the instance that you want to delete by checking the box adjacent to the instance that you want to delete.

And then click the terminate instance button on the top right corner of the screen to terminate the instance. 

The success message that appears on top right corner of the screen confirms the deletion of the instance. 

## Summary

Nova is OpenStack’s compute services. The horizon dashboard acts as a user interface that allows easy access and management of instances, flavors, security groups and its rules.

## References

http://blog.flux7.com/blogs/openstack/tutorial-what-is-nova-and-how-to-install-use-it-openstack
http://docs.openstack.org/admin-guide/cli_set_compute_quotas.html
