<?php


//namespace frontend\tests\Unit;

//use frontend\tests\UnitTester;

use frontend\models\Favorite;

class FavoriteTest extends \Codeception\Test\Unit
{
    use Codeception\Specify;

    //protected UnitTester $tester;

    /** @specify */
    private $favorite;

    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    public function testFavoriteValidation()
    {
        $this->favorite = new Favorite();

        $this->favorite->service_id = null;
        $this->assertFalse($this->favorite->validate(['service_id']));

        $this->favorite->service_id = 5;
        $this->assertFalse($this->favorite->validate(['service_id']));

        $this->favorite->user_id = null;
        $this->assertFalse($this->favorite->validate(['user_id']));

        $this->favorite->user_id = 1;
        $this->assertTrue($this->favorite->validate(['user_id']));

        $this->favorite->created_at = null;
        $this->assertTrue($this->favorite->validate(['created_at']));

        $this->favorite->created_at = '1673496989';
        $this->assertTrue($this->favorite->validate(['created_at']));

        $this->favorite->updated_at = null;
        $this->assertTrue($this->favorite->validate(['updated_at']));

        $this->favorite->updated_at = '1673496989';
        $this->assertTrue($this->favorite->validate(['updated_at']));
    }

    function testIntegrationFavoriteValidation()
    {
        /* ╔══════════════════════════════╗ */
        /* ║     Create Favorite Test     ║ */
        /* ╚══════════════════════════════╝ */

        $favorite = new Favorite();
        $favorite->service_id = 1000;
        $favorite->user_id = 1;
        $favorite->save();
        $this->assertEquals(1000, $favorite->service_id);
        verify($favorite->service_id)->equals(1000);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Verify Create Favorite Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        $this->assertNotEmpty($favorite);
        $this->assertNotEmpty($favorite->service_id);
        $this->assertNotEmpty($favorite->user_id);

        $this->assertEquals('1000', $favorite->service_id);
        $this->assertEquals('1', $favorite->user_id);

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════╗ */
        /* ║     Update Favorite Test     ║ */
        /* ╚══════════════════════════════╝ */

        $favorite = new Favorite();
        $favorite->service_id = 2000;
        $favorite->user_id = 2;
        $favorite->save();
        $this->assertEquals(2000, $favorite->service_id);
        verify($favorite->service_id)->equals(2000);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Verify Update Favorite Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        $this->assertNotEmpty($favorite);
        $this->assertNotEmpty($favorite->service_id);
        $this->assertNotEmpty($favorite->user_id);

        $this->assertEquals('2000', $favorite->service_id);
        $this->assertEquals('2', $favorite->user_id);

        /* ***** End of Section ***** */
    }

    function testVerifyIntegrationUserValidation()
    {
        /* ╔══════════════════════════════╗ */
        /* ║     Create Favorite Test     ║ */
        /* ╚══════════════════════════════╝ */

        $favorite = new Favorite();

        $favorite->attributes = [
            'service_id' => '3000',
            'user_id' => '3',
        ];

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Verify Create Favorite Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        verify($favorite)->notEmpty();
        verify($favorite->service_id)->notEmpty();
        verify($favorite->user_id)->notEmpty();

        verify($favorite->service_id)->equals('3000');
        verify($favorite->user_id)->equals('3');

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════╗ */
        /* ║     Update Favorite Test     ║ */
        /* ╚══════════════════════════════╝ */

        $favorite->attributes = [
            'service_id' => '4000',
            'user_id' => '4',
        ];

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Verify Update Favorite Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        verify($favorite)->notEmpty();
        verify($favorite->service_id)->notEmpty();
        verify($favorite->user_id)->notEmpty();

        verify($favorite->service_id)->equals('4000');
        verify($favorite->user_id)->equals('4');

        /* ***** End of Section ***** */
    }

    function testDbFavorite()
    {
        $modelFavorite = Favorite::find()->all();
        $modelFavoriteCount = Favorite::find()->count();
        $radom = rand(0,$modelFavoriteCount - 1);
        $service_id = $modelFavorite[$radom]->service_id;

        if (isset($modelFavorite)) {
            $this->tester->seeInDatabase('favorite', ['service_id' => $service_id]);
            $this->tester->dontSeeRecord(Favorite::class, ['service_id' => 1000]);
            $this->tester->grabColumnFromDatabase('favorite', 'id', array('service_id' => $service_id));
            $this->tester->updateInDatabase('favorite', array('service_id' => $service_id), array('service_id' => $service_id));
        }
    }
}
