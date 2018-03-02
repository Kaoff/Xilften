<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 27/02/2018
 * Time: 10:03
 */

namespace AppBundle\Service;


use AppBundle\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

class PersonManager
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getPerson(int $id)
    {
        return $this->em->getRepository(Person::class)->find($id);
    }

    public function getPersons()
    {
        return $this->em->getRepository(Person::class)->findAll();
    }

    public function createPerson(string $fullname)
    {
        $person = new Person();

        $person->setFullname($fullname);

        $this->em->persist($person);
        $this->em->flush();

        return $person;
    }

    public function editPerson(Person $person)
    {
        $this->em->persist($person);
        $this->em->flush();
    }
}