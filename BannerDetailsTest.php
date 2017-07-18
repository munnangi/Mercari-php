<?php
/**
 * Created by PhpStorm.
 * User: munna
 * Date: 7/18/2017
 * Time: 12:53 AM
 */

include_once('BannerDetails.php');

use PHPUnit\Framework\TestCase;

Class BannerDetailsTest extends TestCase{

    /**
     * Test if the function does not show any banner if the current date is not of the display
     * period range
     * start time is assigned the ISO 8601 formatted date which is greater than 1 day from the current date
     * end time is assigned the ISO 8601 formatted date which is greater than 2 days from the current date
     */
    public function testBannerEmpty()
    {
        $Obj = new BannerDetails();
        $startime = date('c',strtotime('+1 day',strtotime(date('c'))));
        $endtime  = date('c',strtotime('+2 day',strtotime(date('c'))));

        $bannerDetailsArray[]=array('starttime'=>$startime,'endtime'=>$endtime , 'bannertit'=>'Banner 1');

        $Obj->createBanners($bannerDetailsArray);
        $this->expectOutputString('Banner Not Available');
        $Obj->displayBanner();

    }

    /**
     * test the function displays the banner if the current date is within the range
     * start time is assigned the ISO 8601 formatted date which is less than 1 day from the current date
     * end time is assigned the ISO 8601 formatted date which is greater than a day from the current date
     */
    public function testBannerNotEmpty()
    {
        $Obj = new BannerDetails();
        $startime = date('c',strtotime('-1 day',strtotime(date('c'))));
        $endtime  = date('c',strtotime('+1 day',strtotime(date('c'))));
        $bannerDetailsArray[]=array('starttime'=>$startime,'endtime'=>$endtime , 'bannertit'=>'Banner 1');

        $Obj->createBanners($bannerDetailsArray);
        $this->expectOutputString('This is an active banner Banner 1');
        $Obj->displayBanner();

    }

    /**
     * @return array
     * test the count of the allowedIps in the array. should be equal to 2.
     */
    public function testCountAllowedIpArray()
    {
        $Obj = new BannerDetails();
        $this->assertEquals(2,count($Obj->getAllowedIpArr()));
        return $Obj->getAllowedIpArr();

    }

    /**
     * @depends testCountAllowedIpArray
     * @param $allowedIpArr
     * test the values of the allowed ips array.
     */
    public function testAllowedIpArrayContents(array $allowedIpArr)
    {
        $this->assertContains('10.0.0.1',$allowedIpArr);
        $this->assertContains('10.0.0.2',$allowedIpArr);
    }



}

