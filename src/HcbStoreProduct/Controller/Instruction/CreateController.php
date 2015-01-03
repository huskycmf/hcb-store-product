<?php
namespace HcbStoreProduct\Controller\Instruction;

use HcBackend\Controller\AbstractController;
use Zend\Mvc\MvcEvent;

class CreateController extends AbstractController
{
    /**
     * @param \Zend\Mvc\MvcEvent $mvcEvent
     * @return mixed | void
     */
    public function onDispatch(MvcEvent $mvcEvent)
    {
        $files = $this->params()->fromFiles('instruction');
        $response = $this->getResponse();

        if ($files['type'] != 'application/pdf') {
            $response->setContent('<html><head></head><body><textarea name="response">{"message":"Не корректный файл", "status":0}</textarea></body></html>');
        } else {
            if (!move_uploaded_file($files['tmp_name'], '/tmp/'.$files['name']))  {
                $response->setContent('<html><head></head><body><textarea name="response">{"message":"Не удалось загрузить файл",
                   "status":0}</textarea></body></html>');
            } else {
                $response->setContent('<html><head></head><body><textarea name="response">{"message":"Файл успешно загружен",
                   "name": "/tmp/'.$files['name'].'",
                   "status": 1}</textarea></body></html>');
            }
        }

        $response->getHeaders()->addHeaders(
                array('Content-Type'=>'text/html; charset=utf-8'));

        return $response;
    }
}
