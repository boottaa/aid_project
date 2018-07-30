<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 04.07.18
 * Time: 13:13
 */

namespace Aid\Interfaces\Models;

use Zend\InputFilter\InputFilter;

interface Filter
{
    /**
     * @return InputFilter
     */
    public function getInputFilter();
}