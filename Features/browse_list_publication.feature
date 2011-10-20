Feature: Browse the publication list
  In order to see the total number publicated documents
  As an editor
  I want to see the number on the top of the page

  #@javascript
  Scenario:
    Given I am on /publication
    Then the response status code should be 200
    Then I should see "0 article(s)"
    Then I should see "0  news"
