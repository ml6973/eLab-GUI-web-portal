---
layout: post
title: Lab 5 Horizon Dashboard - Glance as an Admin
categories: core_services
author: 
description: Horizon Dashboard - Glance as an Admin
---

* * *
#### Lab 5: Horizon Dashboard - Glance as an Admin #
* * *

# Table of Contents

* Introduction
* Accessing Horizon Dashboard
* List Images
* Create Image
* Edit Image
* Delete Image
* Summary
* References


## Introduction 
Glance is OpenStack’s Image Service. It imparts discovery, registration and delivery services for server and disk images. It is the core openstack service which allows the creation of virtual disk images and storing them. The images that are stored can be used as templates which the clients can use to get a new server up and running easily. The virtual machine images can be stored in backends, local file systems, or even in the openstack object storage - Swift. 

Glance image services uses a client-server architecture which allows you to have a REST API. It can be used to respond to the requests to the server.

Let us now familiarize with the Glance Service in the Horizon Dashboard: 

## Accessing Horizon Dashboard
To access the horizon dashboard, type the IP address on your browser bar. Provide the credentials to the login page:

Username: admin
Password: secrete

Afterwards, click connect button. 

## List Images
Once you are in the horizon dashboard, follow the navigation: 
Within admin, Admin→ System → Images

The Image screen shows the list of images that are available currently. The table has Image details: Project, Image name, Type, Status of the image, whether the image is Public or  Protected, the format of the image, the size of the image and also an action field that provides you an option to edit image. 

## Create Image

Let us now show you the procedure to create an Image: 
To create an image, Click on the button ‘Create Image’ on the top right corner of the screen. 

In this screen that has popped up, provide a name for your image, a description-describing the image that you are going to create, in the next field - choose an image source as Image File( If you have the image saved in the local machine) or Image Location ( If you have an external HTTP URL from which the image can be loaded from). For example, the ubuntu cloud image for trusty server is available at :[images](https://cloud-images.ubuntu.com/trusty/current/trusty-server-cloudimg-amd64-disk1.img)

The kernel field is meant for AMI style image. It denotes the ID of the image stored in glance.
Minimum Disk denotes the minimum disk size required to boot the image and Minimum RAM denotes the minimum memory size. 

Public checkbox is checked only if the image can be shared with all other tenants. By default, the access is provided ONLY for Admin.

If you have checked Protected,  the image will be prevented from getting deleted. 

Once the image details are provided, click on Create Image button to create an image.  

After clicking on the create image button, check if you get the success message on the top right corner for the image created. Now you will get to see the image created among the list of other images. 


## Edit Image
Now let us see the procedure to edit an image. An image can be edited using the Edit Image button available at the right side of the screen. In the resulting screen that pops up, you can edit/update name, format, minimum disk, minimum RAM, and also specify/ update if image is public or protected. 

Once updated, you need to click on Update Image to save your changes.In order to confirm that the changes are saved, check for the “Success: Image was updated successfully” message towards the top right corner of the screen. 

## Delete Image
Now let us see the steps to delete an image.
In order to delete an image, select the image you wish to delete by checking on the box adjacent to project names on the screen. 

Once selected, click on the Delete Image button on top right corner of the screen. The pop up screen will now ask you to cross check the name of the image to be deleted. If you have selected the right one, proceed by clicking on Delete image button. 

You need to check for the success message which appears on the top right corner to confirm the deletion of the image. 

## Summary
To summarise, Glance is the only image service for openstack. 
Within Admin project, go to admin and then glance can be accessed within the System tab. The Horizon Dashboard manages images using the functionalities that allows you to list, create, edit and delete images of the virtual disks and servers. 

## References
* [Openstack Doc](http://docs.openstack.org/icehouse/training-guides/content/operator-getting-started.html)
* [Deploying OPenstack](https://www.safaribooksonline.com/library/view/deploying-openstack/9781449311223/ch03.html)
* [Architecture](http://docs.openstack.org/developer/glance/architecture.html)

