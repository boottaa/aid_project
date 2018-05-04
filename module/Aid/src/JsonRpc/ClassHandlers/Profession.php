<?php
namespace Aid\JsonRpc\ClassHandlers;

use Aid\Model\EmployeeProfession\EmployeeProfessions;
use Aid\Model\EmployeeProfession\EmployeeProfessionsTable;
use Aid\Model\Pofession\Professions as dProfessions;
use Aid\Model\Pofession\ProfessionsTable;
use Zend\Json\Server\Exception\ErrorException;

/**
 * Class Profession
 *
 * @package Aid\JsonRpc\ClassHandlers
 */
class Profession
{
    private
        /**
         * @var ProfessionsTable
         */
        $professionsTable,
        /**
         * @var dProfessions
         */
        $professions,
        /**
         * @var EmployeeProfessionsTable
         */
        $employeeProfessionsTable,
        /**
         * @var EmployeeProfessions
         */
        $employeeProfessions;

    /**
     * Profession constructor.
     *
     * @param ProfessionsTable $professionsTable
     * @param dProfessions $professions
     * @param EmployeeProfessionsTable $employeeProfessionsTable
     * @param EmployeeProfessions $employeeProfessions
     */
    public function __construct(
        ProfessionsTable $professionsTable,
        dProfessions $professions,
        EmployeeProfessionsTable $employeeProfessionsTable,
        EmployeeProfessions $employeeProfessions
    ) {
        $this->professionsTable = $professionsTable;
        $this->professions = $professions;
        $this->employeeProfessions = $employeeProfessions;
        $this->employeeProfessionsTable = $employeeProfessionsTable;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function addProfession(array $data)
    {
        $professions = $this->professions;

        $filter = $professions->getInputFilter();
        $filter->setData($data);

        if ($filter->isValid()) {
            $professions->exchangeArray($data);
            $this->professionsTable->saveProfession($professions);

            return true;
        } else {
            throw new ErrorException("Error: not valid data");//"Error: not valid data";
        }
    }

    /**
     * adeProfessionToEmployee - add delited and edit
     *
     * @param array $data
     *
     * @return bool
     */
    public function adeProfessionToEmployee(array $data)
    {
        $employeeProfessions = $this->employeeProfessions;

        $filter = $employeeProfessions->getInputFilter();
        $filter->setData($data);
        if ($filter->isValid()) {
            $employeeProfessions->exchangeArray($data);
            $this->employeeProfessionsTable->saveEmployeeProfession($employeeProfessions);

            return true;
        } else {
            throw new ErrorException("Error: not valid data");//"Error: not valid data";
        }
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function getProfessionToEmployee(array $data)
    {
        $employeeProfessions = $this->employeeProfessions;

        $filter = $employeeProfessions->getInputFilter();
        $filter->setData($data);
        if ($filter->isValid()) {
            $employeeProfessions->exchangeArray($data);
            $result = $this->employeeProfessionsTable->getEmployeeProfession($employeeProfessions);
        } else {
            throw new ErrorException("Error: not valid data");//"Error: not valid data";
        }

        return $result;
    }
}