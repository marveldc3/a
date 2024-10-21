<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RoomFixtures extends Fixture
{
    public const ROOM_REFERENCE = 'room_reference';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $allEquipments = ['projector', 'whiteboard', 'computer', 'video_conference', 'touch_screen'];
        $allErgonomics = ['natural_light', 'wheelchair_accessible', 'air_conditioning', 'soundproof', 'ergonomic_furniture'];

        // Create 50 rooms
        for ($i = 0; $i < 50; $i++) {
            $room = new Room();
            $room
                ->setName($faker->company)
                ->setCapacity($faker->numberBetween(10, 100))
                ->setEquipments($faker->randomElements($allEquipments, $faker->numberBetween(1, count($allEquipments))))
                ->setErgonomics($faker->randomElements($allErgonomics, $faker->numberBetween(1, count($allErgonomics))));
            $manager->persist($room);
        }

        $manager->flush();

        // Save room reference for later use
        $this->setReference(self::ROOM_REFERENCE, $room);
    }
}