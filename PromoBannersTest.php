<?php

/**
 * Created by PhpStorm.
 * User: munna
 * Date: 7/17/2017
 */
include_once('PromoBanners.php');
use PHPUnit\Framework\TestCase;
class PromoBannersTest extends  TestCase
{
    /**
     * test whether the client ip is being set or not set
     */
    public function testClientIp(){
        $promoObj = new PromoBanners();
        $this->assertEmpty($promoObj->getClientIp());

    }

    /**
     * test if the starttime is set correctly.
     */
    public function testSetStartTime()
    {
        $promoObj = new PromoBanners();
        $promoObj->setStarttime(date('c'));
        $this->assertEquals(strtotime('0 day',strtotime(date('c'))),$promoObj->getStarttime()->getTimestamp());
        return $promoObj;
    }

    /**
     * @depends testSetStartTime
     * @param PromoBanners $promoObj
     */

    public function testBannerTitle(PromoBanners $promoObj )
    {
        $promoObj->setBannerTitle('Banner one');
        $this->assertEquals('Banner one',$promoObj->getBannerTitle());
    }


}