---
layout: post
title: Lab 2 Creating a Local Testing Environment
categories: core_services
author: 
description: Creating a Local Testing Environment
---

## Lab 2: Creating a Local Testing Environment #

* * *

## Install VirtualBox
Open the web explorer of your preference and access:


https://www.virtualbox.org/


Click on the link Downloads. For your particular host system, choose whichever is the appropriate option for you to download. So if you are running windows you click on the windows link, if you are using Mac you will click on the OS X hosts link, etc.

Here we are running OS X 10 so we will click on the corresponding link. Choose to save that file, click ok and we will come back to this in a minute.

Let me show you how we did the installation on my MAC.

There aren’t any major installation differences for the other platforms. All the defaults will work for the installation. However you may need to reboot after installing vagrant, this will depend on how the kernel drivers were configured before the installation. Vagrant installs new ones and messes with things a bit in a way that might require you to reboot. 

Once you have downloaded the file, access the folder where the file was downloaded. In my case, this folder will be the downloads folder. In order to run Vagrant you need to have VirtualBox accessible but it doesn’t make a difference which you install first. Nevertheless, you can’t run vagrant before virtualbox is installed.

Double click on the VirtualBox installation file. The process may be a little bit different depending on the host you may be using. Again, this is the process whenever you run the installation on a MAC. 

As it says here, let us double click on the icon VirtualBox.pkg, press continue and it will take you through the installation process.

The first step you will see is the Introduction, press continue. In Installation Type you can change the installation location but there is no need so we can use the default location and proceed to just click on Install. 

Once we have VirtualBox Installed, we are ready to install Vagrant. 


## Install Vagrant

Access the vagrant web site using the following url:

https://www.vagrantup.com/


From the top navigation menu select downloads and since I am using a MAC I am going to click on the Universal (32 and 64 bit) download. Afterwards I will proceed to save the file. 

Access the folder where the Vagrant Installation file was downloaded to. Depending on the operating system you are using this procedure might be different. On Mac OS X, double click on the Vagrant.pkg icon and follow the installation procedure. 

Create a new directory to store the configuration files

Once VirtualBox and Vagrant had been successfully installed, we can proceed to create our first instance.

Open a terminal and change to the directory of your preference. In this case, we are accessing the Desktop directory with: 

> $ cd ~/Desktop/

## Creating a new directory

> $ mkdir my-instance-test

Change to this directory

> $ cd my-instance-test

## Vagrant Commands

Next, we need to add a vagrant box containing an operating system of our preference but before that, let us get a list of the current boxes in our system by using the command:

> $ vagrant box list

We obtain a message stating that there are no installed boxes.

To explore the boxes that Vagrant provides, access this link:

https://atlas.hashicorp.com/boxes/search


To add a box, we need to explicitly indicate vagrant the user name and the box name we desire to add. If you go back to your explorer, you will be able to see in the first link the ubuntu box, which contains one of the most popular operating systems, provided by the ubuntu user. To add this box to our system, back on our terminal we type the command:

> $ vagrant box add ubuntu/trusty64

Let us verify if the box has been downloaded:

> $ vagrant box list

Now let’s initialize the folder as being a new vagrant instance and indicate the box we want to use:

> $ vagrant init ubuntu/trusty64

This command created a Vagrant file on your current directory, we can validate by listing the contents of our directory:

> $ ls

Let us proceed to configure our project by first opening the Vagrantfile.

> $ vi Vagrantfile

In this file you will be able to view, modify, add or remove different configuration settings. As an example we can view the following:


 The box used by vagrant for this project
config.vm.box = "ubuntu/trusty64"
The forwarded port mapping which indicates the port you can use to access the machine
config.vm.network "forwarded_port", guest: 80, host: 8080
The IP assigned to this vm assigned by Vagrant from the virtual private network
config.vm.network "private_network", ip: "192.168.33.10"
The provisioning of a GUI
vb.gui = true
The amount of memory ram assigned to this vm, which in this case this is not being taken into account because this section is commented. If we want vagrant to take this configuration to our VM, we need to uncomment the sections starting with:
config.vm.provider "virtualbox" do |vb|
 
vb.memory = "1024"
We can also edit this section of the Vagrantfile and customize in a different manner to define the amount of memory and cpus we would like this VM to use. To do se edit the config.vm.provider section:

config.vm.provider "virtualbox" do |v|
     v.customize ["modifyvm", :id, "--memory", "2048"]
     v.customize ["modifyvm", :id, "--cpus", "2"]
end


To save this changes, since we are using vi editor, we need to type ESC and then :wq

Now it is time to launch our vm by using the command:

> $ vagrant up

This process might take some time whenever you are running it for the first time, specially if the base box wasn’t added previously as we indicated in the first steps of this lab. Now that your vm has been built, lets proceed to access it.

The next step we want to do is to access our vm. To do so, use the following command if you are using a terminal in a linux host environment:

> $ vagrant ssh

If everything works properly you will now have access to your ubuntu 14.04 vm. To verify this we can check the following command to get the release information of this operating system:

> $ lsb_release -a

In addition we can validate the number of processors that we requested for this vm by typing the following command:

> $ cat /proc/cpuinfo | grep processor | wc -l

Or if we want to validate the amount of memory we requested we can use:
> $ cat /proc/meminfo

With this process we have created an Ubuntu 14.04 virtual machine on top of my host operating system which in my case is OS X 10

In case you are using a Windows hosts, I strongly recommend you to download Putty, which is an SSH client. You can get this client from:
 
http://www.putty.org/


In the Putty login screen, you will need to use the following parameters to access your:

HostName:127.0.0.1 (localhost)
Port: 2222 (ssh port is 22)
User: vagrant
Password: Vagrant 

Now let's exit our Ubuntu vm by typing:

> $ exit

Once we have exited our VM and come back to our OS X 10 host, we can use a variety of commands to control the state our our vm.

To suspend the vm we can use:

> $ vagrant suspend

To wake up our system we can use:

> $ vagrant resume

Let’s request vagrant to gracefully shut down our system by using:

> $ vagrant halt

If for any reason this command does not shuts down your vm, you can add the force flag to it which will literally plug out the power cord from the vm:

> $ vagrant halt --force

To bring up your vm and access it again we can use again the commands:

> $ vagrant up
> $ vagrant ssh

Now let us exit the vm. In this moment my vm is still running since I haven’t used the halt command to shutdown the instance.

Let us access our home directory and if we access the VirtualBox VMs directory we will be able to see an additional directory with the name of our vm. This folder contains the disk image for the virtual box we created.

## Destroy the vagrant vm

Now let’s go back to out terminal to show you how we can destroy destroy our VM. Don’t be nervous about it, we can create and destroy these types of machines as many times we want. During this process vagrant first checks if our vm is running, which in this case it is.To do so, we use the command:

> $ vagrant destroy

Am you sure you want to destroy the VM? Type:

> $ Y

Following your confirmation, it will first shot down the machine and destroy the contents and files associated with it.

To confirm this we can access again our Home Directory and then access the VagrantBox VMs to look at its contents. As we can see, there are no additional directories inside it containing any disk images.

If you were to create another vm, you will see another directory corresponding to the vm containing the disk image for the particular virtual box.

## Summary

Install VirtualBox
Install Vagrant
Create a new directory to store the configuration files
Run vagrant commands
Destroy the vagrant vm
Vagrant Commands
vagrant init
vagrant up
vagrant ssh
vagrant halt
vagrant suspend
vagrant resume
vagrant destroy

#### References

https://drupalize.me/videos/installing-vagrant-and-virtualbox?p=1526
