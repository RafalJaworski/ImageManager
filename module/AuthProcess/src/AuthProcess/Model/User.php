<?php
/**
 * Created by PhpStorm.
 * User: rj
 * Date: 21.06.15
 * Time: 14:59
 */

namespace AuthProcess\Model;

class User {

    /**
     * $autoincremented $id
     * */
    public $id;

    /**
     *  string
     * */
    public $firstName;

    /**
     * string
     * */
    public $lastName;

    /**
     * string
     * */
    public $email;

    /**
     * string
     * */
    public $position;

    /**
     * string
     * */
    public $location;

    /**
     * string
     * */
    public $role;

    /**
     * string
     * contain staff of certain manager user
     * */
    public $staff;

    /**
     * datetime
     * */
    public $createdAt;

    /**
     * user
     * */
    public $createdBy;

    /**
     * collection of uploaded images
     * */
    public $uploadedImages;


    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->firstName = (!empty($data['firstName'])) ? $data['firstName'] : null;
        $this->lastName  = (!empty($data['lastName'])) ? $data['lastName'] : null;
        $this->email     = (!empty($data['email'])) ? $data['email'] : null;
        $this->position     = (!empty($data['position'])) ? $data['position'] : null;
        $this->location     = (!empty($data['location'])) ? $data['location'] : null;
        $this->role     = (!empty($data['role'])) ? $data['role'] : null;
        $this->staff     = (!empty($data['staff'])) ? $data['staff'] : null;
        $this->createdAt     = (!empty($data['createdAt'])) ? $data['createdAt'] : null;
        $this->createdBy     = (!empty($data['createdBy'])) ? $data['createdBy'] : null;
        $this->uploadedImages     = (!empty($data['uploadedImages'])) ? $data['uploadedImages'] : null;
    }
}