Feature: Question Category CRUD Exceptions
  As a developer accessing the API
  I need to receive appropriate exceptions whenever something goes wrong with the Question Category API
  In order to be able to debug the problem and solve the problem

  Scenario: Create Question Category
    Given I want to make an API request with the data in file "/api-mock/question_category.create.request.json"
    When I make a "POST" request to "/api/question-category/"
    Then the response has a status code of "200"
    And the response contains valid JSON
    And the response has the value "name" set to "Agile"

  Scenario: Create Question Category Exception because of invalid data
    Given I want to make an API request with the data in file "/api-mock/question_category.create.request_invalid.json"
    When I make a "POST" request to "/api/question-category/"
    Then the response has a status code of "400"
    And the response contains valid JSON
    And the response has the value "code" set to "400"
    And the response has the value "message" set to "Entity does not validate correctly."
    And the response has extra information with the value "name" set to "This value should not be blank."

  Scenario: Update Question Category Exception because of invalid data
    Given I want to make an API request with the data in file "/api-mock/question_category.update.request_invalid.json"
    When I make a "PUT" request to "/api/question-category/1"
    Then the response has a status code of "400"
    And the response contains valid JSON
    And the response has the value "code" set to "400"
    And the response has the value "message" set to "Entity does not validate correctly."
    And the response has extra information with the value "name" set to "This value should not be blank."

  Scenario: Update Question Category Exception because of resource not found
    Given I want to make an API request with the data in file "/api-mock/question_category.update.request_invalid.json"
    When I make a "PUT" request to "/api/question-category/9999"
    Then the response has a status code of "404"
    And the response contains valid JSON
    And the response has the value "code" set to "404"
    And the response has the value "message" set to "Resource not found."

  Scenario: Delete Question Category Exception because of resource not found
    When I make a "DELETE" request to "/api/question-category/9999"
    Then the response has a status code of "404"
    And the response contains valid JSON
    And the response has the value "code" set to "404"
    And the response has the value "message" set to "Resource not found."
