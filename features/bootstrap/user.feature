# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html
Feature:
    Background: Log in as admin
        Given I am on "/admin/connexion"
        When I fill in "email" with "hasana.ali@gmail.com"
        When I fill in "password" with "adminPassword"
        When I press "S'identifier"
        Then I should see "Dashboard en construction..."
    
    Scenario: User List page
        Given I am on "/admin/dashboard/utilisateurs"
        Then I should see "Liste des utilisateurs"

    Scenario: Create User Administrator Page
        Given I am on "/admin/dashboard/utilisateurs/ajouter"
        Then I should see "Ajouter un utilisateur"
        When I fill in "admin_user[email]" with "test@test.com"
        When I fill in "admin_user[password]" with "passwordtest"
        When I fill in "admin_user[isVerified]" with "1"
        When I fill in "admin_user[agreeTerms]" with "1"
        When I fill in "admin_user[status]" with "2"
        When I fill in "admin_user[type]" with "Administrator"
        When I check "admin_user_roles_0"
        When I press "Enregistrer"
        Then I should see "Fiche utilisateur"
