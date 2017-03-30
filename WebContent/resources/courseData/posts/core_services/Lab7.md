---
layout: post
title: Lab 7 Horizon Dashboard - Cinder as an Admin
categories: core_services
author: 
description: Horizon Dashboard - Cinder as an Admin
---

* * *

#### Lab 7: Horizon Dashboard - Cinder as an Admin #

* * *

# Table of Contents
* Create and delete volumes
* Migrate Volumes
* Create and modify volume types
* Create QoS specifications

## Introduction
The Horizon dashboard interface, by default, allows the admin role to perform all the normal user role capabilities as well as a few extra. The user can create, delete, extend, and migrate their volumes, while the admin can do all of these things along with creating the volume types and managing the volume snapshots that are created.

## Creating and deleting a Cinder Volume
The main difference to the admin role is that there is a seperate tab available to the admin which contains the admin capabilities, while also having the normal user tab which allows them to create and interact with Horizon in a similar fashion as a user. The admin role should be just that, administrative, which means stepping in to maintain functionality or overseeing normal operations in general. As such, the admin has capabilities like deleting any of the users' volumes, detaching, migrating, and so on. The Horizon dashboard still may have a few problems from time to time, but the admin can easily go into console and issue commands to perform the functions. For CLI commands related to cinder, please refer the Cinder CLI tutorial. 

The admin role can use the project or admin tab to create volumes. To create a volume under the admin tab, select +Manage Volume and type in the information desired. 

Once the volume is created successfully, you may find that you no longer need it. To delete the volume simply locate and click the drop down menu associated with the offending volume and select 'delete volume'.	

## Migrate a volume
This function is simple for the admin. They may choose any volume and, using the drop down menu associated with it, select migrate volume. This function is similar to the user's ability to transfer a volume except the admin may choose the recipient and send it despite not being the creator of the volume.

## Create and modify volume types
This is a distinct capability of the admin role with regards to cinder. An admin may create a variety of volume types and Quality of Service specifications (known as QoS Specs). This allows the admin to make the best use of the hardware and/or limit users consumption of the assets. Creating a volume type is easy, but the documentation regarding keys and values for extra specs and QoS is limited. Both are for things like hardware segregation/aggregation and/or multi-backend operations. 

## Create QoS specifications
To create a QoS spec, navigate to volume types, within volumes. At the bottom of the volume types tab is a subsection that allows you to create, modify, and delete QoS specs for your needs.

## References

* http://netapp.github.io/openstack-deploy-ops-guide/icehouse/content/section_cinder-key-concepts.html
* https://wiki.openstack.org/wiki/Cinder_Backend_Activity_Attributes
* https://wiki.openstack.org/wiki/Cinder-multi-backend
* https://netapp.github.io/openstack-deploy-ops-guide/mitaka/content/cinder.examples.cinder_cli.html


