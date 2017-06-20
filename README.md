# eLab Web Portal

Requires Xampp (PHP version 5.6.xx)
Requires MongoDB (version 3.4)


Install Python 2.6 Dependencies:
```
$ sudo apt-get update
$ sudo apt-get install python-pip
$ sudo apt-get install python-dev libmysqlclient-dev
$ sudo pip install MySQL-python
$ sudo pip install requests
```

## Deploying New Course Content

### 1. Navigate to the course content directory
```
WebContent -> resources -> courseData
```

### 2. Add a course (if needed)

The course directory defines the courses that'll appear on the main page.  The document must be in YAML format and can be named anything.  Each file represents one course.  The following is an example:

example.yaml
```
- title: Example Course Title
  description: The course description goes here.
  image: This must match the image name stored on the cloud.
  topicFile: exampleTopic.yaml (this filename must match with the file created in part 3)
```

### 3. Add a topic (if needed) 
The topics directory defines the topics that'll appear on the main page underneath each course description.  The document must be in YAML format and the name must match the "topicFile:" attribute defined previously.  The file can contain multiple topics. The following is an example:

exampleTopic.yml
```
- title: Example Topic Title
  icon: <i class="fa fa-download" aria-hidden="true"></i> (leave this line exactly as it appears)
  description: (leave blank)
  image:  This must match the image name stored on the cloud.
  link: examplePost (this must match the directory name that is defined in part 4)
```

### 4. Add posts
The posts directory defines the posts (labs) that'll appear once you click a topic.  The directory name must match the "link:" attribute defined previously.  The files that populate this directory must be in MD format, with the **required header**.  Each file represents one lab.  An example md document is shown below:

examplePost / post1.md
```
---
layout: post (leave this line exactly as it appears)
title: Example Title
categories: examplePost (must match the directory name that this file exists in)
author: John Smith
description: Post (lab) description goes here
---

All remaining post (lab) content goes here.
```

### 5. Add YouTube video (if needed)
The videos directory contains a single file "videos.yaml".  Simply append the following code into the document with the correct information to add your video to the post (lab).
```
- title: Example Title (this title must match the title defined for the post you wish to add the video)
  code: <div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="{insert YouTube embed link here}" frameborder="0" allowfullscreen></iframe></div>

```

### Things to keep track of
1. The website will sort the document files alphabetically, so if you wish to change the order in which items appear, you must ensure that the names of the documents correspond your desired order.
2. The YAML parser used for this site will fail if there is improper usage of whitespaces and tabs.  Please ensure that for each document you create or append to in YAML, that there are no unnecessary or trailing whitespaces.  This also applies to the special header described in part 4.
3. Please ensure that no file or directory names contain whitespaces.
