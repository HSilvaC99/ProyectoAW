<?php

namespace es\ucm\fdi\aw\DTO;

require_once 'includes/config.php';

class ReviewDTO extends DTO
{
    private $m_ID;
    private $m_Comment;
    private $m_Review;
    private $m_Date;

    public function __construct($id, $comment, $review, $date)
    {
        $this->m_ID = $id;
        $this->m_Comment = $comment;
        $this->m_Review = $review;
        $this->m_Date = $date;
    }

    public function getID()
    {
        return $this->m_ID;
    }

    public function getComment()
    {
        return $this->m_Comment;
    }

    public function getReview()
    {
        return $this->m_Review;
    }

    public function getDate()
    {
        return $this->m_Date;
    }
}

?>