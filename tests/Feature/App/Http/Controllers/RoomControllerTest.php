<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Price;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RoomControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItListsAllTheRoomsOrderedByName(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $rooms = Room::factory(3)->create([
            'hotel_id' => $hotel->id,
        ]);
        $initial_date = Carbon::now()->addDays(30)->format('Y-m-d');
        $final_date = Carbon::now()->addDays(31)->format('Y-m-d');
        $rooms->each(fn ($room) => Price::factory()->create([
                'room_id' => $room->id,
                'date' => $initial_date,
            ])
        );
        Price::factory()->create([
            'room_id' => $rooms[0]->id,
            'date' => $final_date,
        ]);
        Room::factory()->create([
            'hotel_id' => $hotel->id,
        ]);

        $this->actingAs($user)
            ->getJson(
                route(
                    'rooms.index',
                    [
                        'hotel_id' => $hotel->id,
                        'initial_date' => $initial_date,
                        'final_date' => $final_date,
                    ],
                ),
            )
            ->assertOk()
            ->assertJsonCount(3, 'rooms')
            ->assertJsonStructure([
                'hotel' => [
                    'name',
                    'location',
                    'image_url',
                    'user_id',
                ],
                'rooms' => [
                    '*' => [
                        'id',
                        'type',
                        'total',
                        'prices',
                    ],
                ],
            ]);
    }

    public function testARoomCanBeShown(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $room = Room::factory([
            'user_id' => $user->id,
            'hotel_id' => $hotel->id,
        ])->create();

        $this->actingAs($user)
            ->getJson(
                route('rooms.show', $room)
            )
            ->assertOk()
            ->assertJsonStructure([
                'room' => [
                    'id',
                    'type',
                    'total',
                    'hotel',
                ],
            ]);
    }

    public function testARoomCanBeStored(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $rooms = Room::factory(['hotel_id' => $hotel->id])
            ->make()
            ->toArray();

        $this->actingAs($user)
            ->post(route('rooms.store'), $rooms)
            ->assertCreated()
            ->assertJson(['message' => 'Room successfully created!']);

        $this->assertDatabaseHas(Room::class, $rooms);
    }

    public function testAnRoomCanBeUpdated(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $room = Room::factory([
            'user_id' => $user->id,
            'hotel_id' => $hotel->id,
        ])->create();
        $new_room_payload = Room::factory(['hotel_id' => $hotel->id])
            ->make()
            ->toArray();

        $this->actingAs($user)
            ->put(
                route('rooms.update', $room),
                $new_room_payload
            )
            ->assertOk()
            ->assertJson(['message' => 'Room successfully updated!']);

        $this->assertDatabaseHas(Room::class, [
            'id' => $room->id,
        ] + $new_room_payload);
    }

    public function testAnRoomCanBeDeleted(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $room = Room::factory([
            'user_id' => $user->id,
            'hotel_id' => $hotel->id,
        ])->create();

        $this->actingAs($user)
            ->delete(route('rooms.update', $room))
            ->assertOk()
            ->assertJson(['message' => 'Room successfully deleted']);

        $this->assertDatabaseMissing(Room::class, $room->toArray());
    }
}
