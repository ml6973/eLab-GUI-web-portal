---
layout: post
title: Lab 7 Horizon Dashboard - Neutron as an Admin
categories: core_services
author: 
description: Horizon Dashboard - Neutron as an Admin
---



* * *

#### Lab 7: Horizon Dashboard - Neutron as an Admin #

* * *


# Table of Contents
* Introduction
* Accessing Horizon Dashboard
* Creating and Managing Networks
* Creating and Managing Routers
* Creatin and Managing Interfaces
* Connecting to a Private Network:
* Port Reservation
* DHCP Agent (quantum-dhcp-agent)
* Creating and Managing Security Groups
* Creating and Managing Security Rules
* Summary
* References

## Overview
If you want to be familiar with pretty much everything related to Networking in Openstack, knowing Neutron is mandatory. Neutron is Openstack’s networking service. It’s built to deliver Networking-as-a-Service (NaaS) in cloud environment. It enables you to create and manage network objects which include but are not limited to networks, subnets and ports that other services of OpenStack can use. It brings ease of use to the network operators by providing a “plug in” mechanism to facilitate different networking equipment or software providing flexibility to Openstack architecture and deployment [1].  

It also provides networking API to help you define networking connections in your cloud. You can configure and manage diverse networking services ranging from L3 forwarding to NAT etc [1]. You can also create multiple private networks and control their networking. One of the major consumer of Neutron service is Openstack compute which requires networking connections for instances. It is important to have a basic understanding of Neutron, as it is often needed in industry while dealing with requirements like efficient operation in heterogenous environments. It is adopted by many prominent networking suppliers such as Arista, Brocade Communications Systems, Hewlett-Packard, Cisco etc.

Now let’s dig into hands-on ways to implement features from Neutron through Horizon Dashboard.

## Accessing Horizon Dashboard
To access the horizon dashboard, type the IP address of machine you received from our “Get Machine” service on course page in your browser. Enter the credentials for logging in.

For Admin:     
Username: admin   
Password: secrete    

Some important parts of Neutron are:
* Public Networks
* Private Networks
* Creating Subnets
* Routers
* Interfaces
* Port Reservation
* DHCP Agents
* Security Groups
* Security Rules

## Creating and Managing Networks
Before beginning into a hands-on practice, let’s understand the definitions of these terms so you can have a better understanding of what you are doing. We have extracted these definitions from Openstack documentation and presented below so you can have all of them at one place without having to separately search for each one of them.

### Public Networks

Before launching an instance, you must create the necessary virtual network infrastructure.Openstack documentation describes it as “For networking option 1, an instance uses a public provider virtual network that connects to the physical network infrastructure via layer-2 (bridging/switching). This network includes a DHCP server that provides IP addresses to instances. The admin or other privileged user must create this network because it connects directly to the physical network infrastructure.”

### Private Networks:
“If you chose networking option 2, you can also create a private project virtual network that connects to the physical network infrastructure via layer-3 (routing) and NAT. This network includes a DHCP server that provides IP addresses to instances. An instance on this network can automatically access external networks such as the Internet. However, access to an instance on this network from external networks such as the Internet requires a floating IP address. The demo or other unprivileged user can create this network because it only provides connectivity to instances within the demo project.

### Network Topology
Networks are fundamental to cloud computing and being able to configure them is an important skill. As an admin, in the admin project we can
Control the network topology overall
 We can control tenant networks
 We can create and manage routers

On the left hand side you see a panel with different tabs such as “Project”, “Admin” and “Identity”. Click on Project and under Project → Networks


### Creating Network              

As an Admin:

As an admin, you can set up a network in the same way as for demo user as discussed in Module 4.d but with extended privileges of defining features such as whether you want the network shared with other tenants or not. You can switch between “admin” and “demo” projects as an admin user. 



Click on “Create Network”. Here, you have the option to assign the network to a Project. You can also select the Provider Network Type from the dropdown options. You can also select if you want it to be shared with other tenants by checking Shared option. Or make it an External Network which typically provides internet access for your instances. 


Let’s discuss what we just setup, A virtual network with an associated subnet as well as DHCP service for the subnet (optional). It’s somewhat analogous to VLAN in traditional network but with more flexibility. We know a VLAN is a logical splice of the physical network. Systems of one are logically separated from others. Similarly, Openstack Networks provides logical space isolated from other Openstack Networks.    

## Creating and Managing Routers
Subnetting allows you to divide areas of your network out to prevent this. But how can we make them communicate with each other? By installing Layer 3 Switch or a Router. With the help of Router the subnets can essentially “talk” to each other.

### Creating Routers

As Admin User:
Under Networks Tab in Project click on “Routers” category. Click on “Create Router”. 



Select a Router Name, Admin State and External Network. Now click on Create Router. I have created a Router with name “Routercheck” and selected external network “public”. 






## Creating and Managing Interfaces:

