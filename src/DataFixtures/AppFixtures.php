<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Category;
use App\Entity\Nft;
use App\Entity\Nftcollection;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        $addresses = [];
        for ($i = 0; $i < 11; ++$i) {
            $address = new Address();
            $address->setCountry($faker->country);
            $address->setCity($faker->city);
            $address->setZipcode($faker->postcode);
            $address->setStreet($faker->streetAddress);
            $manager->persist($address);
            $addresses [] = $address;  
        }

        $categories = [];
        for ($i = 0; $i < 10; ++$i) {
            $category = new Category();
            $category->setName($faker->text(17));
            $manager->persist($category);
            $categories[] = $category;
        }

        $Nft = [];
        for ($i = 0; $i < 10; ++$i) {
            $Nft = new Nft();
            $Nft->setName($faker->name);
            $Nft->setImg($faker->imageUrl());
            $Nft->setDescription($faker->text);
            $Nft->setLaunchDate($faker->dateTime);
            $Nft->setLaunchPriceEth($faker->randomFloat(2, 0, 100));
            $Nft->addRelation($faker->randomElement($categories));
            $manager->persist($Nft);
            $Nft = [];
        }

        $Nftcollections = [];
        for ($i = 0; $i < 10; ++$i) {
            $Nftcollection = new Nftcollection();
            $Nftcollection->setName($faker->name);
            $manager->persist($Nftcollection);
            $Nftcollections [] = $Nftcollection;
        }

        $user = [];
        for ($i = 0; $i < 10; ++$i) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            $user->setPseudo($faker->userName);
            $user->setGender($faker->title);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setBirthDate($faker->dateTime);
            $user->setAddress($faker->randomElement($addresses));
            $manager->persist($user);
            $user = [];
        }

            $adminUser = new User();
            $adminUser->setEmail($faker->email);
            $adminUser->setRoles(['ROLE_ADMIN']);
            $adminUser->setPassword($this->passwordHasher->hashPassword($adminUser, 'password'));   
            $adminUser->setPseudo($faker->userName);
            $adminUser->setGender($faker->title);
            $adminUser->setFirstname($faker->firstName);
            $adminUser->setLastname($faker->lastName);  
            $adminUser->setBirthDate($faker->dateTime);
            $adminUser->setAddress($faker->randomElement($addresses));
            $manager->persist($adminUser);

        $manager->flush();
    }

    
        
        
    
}
