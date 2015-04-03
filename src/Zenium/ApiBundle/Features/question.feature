Feature: Question CRUD
  As a developer accessing the API
  I need to be able to create, review, update and delete Questions of varying difficulty
  In order to be able to define exercises for the candidates to take so that we can assess their technical level

  Scenario: Create Question
    Given I want to make an API request with the data in file "/api-mock/question.create.request.json"
    When I make a "POST" request to "/api/question/"
    Then the response has a status code of "200"
    And the response contains valid JSON
    And the response has the value "content" set to "What is 42?"
    And the response has the value "difficulty" set to "5"

  Scenario: Update Question
    Given I want to make an API request with the data in file "/api-mock/question.update.request.json"
    When I make a "PUT" request to "/api/question/2"
    Then the response has a status code of "200"
    And the response contains valid JSON
    And the response has the value "content" set to "Which of the answers below best describes the OOP term 'inheritance'?"
    And the response has the value "id" set to "2"
    And the response has the value "difficulty" set to "2"

  Scenario: Delete Question
    When I make a "DELETE" request to "/api/question/2"
    Then the response has a status code of "200"

  Scenario: Retrieve Question
    When I make a "GET" request to "/api/question/3"
    Then the response has a status code of "200"
    And the response contains valid JSON
    And the response has the value "content" set to "What is the role of a Repository?"
    And the response has the value "difficulty" set to "2"
    And the response has the value "id" set to "3"

  Scenario: Retrieve Question when resource no longer exists
    When I make a "GET" request to "/api/question/2"
    Then the response has a status code of "404"
    And the response contains valid JSON
    And the response has the value "code" set to "404"
    And the response has the value "message" set to "Resource not found."

  Scenario: Retrieve Question List
    When I make a "GET" request to "/api/question/"
    Then the response has a status code of "200"
    And the response contains valid JSON
    And the response contains an array with "3" items.

  Scenario: Associate Question to Question Category
    When I make a "PATCH" request to "/api/question/1/question-category/1"
    Then the response has a status code of "200"