A network interface is a point of interconnection between an instance and a public or private network. You can add a networking interface to an instance in Openstack after launching the instance. 
Connecting to a Private Network:
After creating a router, you can connect it to a private network. Click on the name of the router you want to configure in the Routers tab. I will be using the “Routercheck” router I just created in previous step. 

It will take you to the “Router Details” page. Click on the “Interfaces” tab and then click “Add Interface”.   
 


By default OpenStack Networking uses the first host IP address in the subnet. You can change this default by setting up an IP Address for the router interface for the selected subnet. I have selected my previously made subnet named “Subnetcheck” for this example. Note that the Router Name and Router ID fields are automatically updated. After giving details, click on “Add Interface”. 


You can now check the new topology from Network Topology. It can be done in same way being a demo user. 



## Port Reservation
Ports are critically important while dealing with ingress and egress points for data traffic. Openstack Neutron ports are created automatically but we can also independently create them if needed. They are realized on the underlying hypervisor using interfaces. They play an important role in Neutron as they are not only associated with entry or exit points for data traffic but also with configurations such as interface and IP addresses [5].  
### Creating Ports:
Only the administrator can create and manage ports. I will be switching to the Admin user for this feature. You can select the appropriate project from the dropdown menu on top . 
On the Admin tab in left hand side, click on Networks category. Here select the Network Name in which you want the ports to be created. I will be selecting “Networkcheck”. This will direct you to the Network Overview page. Scroll down to Ports. You will see an option to Create Port here.

Clicking on it will take you to the configuration page for creating port. 
Specify the Port Name to identify the port, if you specify device ID to be attached, the device specified will be attached to the port created. You can then define Device Owner attached to the port. Binding Host option defines the ID of the host where the port is located. Binding VNIC Type  in this field, select the VNIC type that is bound to the neutron port.


After populating the fields, click on Create Port. 
You can now see the newly created port in the Ports list. I created a port named “iPortcheck”.


I did not enter a device ID, hence the attached device attribute shows “Detached”.

## DHCP Agent (quantum-dhcp-agent)
It Provides DHCP services to tenant networks. This agent is the same across all plug-ins. We have already discussed the assignment of this feature while creating subnets. The Openstack documentation states that “The OpenStack Networking service has a scheduler that lets you run multiple agents across nodes; the DHCP agent can be natively highly available. To configure the number of DHCP agents per network, modify it’s config file. By default this is set to 1. To achieve high availability, assign more than one DHCP agent per network.”

## Creating and Managing Security Groups
Openstack documentation describes as - Security groups are sets of IP filter rules that are applied to an instance's networking. They are project specific, and project members can edit the default rules for their group and add new rules sets. All projects have a "default" security group, which is applied to instances that have no other security group defined. Unless changed, this security group denies all incoming traffic. 

### Creating Security Groups
To create Security Groups, go to Project in the left hand side panel, and under Compute tab, select Access & Security category.
Here click on “Create Security Group” button. Enter the Name for your Security Group and an optional Description for your group. Then click on Create Security Group button. I have created a security group named”Securitycheck”. 
Now you can see your security group in the list of groups. 

## Creating and Managing Security Rules
You can also edit or add rules to this group by clicking on Manage Rules. 
This will direct you to the Manage Security Group Rules for your security group’s page. By default all ports are opened for outbound connections and no inbound connections are allowed. 
Click on Add Rule button on top. 
Here select the rule you need from the dropdown menu.You can specify the desired rule template or use custom rules, the options are Custom TCP Rule, Custom UDP Rule, or Custom ICMP Rule.
Select the direction of traffic as Ingress or Egress.
 
### Open Port / Port Range 
For TCP and UDP rules you may choose to open either a single port or a range of ports. Selecting the "Port Range" option will provide you with space to provide both the starting and ending ports for the range. For ICMP rules you instead specify an ICMP type and code in the spaces provided.
 
### Remote 
You must specify the source of the traffic to be allowed via this rule. You may do so either in the form of an IP address block (CIDR) or via a source group (Security Group). Selecting a security group as the source will allow any other instance in that security group access to any other instance via this rule.

After configuring, click on Add. You will now see your added rule on the refreshed security group rules page. 

## Summary
In this module, you have learned how to configure Openstack Neutron features as a demo user.

## References
* [Networking Concepts](http://docs.openstack.org/mitaka/networking-guide/intro-os-networking-overiew.html#openstack-networking-concepts)
* “OpenStack Fundamentals Configuring a Tenant Network” Byron Hynes, Enterprise Technology Strategist, Skillsoft. Accessed: July 27, 2016.
* “Introduction to Openstack Neutron”, David Mahler. Accessed: July 27, 2016.
* [Openstack User Guide](http://docs.openstack.org/user-guide/dashboard_create_networks.html) 
* “Ports in Openstack Neutron”, Blogs by Sriram, July 5, 2015. Accessed: July 27, 2016. 



