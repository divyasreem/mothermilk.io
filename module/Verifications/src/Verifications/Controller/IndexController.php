<?php

namespace Verifications\Controller;


use Zend\MVC\Controller\AbstractActionController;
// Pagination
use DoctrineModule\Paginator\Adapter\Selectable as SelectableAdapter;
use Doctrine\Common\Collecttions\Criteria as DoctrineCriteria; // for criteria
use Zend\Paginator\Paginator;


use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
// Zend Annotation 
use Zend\Form\Annotation\AnnotationBuilder;
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
			$request = $this->getRequest();
			$form->get('submit')->setValue('Submit');
			$start = ($request->isPost())? $request->getPost('from'):date("Y-m-d"); 
			$end = ($request->isPost())? $request->getPost('to'):date("Y-m-d"); 
			$form->get('from')->setValue($start);
			$form->get('to')->setValue($end);
			$message = null;
			$paginator = array();
			$em = $this->getEntityManager();
			
			$c = 'Correct';
		    $queryBuilder = $em->createQueryBuilder('verification');
			$queryBuilder->select("i")
			           	 ->from('Verifications\Entity\Verification', 'i')
			           	 ->where("i.scan = :scanType AND i.ts >= :start AND i.ts <= :end")
			             ->setParameter('scanType', $c)
			             ->setParameter('start', $start)
			             ->setParameter('end', $end);
			$adapter = new DoctrinePaginator(new ORMPaginator($queryBuilder)); 
			$paginator = new Paginator($adapter);
			$page = 1;
			if ($this->params()->fromRoute('page')) $page = $this->params()->fromRoute('page');
			$paginator->setCurrentPageNumber((int)$page)
					  ->setItemCountPerPage(10);		

			return new ViewModel(array(
				'message' => $message,
				'form'	=> $form,
				'paginator' => $paginator,
			));
		}
	
}
?>