---
layout: post
title: Course 3 Horizon Dashboard Overview
categories: cloud-dashboard
author: 
description: We give a brief overview of the OpenStack Horizon dashboard.
---

  

* * *

#### Course 3: Horizon Dashboard Overview #

* * *

First, the URL that we use to connect to the dashboard is connecting to our Horizon service. This URL is usually either a floating or local IP that we set up during the deployment phase. If we need a URL that can be reached externally, we would set up a floating ip, but, if the cloud is only going to be used internally, a local static IP works just fine. Once you have set up a deployment you can set up accounts and passwords for each user and user groups. For this tutorial we assume you have already gone through that phase and move into how the OpenStack Horizon dashboard actually functions.

Horizon is just a gateway to the various services within OpenStack. It is a graphical user interface which gives us ease in creation of virtualization. First, let’s take a look around here. The top left shows us a button which tells us which project we are currently working with. The project we are working on is kind of like a user group. A project allows us to assign a set of users an allotment of assets so that they can all work on a project together or just in a similar direction. Mostly, it’s just a way to divide assets of the cloud. You can be assigned to multiple projects, so, it’s best to check this when you are about to make any changes. 

On the left hand side you will see what I call an accordion. This accordion holds all the tabs for the various OpenStack functions. The first screen we see when logging in is the overview tab, which gives us a pie chart for our used vs total assets we have available. The total available amount that we see is dictated by several factors, but mainly it is the deployment and project. The next button down is called instances.

Rather than jumping right into the creation of an instance, I will simply state that this is where you will see a list of the created instances and their current state. If the instance is having some problems, theey may still appear in this list, which allows you to delete them. Next is volumes.

Volumes are the extra storage that you have available to you. We will go into detail as to why you may need to connect extra storage to your instance further on.

Images are the list of operating systems, kernels, and snapshots of instances or installations that we have at our disposal. Here we will find the list of images and the buttons to create an image as well as launch an instance from that image directly.

Access & Security is the tab where we find security groups, key pairs, floating IPs, and API access. Security groups are like rule sets. We can start a new rule set and change the ports that are open and save it with a special name that we can then use when we need a specific type of port open or closed for our instances. When we create a security group, it exists here and any number or combination of the groups can be assigned to our instances upon creation. Key pairs are the ssh keypairs that we can assign to the instances. This subtab allows us to add and appropriately name ssh keypairs so we can ssh into our instances to control them using the command line interface. Floating IP’s give us the ability to connect to our instances remotely. They reside here and can be assigned or unassigned using this tab as well as on the instances tab. API access shows us the exact address, port number, and protocol version so that if we desire to communicate with a specific service via API calls, we can do so.

The next main tab says Network. Clicking this closes the previous set of tabs and opens another set of tabs associated with networking. First, clicking Network topology gives us a GUI of the topology of our currently created network. Initially you will see zero network items and will have to build things from scratch, but this depends on your deployment as well as the way you system administrators have things put in place. You can use this interface to visually coordinate what elements are connected to what as well as move them around with you mouse to further delineate for yourself. From this view you can also create an instance using the top right button that says create instance. This takes you to the exact same GUI for instance creation regardless of what tab you clicked it from.

Next is networks. This is simply a list of the networks currently created and their associated features. You can create networks and subnets from this page as well as delete them.

Routers tab is very much like the networks tab in that it shows us a list of routers and their associated properties. It also allows us to create, delete, and modify our routers.

The next main tab is orchestration. Here we see the tabs Stacks and resource types. This service is called HEAT and allows us to configure our instances using templates. This allows us to rapidly control our applications on OpenStack.

Resource types is a tab where 

The next tab shows admin, which is not necessarily available unless you have admin access to the deployment. Here is where we show the non admin view and describe the features that differ.

Under admin we see a tab has automatically opened called System and in it is a long list of tabs, many of which we have already covered just previously. If you click on overview, or any other tab that we have covered so far, they appear pretty similar, although all of the output here in the admin tab will sometimes not be visible to the standard users of the project. 

Hypervisors shows the currently operating hypervisors and their assets used. We can also see the current state of the compute hosts and disable their service.

Host aggregates shows us where our services are at in our deployment, what availability zone they reside, and what their status is.
Flavors shows us the types of flavors and their features. From this tab we can create and manage all flavors.

Defaults

Metadata definitions

System information tab allows us to view all of the OpenStack services and their various feature including current state and residence.

Finally, Identity tab shows us several selections that remind of us user groups. First, domains. Domain tab shows us the types of domains and allows us to manage their members. Think of this very much like the normal definition of domain groups where they are larger groups of people or, as is the case in openstack, what users have access to certain services as well. 

Projects are another segregation beneath domains. Projects can have admin users as well as standard users. This tab shows us the various projects and allows us to change the members of each project as well as change the assets they can use.
Users gives us a list of all users, which includes the services within OpenStack itself. OpenStack services are considered a user and during the deployment phase we must give them the same sort of rights as an admin for their purposes. Here we can manage username, passwords, create users, etc.

Groups

Roles tab shows us the type of roles that a user is able to have. Most services have admin roles and most users have _member_ roles. Think of member as a standard user. You will see other role types here that have to do with specific services. You can also create a role here, but currently the best way to modify or delete roles is to use the CLI.
