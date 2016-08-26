---
layout: post
title: Lab 19 Command Line Interface - Neutron
categories: core_services
author: 
description: Neutron Command Line Interface
---
* * *
#### Lab 19 Command Line Interface - Neutron 
* * *

# Table of Contents

* Listing Networks
* Creating a Public Network
* Creating a Public Subnet
* Creating a Private Network
* Creating a Private Subnet
* Creating a Router
* Adding Interfaces Between Router and Subnets

Welcome to the Neutron Command Line Interface eLab. 

We assume you have the basic knowledge about openstack and its services. 


## Introduction

If you want to be familiar with pretty much everything related to Networking in Openstack, knowing Neutron is mandatory. Neutron is Openstack’s networking service. It’s built to deliver Networking-as-a-Service (NaaS) in cloud environment. It enables you to create and manage network objects which include but are not limited to networks, subnets and ports that other services of OpenStack can use. It brings ease of use to the network operators by providing a “plug in” mechanism to facilitate different networking equipment or software providing flexibility to Openstack architecture and deployment [1].  

Let us now begin exploring the Neutron CLI. First you will need to access your openstack environment and source your credentials as admin user and admin tenant. 

In your terminal type
```sh
$ ssh ~/.ssh/cloud.key cc@<Your Instance IP>
$ cd ~/devstack
$ source openrc admin admin
```

Now that you are in your Openstack environment, we can proceed with using the Neutron command line interface.

###Listing Networks
One of the first commands you should learn on Neutron’s CLI is the command used to list networks:
```sh
$ neutron net-list
```
###Creating a Public Network
The first step that we need to follow whenever we start creating our first functional network topology is the creation of our own Public Network. The public network needs to be created based on the physical network where your OpenStack environment is deployed.
```sh
$ neutron net-create --shared --provider:network_type flat --provider:physical_network flat --router:external public_network
```
###Creating a Public Subnet
The previous command will only add a new entry in the sql database. To complete the specifications of this network, we need to create a subnet where we specify the address of the physical gateway, the address of the dns name server, the physical address of our network, and the range of Public IP addresses we have obtained from our Internet Service Provides that we will be able to use as floating IPs. As an example:
```sh 
$ neutron subnet-create --name public_subnet --gateway 17.200.0.1 --allocation-pool start=17.200.50.2,end=17.200.50.255 --dns-nameserver 8.8.8.8 public_network 17.200.0.0/16
```

###Creating a Private Network
Private network creation can be performed with user or admin credentials. This depends on the permissions defined in the policy.json file in Neutron. Let us proceed to create a private network by using the command:
```sh
$ neutron net-create my-private-network
```

###Creating a Private Subnet
In the same manner as we experienced in the public network, the above command will only create a database entry.

To specify the details of our private network, we need to create a subnet for this private network. The specifics of this private subnet do not need to be based on the physical network as this network will only be used by neutron as an internal network. To create a subnet, we can simply use the command:
```sh
$ neutron subnet-create my-private-network --name my-private-subnet --gateway 192.168.0.1 192.168.0.0/24
```

###Creating a Router
Now that we have created our Public and Private networks, we need to proceed to create a router that will enable communication between both of them. To create our router we can use the command:
```sh
$ neutron router-create my-router
```

###Adding Interfaces Between Router and Subnets
Note that this will only create the router but so far there is no connectivity between this and any of the previously created networks. To create the connectivity we need, we require to add interfaces from the router to our networks. We can proceed to create these interfaces by using the commands:
```sh
$ neutron router-interface-add my-router my-public-subnet
```
This will create an interface that will be attached to the public subnet.
```sh
$ neutron router-interface-add my-router my-private-subnet
```
This will create an interface that will be attached to the private subnet.
Neutron Networking Lesson


First of all we will be utilizing 3 terminals for this lesson.

Terminal 1.- Infrastructure Node / Utility Container
Terminal 2.- Compute Host
Terminal 3. Infrastructure Node / Neutron Agents Container

1. Step

A. Terminal 1.- Infrastructure Node / Utility Container

$ neutron net-list
$ neutron net-show <ID>

Description:

- Get the list of networks
- We do not know much about these
- We can get additional information with neutron net-show

$ neutron net-show my-public-network

