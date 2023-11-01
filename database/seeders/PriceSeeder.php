<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Price;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotel = Hotel::factory()->create();

        $rooms = Room::factory(3)->create([
            'hotel_id' => $hotel->id,
        ]);

        $rooms->each(fn ($room) => Price::factory()->create([
                'room_id' => $room->id,
                'date' => Carbon::now()->addDays(30)->format('Y-m-d'),
            ])
        );

        Price::factory()->create([
            'room_id' => $rooms[0]->id,
            'date' => Carbon::now()->addDays(31)->format('Y-m-d'),
        ]);

        Price::factory(9)->create([
            'room_id' => $rooms[0]->id,
        ]);
    }
}
