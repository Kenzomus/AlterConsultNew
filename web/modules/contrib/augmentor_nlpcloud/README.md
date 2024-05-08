CONTENTS OF THIS FILE
---------------------

 * Introduction
 * About NLP Cloud
 * Requirements
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------

The Augmentor NLP Cloud is a submodule of Augmentor.
It provides an implementation of an Augmentor plugin to allow Augmentor
to interface with NLP Cloud's REST API.

ABOUT NLP CLOUD
---------------

NLP Cloud serves high performance pre-trained or custom models for NER, 
sentiment-analysis, classification, summarization, dialogue summarization, 
paraphrasing, intent classification, product description and ad generation, 
chatbot, grammar and spelling correction, keywords and keyphrases extraction, 
text generation, image generation, blog post generation, code generation, 
question answering, automatic speech recognition, machine translation, 
language detection, semantic search, semantic similarity, tokenization, 
POS tagging, embeddings, and dependency parsing.

[Official documentation](https://docs.nlpcloud.com) 

REQUIREMENTS
------------

This module requires the following modules:

 * [Augmentor](https://www.drupal.org/project/augmentor)
 * [PHP Client For NLP Cloud](https://github.com/nlpcloud/nlpcloud-php)


INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module. Visit
   https://www.drupal.org/node/1897420 for further information.


CONFIGURATION
-------------

 * Configure the user permissions in Administration » People » Permissions:

   - Administer augmentors

     Users with this permission will see the webservices > augmentors
     configuration list page. From here they can add, configure, delete, enable
     and disabled augmentors.

     Warning: Give to trusted roles only; this permission has security
     implications. Allows full administration access to create and edit
     augmentors.


MAINTAINERS
-----------

Current maintainers:
 * Eleo Basili (eleonel) - https://www.drupal.org/u/eleonel
 * Naveen Valecha (naveenvalecha) - https://www.drupal.org/u/naveenvalecha

This project has been sponsored by: [Morpht Pty Ltd](https://www.morpht.com)

<img alt="Morpht Logo" src="https://www.morpht.com/sites/default/files/2020-12/
morpht_logo__default.png" height="40px">

We are a team of dedicated and enthusiastic designers, programmers and site
builders who know how to get the most from Drupal. We work for a variety of
clients in government, education, media and pharmaceutical sectors.
