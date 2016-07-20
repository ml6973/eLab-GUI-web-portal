---
layout: post
title: Lab 9 Submitting Your Info to Stackalytics
categories: openstack-contri
author: 
description: How to add your info to Stackalytics so that we can properly identify who is contributing and to what. Credit where credit is due.
---

Submitting Your Info to Stackalytics

Step 1 - Clone Stackalytics Repo

```sh
ssh <yourip>
git clone https://git.openstack.org/openstack/stackalytics.git
```sh

Step 2 - Set up the Local Repo for Git Review

```sh
cd stackalytics
git review -s
```

Step 3 - Create a New Branch for the Proposed Change

```sh
git checkout -b update_user_info
```

Step 4 - Edit the default_data.json file

Place your entry in alphabetical order of the launchpad_id: <vi,nano,etc> etc/default_data.json

Here is an example:

```json
     {
           "launchpad_id": "lisasmith",
           "gerrit_id": "lisa-smith",
           "companies": [
               {
                   "company_name": "Intel",
                   "end_date": null
               }
           ],
           "user_name": "Lisa Smith",
           "emails": ["lisa.smith@intel.com", "lisasmith@example.com"]
       },
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
git commit -a
```

Step 9 - Write Your Commit Message

```sh
Update info for Lisa Smith
```

Step 10 - Git Review to Send the Change

```sh
git review
```

A link to the change in Gerrit should be displayed in the console.


   

