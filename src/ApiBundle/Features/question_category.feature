Feature: Question Category CRUD
  As a developer accessing the API
  I need to be able to create, review, update and delete Question Categories
  In order to be able to group questions into specific Categories that can be included into Tests

  Scenario: Create Question Category
    Given I am making a POST request to "/api/question-category/"
    When I send the data in file "api-mocks/question_category.create.json"
    Then I should get the API response in "api-mocks/question_category.create.json"
