---
layout: post
title: Course 3 Preparing Drives for Ceph Installation
categories: ceph-install
author: 
description: Create partition on the drives.
---




This video explains about how to create partition for using them as Ceph OSD:

We are still logged in as root to 10.40.0.253 server which is our Ceph Monitor  

As we discussed in previous video, this server has total 16 drives but for the experiment purpose we are using only 2 of them as Ceph OSD.    
  
If you are not a root user, execute below command 

```sh
$ sudo su -
```

To check all the drivers attached 

```sh$
# lsblk
```
Now You can see all the 16 drives here and one more drive having our OS installed
  
Creating Partition:

For /dev/sda we will follow manual partition method

```sh$
# fdisk /dev/sda
```
Now type in few options in the order given below one by one

```sh$
m
n
p
1
press ENTER
press ENTER
w
```

To automate this process for /dev/sdb

```sh$
# (echo m; echo n; echo p; echo 1; echo; echo; echo w) | sudo fdisk /dev/sdb 
```

You can use above command just by changing the device name for rest of the 14 drives. 

Now we need to add the IP and host name in hosts file. The host name appears as follows on your system

```sh$
root@ceph1:~#
```

Here **ceph1** is the host name

```sh$
# nano /etc/hosts
```

Don't use floting/public IP. Do **ip a** to get static IP. 

```sh$
10.40.0.253 ceph1
```

Now we need to reboot the server

```sh$
# reboot
```


* * *
