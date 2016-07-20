---
layout: post
title: Lab 3 Setup Gerrit Account
categories: openstack-contri
author: 
description: Here we need to set up a Gerrit account which is used as a sort of clearing house for all code transactions.
---

## Setup Gerrit Account

Step 1 - Login to the Instance
  	ssh  <your_ip>

Step 2 - Create the SSH Key Pair

```sh
ssh-keygen -t rsa -b 4096 –C "email@example.com" -f ~/.ssh/gerrit
```

Step 3 - Setup the SSH Config

```sh
cat > ~/.ssh/config <<EOF
host review.openstack.org
HostName review.openstack.org
IdentityFile ~/.ssh/gerrit
EOF
```

Step 4 - Login to Gerrit

Go to <review.openstack.org> and sign in using your Ubuntu One credentials.

Step 5 - Choose Username on Gerrit

Click your name, which is located on the top right hand corner, select settings, on the left hand side you will see __Profile__ (click that), and type your desired username.

Step 6 - Submit Public SSH Key to Gerrit

Copy the contents of the public key you generated on __Step 2__. Click your name in the top right hand corner again, select settings, and then click __SSH Public Keys__ located on the left hand side. You should be able to add the SSH key to your account by clicking add and pasting in the key to the text box.

Step 7 - Sign the Contributor License Agreement

Once again, navigate to the main page and click your name in the top right hand corner, click settings, on the left hand side you will click agreements, and then click the __New Contributor Agreement__ link. Select __ICLA OpenStack Individual Contributor License Agreement__ and review the agreement. Review your full name and preferred email, mailing address, country, phone number, and then select _I AGREE__. Click __Submit Agreement__.
