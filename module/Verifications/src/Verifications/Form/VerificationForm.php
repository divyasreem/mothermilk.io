<?php
namespace Verifications\Form;

use Zend\Form\Form;

class VerificationForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('index');
        $this->setAttribute('method', 'post');
        /*
		$this->add(array(
            'name' => 'usr_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
		*/
        

         $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'serach_by',
            'options' => array(
                'label' => 'Search By',
                'value_options' => array(
                    'mrn' => 'MRN',
                    'scan' => 'Scan',
                    'ecd' => 'ECD',
                    'babyName' => 'Baby Name',
                    'ts'  => 'Time Stamp',
                    'reason'  => 'Override Reason',
                    'adLogin'  => 'AD Login'
                ),
            ),
            'attributes' => array(
                'value' => '1' //set selected to '1'
            )
        ));

         $this->add(array(
            'name' => 'from',
            'options' => array(
                'label' => 'From',
                'format' => 'Y-m-d H:i P',
            ),
             'attributes' => array(
                'id' => 'from', 
                'type'  => 'DateTime',
            )
        ));

         $this->add(array(
            'name' => 'to',
            'options' => array(
                'label' => 'To',
                'format' => 'Y-m-d H:i P',
            ),
             'attributes' => array(
                'id' => 'to', 
                'type'  => 'DateTime',
            )
        ));

        $this->add(array(
                'name' => 'submit',
                'attributes' => array(
                    'type'  => 'submit',
                'value' => 'Submit',
                'id' => 'submitbutton',
            ),
        )); 
    }
}