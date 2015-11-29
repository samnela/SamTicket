<?php

 namespace TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="TicketBundle\Entity\Repository\PriorityRepository")
 */
class Ticket
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=100)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $lastname;

    /**
     * @ORM\Column(type="integer", length=100,nullable=true )
     */
    protected $phonenumber;

    /**
     * @ORM\Column(type="integer", length=100, nullable=true)
     */
    protected $cellnumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $subject;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime", nullable=true ,name="due_date")
     */
    protected $dueDate;

    /**
     * @ORM\Column(type="datetime",nullable=false,name="created_date")
     */
    protected $createdDate;

    /**
     * @ORM\Column(type="datetime",name="updated_date",nullable=true)
     */
    protected $upatedDate;

    /**
     * @ORM\ManyToOne(targetEntity="Priority", inversedBy="tickets")
     * @ORM\JoinColumn(name="priority_id",referencedColumnName="id")
     * @Assert\Type(type="TicketBundle\Entity\Priority")
     * @Assert\Valid()
     */
    protected $priority;

    /**
     * @ORM\ManyToOne(targetEntity="Status",inversedBy="tickets")
     * @ORM\JoinColumn(name="status_id",referencedColumnName="id") 
     * @Assert\Type(type="TicketBundle\Entity\Status")
     * @Assert\Valid()
     */
    protected $status;


/**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Ticket
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Ticket
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Ticket
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set phonenumber
     *
     * @param integer $phonenumber
     *
     * @return Ticket
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get phonenumber
     *
     * @return integer
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Set cellnumber
     *
     * @param integer $cellnumber
     *
     * @return Ticket
     */
    public function setCellnumber($cellnumber)
    {
        $this->cellnumber = $cellnumber;

        return $this;
    }

    /**
     * Get cellnumber
     *
     * @return integer
     */
    public function getCellnumber()
    {
        return $this->cellnumber;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Ticket
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Ticket
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return Ticket
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Ticket
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set upatedDate
     *
     * @param \DateTime $upatedDate
     *
     * @return Ticket
     */
    public function setUpatedDate($upatedDate)
    {
        $this->upatedDate = $upatedDate;

        return $this;
    }

    /**
     * Get upatedDate
     *
     * @return \DateTime
     */
    public function getUpatedDate()
    {
        return $this->upatedDate;
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpatedDate(new \DateTime());
    }

    /**
     * Set priority
     *
     * @param \TicketBundle\Entity\Priority $priority
     *
     * @return Ticket
     */
    public function setPriority(\TicketBundle\Entity\Priority $priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return \TicketBundle\Entity\Priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set status
     *
     * @param \TicketBundle\Entity\Status $status
     *
     * @return Ticket
     */
    public function setStatus(\TicketBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \TicketBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }
}
