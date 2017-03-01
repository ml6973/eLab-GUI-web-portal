---
layout: post
title: Lab 15 Command Line Interface - Glance
categories: core_services
author: 
description: Glance Command Line Interface
---
* * *
#### Lab 15: Command Line Interface - Glance 
* * *

# Table of Contents

* Available images
* Getting Images
* Create an Image
* Image Deactivate
* Reactivate Image
* Updating an Image
* Tags
* Image Delete
* Summary
* Glance Commands
* Sources


 
Welcome to the Glance Command Line Interface eLab. 

We assume you have the basic knowledge about openstack and its services. 

## Introduction 

The Glance project provides a service where you can upload and discover data assets that are meant to be used with other services. This currently includes images and metadata definitions. Glance image services include discovering, registering, and retrieving virtual machine images. Let us see how we can proceed with performing these tasks.
First you will need to access your openstack environment and source your credentials as admin user and admin tenant. You have already done this in the keystone tutorial.

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

Now that you are in the Openstack environment, we can proceed with using the glance command line interface. Glance is the reference implementation of the OpenStack Images API. As such, Glance fully implements versions 1 and 2 of the Images API.

Currently Nova uses the Images v1 API, but work is in progress to convert Nova (and other OpenStack services that consume images) to using the Images v2 API. Once that occurs, it will be possible to deploy OpenStack without deploying the Images v1 API. At that point, the Images v1 API will be deprecated, following the standard OpenStack deprecation policy. The glance command line utility interacts with OpenStack Images Service (Glance).

## Available images
To view the existing images you can use the command:

```sh
$ glance image-list
```

You will now see a list of images that are already present in a tabular form with the attributes of the image name and the image ID.

Running this command displays the list of images with their names and unique ID. If you run this same command using a version 1 image API, you can use: 

```sh
$ glance --os-image-api-version 1 image-list
```

As you can see in the version 1 API you can see some extra attributes about the image like Disk format, Container format, Size and Status.

## Getting Images
There are many images that you can use for instance like CentOS, CirrOS, Ubuntu, Debian etc. Each of these have their own resource from which you can download them. For example, to view the current cloud images for Ubuntu you could browse:

```sh
https://cloud-images.ubuntu.com/trusty/current/
```

```sh
$ glance --os-image-api-version 1 image-list
```
Let us download a few Ubuntu images. First we create a directory to save these downloaded images on our instance.

Now we get the image into the directory. You can use

```sh
$ wget https://cloud-images.ubuntu.com/trusty/current/trusty-server-cloudimg-amd64-disk1.img
```

## Create an Image

Let us now use this downloaded image to create a new glance image. The following command shows you how to create a glance image using version 2 API

```sh
$ glance --os-image-api-version 2 image-create --protected False --name ubuntu-14-04-V2 --min-disk 2 --visibility private --tags ubuntu --disk-format qcow2 --min-ram 1024 --container-format bare --file ~/downloaded_images/trusty-server-cloudimg-amd64-disk1.img --progress
```

As you can see we have set many of the parameters of this image like –protected, --name, --visibility, --tags, --disk-format, --min-ram, --container-format, --file, --progress. Let us look at one more way of creating an image with version 1 image API and using a location url. Here you find that you can directly specify the “location” parameter which is a url from which the image can directly be downloaded. If you take a look at the displayed table, you can see that there is a “Property column” and a “Value” column. The properties are all the optional arguments that you can modify or set for the image that you created. This parameter was not available when you used the same command with image version 1 API.  You can use the command:

```sh
$ glance --os-image-api-version 1 image-create --name "ubuntu-14-04" --disk-format qcow2 --container-format bare --is-public False --location
```

To see the optional parameters you can always use the command
```sh
$ glance help image-create
```
You can also see the parameters for the glance command by typing 
```sh
$ glance (return key)
```

This command will give you an error but it will also give you a list of parameters that you can use with the glance command.

Now that you have created two glance images using two different methods, let us take a look at our list of images. You can use the command:

```sh
$ glance image-list
```
Now that we have uploaded images, if you want to download one of these images on your instance so that you can reuse them,you could use the command:

```sh
$ glance image-download 257520b3-22cd-49f0-bf8d-b958292941e3 > cirros-0.3.4-x86_64-uec.ami 
```

## Image Deactivate
You can deactivate an image by using the command. 

```sh
$ glance image-deactivate <image id>
```
To check the status of this image and verify that it has been deactivated you can use the command

```sh
$ glance image-show <image id>
```
This command gives a detailed description of the image that you have referenced with you’re the image ID


## Reactivate Image
Now that you have deactivated this image if you wish to reactivate it you could use the command

```sh
$ glance image-reactivate <image id>
```

## Updating an Image
You can update any of the attributes of the image for example here we are going to change the name from cirros-0.3.4-x86_64-uec to XYZ that has been created by using the command:

```sh
$ glance image-update <image ID> --name XYZ
```

You can see that the image name has been changed. Likewise, you can change other attributes too.

## Tags
You can also add tags as metadata to the images that you create. You can use the command:

```sh
$ glance image-tag-update <image ID> --name XYZ
```
You can also delete the tag that you have created using the command

```sh
$  glance image-tag-delete <image id> ABCtag
```

## Image Delete
You can delete the image you created by using the command glance image-delete and specifying the image id:

```sh
$ glance image-delete <image id>
```
So now when you do a glance image-list you can see that the image you created has been deleted

## Summary
In this tutorial we have seen the two versions of the image API and how to use the glance CLI to:

* List available images
* Download and Upload images
* Create an Image
* Delete an image
* Deactivate and Reactivate an Image
* Update an Image
* Add Tags to an image

## Glance Commands Summary

* glance --os-image-api-version 1 image-list
* glance image-create <parameters>
* glance image-deactivate <image-id>
* glance image-show <image-id>
* glance image-reactiactivate <image-id>
* glance image-update <image-id> <parameter to be updated>
* glance image-delete <image-id>

## References
* [Openstack Doc](http://docs.openstack.org/icehouse/training-guides/content/operator-getting-started.html)
* [Deploying OPenstack](https://www.safaribooksonline.com/library/view/deploying-openstack/9781449311223/ch03.html)
* [Architecture](http://docs.openstack.org/developer/glance/architecture.html)

