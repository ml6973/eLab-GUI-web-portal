---
layout: post
title: Lab 11 Horizon Dashboard - Glance as a User
categories: core_services
author: 
description: Horizon Dashboard - Glance as a User
---

#### We followed, abridged, and skipped around the guide laid out at: # [http://docs.openstack.org/developer/openstack-ansible/install-guide/index.html](http://docs.openstack.org/developer/openstack-ansible/install-guide/index.html)

  

* * *

#### Lab 11: Horizon Dashboard - Glance as a User #

* * *

# TABLE OF CONTENTS

* Introduction
* Accessing Horizon Dashboard
* List Images
* Create Images
* Edit Images
* Delete Images
* Summary


Welcome to the Horizon Dashboard Glance Tutorial. 

We assume you have the basic knowledge about openstack and its services.

## Introduction
Glance is OpenStack’s Image Service. It imparts discovery, registration and delivery services for server and disk images. It is the core openstack service which allows the creation of virtual disk images and storing them. The images that are stored can be used as templates which the clients can use to get a new server up and running easily. The virtual machine images can be stored in backends, local file systems, or even in the openstack object storage - Swift. 

Glance image services uses a client-server architecture which allows you to have a REST API. It can be used to respond to the requests to the server.

Let us now familiarize with the Glance Service in the Horizon Dashboard:

## Accessing Horizon Dashboard
To access the horizon dashboard, type the IP address on your browser bar. Provide the credentials to the login page:

Username: demo
Password: secrete

Afterwards, click connect button.

## List Images
Once you are in the horizon dashboard, follow the navigation: 

Within demo, Project → Compute → Images

The Image screen shows the list of images that are available currently. The table has Image details: Project, Image name, Type, Status of the image, whether the image is Public or  Protected, the format of the image, the size of the image and also an action field that provides you an option to edit image/ launch instance. 

Let us now show you the procedure to create an Image: 

## Create Image
To create an image, Click on the button ‘Create Image’ on the top right corner of the screen.

In this screen that has popped up, provide a name for your image, a description-describing the image that you are going to create, in the next field - choose an image source as Image File( If you have the image saved in the local machine) or Image Location ( If you have an external HTTP URL from which the image can be loaded from). For example, the ubuntu cloud image for trusty server is available at :https://cloud-images.ubuntu.com/trusty/current/trusty-server-cloudimg-amd64-disk1.img


The kernel field is meant for AMI style image. It denotes the ID of the image stored in glance.


Minimum Disk denotes the minimum disk size required to boot the image and Minimum RAM denotes the minimum memory size. 

Public checkbox is checked only if the image can be shared with all other tenants. By default, the access is provided ONLY for Admin.

If you have checked Protected,  the image will be prevented from getting deleted. 

Once the image details are provided, click on Create Image button to create an image.  

After clicking on the create image button, check if you get the success message on the top right corner for the image created. Now you will get to see the image created among the list of other images. 


## Edit Image
Now let us see the procedure to edit an image. Click on the drop down beside the Launch Instance button on the action field. The options that pops up here are: Create Volume, Edit Image and Update Metadata. Now click on the Edit Image option to edit the image.

In the resulting screen that pops up, you can edit/update name, description, format, minimum disk, minimum RAM, and also specify/ update if image is public or protected.

Once updated, you need to click on Update Image to save your changes.In order to confirm that the changes are saved, check for the “Success: Image was updated successfully” message towards the top right corner of the screen.

## Delete Image
When it comes to deleting an image, a demo user do not have the permission to delete an Image. Only an admin user has the access to delete the image.

Login using the demo credentials: 

Username: demo
Password: secrete

Once you are in the horizon dashboard, follow the navigation: 

Within demo, demo→ System → Images


To delete an image, select the image you wish to delete by checking on the box adjacent to project names on the screen.

Once selected, click on the Delete Image button on top right corner of the screen. The pop up screen will now ask you to cross check the name of the image to be deleted. If you have selected the right one, proceed by clicking on Delete image button.

A success message will appear on the top right corner of the screen to confirm the successful  deletion of the image.

## Summary
To summarise, Glance is the only image service for openstack. 
Within demo project, go to project and then Image list can be accessed within the compute tab. The Horizon Dashboard manages images using the functionalities that allows you to manage the virtual disks and servers. A demo user do not have the permission to delete an image, but can list, create and edit images. 
