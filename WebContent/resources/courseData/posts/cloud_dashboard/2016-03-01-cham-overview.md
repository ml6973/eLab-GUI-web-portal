---
layout: post
title: Course 1 Chameleon Dashboard Overview
categories: cloud-dashboard
author: 
description: We briefly go over all the features of the Chameleon Cloud dashboard, which is very similar to OpenStack's Horizon dashboard.
---

  

* * *

#### Course 1: Chameleon Dashboard Overview #

* * *

The url for the dashboard is our gateway to our environment. This makes our interaction seem like a web application, which this is very much similar to that idea. The dashboard serves as a graphical interface for most functions within chameleon cloud. The primary focus of chameleon cloud is virtualization of machines using baremetal or kvm.

First, let’s go over each of the tabs in a brief overview style. When you first login, you will see a panel on the left hand side that contains an accordion style list of the features in the dashboard. We will begin with the overview tab. The Overview tab gives you a brief summary of your used versus total available assets. This includes the number of instances, which are your VM’s, VCPUs (virtual CPUs), RAM, Floating IPs, which are your externally accessible IPs, and security groups. 
Projects. On the top left hand side you will see a naming system along with an arrow down. This button allows you to select which project you are working on/with when manipulating the accordion features. Imagine a project like a collection of users working in the same project/direction. If you happen to work in several projects at once, you can manipulate each of them relatively individually by pressing the Project button and selecting corresponding project.

On the top right you will notice you have your username that you signed up with.
Instances are your virtual machines. They are the primary focus for users of cloud architecture. People want to run apps on virtual machines rather than on dedicated machines because it saves time, money, and adds redundancy and reliability. The limit shown is a default and can be changed depending on your project’s needs, but only by the administrator for that project. 

Images are what operating systems you have available to your project. They are more complex than normal operating systems in that they can be snapshots of the way a specific computer was at some point in time. This allows us to start up a virtual machine with the exact configuration that we desire, rather than going thru a lengthy process of loading an operating system and all the applications we desire as well. The image tab may be initially relatively empty as the standard operating system available in chameleon cloud is simply CirrOS, which is a small testing OS made for running on cloud systems. You can add already prepackaged images as well as create your own snapshots using this tab. We will go into much greater detail in another lab.

Access and security is the tab that takes us to the security groups, key pairs, floating IPs, and api access. The security groups are simply sets of rules that you can configure depending on your needs. Admins can create special rules for their users that upon the creation of instances, instances can add special rules that those instances will then follow. Key pairs are the SSH key pairs stored by the dashboard so that users can access their instances using their CLI. Floating IPs are the url numbers that can be used to access the instances externally using the chameleon dashboard. It is the same as typing a web address only it goes to the dashboard login which then gives you access to your project and VMs. The API access tab gives you the endpoints for you to connect to specific services within Chameleon cloud. For instance, if you wanted to connect to the network service itself in order to modify or create a network, you could do so using the API interface endpoint described here.

By clicking the network tab on the far left, we see another accordion of selections appear. Network topology is where we find a graphical and interactive interface displaying and detailing our network. With Chameleon dashboard there is limited abilities granted as far as the user’s ability to create or delete networks. You can also launch instances from within this same screen. Clicking on the networks tab shows you a list of all networks and their associated subnets. This is just so you can see the networks in a listed fashion. You can delete networks quickly and easily from here. The router tab shows all routers in a list. For some users, creating a virtual router may not be possible and you will need to contact your project leader/whomever to create a router for your needs. In chameleon we cannot create routers, but there is automatically a connection to the outside when connected to the shared network.

The next tab is reservations which has a single subfeature, leases. Leases are exactly as they sound, a temporary use of certain assets. This allows a user to provision a certain amount of hardware that they may need at some point and for a certain period of time. This gives a group working within a project the ability to schedule their major work on a calendar and coordinate their efforts.
The identity tab holds a list of the projects that the user is associated with. This is simply a list and can be searched.


 
