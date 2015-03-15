Feature: Question Category CRUD
  As a developer accessing the API
  I need to be able to create, review, update and delete Question Categories
  In order to be able to group questions into specific Categories that can be included into Tests

  Scenario: Create Question Category
    Given I want to make an API request with the data in file "/api-mock/question_category.create.request.json"
    When I make a "POST" request to "/api/question-category/"
    Then the response has a status code of "200"
    And the response contains valid JSON
    And the response has the value "name" set to "Agile"

  Scenario: Update Question Category
    Given I want to make an API request with the data in file "/api-mock/question_category.update.request.json"
    When I make a "PUT" request to "/api/question-category/2"
    Then the response has a status code of "200"
    And the response contains valid JSON
    And the response has the value "name" set to "Update test"
    And the response has the value "id" set to "2"

  Scenario: Delete Question Category
    When I make a "DELETE" request to "/api/question-category/2"
    Then the response has a status code of "200"
