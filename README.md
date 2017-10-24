#Description
Test exercise for Creditstar Group

As a very first shortlisting procedure of candidates, we have set up a test exercise that the interested applicants are executing.  

We assume that interested applicants would be able to complete the test within few days. Once test is completed please forward the results to <kadriann@creditstar.com>.

#1 Setup.
Setting up is easy. You need Vagrant with VirtualBox to setup the virtual machine locally. 
* VirtualBox https://www.virtualbox.org/wiki/Downloads 
* Vagrant https://www.vagrantup.com/downloads.html

Once finished open up terminal and go to the project root.

To build your virtual machine run $ vagrant up . The script might ask you for your GitHub login credentials to download dependencies via API. Alternatively you can add your github API token to bootstrap.sh file after GITHUB_TOKEN.

Once vagrant has finished with the setup your dev environment should be all set up. You can now access web server at: http://192.168.50.10/ . If those mappings don't suit you, you can Modify the Vagrantfile.

#2 Database

The database consists of two tables created for you 'loan' and 'user. Each User can have multiple Loans. Each loan must have a User.

#3 Assignment

You need to create a webapp that provides

* viewing, adding, editing and removing Loans and Users in the database ( form validation ).
http://www.yiiframework.com/doc-2.0/guide-start-forms.html
http://www.yiiframework.com/doc-2.0/guide-input-forms.html

* Listing out all the Loans and Users (pagination, filtering and sorting). -> http://www.yiiframework.com/doc-2.0/guide-output-pagination.html | http://www.yiiframework.com/doc-2.0/guide-output-sorting.html

* There are two Json files in the root folder of the project ( users.json and loans.json ) with predefined loans and users. You must import that data into the database programmatically. For example create a script that imports the file or use a migration -> http://www.yiiframework.com/doc-2.0/guide-db-migrations.html

* Write a method to get user age from user personal code. All supplied personal codes are in Estonian personal code format: https://en.wikipedia.org/wiki/National_identification_number#Estonia
Display user age in user view.

* Style of the page should be based on recruitment.png file that is included with the project under root.

Use Bootstrap available functionalities as much as you can. Bonus for responsiveness ( rather mandatory ) and SCSS usage.

Font used -> http://font.ubuntu.com/

* Write a test case to test if your user age calculation method returns correct age and test if user is allowed to apply for a loan (user is not underage).

* Once the assignment is done upload to a public git repository (github, bitbucket)

# Evaluation Criteria

* Is every feature working.
* Use as much Yii2 built in features. For layout use Bootstrap which comes with Yii2 OOTB ( feel free to use Foundation 6 instead of Bootstrap)
* MVC usage. Using models ( keyword here is Yii's built in tool Gii for creating them from database tables), views and controllers correctly.
http://www.yiiframework.com/doc-2.0/ext-gii-index.html
http://www.yiiframework.com/doc-2.0/guide-structure-overview.html
* Code legibility.
* Git usage. How commits are created and commented. We want to see the process of the work.
* Finished code should be possible to deploy and run the same way as described in: #1 Setup.

Relevant tools/helpful links:
Vagrant - https://www.vagrantup.com/downloads.html
Virtualbox(OSX) - http://download.virtualbox.org/virtualbox/4.3.28/VirtualBox-4.3.28-100309-OSX.dmg
( for windwos please go to http://download.virtualbox.org )
Github_token for bootstrap.sh - https://github.com/settings/tokens

After vagrant setup:
Database link - http://localhost:8080/phppgadmin/
Page link - http://localhost:8080/web/

Should any technical questions arise feel free to contact: <helari.laurent@creditstar.com>


Yii 2 Basic Project Template
============================

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

More about Yii:
* https://github.com/yiisoft/yii2
* http://www.yiiframework.com/doc-2.0/guide-index.html
