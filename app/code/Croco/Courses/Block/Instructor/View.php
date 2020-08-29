<?php
namespace Croco\Courses\Block\Instructor;
class View extends \Magento\Framework\View\Element\Template
{
    protected $_courseCollection = null;
    protected $_instructor;
    protected $_course;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Croco\Courses\Model\Instructor $instructor
     * @param \Croco\Courses\Model\Course $course
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Croco\Courses\Model\Instructor $instructor,
        \Croco\Courses\Model\Course $course,
        array $data = []
    ){
        $this->_instructor = $instructor;
        $this->_course = $course;

        parent::__construct(
          $context,$data
        );
    }

    /**
     * @return $this
     */
    protected function _prepareLayout(){
        parent::_prepareLayout();

        //Get Instructor
        $instructor = $this->getLoadedInstructor();
        $title = $instructor->getName();
        $description = __('Courses offered by Croco');
        $keywords = __('learn,course');
        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');


        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'courses',
                [
                    'label' => __('We are teaching'),
                    'title' => __('We are teaching'),
                    'link' => $this->getListCourseUrl() // No link for the last element
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'course',
                [
                    'label' => $title,
                    'title' => $title,
                    'link' => false // No link for the last element
                ]
            );
        }
        $this->pageConfig->getTitle()->set($title);
        $this->pageConfig->setDescription($description);
        $this->pageConfig->setKeywords($keywords);


        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle) {
            $pageMainTitle->setPageTitle($title);
        }

        return $this;

    }

    protected function _getInstructor(){
        if(!$this->_instructor->getId()){
            $entityId = $this->_request->getParam('id');
            $this->_instructor = $this->_instructor->load($entityId);
        }
        return $this->_instructor;
    }

    public function getLoadedInstructor()
    {
        return $this->_getInstructor();
    }

    public function getListCourseUrl(){
        return $this->getUrl('courses/course');
    }

    protected function _getCoursesCollection(){
        if($this->_courseCollection === null && $this->_instructor->getId()){
            $courseCollection = $this->_course->getCollection()
                ->addFieldToFilter('instructor_id', $this->_instructor->getId());
            $this->_courseCollection = $courseCollection;
        }
        return $this->_courseCollection;
    }

    public function getLoadedCoursesCollection()
    {
        return $this->_getCoursesCollection();
    }


    public function getCourseUrl($course){
        if(!$course->getId()){
            return '#';
        }

        return $this->getUrl('courses/course/view', ['id' => $course->getId()]);
    }



}