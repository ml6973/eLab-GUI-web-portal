---
layout: post
title: Lab 8 Horizon Dashboard - Keystone as a User
categories: core_services
author: 
description: Horizon Dashboard - Keystone as a User
---

* * *
#### Lab 8: Horizon Dashboard - Keystone as a User #
* * *

## Table of Contents

* Horizon Dashboard - Keystone
* Accessing the Horizon Dashboard
* Services
* Tenant
* Users and Roles
* Summary

The Horizon dashboard supports 3 types of central dashboards. These are: 
User Dashboard
System Dashboard
Settings Dashboard of all the core openstack projects

Using these, the core openstack projects are supported and delivered.

It has an Extensible feature as the user can customize the dashboard with new components that are related to the projects. 
The code base is simple, easy to navigate as every file is programmed  with the required logic and arranged in a modular manner such that the files are easily correlated with navigation, making it a lot Manageable.
There is Consistency across the application with respect to the visual paradigm and interaction paradigm by accessing a solid set of reusable templates, the required core classes on which the changes are made and also additional tools such as base widget classes, form classes, etc)
The Horizon Dashboard is also Stable. The use of core classes and reusable templates creates an implicit requirement that there has to be backward compatibility in case of a change.


## Horizon Dashboard

Now let us get familiarised with Horizon Dashboard:

As we have discussed before,  keystone OpenStack’s identity service. The authentication and authorization can be done using a combination of users, roles, tenants or projects and domain.

The default OpenStack users are admin and demo. Also, the default tenants are admin and demo. Since admin user has an admin role, it can have control over admin tenant and demo tenant; on the other hand, demo user can only have access to demo tenant. In addition to the default user and tenants names, the default password that we have given to both of these users is secrete.

Let us start our hand-on activities by showing you how to access the Horizon Dashboard.

### Accessing the Horizon Dashboard
To access the horizon dashboard, type the IP address on your browser bar. Provide the credentials to the login page:

Username: admin
Password: secrete and then click connect button.


 
Now let us begin familiarizing with Horizon Dashboard. 

We will start with Services.


## Services
Within the horizon dashboard, the service list can be found in system information. The navigation is: 

Admin → System→ System Information

The system information table has the information like service Name, the openstack service to which it is associated with, host address and the status -  whether it is enabled or disabled.


## Tenants
A Tenant is another term for a project. It represents a group of users who have dedicated access to their compute resources. 
#### List Tenant
List tenant will provide you with a list of the currently available tenants / projects.

You can find the list of tenants within the admin project. The navigation is: 

In Admin→ Identity → Projects→ the list of tenants can be found here.

Let us now see the procedure to create a tenant.
#### Create Tenant	

To create a tenant, click on the Create Project button on top right corner of the screen. 

In the project information tab, provide project name, description. In the project members tab, click on the + sign located next to each user to provide users access to this new tenant. In the Quota tab, check  if the default values are the ones that you require and click on Create project button. 

The  ‘Success: Created new project <project name>’ message confirms the successful creation of your project. Now you will get to see the newly created project among the project list. 

#### Delete Tenant

To delete a tenant, you need to first check the box next to the project name that you wish to delete. 

Click on Delete Project button to delete the project that you checked in the previous step.

The pop up box that appears will now ask you to confirm the name of the tenant/project that you wish to delete. Confirm the deletion of the tenant by clicking on the Delete Project option. 

Let us see the procedure to edit a tenant now.

#### Edit Tenant
To edit a tenant, click on the drop down icon towards the right side of the screen. Click on ‘Edit Project’ to edit the project details.

 There are 3 tabs available within Edit Tenant: Project Information, Project Members and Quota that can be edited. 
In project information, the project name, description and the enabled property can be edited.  

In Project Members, you can add members using the + icon beside every user. The save button beneath the dialog box can be used to save the changes. 

In Quota tab, the related fields can be edited and saved using the save button. 


## Users and Roles
#### Create User

Click on the Create User button available on the top right corner of the screen. 
Fill in the required details like username, email, password, confirm password, primary project with which the user is going to be attached to and also the role in order  to create the user. 

Roles represent duties / functionalities  assigned to users. The Roles can be modified using a set of command line interface commands. The Roles that are available can be found in the dropdown list. Select a role from the list to assign it to the user. 

Once the details are filled in, click on Create User button.

To confirm the user creation, see for the ‘Success: <user> was created successfully’ message on the top right corner of the screen . Now you can find the user among the list of others users in the screen

#### Delete User
To delete a user from the list, select the user to be deleted from the list in the User 
Screen by clicking on the check box. Click on the Delete User button on the top right corner of the screen to delete the selected user. 

The resulting pop up screen will ask you to confirm the user name that you wish to delete. Click on the Delete User button to confirm it. 

Once deleted, the action can be confirmed by checking for the success message that appears on the top right corner. 
 
#### Get User
In this section we will see how to see the details of a particular user. 

Follow the navigation : In Identity→ Users 

This screen shows the list of users. So here if you notice, all the users have a hyperlink to their details screen. The details screen will provide with the information of the users.
 To see the details of a particular user, keep cursor on the user name you wish to view.Using the hand symbol, click on the user name. The following screen will show the details of the user (demoUser).

#### List User
List user screen will provide you with the list of currently available users. 
	You can get to the list of users by following the navigation: 

Within demo project; Identity → Users 
	
The list user screen has information like User Name which is the name of the user, and then Email of the user, a unique User ID, it has information whether the user is Enabled or disabled and it also have an Action field with options for you to edit the user.

Now let us see how to edit a user.

#### Edit User
To update/edit the user details, click on the edit button on the action column of the user name. The Edit button allows you to edit the username, email, and primary project.


 The drop down can be accessed to edit the status of the user, the password for the user and also Delete a user. 


## Summary
The keystone dashboard provides a web based user interface for openstack services. It provides with an interface that provides access information on the most important components of keystone, that are required for the management of users, roles, tenants and services.


## References
* http://docs.openstack.org