Characteristics
admin_state_up and provider attributes will not be shown to the user but these tells us important information
provider: network_type - Tells us that the type of network is flat so there is no VLAN tagging
provider: physical_network - Tells us that the physical network main is flat. It is a label that has been given to describe an interface. In the neutron ml2 configuration file is going to be a mapping there that maps the name flat with some ethx physical interface.
provider: segmentation id - Used to describe the L2 segmentation ID of the network. Flat network has no tagging so it has no segment ID. A VLAN network would have a VLAN ID, a VXLAN network would have a VNI, GRE would have some other kind of segmentation.
router: external - Tells us that this network is eligible for purposes of floating IP pool so you can attach your routers with the "$ router gateway-set" command to neutron networks that have this property set to "True". If "False" you could not attach your router to that network as a Gateway Network.
The difference between provider network (public) and tenant network is that administrators can describe the type of network they are creating. Tenant users cannot. There are configuration files buried in neutron where we can define the type of networks neutron get to create. It is in order list, so if a user ends all the VXLAN networks the next one they might use is GRE, VLANs and so on.
shared - Means that any project means that any project can access this network and users can see it in the neutron net-list. If "False" this network is only visible to a particular tenant. There is neutron RBAC (Liberty) gives you the ability to define a policy that says these particular tenants can see this network, not all tenants. There are some neutron RBAC commands that you can use.

$ neutron net-show my-private-network

Characteristics
provider:network_type | vxlan - Does not have a physical network mapping and has a segmentation ID of 80 (VXLAN-VNI). If you were to do a packet capture you will see that the header would have that 80 in there. All your vxlan traffic between hosts traverses through a single interface. Each host has what is called a vxlan tunnel endpoint address. It is all UDP traffic. So imagine a packet from a vm that traverses this vxlan interface, gets encapsulated with vxlan headers that describe and segment this traffic out. So this VM is connected to a neutron network that is connected to a bridge that corresponds to vxlan 80 and all traffic from that VM is encapsulated. Any other VM in network 80 would be in the same broadcast domain network. There are about 16 million unique combinations of VNIs you can have. The default range is from 1:1000, once you get to 1000 networks you get an error that says no more networks available.
Neutron Availability Zones - New in mitaka, compared to nova previously neutron did not have a concept of AZs. If you had instances that you wanted to separate into availability zones, the networks would have to span those AZs. Where as you could say that this VM can land on the RED zone and not the YELLOW zone, but you wanted a RED and a YELLOW VM to be on the same network, the network has to span those zones.
If you had a network that you wanted it limited to a subset of servers, let's just say that it is whatever you want to use to segment AZs for, but you can describe that in neutron so if you spun up a VM and tell it "Go to the RED zone" and you gave it a particular network. If that network is not trunked to any of those compute hosts you will have connectivity issues.


With Neutron AZs you now have the ability to state that a certain networks only exists on these zones so nobody can schedule an instance to a nova AZ and have connectivity problems because that network is not set up over there.  



--------------------------------------------------
2. Step

A. Terminal 1.- Infrastructure Node / Utility Container

$ neutron subnet-list

Description:


Our subnets show us that they belong to the previously stated networks. 


You are able to see the allocation pools which are basically the DHCP pools for that subnet. Neutron will only handout addresses within this allocation pool.


You can have other servers using an IP within the range of your network that are not even living in this particular openstack environment.

--------------------------------------------------
3. Step

A. Infrastructure Node / Utility Container

$ neutron port-list

Description:


Think of neutron in the port database as if it was a huge logical switch.


Unlimited amount of ports in this logical switch.


Ports define your mac address. This mac address in the port list is the mac address that your instance will have. If I assign a port to a VM, inside the VM this mac address will correspond to this virtual port. These describe the virtual nic. Every port corresponds to a virtual network, every port is associated with one or more subnets, and is associated with a very particular ip address. 


Whenever you create an instance, Nova will ask Neutron to create a port in the network that you specified. Neutron will go into it's database and pull the next available IP for allocation and build this port record that is going to describe to us. There is no pool for the MAC address, there is only a prefix which states that all mac addresses will start with f6:16:3e and the rest is randomly generated but there are checks to ensure that they do not overlap.


--------------------------------------------------
4. Step

A. Infrastructure Node / Utility Container

$ neutron port-show <your-port>

Description:

Port have attributes that will describe subnet, ip_address, mac address, network associated with, security groups associated with the port, the infra node where this port was configured, and other attributes that depend on the driver that you have.
If you use OVS:
binding:vif_type      | ovs 
binding:vif_details   | {"port_filter": true, "ovs_hybrid_plug": true} 
If you use Linux bridge:
binding:vif_type      | bridge 
binding:vif_details   | {"port_filter": true}
Anyone who is using the ml2 framework will populate these accordingly.

--------------------------------------------------
5. Step

A. Infrastructure Node / Utility Container

