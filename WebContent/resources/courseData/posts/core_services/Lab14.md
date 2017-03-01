---
layout: post
title: Lab 14 Horizon Dashboard - Swift as a User
categories: core_services
author: 
description: Horizon Dashboard - Swift as a User
---
  

* * *

#### Lab 14: Horizon Dashboard - Swift as a User #

* * *

# Table of Contents

* Introduction
* Creating a Container
* Uploading Objects in the Container
* Create a Pseudo Folder
* Download Objects from the Container
* Copy a Object
* Delete the Objects and Container
* Summary
* References

## Introduction
Recently, the widespread use of smart mobile devices, such as iPhone, iPad, Android phones and Windows family devices, has led to a great demand for cloud computing. 
Meanwhile, the local storages of these devices are limited, and the security of the files is not guaranteed. Therefore, there is a need to handle a massive amount of data kept on cloud storage efficiently

The OpenStack Swift distributed file system, stores files into different storage devices in the cluster instead of an exclusive or single server. To guarantee the quality of service (QoS), the distributed file system can also use the load balance scheduler to make every storage device handle the equal data access requirement


## Creating a Container
As you have already created an instance, now we will create a swift object storage container. A container is a storage compartment for your data and provides a way for you to organize your data. You can think of a container as a folder in Windows ® or a directory in UNIX ®. It will be attached to your instance like a external hard drive or a flash drive.

We will go to object storage section under project tab. Now click on containers. 
As we haven’t created any container. We will create one using “Create Container” option.

Let’s create a container named “OCI”. We will keep the container “Private”.  A Public Container will allow anyone with the Public URL to gain access to your objects in the container

Now we have created a container. 
However, you can create an unlimited number of containers within your account. Data must be stored in a container so you must have at least one container defined in your account prior to uploading data.

## Uploading Objects in the Container
 In order to upload objects to the container, we need to select the container. As I have clicked on “OCI”, we can see several options like “Create Pseudo-folder” and “Upload Objects” coming up on the screen. Now we will upload an object using “Upload Object” option.
 
As the description says, an object is the basic storage entity that represents a file you store in the OpenStack Object Storage system. 
When you upload data to OpenStack Object Storage, the data is stored without any compression or encryption and it consists of a location, the object's name, and any metadata consisting of key/value pairs. 

And we can always create a pseudo-folder within a container so that you can group your objects into pseudo-folders, which behave similarly to folders in your desktop operating system. We will create the pseudo-folder later. Let’s upload an object to the OCI container 1st. 

You can choose any file from your host machine. I have selected a text file.

Hit the “Upload Object” Button. 

So we have successfully uploaded the object to the container.


## Create a Pseudo Folder
Now we will look how to create a pseudo-folder inside “OCI” container.

Let’s create “UTSA” as a pseudo-folder.

Now you can see a pseudo folder named “UTSA” got created.

You can create as many nested pseudo folders you want.

Let’s upload some files in UTSA folder. Click on UTSA.

There are no objects as of now in this folder, lets upload some. We will upload a PDF this time. You can upload any file type.

So now you can see the PDF in UTSA folder.


## Download Objects from the Container
You can always delete or download as many number of objects you want. 
Let’s download the txt file we just uploaded.  Simply click on download button to download the object.


## Copy a Object
Before going to delete option, we will see how to copy a file from a container to another container or to a pseudo folder or within the same container.

If you want to select a different container, you can do it using the drop down list of destination container.

For now we will copy the file into UTSA pseudo folder. Hit “Copy Object”

Now let’s go the UTSA folder to check whether we have successfully copied the file or not.
 
Now here you can see the copy of the txt file.


## Delete the Objects and Container
Similarly you can delete the object using drop down list. Before you delete a container you need to delete all the objects and pseudo folders in the container.

## Summary

## References
* http://docs.openstack.org/developer/openstack-ansible/install-guide/index.html
