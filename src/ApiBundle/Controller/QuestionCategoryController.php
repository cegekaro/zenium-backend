<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class QuestionCategoryController extends Controller
{
    /**
     * @Route("/api/question-category/", name="api.question_category.create")
     * @Method({"POST"})
     */
    public function createAction()
    {
        $data = [
            'id' => 1,
            'name' => 'OOP',
        ];
        $data = json_encode($data);

        return new Response($data);
    }
}