$ neutron port-create <UUID of Private Network>

Description:


Let's create a port on the private network


binding:vif_type      | unbound - Not associated


It has a fixed IP 192.170.0.7 from the only subnet associated with the network


You can have more than 1 subnet. This happens in the cases where the users have consumed all IPs in a subnet, you might need to create a second subnet in that network which will be attached to a router.


Mac Address is automatically assigned


Status down because is not plugged into anything
--------------------------------------------------
6. Step

A. Infrastructure Node / Utility Container

$nova boot --image ubuntu\ 14.04 --flavor m1.medium --nic port-id=<Port ID> my-little-instance

Description:


Whenever you are creating an instance you can specify a network or a port.


We will specify that port to nova

If you want to specify the network (having multiple) you need to specify the network


If you only have one network, that network will be chosen by default.

When I created the port it was assigned to the default security group.

--------------------------------------------------
7. Step

A. Infrastructure Node / Utility Container
$ nova show <Instance ID>

Description:

Provides you with information where your instance was created
OS-EXT-SRV-ATTR:hypervisor_hostname  | uthscsa-4

IP Address which is the one assigned by neutron previously to the port we assigned to this instance
my-private-network network           | 192.168.0.3 

No information on the port-id or mac address associated with this instance.

--------------------------------------------------
8. Step

A. Infrastructure Node / Utility Container

$ neutron port-list --device_id=<Instance ID>
$ neutron port-show <Port ID>


Description:

Let's assume that you have hundreds of ports. You can filter by instance id.

You can then use neutron port-show <Port ID> to get information on this port.

You can now see that the port status is active now and this will only occur once it has been verified that these actions have taken place on the compute node. Verification that takes place that it was connected/plugged in. Not always a 100% accurate

status                | ACTIVE

Shows the host id and should be consistent:

OS-EXT-SRV-ATTR:hypervisor_hostname  | uthscsa-4
binding:host_id       | uthscsa-4 

--------------------------------------------------
9. Step

A. Infrastructure Node / Utility Container

B. Compute Host

From the infrastructure node, you can ssh into the host by using as an example:

$ ssh rack3-19

OS-EXT-SRV-ATTR:host                 | rack3-19

Get a list of VMs
$ virsh list

You will be able to see a list of instances that are being hosted in this compute node. This can be listed by using:
$ nova show <instance-uuid>

OS-EXT-SRV-ATTR:instance_name        | instance-00000005

You can also view the xml file details corresponding to that particular instance in the directory specified:
$ cd /opt/stack/data/nova/instances/<Instance ID> (DevStack)
$ /var/lib/nova/instances/<Instance ID> (OpenStack)
$ cat libvirt.xml



In the network interfaces type you will find the following information:
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    <interface type="bridge">						
      <mac address="fa:16:3e:eb:50:75"/>		MAC
      <model type="virtio"/>						Type of NIC
      <driver name="qemu"/>						
      <source bridge="qbrd6765467-2a"/>		Bridge that is going to connect to
      <target dev="tapd6765467-2a"/>			The name of the tap interface
    </interface>										
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This file provides us with a large amount of detailed information of the instance such as memory, name, network infoo, mac of the instance, type of nic, the bridge that it connects to and the name of the tap interface. The tap interface has a name with a prefix "tap" and an alphanumeric 9 character.
- The alphanumeric corresponds to the PORT ID <d6765467-2ab6-4a65-83e1-2302d0242a34> attached to our instance.
If we were to look for our bridge by using on the compute node:
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$ brctl show
brqc31c1b60-1e		8000.f6e39ceca55d	no		tap5a86dc32-c7
							Vxlan-80
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You will be able to see a bridge connected to the tap interface. This bridge ID corresponds to the private network ID. To verify, type on your utility container the following:
$ neutron net-list | grep <Bridge ID Alphanumeric Termination>

In case you had an instance of every node connected to this same private network, you would be able to see that this same bridge in every compute node.

--------------------------------------------------
11. Steps

A. Infrastructure Node / Utility Container

We could get the instance ID by looking for the ports IDs displayed under the bridge in the compute node in the utility container using neutron:

	$ neutron port-list | grep <ID of the port>

Then we can do a neutron port-show on the ID displayed:

$ neutron port-show <UUID of the port>

In this screen now we want to look for the instance id which looks like:
| device_id             | 8b6995ad-96a0-42c1-91aa-935dcfb276ed 

Then we proceed to get information about this particular instance by using the command:
$ nova show <Instance UUID> 


B. Compute Host

