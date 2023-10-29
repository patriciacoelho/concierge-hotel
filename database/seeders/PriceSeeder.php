<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Price;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotel = Hotel::factory()->create();

        $room = Room::factory()->create([
            'hotel_id' => $hotel->id,
        ]);

        Price::factory(10)->create([
            'room_id' => $room->id,
        ]);
    }
}
