<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Lesson;
use App\Models\UserProfile;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
    * @param string $plan
    * @param int $remainingCount
    * @dataProvider dataCanReserve_正常
    */
    public function testCanReserve_正常(string $plan, int $remainingCount, int $reservationCount)
    {
        /** @var User $user*/
        $user = Mockery::mock(User::class)->makePartial();
        $user->shouldReceive('reservationCountThisMonth')->andReturn($reservationCount);
        $user->profile = new UserProfile();
        $user->profile->plan = $plan;

        /** @var Lesson $lesson */
        $lesson = Mockery::mock(Lesson::class);
        $lesson->shouldReceive('remainingCount')->andReturn($remainingCount);
        
        $user->canReserve($lesson);
        $this->assertTrue(true);
    }

    public function dataCanReserve_正常()
    {
        return [
            '予約可:レギュラー,空きあり,月の上限以下' => [
                'plan' => 'regular',
                'remainingCount' => 1,
                'reservationCount' => 4,
            ],
            '予約可:ゴールド,空きあり' => [
                'plan' => 'gold',
                'remainingCount' => 1,
                'reservationCount' => 5,
            ],
        ];
    }
/**
 * @param string $plan
 * @param int $remainingCount
 * @param int $reservationCount
 * @param string $errorMessage
 * @dataProvider dataCanReserve_エラー
 */
public function testCanReserve_エラー(string $plan, int $remainingCount, int $reservationCount, string $errorMessage)
{
    /** @var User $user */
    $user = Mockery::mock(User::class)->makePartial();
    $user->shouldReceive('reservationCountThisMonth')->andReturn($reservationCount);
    $user->profile = new UserProfile();
    $user->profile->plan = $plan;

    /** @var Lesson $lesson */
    $lesson = Mockery::mock(Lesson::class);
    $lesson->shouldReceive('remainingCount')->andReturn($remainingCount);

    $this->expectExceptionMessage($errorMessage);

    $user->canReserve($lesson);
}

public function dataCanReserve_エラー()
{
    return [
        '予約不可:レギュラー,空きあり,月の上限' => [
            'plan' => 'regular',
            'remainingCount' => 1,
            'reservationCount' => 5,
            'errorMessage' => '今月の予約がプランの上限に達しています。',
        ],
        '予約不可:レギュラー,空きなし,月の上限以下' => [
            'plan' => 'regular',
            'remainingCount' => 0,
            'reservationCount' => 4,
            'errorMessage' => 'レッスンの予約可能上限に達しています。',
        ],
        '予約不可:ゴールド,空きなし' => [
            'plan' => 'gold',
            'remainingCount' => 0,
            'reservationCount' => 5,
            'errorMessage' => 'レッスンの予約可能上限に達しています。',
        ],
    ];
}



    // public function testReserve()
    // {
    //     $spy = Notification::spy();

    //     $lesson = new Lesson();
    //     $lesson->id = 1;
    //     $lesson->coach = new Coach();

    //     $user = new User();
    //     $user->id = 1;
    //     $reservation = (new ReservationService())->invoke($lesson, $user);

    //     $spy->shouldHaveReceived('send')->with($lesson->coach, Reserved::class)->once();

    //     $this->assertSame(['lesson_id'=> $lesson->id, 'user_id'=> $user->id], $reservation->toArray());
    // }

}
