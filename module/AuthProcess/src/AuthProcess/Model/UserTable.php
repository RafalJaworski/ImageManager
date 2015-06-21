<?php
/**
 * Created by PhpStorm.
 * User: rj
 * Date: 21.06.15
 * Time: 15:24
 *
 *
 * We will use this to perform operations on the database table for our user
 */

use Zend\Db\TableGateway\TableGateway;

class UserTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $users = $this->tableGateway->select();
        return $users;
    }

    public function getUser($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveUser(User $user)
    {
        $data = array(
            'id'=>$this->id,
            'firstName'=>$this->firstName,
            'lastName'=>$this->lastName,
            'email'=>$this->email,
            'position'=>$this->position,
            'location'=>$this->location,
            'role'=>$this->role,
            'staff'=>$this->staff,
            'createdAt'=>$this->createdAt,
            'createdBy'=>$this->createdBy,
            'uploadedImages'=>$this->uploadedImages,

        );

        $id = (int) $user->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('User id does not exist');
            }
        }
    }

    public function deleteUser($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
