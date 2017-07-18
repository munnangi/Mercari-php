<?php

/**
 * Created by PhpStorm.
 * User: munna
 * Date: 7/17/2017
 * Time: 11:03 PM
 */

include_once 'PromoBanners.php';

class BannerDetails
{
    private $promoBannerObj;
    // array with prefined allowable ip's
    private $allowedIp_arr = array('10.0.0.1','10.0.0.2');
    private $bannerArray = array();
    private $current_time;

    /**
     * @return array
     */
    public function getAllowedIpArr()
    {
        return $this->allowedIp_arr;
    }

    /**
     * @param $bannerDetails
     * function to create banners instances
     */

    public function createBanners(array $bannerDetails)
    {
        // validate to check if the bannerdetails array is not empty
        if(!empty($bannerDetails)) {
            foreach ($bannerDetails as $bannerDetail) {
                $this->promoBannerObj = new PromoBanners();
                $this->promoBannerObj->setStarttime($bannerDetail['starttime']);
                $this->promoBannerObj->setEndtime($bannerDetail['endtime']);
                $this->promoBannerObj->setBannerTitle($bannerDetail['bannertit']);
                array_push($this->bannerArray, $this->promoBannerObj);
            }
        }

    }


    /**
     * logic to check whether the current time is with the display period of the banner.
     * also the allow the banner to show if the ip addresses match the default ip addresses.
     */
    public function displayBanner()
    {
        $this->current_time = new datetime();
        // validate if the array is not empty
        if (!empty($this->bannerArray)) {
            foreach ($this->bannerArray as $banner) {
                if (($this->current_time->getTimestamp() > $banner->getStarttime()->getTimestamp() && $this->current_time->getTimestamp() < $banner->getEndtime()->getTimestamp())
                    || in_array($banner->getClientIp(), $this->getAllowedIpArr())
                ) {

                    print "This is an active banner " . $banner->getBannerTitle();

                }
                else{
                    print "Banner Not Available";
                }
            }
        }
    }
}
/**
 * data that needs to be set for the bannners.
 */
/*$Obj = new BannerDetails();
$bannerDetailsArray = array();
$bannerDetailsArray[]=array('starttime'=>'2017-07-10T12:00:00+0900','endtime'=>'2017-08-10T12:00:00+0900' , 'bannertit'=>'Banner 1');
$bannerDetailsArray[]=array('starttime'=>'2017-07-10T12:00:00+0900','endtime'=>'2017-08-10T12:00:00+0900' , 'bannertit'=>'Banner 2');
$bannerDetailsArray[]=array('starttime'=>'2017-07-10T12:00:00+0900','endtime'=>'2017-08-10T12:00:00+0900' , 'bannertit'=>'Banner 3');
$Obj->createBanners($bannerDetailsArray);
$Obj->displayBanner();*/