<?php
class Imatge
{
    public $image;
    public $date;

    function __construct($image, $date)
    {
        $this->image = $image;
        $this->date = $date;
    }
}