---
layout: post
title: Lab 1 Introduction to Cloud Computing
categories: core_services
author: 
description: Introduction to Cloud Computing
---
* * *
#### Lab 1: Introduction to Cloud Computing #
* * *
## Table of Contents
* Introduction  
* Characteristics of Cloud
* Types of Clouds
* Types of Cloud Providers
* Introduction to Openstack
* Core Components of OpenStack
* Summary  
* References  

## Introduction
The objective of this lab is to provide an introduction to openstack and cloud computing. Cloud computing gradually evolved from mainframe computing which worked on a shared resource model. The definition of Cloud computing according to the National Institute of Standards and Technology is as follows:

“ Cloud Computing is a model for enabling ubiquitous, convenient, on-demand network access to a shared pool of configurable computing resources (e.g., networks, servers, storage, applications and services) that can be rapidly provisioned and released with minimal management effort or service provider interaction “ In simple terms it is storing and accessing data/computing resources over the internet.  

Internet has an important contribution towards the evolution of Cloud computing. With its advent and increased reliability and low cost of internet and computers, there has been an improvement on the use of the number of web based applications. The evolution of cloud computing can be briefly explained using the following:     
	• Grid computing: This involved usage of a distributed architecture working on a  single problem and the tasks are assigned independent of each other   
    • Utility computing: In the case of utility computing, the resources required for computing are made available for the client as a metered service   
    •SaaS: Software as a service is a network based model that takes care of software licensing and delivery by providing applications through a web browser   
    • Cloud computing: This provides the required computing resources anytime, anywhere for the Clients   

## Characteristics of Cloud
One of the first milestone with cloud computing was with Saleforce.com which delivered enterprise application through a website. Cloud computing brought in a lot of activities that ranged from replacement of on premise infrastructure to on-demand applications.    
The 5 main characteristics of Cloud Computing:    
•      On- demand self service: Auto provisioning of computer resources as and when needed without any human intervention    
•      Broad Network Access: The computing resources can be accessed anywhere using the Internet       
•      Resource Pooling: Dynamic assignment of resources in order to meet the requirement of the consumers    
•      Rapid Elasticity: The resources are released or assigned  	as per demand    
•      Measures Service: The clients only pay for the computing resources that were used.    

Cloud providers are called as Cloud Service Providers or CSPs. A cloud provider is a service provider that helps with a specific functionality/service. The service provider is chosen depending on your requirement. It depends on the way the computing resources in the cloud are used or accessed.
The 4 main areas that cloud computing focussed were:
### Virtualization
In virtualization, it deals with multiple pseudo servers on one physical device. Having multiple virtual servers instead of a single physical server with segregated data is the backbone of cloud computing. It promoted better flexibility and resource utilization thereby improving efficiency.
 
### Democratization of Computing
Cloud computing has facilitated business development to a great extent. Democratization has enabled setting up of an infrastructure and application for a particular business in an effortless manner. With cloud computing it provides a centralized access to the common business and web applications that are required for the client.   It also allows to massively scale the infrastructure to a level that were not attained previously.

### Scalability and fast provisioning
 Under provisioning and over provisioning of servers are scenarios that can create an undesirable impact on the business or its service levels. Cloud computing allows businesses to maintain their infrastructure levels as and when required. 
 
### Commoditization of infrastructure
Cloud computing allows the IT users to use the resources as and when required allowing them to focus on the important aspects of their roles

## Types of Clouds
### Cloud System
The Cloud System is based on the Internet - it is an internet based computation. You get to access your data anywhere, anytime using Cloud.
Cloud Computing is a service model that consists of shared configurable computing resources that can be accessed according to your requirement through a network.    
A cloud computing stack consists of:   
•      Software   
•      Platform   
•      Infrastructure     

It is massive data processing and it is an easy way to access your programs/ any data, server, databases over the internet or is in sync with other information on the web.

The main types of cloud includes:   
•  	Public Cloud   
•  	Private Cloud   
•  	Community Cloud   
•  	Hybrid Cloud

### Public Cloud
 A public cloud can be accessed by any client with access to internet and to cloud space. There is much cost savings with public cloud as there are no upfront costs or infrastructure costs that usually comes up in the case of an on premise set up. The users / clients have increased flexibility with public cloud as it allows capacity to be mapped adjacently with the requirements
The public cloud is based on a virtually unlimited capacity whenever the client requires it.

