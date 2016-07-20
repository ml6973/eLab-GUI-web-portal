---
layout: post
title: Lab 3 Deploying applications using Kubernetes
categories: Kubernetes
author: Aqsa Fatima
description: Now that we have the Kubernetes system in place, we can now use it to deploy applications.
---
#### We followed, abridged, and skipped around the guide laid out at: 
[https://docs.docker.com/](https://docs.docker.com/)

###  Simple Uses of Kubernetes
Now that we have the Kubernetes system in place, we can now use it to deploy applications. As mentioned before, the Master controls the entirety of Kubernetes, so each of these commands will be run on the Master host/instance that we set up previously. In our example, this would be the <> machine. To start off with, we will take a look at the attached nodes using the following command.
``` sh
kubectl get nodes
```
We can see the attached node at <> showing that the Master recognizes the attached Node.
The command, kubectl (Kubernetes Control), is the primary command used to interact with Kubernetes and the attached cluster. Passing get to the command is similar to reading variables with the final argument being nodes, any and all attached nodes that are responding will be displayed the same as above. We will see this command used further in later examples.
For the next section, we will being talking about Pods. Pods are a container or group of containers that are typically meant to be run together to create a Service. There are a few main terms and concepts that need to be explained before advancing further.
Some important terms to understand first are:

#### Pod
A pod is defined as a collection of any number of containers or applications that are to interact with one another as though they existed on the same machine. This is used in the same sense that a multi-container application would be used for within Docker alone. It is recommended that any and all applications that exist within a single pod be very tightly related to the point where it is almost a necessity that they exist on the same host. Typically, the more you can segment out a large project into separate pods the better. This is thanks to the fact that you can then scale each pod individually from each other based on their independent needs and usage to optimize resources overall.

#### Service
A Service is a unique abstraction of Kubernetes that behaves in the sense of directing network traffic and flow within the cluster. Each pod is self contained and will remain so unless explicitly exposed by a service. In defining a pod, you can also define a label for the pod that Kubernetes can use to distinguish one type of pod from another. These labels are used by services in order to succesfully direct incoming and outgoing packets. Usually, services are first used internally to expose ports from one pod to another such that a project can interact between pods. Again, this can be related back to Docker in the form of linked containers.
However, services in Kubernetes go far beyond the ambassador links present in Docker. To begin with, a service defines a collection of Pods, using the labels as mentioned before, and abstracts the connection between the two. This is where the SDN (Software Defined Networking) comes into play in that the pods are only required to worry about themselves and that’s it. The relation between them is handed over to the service which decides how they interact. This is one of the features that permits Kubernetes’s built-in load balancing for deployments. For example, when working with a web server, you typically embrace a frontend and backend. By splitting these two into separate pods, you can have several instances of each used to handle the load. When the frontend need a backend, it will reach out and be picked up by the service that is currently in control. The service will then select a backend that is currently unoccupied or otherwise free from the pool of available backend pods and a momentary connection will be formed. 

#### Step 1: To see our active pods
``` sh
kubectl get pods
```
Since we have not yet created any pods, non are present at the execution of this command. Just to get started, we will begin by launching two instances of nginx that are guaranteed by a Replication Controller.

#### Replication Controller
 A Replication Controller (RC) is a tool utilized by Kubernetes to ensure a specific number of pod instances are always running. It will either create or destroy more pods until it is within the specific amount provided. In addition, the RC will also be able to account for Node failure in order to migrate which host the pods are being hosted on without user intervention.
 
#### Step 2:
``` sh
kubectl run-container my-nginx --image=nginx --replicas=2 --port=80
```
This command will spawn two nginx pods that have port 80 open to accept incoming HTTP traffic. From here, let’s take a look back at the currently existing pods.

#### Step 3:
``` sh
kubectl get pods 
```
You can see the pods are still spawning given thei current status as **Pending**. Given a few more moments, the pods are now officialy in the **Running state**:
Now, it is important to remember that Kubernetes separates everything as much as it can. In that sense, even though we were only looking to run a container, pods were created for us automatically to contain the containers. In addition, since we specified that we always want two instances of nginx running, we have also indirectly created a Replication Controller that is used to monitor the pods.

#### Step 4:
``` sh
kubectl get rc
```

#### Step 5:
Now that we are done, we can simply destroy them.
``` sh
kubectl delete rc my-nginx 
```
