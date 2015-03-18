Feature: Question CRUD Exceptions
  As a developer accessing the API
  I need to receive appropriate exceptions whenever something goes wrong with the Question API
  In order to be able to debug the problem and solve the problem

  Scenario: Create Question Exception because of invalid data
    Given I want to make an API request with the data in file "/api-mock/question.create.request_invalid.json"
    When I make a "POST" request to "/api/question/"
    Then the response has a status code of "400"
    And the response contains valid JSON
    And the response has the value "code" set to "400"
    And the response has the value "message" set to "Entity does not validate correctly."
    And the response has extra information with the value "content" set to "This value should not be blank."

  Scenario: Update Question Exception because of resource not found
    Given I want to make an API request with the data in file "/api-mock/question.update.request.json"
    When I make a "PUT" request to "/api/question/9999"
    Then the response has a status code of "404"
    And the response contains valid JSON
    And the response has the value "code" set to "404"
    And the response has the value "message" set to "Resource not found."

  Scenario: Update Question Exception because of invalid data
    Given I want to make an API request with the data in file "/api-mock/question.update.request_invalid.json"
    When I make a "PUT" request to "/api/question/1"
    Then the response has a status code of "400"
    And the response contains valid JSON
    And the response has the value "code" set to "400"
    And the response has the value "message" set to "Entity does not validate correctly."
    And the response has extra information with the value "difficulty" set to "This value should not be blank."

  Scenario: Delete Question Exception because of resource not found
    When I make a "DELETE" request to "/api/question/9999"
    Then the response has a status code of "404"
    And the response contains valid JSON
    And the response has the value "code" set to "404"
    And the response has the value "message" set to "Resource not found."

  Scenario: Retrieve Question Exception because of resource not found
    When I make a "GET" request to "/api/question/9999"
    Then the response has a status code of "404"
    And the response contains valid JSON
    And the response has the value "code" set to "404"
    And the response has the value "message" set to "Resource not found."

  Scenario: Associate Question to Question Category Exception because of Question resource not found
    When I make a "PATCH" request to "/api/question/9999/question-category/1"
    Then the response has a status code of "404"
    And the response contains valid JSON
    And the response has the value "code" set to "404"
    And the response has the value "message" set to "Resource not found."

  Scenario: Associate Question to Question Category Exception because of Question Category resource not found
    When I make a "PATCH" request to "/api/question/1/question-category/9999"
    Then the response has a status code of "404"
    And the response contains valid JSON
    And the response has the value "code" set to "404"
    And the response has the value "message" set to "Resource not found."