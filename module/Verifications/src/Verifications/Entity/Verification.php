<?php

namespace Verifications\Entity; // added by Stoyan

use Doctrine\ORM\Mapping as ORM;
// added by Stoyan
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation; // !!!! Absolutely neccessary

// setters and getters - Zend\Stdlib\Hydrator\ClassMethods, for public properties - Zend\Stdlib\Hydrator\ObjectProperty, array 
// Zend\Stdlib\Hydrator\ArraySerializable
// Follows the definition of ArrayObject. 
// Objects must implement either the exchangeArray() or populate() methods to support hydration, 
// and the getArrayCopy() method to support extraction.
// https://bitbucket.org/todor_velichkov/homeworkuniversity/src/935b37b87e3f211a72ee571142571089dffbf82d/module/University/src/University/Form/StudentForm.php?at=master

// read here http://framework.zend.com/manual/2.1/en/modules/zend.form.quick-start.html

/**
 * Verifications
 *
 * @ORM\Table(name="verifications")
 * @ORM\Entity(repositoryClass="Verifications\Entity\Repository\VerificationRepository")
 * @Annotation\Name("verification")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Verification
{
	

     /**
     * @var integer
     *
     * @ORM\Column(name="entry_number", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @Annotation\Exclude()
     */
     private $entryNumber;

	 /**
     * @var string
     *
     * @ORM\Column(name="scan", type="string", length=10, nullable=false)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Scan:"})
     */
     private $scan;

     /**
     * @var string
     *
     * @ORM\Column(name="mrn", type="string", length=7, nullable=false)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"MRN:"})
     */
     private $mrn;

     /**
     * @var string
     *
     * @ORM\Column(name="ecd", type="string", length=9, nullable=false)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"ECD:"})
     */
     private $ecd;

     /**
     * @var string
     *
     * @ORM\Column(name="baby_name", type="string", length=100, nullable=false)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Baby Name:"})
     */
     private $babyName;

     /**
     * @var string
     *
     * @ORM\Column(name="badge_number", type="string", length=10, nullable=false)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Badge Number:"})
     */
     private $badgeNumber;

     /**
	 * @ORM\Column(name="ts")
	 * @Annotation\Attributes({"type":"text"})
	 * @Annotation\Options({"label":"CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP	Change"})
	 * @Annotation\Exclude()
	 *
	 */
	 protected $ts;

	 /**
     * Set entryNumber
     *
     * @param integer $entryNumber
     * @return Verifications
     */
    public function setEntryNumber($entryNumber)
    {
        $this->entryNumber = $entryNumber;
    
        return $this;
    }

    /**
     * Get entryNumber
     *
     * @return integer 
     */
    public function getEntryNumber()
    {
        return $this->entryNumber;
    }

    /**
     * Set scan
     *
     * @param string $scan
     * @return Verifications
     */
    public function setScan($scan)
    {
        $this->scan = $scan;
    
        return $this;
    }

    /**
     * Get scan
     *
     * @return string 
     */
    public function getScan()
    {
        return $this->scan;
    }

    /**
     * Set mrn
     *
     * @param string $mrn
     * @return Verifications
     */
    public function setMrn($mrn)
    {
        $this->mrn = $mrn;
    
        return $this;
    }

    /**
     * Get mrn
     *
     * @return string 
     */
    public function getMrn()
    {
        return $this->mrn;
    }

    /**
     * Set ecd
     *
     * @param string $ecd
     * @return Verifications
     */
    public function setEcd($ecd)
    {
        $this->ecd = $ecd;
    
        return $this;
    }

    /**
     * Get ecd
     *
     * @return string 
     */
    public function getEcd()
    {
        return $this->ecd;
    }

    /**
     * Set babyName
     *
     * @param string $babyName
     * @return Verifications
     */
    public function setBabyName($babyName)
    {
        $this->babyName = $babyName;
    
        return $this;
    }

    /**
     * Get babyName
     *
     * @return string 
     */
    public function getBabyName()
    {
        return $this->babyName;
    }

     /**
     * Set badgeNumber
     *
     * @param string $badgeNumber
     * @return Verifications
     */
    public function setBadgeNumber($badgeNumber)
    {
        $this->badgeNumber = $badgeNumber;
    
        return $this;
    }

    /**
     * Get badgeNumber
     *
     * @return string 
     */
    public function getBadgeNumber()
    {
        return $this->badgeNumber;
    }

    /**
     * Set ts
     *
     * @param string $ts
     * @return Verifications
     */
    public function setTs($ts)
    {
        $this->ts = $ts;
    
        return $this;
    }

    /**
     * Get ts
     *
     * @return string 
     */
    public function getTs()
    {
        return $this->ts;
    }


}


?>