The vxlan interface shown under the tap interfaces is an interface created by neutron that sits on the bridge. The purpose of the bridge is to bridge the virtual network interface with a physical interface.  
$ ip -d link show vxlan-80

The command above will show that vxlan-80 is a real VXLAN linux interface that is a VXLAN interface created with the standard ip utilities. In turn is using the interface called br-vxlan (overlay network) on this host as the egress point.

If we want to obtain more information about this interface from our overlay network and check the ip address associated to it, type:

$ ip a show br-vxla

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
7: br-vxlan: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc noqueue state UP group default 
    link/ether 00:1b:21:bf:a7:fc brd ff:ff:ff:ff:ff:ff
    inet 10.20.30.5/24 brd 10.20.30.255 scope global br-vxlan
       valid_lft forever preferred_lft forever
    inet6 fe80::21b:21ff:febf:a7fc/64 scope link 
       valid_lft forever preferred_lft forever
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The highlighted would be the vtap address for this particular compute node



C. Infrastructure Node / Neutron Agents Container
From our infrastructure node, we proceed to access the neutron agents container:
$ lxc-ls
$ lxc-attach -n infra1_neutron_agents_container-1564d434

We would like to view the other vtap addresses in the 10.20.30 network . So the compute node and the infrastructure node will send vxlan traffic over these two addresses.
	$ ip a show eth10


B. Compute Host

In the same manner a compute node will send traffic to another compute node using other vtap addresses. There is this vlan mesh that exists here. The way the system know how to move and forward traffic is by using the bridge table.
	
	$ bridge fdb show

The command above will show the contents of the bridge table. This contains all the mac addresses that it knows, the device that it learned them on and in the case of vxlan it shows the vtab address to forward that traffic to. 
Pause: 23:18



Description:

- We want to observe the network this bridge corresponds to.
- If we have a VXLAN interface listed under the bridge is an interface created by neutron which purpose is to bridge the virtual network interface to some physical interface.
- vxlan-29 interface is a real interface created with the standard ip utilities. In turn it uses the interface called br-vxlan on the host as the egress point.
- You can find by using the command "ip a" that the interface br-vxlan has an ip "10.20.30.5/24" which corresponds to the vtap address you will have for the particular infrastructure node.
- From a compute to an infrastructure node under the same vtap network, traffic trhough the 10.20.30.X addresses
- 
--------------------------------------------------
12. Steps

A. Utility Container

B. Network on Infrastructure Node
bridge fdb show

C. Terminal

Description:

- Show the bridge tables to see view hos the system know how to forward traffic.
- We will see MACs, device they lerned them on, vxlan the vtap address to forward taht traffic to.
- You will notice that some vtap adresses. This occurs because the forwarding table gets updated on a need to know bases. There fore here might be only a few hosts with VMS on them. As a compute node created a VM on the particular network, the forwarding table will get updated across the board. As those VMs dissapear, these entries will dissapear.
- In the case of vlan traffic, the missing vtaps would be learned just like a regular switch and the CAM table would be updated because it heard traffic on the port because it works as a self learning mechanism.
- In the case of neutron in the particular case of vxlan, thse entries would be programmed either through the "ls population" driver which maintains these forwarding tables accross the cloud, or you could use vxlan to get this task done.
- The idea is to have this overlay on top of a traditional network and to eliminate a lot of the vhatter. If you can reduce the ammount of broadcast traffic and arp traffic that traverses the network on a normal basis by statically programming bridge entries so you are telling it where to forward the traffic to, you are eliminating a lot of the chatter and you dont impact the performance.
- In VXLAN there is some overhead as compared to traditional VLAN networks.
- Virtual and Physical switches benefit from this action. 

--------------------------------------------------
13. Steps

A. Utility Container

B. Network on Infrastructure Node (Neutron agent container)
$ ip r
$ sudo ip netns exec qrouter-6c81aa37-92ee-4830-880b-9fd0fe67c18b ip a

C. Terminal

Description:
- We will be able to observe the two interfaces.
	- qr interface: LAN link from our private network. Inside interface.
	- qg interface: Gateway interface which will have an outside IP for this router. The names of these interfaces correspond to the ports associated with them. WAN interface of the router.
	- Routers can only have 1 gateway interface. This is added when you use the "neutron router-gateway-set" command. When you use the "neutron router-gateway-add" you add the qr interfaces
	- qr: tenant networks
	- qg: Attaches your router to a provider network.
- If you look up the MAC addres associated with the qr interface by using "bridge fdb show" you will see that this particular MAC address, you will see the entry over the vxlan29 interface destined to a particular IP Ex: 10.0.30.208. You can see if this IP is configured by checking it how is listed on your ip r command.


