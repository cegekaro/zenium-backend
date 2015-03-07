<?php

namespace ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am making a POST request to :arg1
     */
    public function iAmMakingAPostRequestTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I send the data in file :arg1
     */
    public function iSendTheDataInFile($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should get the API response in :arg1
     */
    public function iShouldGetTheApiResponseIn($arg1)
    {
        throw new PendingException();
    }
}
