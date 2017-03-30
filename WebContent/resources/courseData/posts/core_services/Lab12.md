---
layout: post
title: Lab 12 Horizon Dashboard - Cinder as a User
categories: core_services
author: 
description: Horizon Dashboard - Cinder as a User
---

* * *

#### Lab 12: Horizon Dashboard - Cinder as a User #

* * *

# Table of Contents
* Introduction
* Creating a cinder volume.
* Editing the volume.
* Resizing the volume
* Snapshot of the volume
* Volume transfer
* Attaching volume
* Deleting the volume

## Introduction
Block storage is a type of data storage typically where data is stored in volumes, also referred to as blocks. Each block acts as an individual hard drive. Because the volumes are treated as individual hard disks, block storage works well for storing a variety of applications such as file systems and databases. While block storage devices tend to be more complex and expensive than file storage, they also tend to be more flexible and provide better performance.

## Creating a Cinder Volume
As you have already created an instance, now we will create a cinder block storage volume. It will be attached to your instance like a external hard drive or a flash drive. We will go to volumes section under compute tab.  Here you will see the options like create volume and accept transfer.We will look into this options one by one. 

Let’s create a volume 1st. Click on create volume. Now a pop up window will open. We just need to fill in the blanks. Very easy.

Let’s type in the volume name as OCI. You can put any description as per your choice. 

Volume source ---

We will select the default type lvmdriver-1. Select the size as per your requirement. You can always extend the volume size. And the default availability zone is Nova in our project. 
Now click on create volume. And the volume will get created within few secs. 

## Editing the Volume
Now we will take a look into options such as edit volume for the OCI volume is just created.
Click on Edit Volume, a pop up window will open. 
Here you can change the name and description of the volume we just created.

## Resizing the Volume
If you click on the down arrow near edit instance, you will see other options such extend volume, manage attachments, create snapshots, change volume type, upload image, create transfer and delete volume. We will look into these one by one.

If you click on extend volume you will get another popup window. We will extend the volume  to 10GB. 
Now the volume size is changed to 10GB. 

## Snapshot of the Volume
Before going to 2nd option we will check the 3rd option of creating a snapshot. Volume snapshot saves all the data with your current settings so that you can create similar volume in future. 
We will give some name and description to this snapshot
Now it’s creating a volume snapshot for us.

Change volume type ---   
Upload to image ---

## Volume Transfer
You can always transfer your volume to someone else in another project. This can be done using create volume transfer option. We will give the transfer name as OCI volume transfer. Hit create volume transfer button. 
We have successfully created a transfer, acceptor needs the transfer ID and Authentication key in order to accept of this volume. You can send this key using email or any other method. 
Now the volume is waiting for transfer, you can anytime cancel the transfer.

Now let’s consider someone have sent you the transfer and authentication ID and if you want to accept the transfer you can simply click on accept transfer button. So for now I have canceled the the transfer.

## Attaching Volume
Now let’s go to the 2nd option in drop down menu i.e Manage attachments. Here you can attach the cinder volume we just created to an instance. 
Now select the name of the instance from the dropdown list to which you want to attach the volume. Hit the attach volume button.

Now you can check the updated window of volumes tab, and the “Attached To” column shows the name of the instance it attached to.  

Now if you check the dropdown menu near edit instance, you will see lasser options as you have attached the volume to the instance. Now you can not extend the volume as you have attached it to an instance neither transfer it to other projects either. You can always dis-attach the volume and then extend it and transfer to some other projects.

## Deleting Volume
Now let’s see how to delete a volume.

## Summary 

## References

* http://docs.openstack.org/developer/openstack-ansible/install-guide/index.html
