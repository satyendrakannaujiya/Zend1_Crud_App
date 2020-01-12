<?php
class IndexController extends Zend_Controller_Action
{
 
    public function init()
    {
        
        
        /* Initialize action controller here */
    }
 
    public function indexAction()
    {
        
        
         $albums = new Application_Model_DbTable_Albums();
         
        $this->view->albums = $albums->fetchAll();
    }

    // public function addAction(){
    //     $form = new Application_Form_Album();
    //     $form->submit->setLabel('Add');
    //     $this->view->form = $form;
    //     if ($this->getRequest()->isPost()) {
    //     $formData = $this->getRequest()->getPost();
    //     if ($form->isValid($formData)) {
    //     $artist = $form->getValue('artist');
    //     $title = $form->getValue('title');
    //     $albums = new Application_Model_DbTable_Albums();
    //     $albums->addAlbum($artist, $title);
       
    //     $this->_helper->redirector('index');
    //     } else {
    //     $form->populate($formData);
    //     }
    //     }
    // }

    public function addAction(){
        if($this->getRequest()->isPost()){
            $formData = $this->getRequest()->getPost();
            $artist = $formData["artist"];
            $title = $formData["title"];
            $album = new Application_Model_DbTable_Albums();
            $album->addAlbum($artist,$title);
            $this->_helper->redirector('index');

        }
    }

    public function editAction(){
        $_id=$this->_getParam('id',0);
        if($this->getRequest()->isPost()){
            $formData = $this->getRequest()->getPost();
            $artist = $formData["artist"];
            $title = $formData["title"];
             $album = new Application_Model_DbTable_Albums();
             $album->updateAlbum($_id,$artist,$title);
             $this->_helper->redirector('index');
        }
        else{
            $album = new Application_Model_DbTable_Albums();
            $albumDetails = $album->getAlbum($_id);
            $this->view->album = $albumDetails;
        }
    
    }

    public function deleteAction(){
       $_id=$this->_getParam('id',0);
       $album = new Application_Model_DbTable_Albums();
       $album->deleteAlbum($_id);
       $this->_helper->redirector('index');
    }

}