--------------------------------------------------
14. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal
$ arp -an | grep 172.XX.XX.XX

Description:

- L2 population also populates the arp table. By displaying the arp table you will be able to see that a permanent arp entry has been added to taht specific mac address from the qr and the ip address of the router.
- When the VM sends an ARP request to look for the owner of the gateway address in the router, the infrastructure node will proxy the response on behalf of the router. So that traffic may never been seen on the virtual router. Instead, the infrastructure node will proxy that response with the MAC address on behalf of the router. That eliminates arp traffic on the overlay.
- Likewase the router has arp entries for all the instances in the network.
- If you have some connectivity issues it may be because the L2 agent cannot keep up with the number of entries as you scale out with hundreds on nodes.Possible race conditions may be introduced, the VM might be up and ready to get its IP or try to hit its gateway. It is sending up arp requests, but the infrasructure node does not yet has an arp entry, the arps get dropped until the agent can program an entry. No response (due to VXLAN kernel module) if arps get dropped. This issue was seen primarly in JUNE due to the code and agents.  

--------------------------------------------------
15. Steps

A. Utility Container

B. Network on Infrastructure Node
ip netns exec qrouter-XXX ssh cirros@ip 

C. Terminal on instance
$ip r
$ping 8.8.8.8

D. Terminal on infrastructure node
- Packet cpture on the tapinterface
tcpdump -i tapxxxxinterface -n icmp
tcpdump -i brqxxxxinterface -n icmp
tcpdump -i vxlan-29 -n icmp
tcpdump -i br-vxlan -n icmp
tcpdump -i eth1.102 -n

Description:

- Let us do packet captures:
32:24
- In the instance, we will ontain the default gateway from the routers, a route to the metadata service pointing to the router itself or to the dhscp namespace in case there is no router.
- When creating a router you can specify to not set a gateway t all which can be done in case you want to multihome an instance you want to make sure that you do not have a default route on all of those subnets because your instance will get all of them and give you connectivity issues.
- On packet capture you will be able to see the ping from the instance and the traffic comming from the instance on the infrastructure node. This is done in order to make sure that traffic is leaving the vm and reaching the infrastructure node.
- You can do the same packet capture on the bridge where the tap interface is attached.
- The next hoop will be capturing capture on the xvlan interface. You will be observing that the traffic is hitting the vxlan interface but is not getting encapsulated. ICMP / OTV (encapsulated traffic) indicator in packet
- We know that the br-vxlan interface has the IP on my vtap. you wont see anything because the traffic has been filtered to see icmp traffic only.
- We can go further to the br-vxlan bridge where our vtap is configured (eth1.102) which corresponds to the overlay net.  Traffic should look very simmilar to the thaffic on eth1. Once the traffic has made it to eth1 pretty much we know that the traffic has traversed through the 5 hops.
--------------------------------------------------
16. Steps

A. Utility Containerp

B. Network on Infrastructure Node
- Access the agents container
- Our router lives here
$ brctl show
-Let us Access our router:
$ ip netns exec qrouter-xxxx-namespace ip a
- To show unencapsulated traffic
$ tcpdump -i vxlan-29 -n icmp
- You can view traffic going trough the qr or qg interface inside the router by:
ip netns exec qrouter-xxxxx-interface tcpdump -i qr-xxxx-interface -n 
ip netns exec qrouter-xxxxx-interface tcpdump -i qg-xxxx-interface -n

C. Terminal

Description:
- Our router is connected to two networks so we will expect to see it connected to two bridges.
- The bridge with the vxlan interface corresponds to our private network. We can also see tp tap interfaces, one belonging to the router and one belongs to the dhcp namespace in the network
- The bridge with the eth12 interface corresponds to the flat network mapping from our public network.
- Once you have accessed the router <ip a> (through the neutron agents container), you will se a qr-interface that corresponds to one of the tap interfaces shown under the umbrella of the private network bridge.
- The unencapsulated traffic will you the ping done from the instance and the response from google.
- The traffic from the qr interface inside the router will show. Cancel it if takes time. See the ICMP request and reply.
- If you run it on the qg-xxxx-interface inside the router you will be able to see the nattig. Here instead of seeing the private ip address you will be able to see the SNAT ip addess requesting. SNAT the ping. All VMs requesting traffic from the outside will be having its traffic trough this IP address.

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:

--------------------------------------------------
10. Steps

A. Utility Container

B. Network on Infrastructure Node

C. Terminal

Description:


