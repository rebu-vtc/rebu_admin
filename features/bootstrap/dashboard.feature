# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html
Feature:
    Background: Log in as admin
        Given I am on "admin/connexion"
        When I fill in "email" with "hasana.ali@gmail.com"
        When I fill in "password" with "adminPassword"
        When I press "S'identifier"
        Then I should see "Dashboard en construction..."
    
    Scenario: 
        Given I am on "admin/dashboard"
        Then I should see "Dashboard en construction..."
