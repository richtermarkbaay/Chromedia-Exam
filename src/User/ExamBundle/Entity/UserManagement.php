<?php

namespace User\ExamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserManagement
 */
class UserManagement
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $conpass;

     /**
     * @var string
     */
    private $newpass;


    /**
     * Get id
     *
     * @return string
     */

    private $date;


    /**
     * Get id
     *
     * @return string
     */

    private $code;

    /**
     * Get id
     *
     * @return string
     */

    private $status;

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
     * @return UserManagement
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
     * @return UserManagement
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
     * @return UserManagement
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
     * Set password
     *
     * @param string $password
     * @return UserManagement
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set conpass
     *
     * @param string $conpass
     * @return UserManagement
     */
    public function setConpass($conpass)
    {
        $this->conpass = $conpass;

        return $this;
    }

    /**
     * Get conpass
     *
     * @return string 
     */
    public function getConpass()
    {
        return $this->conpass;
    }

    public function setNewpass($newpass)
    {
        $this->newpass = $newpass;

        return $this;
    }
    /**
     * Get conpass
     *
     * @return string 
     */
    public function getNewpass()
    {
        return $this->newpass;
    }

    /**
     * Set status
     *
     * @param string $date
     * @return UserManagement
     */

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
    /**
     * Get status
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
    /**
     * Get status
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }


    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    // public function __get($key, $val)
    // {
    //     return $this->data[$key];
    // }
}
