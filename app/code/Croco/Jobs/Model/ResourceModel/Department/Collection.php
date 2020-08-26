<?php
namespace Croco\Jobs\Model\ResourceModel\Department;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = \Croco\Jobs\Model\Department::DEPARTMENT_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Croco\Jobs\Model\Department', 'Croco\Jobs\Model\ResourceModel\Department');
    }

}