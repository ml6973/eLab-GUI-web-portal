---
layout: post
title: Lab 4  Using Setup Files With Kubernetes
categories: Kubernetes
author: Aqsa Fatima
description: In this section, we will go about creating a series of files that can be used to define an application.
---
#### We followed, abridged, and skipped around the guide laid out at: 
[https://docs.docker.com/](https://docs.docker.com/)

For our example, we will be recreating the same tutorial released as the Docker multi-host application in the first Docker tutorial. [https://github.com/cloudandbigdatalab/tutorial-cham-docker-1](https://github.com/cloudandbigdatalab/tutorial-cham-docker-1)

#### Step 1:
``` sh
mkdir dock-app 
cd !!*
```
Now that we are within our application’s directory-to-be, we will need to start defining how we want the application to be set up. Since the application has been created for us, we are going to cater to its original design. Luckily, since all the files are hosted on DockerHub, there is no need to go through the pain of recreating and compiling Dockerfiles for our case.

Each file is of the YAML file format which may often seem a little odd, but is simply broken down as another way to define nested variables in a vein similar to JSON.

Our first file will be for the main webserver and we shall call it **dock-web.yaml**. The contents should be:

``` sh
dock-web.yaml:
apiVersion: v1beta3 kind: ReplicationController metadata:  name: docker-web  labels:    name: docker-web spec:  replicas: 2  selector:    name: docker-web  template:    metadata:      labels:        name: docker-web    spec:      containers:      - name: uwsgi        image: cloudandbigdatalab/uwsgi      - name: nginx        image: cloudandbigdatalab/nginx        ports:        - containerPort: 80
```
By looking at the very top of the file, we can see what exactly is being declared. The most important part of a YAML file for Kubernetes is the kind variables which defines what exactly we are creating. In this case, we can see that we are creating a Repliction Controller. Moving along, we see labels being defined in the metadata section in addition to within the spec section. spec defined the majority of the contents of the actual container, in this case, pulling the nginx and uwsgi docker containers and placing them into the same pod, exposing port 80 locally. Since in the Docker tutorial these were placed on the same host, placing them on the same pod is essentially the same. replicas is the final variable to take note of since it tells Kubernetes how many instances of the pod to run. Given that we are merely testing, we keep the number of replicas fairly small at two.

Next, we will look at the dock-post.yaml file, the file that is used to define our second pod containing a Postgres database.

``` sh
dock-post.yaml:
apiVersion: v1beta3 kind: ReplicationController metadata:  name: docker-postgres  labels:    name: docker-postgres spec:  replicas: 2  selector:    name: docker-postgres  template:    metadata:      labels:        name: docker-postgres    spec:      containers:      - name: postgres        image: cloudandbigdatalab/postgres        ports:        - containerPort: 5432
```

