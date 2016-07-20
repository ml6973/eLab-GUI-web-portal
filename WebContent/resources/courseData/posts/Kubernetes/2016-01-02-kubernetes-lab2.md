---
layout: post
title: Lab 2 Setting up the Node in Kubernetes
categories: Kubernetes
author: Aqsa Fatima
description: Setting up the Node for Kubernetes
---
#### We followed, abridged, and skipped around the guide laid out at: 
[https://docs.docker.com/](https://docs.docker.com/)

In this tutorial we will go through a similar process for the Node instance. Connect to the secondary instance.
#### Step 1: Install Kubernetes
``` sh
sudo apt-get install kubernetes
```
Due to this instance being the node, the configuration files will need to be altered in a slightly different manner than previously with the master.

#### Step 2:
For the file /etc/kubernetes/apiserver, ensure the following line is uncommented and edited to match what is shown:
``` sh
KUBE_ETCD_SERVERS="--etcd_servers=http://kubernetes-master:4001"
```
#### Step 3:
For the file /etc/kubernetes/config, ensure the following line is uncommented and altered to match what is shown:
``` sh
KUBE_MASTER="--master=http://kubernetes-master:8080"
```
In addition, add the following line:
``` sh
KUBE_ETCD_SERVERS="--etcd_servers=http://kubernetes-master:4001"
```

#### Step 4:
For the file /etc/kubernetes/kubelet, ensure the following lines are uncommented and edited to match what is shown:
``` sh
KUBELET_ADDRESS="-address=0.0.0.0"
KUBELET_PORT="--port=10250"
KUBELET_HOSTNAME="--hostname_override=kubernetes-node"
KUBELET_API_SERVER="--api_servers=http://kubernetes-master:8080"
```

#### Step 5:
For the file /etc/kubernetes/proxy, ensure the following line is uncommented and edited to match what is shown:
``` sh
KUBE_PROXY_ARGS="--master=http://kubernetes-master:8080"
```

#### Step 6:
On the Master (the first host), we need to restart the service in order for the configuration changes to take effect. Additionally, we will enable each service so that is will start at boot for
the server.
``` sh
for cmd in restart enable status; do sudo systemctl $cmd etcd kube-apis erver kube-scheduler kube-controller-manager; don
```

#### Step 7:
The Node (the second host) will also need to restart and enable similar services.
``` sh
for cmd in restart enable status; do sudo systemctl $cmd kube-proxy ku belet docker; done
```

Now that all the services are enabled and restarted with the new configurations, we can now begin to manipulate and deploy across the Kubernetes cluster.




