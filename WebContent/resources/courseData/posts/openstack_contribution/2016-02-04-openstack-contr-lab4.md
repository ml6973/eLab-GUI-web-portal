---
layout: post
title: Lab 4 Setup Git Review
categories: openstack-contri
author: 
description: Here we set up a git review acccount to aid us in properly submitting bug fixes.
---

## Setup Git-Review

Step 1 - Install Some Essential Packages

```sh
ssh  <yourip>
sudo apt-get update
sudo apt-get install -y git python-pip vim
```

Step 2 - Install Git-Review

```sh
* sudo pip install --upgrade git-review
* git-review --version
```

Step 3 - Configure Git Identity

Be sure to use the email you used to register at __OpenStack Foundation__.
```sh
git config --global user.name "Firstname Lastname"
git config --global user.email youremail@example.com
```

Step 4 - Configure Git-Review Username

```sh
git config --global gitreview.username yourgerritusername
```

Step 5 - Configure Editor of Choice

```sh
git config --global core.editor yourfavoriteeditor
```

Step 6 - Clone the SandBox Repo

```sh
git clone https://github.com/openstack-dev/sandbox
```

Step 7 - Test Authentication to Gerrit

```sh
cd sandbox
git review -s -v
```
