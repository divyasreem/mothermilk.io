<?php

namespace Verifications\Controller;


use Zend\MVC\Controller\AbstractActionController;
// Pagination
// use DoctrineModule\Paginator\Adapter\Selectable as SelectableAdapter;
// use Doctrine\Common\Collecttions\Criteria as DoctrineCriteria; // for criteria
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
			$start = ($request->isGet())?$this->params()->fromQuery('from',date("Y-m-d")):''; 
			$end = ($request->isGet())? $this->params()->fromQuery('to',date("Y-m-d")):''; 
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
			if ($this->params()->fromQuery('page')) $page = $this->params()->fromQuery('page');
			$paginator->setCurrentPageNumber((int)$page)
					  ->setItemCountPerPage(10);		

			return new ViewModel(array(
				'message' => $message,
				'form'	=> $form,
				'paginator' => $paginator,
				 'data' => $this->params()->fromQuery()
            
			));
		}

		public function reportAction() {
			$form = new VerificationForm();
			$request = $this->getRequest();
			$form->get('submit')->setValue('Submit');
			$start = $this->params()->fromQuery('from',date("Y-m-d"));
			$end = $this->params()->fromQuery('to',date("Y-m-d"));
			$form->get('from')->setValue($start);
			$form->get('to')->setValue($end);
			$paginator = array();
			$em = $this->getEntityManager();
			$message = null;
		    $reports = $this->getEntityManager()->getRepository('Verifications\Entity\Verification')
		     			->createQueryBuilder('i')
			 			->where("i.ts >= :start AND i.ts <= :end")
			            ->setParameter('start', $start)
			            ->setParameter('end', $end)
			            ->getQuery()->getResult();;
			$final_array = array();
			$graph_values = array();
			foreach($reports as $report) {
				$date = date('Y-m', strtotime($report->getTs()));
				$final_array[$date][$report->getScan()][] = $report;
			}
			$x_axis = array();
			$y_axis = array();
			foreach ($final_array as $key => $value) {
				array_push($x_axis, $key);
				$y_axis['Correct_count'][] = isset($value['Correct'])?count($value['Correct']):0;
				$y_axis['Denied_count'][] = isset($value['Denied'])?count($value['Denied']):0;
				$y_axis['Override_count'][] = isset($value['Override'])?count($value['Override']):0;
				// $graph_values[$key]['Correct_count'] = isset($value['Correct'])?count($value['Correct']):0;
				// $graph_values[$key]['Denied_count'] = isset($value['Denied'])?count($value['Denied']):0;
				// $graph_values[$key]['Override_count'] = isset($value['Override'])?count($value['Override']):0;
			}
			return new ViewModel(array(
				'message' => $message,
				'form'	=> $form,
				'x_axis' => $x_axis,
				'y_axis' => $y_axis,
				'data' => $this->params()->fromQuery()
            
			));		

		}
	
}
?>