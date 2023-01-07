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
        $favorite->id = 1000;
        $favorite->service_id = 1001;
        $favorite->user_id = 1002;
        $favorite->save();
        $this->assertEquals(1001, $favorite->service_id);
        verify($favorite->service_id)->equals(1001);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Assert Create Favorite Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        $this->assertNotEmpty($favorite);
        $this->assertNotEmpty($favorite->service_id);
        $this->assertNotEmpty($favorite->user_id);

        $this->assertEquals('1001', $favorite->service_id);
        $this->assertEquals('1002', $favorite->user_id);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Verify Create Favorite Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        verify($favorite)->notEmpty();
        verify($favorite->service_id)->notEmpty();
        verify($favorite->user_id)->notEmpty();

        verify($favorite->service_id)->equals('1001');
        verify($favorite->user_id)->equals('1002');

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════╗ */
        /* ║     Update Favorite Test     ║ */
        /* ╚══════════════════════════════╝ */

        $favorite->service_id = 2001;
        $favorite->user_id = 2002;
        $favorite->save();
        $this->assertEquals(2001, $favorite->service_id);
        verify($favorite->service_id)->equals(2001);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Assert Update Favorite Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        $this->assertNotEmpty($favorite);
        $this->assertNotEmpty($favorite->service_id);
        $this->assertNotEmpty($favorite->user_id);

        $this->assertEquals('2001', $favorite->service_id);
        $this->assertEquals('2002', $favorite->user_id);

        /* ***** End of Section ***** */

        /* ╔═════════════════════════════════════╗ */
        /* ║     Verify Update Favorite Test     ║ */
        /* ╚═════════════════════════════════════╝ */

        verify($favorite)->notEmpty();
        verify($favorite->service_id)->notEmpty();
        verify($favorite->user_id)->notEmpty();

        verify($favorite->service_id)->equals('2001');
        verify($favorite->user_id)->equals('2002');

        /* ***** End of Section ***** */

        /* ╔══════════════════════════════╗ */
        /* ║     Delete Favorite Test     ║ */
        /* ╚══════════════════════════════╝ */

        $favorite->delete();

        /* ***** End of Section ***** */

        /* ╔════════════════════════════════════════════════╗ */
        /* ║     Assert and Verify Delete Favorite Test     ║ */
        /* ╚════════════════════════════════════════════════╝ */

        $findFavorite = Favorite::find()->where(['id' => $favorite->id])->count();
        $this->assertEquals(0, $findFavorite);
        verify($findFavorite)->equals(0);

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

    //function testVerifyIntegrationUserValidation()
    //{
    /* ╔══════════════════════════════╗ */
    /* ║     Create Favorite Test     ║ */
    /* ╚══════════════════════════════╝ */

    /*$favorite = new Favorite();

    $favorite->attributes = [
        'service_id' => '3000',
        'user_id' => '3',
    ];*/

    /* ***** End of Section ***** */

    /* ╔═════════════════════════════════════╗ */
    /* ║     Verify Create Favorite Test     ║ */
    /* ╚═════════════════════════════════════╝ */

    /*verify($favorite)->notEmpty();
    verify($favorite->service_id)->notEmpty();
    verify($favorite->user_id)->notEmpty();

    verify($favorite->service_id)->equals('3000');
    verify($favorite->user_id)->equals('3');*/

    /* ***** End of Section ***** */

    /* ╔══════════════════════════════╗ */
    /* ║     Update Favorite Test     ║ */
    /* ╚══════════════════════════════╝ */

    /*$favorite->attributes = [
        'service_id' => '4000',
        'user_id' => '4',
    ];*/

    /* ***** End of Section ***** */

    /* ╔═════════════════════════════════════╗ */
    /* ║     Verify Update Favorite Test     ║ */
    /* ╚═════════════════════════════════════╝ */

    /*verify($favorite)->notEmpty();
    verify($favorite->service_id)->notEmpty();
    verify($favorite->user_id)->notEmpty();

    verify($favorite->service_id)->equals('4000');
    verify($favorite->user_id)->equals('4');*/

    /* ***** End of Section ***** */
    //}
}
