<?php

/**
 * Created by PhpStorm.
 */
class PromoBanners
{

    private $starttime;
    private $endtime;
    private $bannerTitle;
    private $client_ip;

    /**
     * @return mixed
     */
    public function getBannerTitle()
    {
        return $this->bannerTitle;
    }

    /**
     * @param mixed $bannerTitle
     */
    public function setBannerTitle($bannerTitle)
    {
        $this->bannerTitle = $bannerTitle;
    }

    /**
     * @return datetime
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * set the start time as date time object
     * @param datetime $starttime
     */
    public function setStarttime($starttime)
    {
        try{
            $this->starttime = new DateTime($starttime);

        }
        catch (Exception $exception)
        {
                echo $exception->getMessage();
                exit(1);
        }

    }

    /**
     * @return datetime
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * set the end time as date time object
     * @param datetime $endtime
     */
    public function setEndtime($endtime)
    {
        try {
            $this->endtime = new DateTime($endtime);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            die();
        }
    }

    /**
     * @return string
     */
    public function getClientIp()
    {
        return $this->client_ip;
    }


    /**
     * PromoBanners constructor.
     */
    public function __construct()
    {


        if(isset($_SERVER['REMOTE_ADDR']))
        $this->client_ip= $_SERVER['REMOTE_ADDR'];
        else
            $this->client_ip = '';

    }



}

