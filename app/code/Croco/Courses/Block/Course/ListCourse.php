<?php
namespace Croco\Courses\Block\Course;

class ListCourse extends \Magento\Framework\View\Element\Template
{
    protected $_course;
    protected $_instructor;
    protected $_resource;
    protected $_courseCollection;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Croco\Courses\Model\Course $course
     * @param \Croco\Courses\Model\Instructor $instructor
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Croco\Courses\Model\Course $course,
        \Croco\Courses\Model\Instructor $instructor,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ){
        $this->_instructor = $instructor;
        $this->_course = $course;
        $this->_resource = $resource;

        parent::__construct(
            $context,$data
        );
    }



}