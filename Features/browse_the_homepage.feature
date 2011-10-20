Feature: Browse the homepage
  In order to see easily the goal of this website
  As a visitor
  I want to see most important informations on the homepage

  #@javascript
  Scenario:
    Given I am on /
    Then the response status code should be 200
    Then I should see "Hello!"
