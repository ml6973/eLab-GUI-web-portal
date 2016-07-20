---
layout: post
title: Lab 6 Working with Bugs
categories: openstack-contri
author: 
description: The next step in fixing bugs is to locate the bug repository and see what others are reporting.
---

## Working with Bugs #

The proper procedure for bug fixing is to report the bug to the bug repo launchpad. Here we will find all the bugs and their current states (fixed, in process, undetermined, etc). When you find a bug, you submit it to gerrit to first see if it is a bug, then after it is placed on the website, people can look at the bug, determine if it is a bug, and either help fix the bug or elevate the status of the bug to be fixed by the team who oversees that sector of OpenStack. The core reviewers for each sector are the only persons that may immediately elevate a bugs status.

Step 1 - Navigating to the Bug Repository

Navigate to <https://bugs.qastaging.launchpad.net>. Here you will find a the _DEMO__ page. This is a dummy page that mimics the exact same behavior as the [main page](https://bugs.launchpad.net/). You can search bug reports and pllay around here without causing any problems.

Step 2 - Organizing Bugs

Click the __Search Bug Reports__ and then click the __cog__ icon. Add the __AGE__ and __Date Updated__ column headers then click __Update__. This allows us to sort the bugs by certain selection types. By showing their AGE and Date Updated, we can see how old the bugs are, how much they are being worked with, etc. We can then click on __AGE__ and all bugs will be shows from newest to oldest. Likewise, if we click the __Date Updated__ heading, we can sort the list from most recently updated to least recently updated.

Step 3 - Advanced Searching

You can select __Advanced Search__ to see all available bugs and then also search for many different types of bugs at once. Select all bug statuses except __Fix Commited__, __Fix Released__, and __Invalid__. Under assignee select __Nobody__ then scroll down and click __Search__. Now you can click __Date Last Updated__ and see the bugs that have most recently been updated at the top of the list.   

Step 4 - View Bug Details & Change Bug Status

Select the latest bug and observe the __Status__, __Assigned To__, and __Importance__. Notice that the __bug id__ is in the URL. Now, click the pencil icon next to __Status__. Look at the different statuses that one can select. Select __Confirm__.

Step 5 - Assign a Bug to Yourself

Select the pencil icon next to __Assigned to__ and click __Assign me__. Refresh the page to observe the comments regarding __Status__ and __Assignment changes__.

Step 6 - Adding Comments to Bugs

Scroll to the bottom of the bug details page and fill in the comment box. Click __Post Comment__ and refresh the page to view your comment.

Step 7 - File a New Bug

To file a new bug, first, make sure you are in the right directory by checking the URL. The URL for the keystone test environment would look like <https://bugs.qastaging.launchpad.net/keystone>. Next, click the __Report a bug__ icon located in the top right hand corner. Type in a brief and succinct bug summary. A set of related bug suggestions will appear and you can either review them or select __No, I need to report a new bug__. There will appear a boxx which you can fill out further information about the bug and select certain tags which will allow users to sort and search for. Finally, click __Submit Bug Report__.
