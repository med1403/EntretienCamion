<?php

namespace App\Test\Controller;

use App\Entity\Assurance;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AssuranceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/assurance/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Assurance::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Assurance index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'assurance[dateDebut]' => 'Testing',
            'assurance[dateFin]' => 'Testing',
            'assurance[compagnie]' => 'Testing',
            'assurance[numPolice]' => 'Testing',
            'assurance[camion]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Assurance();
        $fixture->setDateDebut('My Title');
        $fixture->setDateFin('My Title');
        $fixture->setCompagnie('My Title');
        $fixture->setNumPolice('My Title');
        $fixture->setCamion('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Assurance');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Assurance();
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setCompagnie('Value');
        $fixture->setNumPolice('Value');
        $fixture->setCamion('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'assurance[dateDebut]' => 'Something New',
            'assurance[dateFin]' => 'Something New',
            'assurance[compagnie]' => 'Something New',
            'assurance[numPolice]' => 'Something New',
            'assurance[camion]' => 'Something New',
        ]);

        self::assertResponseRedirects('/assurance/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDateDebut());
        self::assertSame('Something New', $fixture[0]->getDateFin());
        self::assertSame('Something New', $fixture[0]->getCompagnie());
        self::assertSame('Something New', $fixture[0]->getNumPolice());
        self::assertSame('Something New', $fixture[0]->getCamion());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Assurance();
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setCompagnie('Value');
        $fixture->setNumPolice('Value');
        $fixture->setCamion('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/assurance/');
        self::assertSame(0, $this->repository->count([]));
    }
}
