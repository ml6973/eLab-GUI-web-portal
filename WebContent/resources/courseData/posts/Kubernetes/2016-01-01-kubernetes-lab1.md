---
layout: post
title: Lab 1 Introduction to Kubernetes
categories: Kubernetes
author: Aqsa Fatima
description: Introduction to Docker Orchestration - Kubernetes Installation and set up guide.
---
#### We followed, abridged, and skipped around the guide laid out at: 
[https://docs.docker.com/](https://docs.docker.com/)

Kubernetes is a system used to control a wide number of hosts for the purpose of deploying and managin containerized applications. In our specific setup, we will be using Kubernetes in association with Docker to serve as our application container system. The fundamental idea
behind Kubernetes, beyond the setup stage, is that, as the user, there is no need to know about which host an application is running on. This serves the purpose of requiring the user to only need to focus on the application and not have to worry about the specifics of the host or management.
In this tutorial, you will be walked through the basic installation of Kubernetes on the currently available CentOS images provided by Chameleon. Following installation, the guide will continue on to explain the basics and advanced usage of Kubernetes.

### Prerequisites
The following prerequisites are expected for successful completion of this tutorial: 
* A Chameleon user account 
* An active project in the Chameleon Dashboard with appropriate administrative permissions. 
* Two active instances accesible by one another through a network connection.

#### Step 1: Setting Up Kubernetes
The setup of Kubernetes relies on a single host serving as a Master that will serve as the primary controller that will manage the Kubernetes installation. Any additional hosts that are to be used for application deployment are defined as a Node.
For the tutorial, the design will be to assign one single instance as the Master and the second as the Node.
First, we need to visit the list of instances and find the two instances we wish to use for our installation.

Take note of the local area network ip addresses of each instance and decide which host will be the Master and which will be the Node. In this scenario, <>, will be appointed as the Master. <> will be the Node.

#### Step 2: Connect to Master Instance
Go ahead and connect to the Master instance to begin installation. Please note that the machines are being connected to through SSH using appropriate aliases.
``` sh
ssh user@ip
```

#### Step 3:
Once logged in, we need to install Kubernetes and etcd so that the instance may act as the Master. 
``` sh
sudo apt-get install etcd kubernetes
```
From here, the installation will have installed all the appropriate configuration files into the /etc/kubernetes/ directory that we will need to modify. 

#### Step 4:
For the file /etc/kubernetes/apiserver, ensure the following lines are uncommented and edited to match what is shown:
``` sh
KUBE_API_ADDRESS="--address=0.0.0.0"
KUBE_API_PORT="--port=8080"
KUBELET_PORT="--kubelet_port=10250"
```

#### Step 5:
In addition, add the following line to the end of the file (where kubernetes-master is replaced by the Master instance’s local ip address e.g., 10.12.0.26 ).
``` sh
KUBE_MASTER="--master=http://kubernetes-master:8080"
```
#### Step 6:
For the file /etc/kubernetes/controller-manager, edit the following line to reflect (where kubernetes-node is replaced by the Node instance’s local ip address).
``` sh
KUBELET_ADDRESSES="--machines=kubernetes-node"
```








 