### Private Cloud
A private cloud is for a particular group or organization and the access rights are given only to this group. Private cloud is either managed by organization itself or by a third party and it exists either on premise or off premise. This diagram shows the 4 approaches to a private cloud. Private cloud helps the organizations on the requirements which reuire a physical or logical separation of data from other organizations. It also provides with ways to improve efficiency on the existing infrastructure that the client uses
Private cloud also helps to meet specific technology requirements that their clients might  have, It helps reduce risks that are associated with vendor lock-in.

### Community Cloud
A community cloud is a shared cloud, shared by more than one organization that shares common cloud requirements.   

### Hybrid CLoud
A hybrid cloud is a combined version of atleast two clouds where the combination includes public, private and community. Hybrid cloud provides the flexibility to retain a part of the infrastructure while moving the others to cloud. It allows the workloads to be split between the existing infrastructure and the cloud. Hybrid cloud also allows the workloads to be retained between on premise infrastructure or on dedicated infrastructures.

## Types of Cloud Providers
There are 3 types of cloud providers:   
•  	Software as a Service or SaaS: The SaaS provider provides access to computing resources and applications for the end users. By accessing the cloud, the client gets to access softwares and other similar applications. SaaS provides the least control over the cloud.   
•  	 Platform as a Service: PaaS is a service setup. This service provider provides components required for development and operation of applications in a quick and efficient way   
•  	Infrastructure as a Service: IaaS has the maximum control over the cloud resources. The complete infrastructure that are required for the organization is out sourced in IaaS, that is the hardware and software like server, storage, network, operating systems.   

### SaaS
The SaaS or Software as a Service provider provides access to computing resources and applications for the end users. It is a fast growing delivering technology.  By accessing the cloud, the client gets to access softwares and other similar applications. SaaS provides the least control over the cloud. 
Some characteristics of Saas are:   
·         The users get web access to commercial software   
·         The software is made available to the users using ‘one to many’ mode   
·         software management, upgrades and patches are dealt by the service   provider from a centralized location

#### Applications of Software as a service 
It involves an interplay between client-organization and outside world   
·         those that requires web or mobile access as in mobile sales mgmt. software   
·         Application as a software that is required only for a shorter period of time- for eg: a software that is used and is collaborated for a particular project   
·         Another application could be in a software whose demand shoots up widely; for eg: the tax software whose demand spikes up during a month   

### PaaS
PaaS generally benefits the software development world. It Mixes both simplicity of Software as a Service  and power of Infrastructure as a Service
PaaS acts as a service setup, providing a platform for creation of softwares, web applications in a quick and an efficient manner. Here the client neednt bother about the buying, maintenance or about the infrastructure that the software requires. This service provider provides components required for development and operation of applications in a quick and efficient way

Characteristics of PaaS includes:   
·         Services offered includes those that are required to fulfill application development process like develop, test, deploy, host, application maintenance   
·         Creation, modification, testing and deploying are done using the user interface creation tools that are accessed through web   
·         Allows concurrent access for multiple users on the same application  resource   
·         Integration between web services and databases using common stds   
·         Project planning and communication tools solutions for development team   
·         It also provides with the tools for billing and subscription    management

#### Applications of PaaS 
Paas is applied in a scenario which involves accesses for both developers and other parties in a development project
It is also used in cases where the testing and deployment services are automated. Some exampes where PaaS is used includes: Google App Engine, Microsoft Azure ServicesForce.com

### IaaS
Infrastructure as a Service handles on demand - delivery of cloud computing resources. IaaS has the maximum control over the cloud resources
Hardwares and Sfotwares infrastructures like servers, network, storage and operating systems that are required for the client are outsourced here.
IaaS can be either public infrastructure or private infrastructure or a combuination of both. In a Public Cloud, it consists of shared computing resources deployed on a self-service via web. In a private network, it focuses on virtualisation which is a cloud computing feature on a private network.    

Characteristics include:    
◦          Computing Resources are considered as a distributed service   
◦         Dynamic Scaling is allowed in IaaS   
◦         Pricing model used is Utility pricing model which has variable costs  
◦         Multiple users have access on the hardware resource   

#### Applications of IaaS includes :
•      Applications which involves significant variations with respect to the demands on the infrastructure that the client requires   
•       For start up organizations that hardly have the capital to investment in the procurement of hardware   
•       IaaS also can be used in scenario where the growth of the organization demands an increase in the hardware resources   
•       When the organization is pressurised to change focus on the limit on capital expenditure to  limit operating expenditure   

