Feature: Browse the Blocks
  In order to list instantiated blocks
  As an editor
  I want to edit configuration of the block

  #@javascript
  Scenario:
    Given I am on /blocks/list
    Then the response status code should be 200
    Then I should see "a static block n°2"

  #@javascript
  Scenario:
    Given I edit the block named "a poll block n°2"
    Then I should see "Edition of the Poll Block a poll block n°2"

  #@javascript
  Scenario:
    Given I edit the block named "a poll block n°2"
    When I select the template "a template n°3" from "pollblock_frontend_template"
    And I press "Save block"
    Then the current block should have the "a template n°3" template
