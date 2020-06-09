<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class DataFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <= 5; $i++) {
            $user = new User();

            $user->setEmail($faker->email);
            $user->setUsername($faker->userName);
            $user->setPassword($faker->password);
            $user->setRoles(['ROLE_USER']);

            $manager->persist($user);
        }

        for ($i = 0; $i <= 3; $i++) {
            $task = new Task();

            $task->setTitle($faker->title);
            $task->setContent($faker->text);
            $task->setCreatedAt(new \DateTime());

            $task->setUser($user);

            $manager->persist($task);
        }

        $manager->flush();
    }
}