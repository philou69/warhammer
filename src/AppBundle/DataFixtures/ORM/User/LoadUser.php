<?php
namespace AppBundle\DataFixtures\ORM\User;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User\User;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userNames = [
            [
                'name' => 'user1',
                'password' => 'AMSaHwjDcCFNKg+6auQc5hS/zpc=',
                'email' => 'phil.pichet.test1@gmail.com',
                'salt' => 'klvtmyxdyg0gc40ok0wskow84c0sswk',
            ],
            [
                'name' => 'user2',
                'password' => 'AMSaHwjDcCFNKg+6auQc5hS/zpc=',
                'email' => 'phil.pichet.test2@gmail.com',
                'salt' => 'klvtmyxdyg0gc40ok0wskow84c0sswk'
            ],
            [
                'name' => 'user3',
                'password' => 'AMSaHwjDcCFNKg+6auQc5hS/zpc=',
                'email' => 'phil.pichet.test3@gmail.com',
                'salt' => 'klvtmyxdyg0gc40ok0wskow84c0sswk'
            ],
            [
                'name' => 'user4',
                'password' => 'AMSaHwjDcCFNKg+6auQc5hS/zpc=',
                'email' => 'phil.pichet.test4@gmail.com',
                'salt' => 'klvtmyxdyg0gc40ok0wskow84c0sswk'
            ],
        ];

        $i = 1;
        foreach ($userNames as $userName) {

            $user = new User();

            $user->setUsername($userName['name']);
            $user->setPassword($userName['password']);
            $user->setEmail($userName['email']);
            $user->setSalt($userName['salt']);
            $user->setEnabled(true);
            if($userName['name'] == 'user1') {
                $user->addRole('ROLE_ADMIN');
            }

            $manager->persist($user);
            $manager->flush();

            $this->addReference('user-' . $i, $user);
            $i++;
        }


    }

    public function getOrder()
    {
        return 1;
    }
}