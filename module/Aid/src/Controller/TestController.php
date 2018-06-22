<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 24.04.18
 * Time: 17:56
 */

namespace Aid\Controller;

use Aid\Model\EmployeeProfession\EmployeeProfessions;
use Aid\Model\EmployeeProfession\EmployeeProfessionsTable;
use Aid\Model\Pofession\Professions;
use Aid\Model\Pofession\ProfessionsTable;
use Zend\Mvc\Controller\AbstractActionController;

class TestController extends AbstractActionController
{
    private $data;

    /**
     * @var ProfessionsTable
     */
    private $p;

    /**
     * @var EmployeeProfessionsTable
     */
    private $ep;

    public function __construct(array $data)
    {
        $this->data = $data;


        $this->p = $this->data['p'];
        $this->ep = $this->data['ep'];
    }

    public function indexAction()
    {
        $this->test_getEmployeeProfession();
        die();
        //        $this->test_InsertEmployeeProfessions();

    }




    public function test_fetchAllEmployeeProfession(){
        echo "<pre>";
        print_r($this->ep->fetchAll());
        die();
    }

    public function test_getEmployeeProfession(){
        $p = new EmployeeProfessions();
        $p->exchangeArray([
            'id_employee' => 41,
        ]);

        echo "<pre>";
        print_r($this->ep->getEmployeeProfession($p));
        die();
    }

    public function test_DeleteEmployeeProfessions(){
        $p = new EmployeeProfessions();
        $p->exchangeArray([
            'id_employee' => 4,
            'id_profession' => 1
        ]);

        print_r($this->ep->deleteEmployeeProfession($p));
        die();
    }

    public function test_InsertEmployeeProfessions(){
        $p = new EmployeeProfessions();
        $p->exchangeArray([
            'id_employee' => 4,
            'id_profession' => 1
        ]);
        print_r($this->ep->saveEmployeeProfession($p));
        die();
    }
}