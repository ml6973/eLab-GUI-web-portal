---
layout: post
title: Lab 7 Committing A Bug Fix
categories: openstack-contri
author: 
description: For this course we will show you how to use a shell to commit a bug fix.
---

## Committing A Bug Fix

Step 1 - Git Pull the the Sandbox Repo

```sh
ssh  <yourip>
cd sandbox
git pull
```

Step 2 - Set up the Local Repo for Git Review

```sh
cd sandbox
git review -s
```

Step 3 - Create a New Branch for the Proposed Change

```sh
git checkout -b bug/1234567
```

Step 4 - Create a File

```sh
touch ./yourfile.py
echo -e "Hello OpenStack Community,\nThis is My First Bug Fix.\nI hope really hope it gets merged to master." > yourfile.py
```

Step 5 - Check the Git Status

```sh
git status
```

Step 6 - Stage the File for Commiting

```sh
git add .
```

Step 7 - Check the Git Status Again

```sh
git status
```

Step 8 - Commit the File

```sh
git commit
```

Step 9 - Write Your Commit Message

Step 10 - Git Review to Send the Change

```sh
git review
```
