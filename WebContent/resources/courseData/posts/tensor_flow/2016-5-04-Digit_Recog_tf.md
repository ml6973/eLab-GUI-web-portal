---
layout: post
title: Lab 4 Digit Recognition using Tensor Flow  
categories: tensor-flow
author: Mitha Ann Philip
description: MNIST Digit Recognition is an introduction towards multiclass classification. The database used is MNIST, which contains handwritten images of digits. This is a practical guide which implements a neural network model using Tensor Flow to recognize the digits in the image and to classify them accordingly.
---
## Introduction

This section primarily focusses on understanding a neural network model using tensor flow. We would use the MNIST, a large dataset of 60,000 handwritten digit images for training the neural network model and 10,000 samples as test cases to test the neural network. MNIST digit recognition task is fundamental towards understanding-how to model a neural net using tensor flow. Our goal in this section would be to implement a neural model for the recognition process and to calculate the accuracy of our model. We have followed the tensor flow [tutorial](tensorflow.org).

## Prerequisite

Knowledge on neural networks and on basic tensor operations. We also assume that you have installed tensor flow. 

### MNIST Digit Classification
MNIST is a computer vision dataset which consist of 28 x 28 images of handwritten digits. MNIST has two main parts: Image of a handwritten digit, xs The corresponding label for the digits, ys (ranging from 0 to 9). 
The network model used to do the recognition using softmax is described in [tensor flow tutorial](https://www.tensorflow.org/versions/r0.9/tutorials/mnist/beginners/index.html)
The model has 2 layers. Input layer, hidden layer and the output layer. The weighted inputs are added with the bias values and is fed as input to the hidden layer. This layer has the softmax function and the output is obtained in terms of probabilistic values which decides the group to which the input image belongs.

To train a model that implements softmax, a gradient descent algorithm is used to minimize the cost which is in terms of weights and bias. That is ,the gradient descent algorithm helps to find the weights and bias which gives the least cost. This is explained by considering cost as a function of 2 values w and b. The cost function used in the tutorial is cross entropy, which is obtained by getting the logarithm of the output of the softmax function. This indicates the closeness of the predicted values to the targeted output / error obtained.

During forward pass in back propagation algorithm, the weighted inputs added with bias value forms the input to the hidden layer in the network which is then modified using an activation function. Back propagation algorithm deals with error calculation which involved the target value and the output obtained. The error is used in backward pass so that the weights are updated in such a manner that the error is minimized. In short, this algorithm helps to train a neural network. The main goal of using back propagation algorithm is to help gradient descent module compute the least cost, which is a function of weight and bias.

