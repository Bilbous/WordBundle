<?php

namespace Bilbous\WordBundle;

use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Factory for PHPWord objects, StreamedResponse, and PHPWord_Writer_IWriter.
 *
 * @package Bilbous\WordBundle
 */
class Factory
{
    private $phpWordIO;

    public function __construct($phpWordIO = '\PhpOffice\PhpWord\IOFactory')
    {
        $this->phpWordIO = $phpWordIO;
    }
    /**
     * Creates an empty PHPWord Object if the filename is empty, otherwise loads the file into the object.
     *
     * @param string $filename
     *
     * @return \PhpOffice\PhpWord\PHPWord
     */
    public function createPHPWordObject($filename =  null)
    {
        if (null == $filename) {
            $phpWordObject = new \PhpOffice\PhpWord\PhpWord();

            return $phpWordObject;
        }

        return call_user_func(array($this->phpWordIO, 'load'), $filename);
    }

    /**
     * Create a writer given the PHPWordObject and the type,
     *   the type coul be one of IOFactory::$_autoResolveClasses
     *
     * @param \PhpOffice\PhpWord\PHPWord $phpWordObject
     * @param string    $type
     *
     *
     * @return \PhpOffice\PhpWord\Writer\WriterInterface
     */
    public function createWriter(\PhpOffice\PhpWord\PhpWord $phpWordObject, $type = 'Word2007')
    {
        return call_user_func(array($this->phpWordIO, 'createWriter'), $phpWordObject, $type);
    }

    /**
     * Stream the file as Response.
     *
     * @param \PhpOffice\PhpWord\Writer\WriterInterface $writer
     * @param int                      $status
     * @param array                    $headers
     *
     * @return StreamedResponse
     */
    public function createStreamedResponse(\PhpOffice\PhpWord\Writer\WriterInterface $writer, $status = 200, $headers = array())
    {
        return new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            },
            $status,
            $headers
        );
    }
}
