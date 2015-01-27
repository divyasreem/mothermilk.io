<?php

namespace Verifications\Controller;


use Zend\MVC\Controller\AbstractActionController;

use Zend\View\Model\ViewModel;

// use Auth\Model\Auth;          we don't need the model here we will use Doctrine em 
use Verifications\Entity\Verification; // only for the filters
use Verifications\Form\VerificationForm;       // <-- Add this import
// use Verifications\Form\LoginFilter;


class IndexController extends AbstractActionController {
		/**             
		 * @var Doctrine\ORM\EntityManager
		 */                
		protected $em;

		public function getEntityManager(){
			if (null === $this->em) {
				$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
			}
			return $this->em;
		}

		public function  IndexAction () {
			$form = new VerificationForm();
			$form->get('submit')->setValue('Submit');
			$message = null;
			$verifications = array();
			$em = $this->getEntityManager();
			$request = $this->getRequest();
			if ($request->isPost()) {
				$verifications = $em->getRepository('Verifications\Entity\Verification')->findAll();
				// $message = $this->params()->fromQuery('message', 'foo');
				
			}
			return new ViewModel(array(
					'message' => $message,
					'verifications'	=> $verifications,
					'form'	=> $form,
		//			'myUsers' => $myUsers
				));
		}
	
}
?>