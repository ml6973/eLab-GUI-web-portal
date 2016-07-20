---
layout: post
title: Lab 5 Testing
categories: openstack-contri
author: 
description: Here install tox and do a smoke test.
---

## Testing

Step 1 - Login to the Instance

```sh
ssh  <yourip>
```

Step 2 - Install Tox

```sh
sudo pip install --upgrade tox
```

Step 3 - Install Required Dev Environment Python Packages

```sh
sudo apt-get install -y build-essential python-dev python3-dev libxml2-dev libxslt-dev lib32z1-dev libmysqlclient-dev libpq-dev libffi-dev
Step 4 - Go into the /opt/stack/cinder Directory
cd /opt/stack/cinder
```

Step 5 - Observe the Cinder Specific Commandments

```sh
cat HACKING.rst
```

Step 6 - Violate the Commandment

* Replace all references to timeutils.utcnow with datetime.now:

```sh
sudo <vi,nano,etc> /opt/stack/cinder/cinder/utils.py
```

Step 7 - Run the PEP8 Unit Test and Observe the Output

```sh
cd /opt/stack/cinder
tox -e pep8
```


Step 8 - Run the Tempest Smoke Test

```sh 
cd /opt/stack/tempest
tox -e smoke
```
