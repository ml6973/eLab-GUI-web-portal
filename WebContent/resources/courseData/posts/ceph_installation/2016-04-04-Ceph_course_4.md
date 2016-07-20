---
layout: post
title: Course 4 Deploying Ceph 
categories: ceph-install
author: 
description: Making file system and Deploying Ceph.
---




Deploying Ceph Packages on server :

After the reboot from last session, we are again logged in as root to 10.40.0.253 server which is our Ceph Monitor  

If you are not a root user, execute below command 

```sh
$ sudo su -
```
In last session we have partitioned the drive, now we will deploy XFS filesystem on it.    

```sh$
# mkfs.xfs -f /dev/sda1
```  

```sh$
# mkfs.xfs -f /dev/sdb1
```  

If you want to use other drives as Ceph OSD deploy filesystem on it using similar commamd.

To check if file system is deployed or not 

```sh$
# blkid
```

Make new directory for Ceph installation 

```sh$
# mkdir my-ceph
# cd my-ceph
```

Now execute below command one by one

```sh$
# yum install ceph*  -y
```

```sh$
# ceph-deploy new <hostname> 
```

```sh$
# ceph-deploy install <hostname> 
```

```sh$
# ceph-deploy mon create-initial 
```

Above command will create key pair for Ceph.

Now we need to prepare and activate the OSDs

```sh$
# ceph-deploy --overwrite-conf osd prepare <hostname>:/dev/sda1
```

```sh$
# ceph-deploy --overwrite-conf osd activate <hostname>:/dev/sda1
```

Follow same process for /dev/sdb1

```sh$
# ceph-deploy --overwrite-conf osd prepare <hostname>:/dev/sdb1
```

```sh$
# ceph-deploy --overwrite-conf osd activate <hostname>:/dev/sdb1
```

This will finish the **Ceph Deployment**

To check the ceph Health

```sh$
# ceph -s
```
Some other usefull commands for Ceph

```sh$
# ceph version
```

```sh$
# ceph osd tree
```

```sh$
# ceph mon stat
```


* * *
