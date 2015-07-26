<?php

namespace Cma\CmaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cma\CmaBundle\Entity\Contact;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $contactdata = new Contact();
        $contactdata->setTitle("Contact");
        $contactdata->setPostalAdress("chargiya tounes");
        $contactdata->setMail("contact@cmanalyse.com"); 
        $contactdata->setPhone("002160251424846");
        $contactdata->setFax("002160251424846");
        $contactdata->setMap("<iframe></iframe>");
        
        $manager->persist($contactdata);
        $manager->flush();
    }
}