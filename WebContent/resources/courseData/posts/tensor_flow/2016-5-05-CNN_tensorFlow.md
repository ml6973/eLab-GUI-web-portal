---
layout: post
title: Lab 5 Convolutional Neural Network using Tensor Flow  
categories: tensor-flow
author: Mitha Ann Philip
description: Convolutional Neural Networks are variants of multilayer perceptrons. We will apply convolutional nets to the digit recognition network model and see if it improves the accuracy of digit recognition. This lab is a practical guide focussing on applying Convolutional Neural Network (CNN) to the digit recognition neural network model.
---

## Introduction
Convolutional Neural Network or CNN is key towards most of the computer vision systems today and is held responsible for highly 
valued results in image classification problems. CNN in simple terms is multiple copies of the same neuron. This tutorial deals 
with basic understanding of a convolutional neural network and would also direct you to implement understand how to apply CNN to 
MNIST digit recognition task using tensor flow.

## Prerequisites

Knowledge in Machine Learning and also basic tensor flow.

## Convolutional Neural Networks

CNNs does convolutions of multiple layers of non linear activation functions on the input layer. Feedforward aritificial neural network involves multiple layers of neurons that takes care of the processes done on a portion in the input image. Biologically, this region can be termed as receptive fields. Output from the receptive fields are tiled up for better original image representation.

In simple terms, convolution can be considered as a window/filter/kernel that slides over each element in the input image. Convolutional Neural Networks (CNN) are those with multiplelayers of convolution applied to an image. The filter indicates a function which needs to be applied over the image. Each of the layers in convolutional neural networks applies different filters and the outputs are al combined to get the final result.The filter values are learnt during the training phase.

Instead of a fully connected layer, CNN uses a local connection where convolution is applied to the input and it is a region from the input layer which is connected to the output layer neurons. This way, there is better performance and lesser requirement on memory. The values of the filter that is applied to the input is learned during the training phase. The 2 main noteworthy aspects that is satisfed here are: Invariance to transformation and compositionality. Pooling provides invariance to transformations like rotation, translation, scaling. The filter applied to input( edge detection from input pixels) composes the local region (to shape detection) to move to a higher level(like facial shape detection) that helps in classification. Pooling is applied after convolution. It gets the input subsamples. Pooling is done by applying a max operation on the convolution results. This is done so as to get a fixed size output and also to reduce dimensionality intending to keep the important features.
