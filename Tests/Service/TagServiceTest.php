<?php
/*
    This file is part of InfoTownLinkWp Plugin of EC-CUBE3
    
    Copyright(c) 2015- Hiroshi Sawai All Rights Reserved.
    
    http://www.info-town.co.jp/
    
    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
    */

namespace Plugin\InfoTownLinkWp\Tests\Service;

use Eccube\Tests\EccubeTestCase;
use Plugin\InfoTownLinkWp\ServiceProvider\ServiceProvider;

class TagServiceTest extends EccubeTestCase
{
    public function setUp()
    {
        parent::setUp();
        $provider = new ServiceProvider();
        $provider->register($this->app);
    }

    /**
     * @test
     */
    function getTagByFilterへfilterの値と値contentsを渡しタグが取得できること()
    {
        $expect  = '<!-- linkwp filter="?filter[s]=AWS+Route53" format="contents" -->';
        $service = $this->app['linkwp.wp_api_tag'];
        $actual  = $service->getTagByFilter("?filter[s]=AWS+Route53", "contents");
        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    function getTagByFilterへfilterとformatが空文字でもタグが取得できること()
    {
        $expect  = '<!-- linkwp format="contents" -->';
        $service = $this->app['linkwp.wp_api_tag'];
        $actual  = $service->getTagByFilter('', '');
        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    function getTagByFilterは引数なしで呼び出してもタグを取得できること()
    {
        $expect  = '<!-- linkwp format="contents" -->';
        $service = $this->app['linkwp.wp_api_tag'];
        $actual  = $service->getTagByFilter();
        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    function getTagByFilterへ投稿IDのみを渡しタグを取得できること()
    {
        $expect  = '<!-- linkwp post_id="995560947" format="contents" -->';
        $service = $this->app['linkwp.wp_api_tag'];
        $actual  = $service->getTagById(995560947);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    function getTagByIdへ投稿Dとフォーマットを渡しタグを取得できること()
    {
        $expect  = '<!-- linkwp post_id="995560947" format="contents" -->';
        $service = $this->app['linkwp.wp_api_tag'];
        $actual  = $service->getTagById(995560947, 'contents');
        $this->assertEquals($expect, $actual);
    }

    /**
     *
     */
    function parseTagへフォーマットのみ渡し配列を取得できること()
    {
        $tag     = '<!-- linkwp format="contents" -->';
        $expect  = $data = [
            'post_id' => '',
            'filter'  => '',
            'format'  => 'contents',
        ];
        $service = $this->app['linkwp.wp_api_tag'];
        $actual  = $service->parseTag($tag);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    function parseTagへ投稿IDとフォーマットを渡し配列を取得できること()
    {
        $tag     = '<!-- linkwp post_id="995560947" format="contents" -->';
        $expect  = [
            'post_id' => 995560947,
            'format'  => 'contents',
        ];
        $service = $this->app['linkwp.wp_api_tag'];
        $actual  = $service->parseTag($tag);
        $this->assertEquals($expect, $actual);
    }

    function parseTagへフィルターとフォーマットを渡し配列を取得できること()
    {
        $tag     = '<!-- linkwp filter="?filter[s]=AWS+Route53" format="contents" -->';
        $expect  = [
            'filter' => '?filter[s]=AWS+Route53',
            'format' => 'contents',
        ];
        $service = $this->app['linkwp.wp_api_tag'];
        $actual  = $service->parseTag($tag);
        $this->assertEquals($expect, $actual);
    }
}