This is a schematic that shows the responsibilities of the cloud service providers (CSP):   
Lets take a look at some of the common applications of cloud:   
•  	Software-as-a-Service (SaaS)    
Microsoft OfficeLive, DropBox, and CloudNumbers.    
•  	Platform-as-a-service (PaaS)   
Google AppEngine, SalesForce VMforce, and Joyent Accelerator.   
•  	Infrastructure-as-a-service (IaaS)Amazon EC2, Eucalyptus Community Cloud, and IBM Cloudburst.   

## Introduction to Openstack
OpenStack is :   
“A cloud operating system that controls large pools of compute, storage, and networking resources throughout a datacenter, all managed through a dashboard that gives administrators control while empowering their users to provision resources through a web interface.”

Openstack can be considered as a group of softwarComputeStoragee tools for cloud computing platforms. It mainly focuses on the development and management of public and private clouds. Here is a schematic representation of the cloud operating system It helps managing resources that includes: pools of compute resources, storage resources and networking resources to run the applications provisioned to the clients.

OpenStack has a modular architecture that includes components like the following:    
Nova    
Swift    
Cinder   
Glance    
Keystone    
Horizon    
Neutron   
Ceilometer    
Heat   
Trove   
Sahara  
Here we have a openstack conceptual architecture:   
·         Horizon is the dashboard. It is the only graphical user interface here. Providing accesses and control to manage the cloud.  

·         Nova is the primary component for OpenStack with respect to computations. It takes care of the virtual machines and instances that handles computations by deploying and managing them.   

·         Cinder, the block storage component in openstack  

·         Neutron module takes care of the networking in openstack by making sure that the components get to communicate efficiently and quickly.   

·         Glance:  This is openstack’s image service. It takes care of the disk and server images. The services include: - discovery, registration and delivery services for the servier and disk images. It can also be used as templates for the new resources like virtual machines instances that may be allocated.      

·         Swift: acts as a storage for objects and files. This is also called as openstack object storage, which provides a scalable system for storage. Here it provides a unique identifier to locate the objects/files and it the location of storage is decided by OpenStack.   

·         Keystone:  is used for the authorization and authentication of openstack services. In short, it is the identity service for openstack. The services that it provides include: Identity, Token, Catalog and Policy services.   

·         Ceilometer & heat are telemetry services and orchestration component of OpenStack respectively. Ceilometer is a data collection service project that transforms and normalises data across core openstack components. Heat  allows developers to store the requirements of a cloud application in a file that defines what resources are necessary for that application. In this way, it helps to manage the infrastructure needed for a cloud service to run.

Massively scalable architecture in cloud computing supports a large deployment or ability to support more number of users accessing the cloud resources
The scalable architecture is a platform for variety of workloads specially for commercial and public clouds.
Cloud components like compute, storage, network are not used here as when scale increases it impacts the cloud components and the other supporting infrastructures

As per the openstack.org tutorials the services offered by massively scalable openstack includes:
            disk image library VMs
            Raw block storage
            File or object storage
            Firewall functionality
            Load balancing functionality
            Private (non-routable) and public (floating) IP addresses
            Virtualized network topologies
            Software bundles
            Virtual compute resources


•      OpenStack is an open source software that provides an infrastructure as a service (IaaS) platform for deployment and management of private and public cloud                         
•       It caters to easy implementation and massive scalability for the Cloud       
•       OpenStack is configured as per the client requirement using the services offered   
•       Key Services offered by OpenStack include : Compute, Object Storage, Block Storage,   
•       Network Management, Authentication, Image Service, Billing Service, Cloud Template and Dashboard   

## Summary
•      OpenStack is an open source software that provides an infrastructure as a service (IaaS) platform for deployment and management of private and public cloud     
•       It caters to easy implementation and massive scalability for the Cloud     
•       OpenStack is configured as per the client requirement using the services offered    
•       Key Services offered by OpenStack include : Compute, Object Storage, Block Storage,
 Network Management, Authentication, Image Service, Billing Service, Cloud Template and Dashboard
 
## References
http://www.webopedia.com/TERM/C/cloud_computing.html
http://www.pcmag.com/article2/0,2817,2372163,00.asp
https://www.us-cert.gov/sites/default/files/publications/CloudComputingHuthCebula.pdf
http://whatis.techtarget.com/definition/OpenStack
https://wiki.openstack.org/wiki/Neutron#What_is_Neutron.3F
 
 
 
 




