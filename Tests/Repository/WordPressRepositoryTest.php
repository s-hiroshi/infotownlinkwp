<?php

namespace Plugin\InfoTownLinkWp\Tests\Repository;

use Eccube\Tests\EccubeTestCase;
use Plugin\InfoTownLinkWp\ServiceProvider\ServiceProvider;
use Symfony\Component\HttpFoundation\Request;

class WordPressRepositoryTest extends EccubeTestCase
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
    public function getEntityでidが1のレコードを取得できるテスト()
    {
        $entity = $this->app['orm.em']
            ->getRepository('Plugin\InfoTownLinkWp\Entity\Wordpress')
            ->getEntity($this->app, 1);
        $expect = [
            'id'      => 1,
            'api_url' => 'wp-json',
        ];
        $actual = [
            'id'      => $entity->getId(),
            'api_url' => $entity->getApiUrl(),
        ];
        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    public function レコードが空でないときエンティティのidは必ず1となるテスト()
    {
        $entity = $this->app['orm.em']->getRepository('Plugin\InfoTownLinkWp\Entity\Wordpress')->find(2);
        $this->assertEmpty($entity);
    }

    /**
     * @group local
     * @test
     */
    public function replaceEntityで更新できること()
    {
        $expect  = [
            'home_url' => 'http://www.findxfine.com',
            'api_url'  => 'wp-json',
        ];
        $request = Request::create(
            $this->app['config']['admin_route'].'/plugin/InfoTownLinkWp/wordpress',
            'POST',
            ['infotown_linkwp_wordpress' => $expect]
        );
        $this->app['orm.em']
            ->getRepository('Plugin\InfoTownLinkWp\Entity\Wordpress')
            ->replaceEntity($this->app, $request);
        $entity = $this->app['orm.em']
            ->getRepository('Plugin\InfoTownLinkWp\Entity\Wordpress')
            ->getEntity($this->app, 1);
        $actual = [
            'home_url' => $entity->getHomeUrl(),
            'api_url'  => $entity->getApiUrl(),
        ];
        $this->assertEquals($expect, $actual);
    }
}