<?php

namespace  Bilbous\WordBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FakeController extends Controller
{
    public function streamAction()
    {
        // create an empty object
        $phpWordObject = $this->createWordObject();
        // create the writer
        $writer = $this->get('phpword')->createWriter($phpWordObject, 'Word2007');
        // create the response
        $response = $this->get('phpword')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.openxmlformats-officedocument.wordprocessingml.document; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=stream-file.docx');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;
    }

    public function storeAction()
    {
        // create an empty object
        $phpWordObject = $this->createWordObject();
        // create the writer
        $writer = $this->get('phpword')->createWriter($phpWordObject, 'Word2007');
        $filename = tempnam(sys_get_temp_dir(), 'docx-') . '.docx';
        // create filename
        $writer->save($filename);

        return new Response($filename, 201);
    }

    public function readAndSaveAction()
    {
        $filename = $this->container->getParameter('doc_fixture_absolute_path');
        // create an object from a filename
        $phpWordObject = $this->createWordObject($filename);
        // create the writer
        $writer = $this->get('phpword')->createWriter($phpWordObject, 'Word2007');
        $filename = tempnam(sys_get_temp_dir(), 'docx-') . '.docx';
        // create filename
        $writer->save($filename);

        return new Response($filename, 201);
    }

    /**
     * utility class
     * @return mixed
     */
    private function createWordObject()
    {
        $phpWordObject = $this->get('phpword')->createPHPWordObject();

        $phpWordObject->getProperties()->setCreator("Bilbous")
            ->setLastModifiedBy("Bilbous")
            ->setTitle("Office 2007 DOCX Test Document")
            ->setSubject("Office 2007 DOCX Test Document")
            ->setDescription("Test document for Office 2007 DOCX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $section = $phpWordObject->addSection();
        $section->addText('Hello Word');

        return $phpWordObject;
    }
}
