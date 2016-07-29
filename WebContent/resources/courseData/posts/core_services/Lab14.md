---
layout: post
title: Lab 14 Horizon Dashboard - Cinder as a User
categories: core_services
author: 
description: Horizon Dashboard - Cinder as a User
---

#### We followed, abridged, and skipped around the guide laid out at: # [http://docs.openstack.org/developer/openstack-ansible/install-guide/index.html](http://docs.openstack.org/developer/openstack-ansible/install-guide/index.html)

  

* * *

#### Lab 14: Horizon Dashboard - Cinder as a User #

* * *

First, you need to identify the allocation of the rack and servers you desire to use. We would like to keep the ip's chosen for our elements in a contiguous range. For our case, we designed our setup as follows:

10.241.1.54 > Storage/Cinder

10.241.1.55 > Infrastructure 1

10.241.1.56 > Infrastructure 2

10.241.1.57 > Infrastructure 3

10.241.1.58 > Compute Node 1

10.241.1.59 > Logging/HA Proxy

  

This arrangement is the bare minimum needed for an iteration of an openstack cloud. Three(3) infrastructure nodes are required for Galera to operate in a highly available manner;otherwise, a single infrastructure node can be used. Generally speaking, Galera will operate best with an odd number of infrastructure nodes.

  

Next, we need to verify if the 10-Gigabit network interface is enabled for each node (this is needed for our servers to talk to each other) and whether or not each node has a 1 gigabit network interface for external communication. Use the following command to determine the hardware configuration for each node:

```sh
$ lshw -C Network
```
  

Determine which interfaces match the MAC address of 10-Gigabit network interface using the following:

```sh
$ ip a
```
  

The output for the previous command will give a lot more information than is needed for our purposes, but the pertinent information within will read as the following:

10.241.1.54 Storage eth1 is 10G

10.241.1.56 In the Infra 2 case, the eth2 is 10-Gigabit network interface.

10.241.1.58 Compute eth1 is 10G

10.241.1.59 Logging/HAProxy eth1 is 10G

  

For each node, you need to ensure that the 10-Gigabit interface is up, if it is down (note that we use eth2 for our case). Replace with the interface that corresponds to your 10g interface:

```sh
$ ip link set dev eth2 up
```
  

Next, use the following command to verify the current state of the interface (up or down). It is a best practice to always verify that your work is completed even after having just recently executed a command. This is done for each node as well:

```sh
$ ip a s <interface>
```

* * *
