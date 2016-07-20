---
layout: post
title: Lab 8 Document Change Verification
categories: openstack-contri
author: 
description: This is a short lesson on how to do version control for your OpenStack contributions.
---

## Document Change Verification

Step 1 - Clone OpenStack Manuals

```sh
ssh <yourip>
git clone https://git.openstack.org/openstack/openstack-manuals
```

Step 2 - Use Tox to Convert the OpenStack Install Guide for Ubuntu (RST to HTML)

```sh
cd ~/openstack-manuals
tox -e install-guide-ubuntu
```

Step 3 - Open the Generated HTML

```sh
cd doc/install-guide/build-ubuntu /html/
python -m SimpleHTTPServer 8000
```

From your browser, go to http://your_ip:8000

Step 4 - Make an Edit to the Install Guide

<vi,nano,etc> ~/openstack-manuals/doc/install-guide/source/glance.rst

```sh
===========================================================
Image service - The Glance Image Service...is really cool!
===========================================================
```

Step 5 - Use Tox to Convert RST to HTML

```sh
cd ~/openstack-manuals
tox -e install-guide-ubuntu
```

Step 6 - Open the Generated HTML (With Your Addition)

```sh
cd doc/install-guide/build-ubuntu/html/
python -m SimpleHTTPServer 8000
From your browser, go to http://your_ip:8000
```
