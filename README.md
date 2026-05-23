# BeMine_wedding_website

A wedding planner website designed to help couples organise their wedding in Malta.

## Tech Stack
* Backend: PHP (mysqli)
* Backend: API 
* Database: MySQL (phpMyAdmin)
* Frontend: HTML, CSS, Bootstrap, JavaScript
* Local server: XAMPP (Apache + MySQL)


## About the Project 

This project is a wedding planner website that supports Maltese and foreign couples organising their wedding in Malta. 

This website allow couples to:
* View the Home page 
* Create a new account 
* Login 
* Create a wedding plan 
* Edit the wedding plan 
* Track completed wedding tasks
* View a wedding date countdown
* Monitor their budget using a budget counter
* Browse vendors by category
* Create a guest list
* View the guest list

## Multiple user roles 
* Couples
* Administrators 
* Vendors 
* Wedding Planner 

Currently, the Couples role and its main features have been developed, while the remaining roles are still in progress.
---
## What has been implemented so far

### User Authentication
* Register a new account
* Login system
* Session management
* Password hashing 

### Create account and Login 
        - You can create an account and login  
* When creating an account, the user's role will be Couple by default.
* Registered users should write e-mail and password and be able to login 
* The users will be redirected to their home page depending on the role (for the future)

### Wedding Planning
* Create personalised wedding plans
* Select wedding categories
* Mark tasks as completed
* Wedding countdown timer
* Budget tracking system

### Vendor Management
* Browse vendors by category
* View vendor information
* Request quotations

### Guest List
* Add guests
* View guest list

### Accessibility 
* This website has some accessibility features such as 
    - Keyboard Navigation  
        - tab - to move forward
        - shift + tab - to move backwards
        - enter - to click
        - alt + left /right arrow - to go back/forward
        - space – to scroll down 
        - shift + space – to scroll up 
    - Colour Contrast 
    - Responsive to different screens 


---

## Database

The project uses MySQL with phpMyAdmin for database management.

Main database tables include:

* users
* wedding_plan
* wedding_plan_task
* vendor
* guest
* category
* role
* task

---

