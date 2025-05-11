<?php

namespace App\DataFixtures;

use App\Entity\Character;
use App\Entity\Game;
use App\Entity\User;
use App\Entity\Rating;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    private \Faker\Generator $faker;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        // Création des jeux
        $tekken1 = new Game();
        $tekken1->setTitle('Tekken 1')
            ->setReleaseYear(new \DateTime('1994-12-09'));
        $manager->persist($tekken1);

        $tekken2 = new Game();
        $tekken2->setTitle('Tekken 2')
            ->setReleaseYear(new \DateTime('1995-08-03'));
        $manager->persist($tekken2);

        // Liste des personnages avec leurs jeux associés et descriptions
        $charactersData = [
            [
                'name' => 'Kazuya Mishima',
                'games' => [$tekken1, $tekken2],
                'description' => 'Fils de Heihachi Mishima, Kazuya cherche à se venger de son père après avoir été jeté dans un ravin durant son enfance. Il maîtrise le karaté style Mishima.',
            ],
            [
                'name' => 'Paul Phoenix',
                'games' => [$tekken1, $tekken2],
                'description' => 'Combattant américain au tempérament fougueux, Paul est un expert en arts martiaux cherchant à prouver qu\'il est le plus fort.',
            ],
            [
                'name' => 'Nina Williams',
                'games' => [$tekken1, $tekken2],
                'description' => 'Tueuse à gages irlandaise, Nina est connue pour sa rapidité et sa précision mortelle. Elle entretient une rivalité intense avec sa sœur Anna.',
            ],
            [
                'name' => 'Marshall Law',
                'games' => [$tekken1, $tekken2],
                'description' => 'Maître du Jeet Kune Do, Marshall rêve d\'ouvrir son propre dojo. Il participe au tournoi pour gagner en notoriété.',
            ],
            [
                'name' => 'Michelle Chang',
                'games' => [$tekken1, $tekken2],
                'description' => 'D\'origine amérindienne et chinoise, Michelle entre dans le tournoi pour venger la mort de son père, tué par la Mishima Zaibatsu.',
            ],
            [
                'name' => 'Yoshimitsu',
                'games' => [$tekken1, $tekken2],
                'description' => 'Ninja cybernétique et chef du clan Manji, Yoshimitsu vole aux riches pour donner aux pauvres, utilisant un style de combat unique.',
            ],
            [
                'name' => 'Jack',
                'games' => [$tekken1],
                'description' => 'Robot militaire conçu par l\'Union Soviétique, Jack est envoyé pour éliminer Kazuya Mishima.',
            ],
            [
                'name' => 'Lee Chaolan',
                'games' => [$tekken1, $tekken2],
                'description' => 'Fils adoptif de Heihachi, Lee est en compétition constante avec Kazuya pour le contrôle de la Mishima Zaibatsu.',
            ],
            [
                'name' => 'King',
                'games' => [$tekken1, $tekken2],
                'description' => 'Lutteur masqué au grand cœur, King participe au tournoi pour financer un orphelinat.',
            ],
            [
                'name' => 'Kuma',
                'games' => [$tekken1, $tekken2],
                'description' => 'Ours domestiqué et garde du corps loyal de Heihachi Mishima, Kuma est un combattant redoutable.',
            ],
            [
                'name' => 'Kunimitsu',
                'games' => [$tekken1, $tekken2],
                'description' => 'Ancienne membre du clan Manji, Kunimitsu est une voleuse agile utilisant le ninjutsu.',
            ],
            [
                'name' => 'Anna Williams',
                'games' => [$tekken1, $tekken2],
                'description' => 'Sœur cadette de Nina, Anna est également une tueuse à gages, rivalisant constamment avec sa sœur.',
            ],
            [
                'name' => 'Armor King',
                'games' => [$tekken1, $tekken2],
                'description' => 'Lutteur masqué et rival de King, Armor King cherche à prouver sa supériorité sur le ring.',
            ],
            [
                'name' => 'Ganryu',
                'games' => [$tekken1, $tekken2],
                'description' => 'Sumotori déshonoré, Ganryu entre dans le tournoi pour restaurer sa réputation et construire son propre dohyō.',
            ],
            [
                'name' => 'Wang Jinrei',
                'games' => [$tekken1, $tekken2],
                'description' => 'Maître en arts martiaux chinois et ami de longue date de Jinpachi Mishima, Wang cherche à ramener la paix.',
            ],
            [
                'name' => 'Prototype Jack',
                'games' => [$tekken1, $tekken2],
                'description' => 'Version expérimentale de Jack, P. Jack est un robot de combat doté de capacités améliorées.',
            ],
            [
                'name' => 'Heihachi Mishima',
                'games' => [$tekken1, $tekken2],
                'description' => 'Patriarche impitoyable de la famille Mishima, Heihachi organise le tournoi pour asseoir son pouvoir.',
            ],
            [
                'name' => 'Devil',
                'games' => [$tekken1, $tekken2],
                'description' => 'Incarnation maléfique de Kazuya, Devil représente la part sombre de son âme.',
            ],
            [
                'name' => 'Jun Kazama',
                'games' => [$tekken2],
                'description' => 'Agent de protection de la faune, Jun cherche à arrêter Kazuya et à purifier son âme corrompue.',
            ],
            [
                'name' => 'Lei Wulong',
                'games' => [$tekken2],
                'description' => 'Détective de Hong Kong, Lei utilise le style des cinq animaux pour traquer les criminels.',
            ],
            [
                'name' => 'Baek Doo San',
                'games' => [$tekken2],
                'description' => 'Maître de Taekwondo sud-coréen, Baek cherche la rédemption après un incident tragique.',
            ],
            [
                'name' => 'Bruce Irvin',
                'games' => [$tekken2],
                'description' => 'Ancien combattant de rue, Bruce est recruté par Kazuya pour ses talents en kickboxing.',
            ],
            [
                'name' => 'Jack-2',
                'games' => [$tekken2],
                'description' => 'Amélioration du modèle original, Jack-2 est envoyé pour protéger sa créatrice, Jane.',
            ],
            [
                'name' => 'Angel',
                'games' => [$tekken2],
                'description' => 'Entité céleste opposée à Devil, Angel représente la part de bonté restante en Kazuya.',
            ],
            [
                'name' => 'Alex',
                'games' => [$tekken2],
                'description' => 'Dinosaure génétiquement modifié avec des compétences en boxe, Alex est un combattant unique.',
            ],
            [
                'name' => 'Roger',
                'games' => [$tekken2],
                'description' => 'Kangourou anthropomorphe créé en laboratoire, Roger est un expert en arts martiaux.',
            ],
        ];

        $characters = [];

        foreach ($charactersData as $data) {
            $character = new Character();
            $character->setName($data['name'])
                ->setDescription($data['description'])
                ->setImage(strtolower(str_replace([' ', '.', '\''], '_', $data['name'])) . '.jpg')
                ->setCreatedAt(new \DateTimeImmutable());

            foreach ($data['games'] as $game) {
                $character->addGame($game);
            }

            $manager->persist($character);
            $characters[] = $character;
        }

        // Ajout d’un utilisateur admin
        $admin = new User();
        $admin->setUsername('admin')
            ->setRoles(['ROLE_ADMIN']);
        $adminPassword = $this->hasher->hashPassword($admin, 'adminpass');
        $admin->setPassword($adminPassword);
        $manager->persist($admin);


        // Ajout de plusieurs utilisateurs avec Faker
        for ($i = 0; $i < 10; $i++) { // Générer 10 utilisateurs
            $user = new User();
            $user->setUsername($this->faker->userName()) // Génère un nom d'utilisateur
                ->setRoles(['ROLE_USER']);

            $password = $this->faker->password(); // Génère un mot de passe
            $hashedPassword = $this->hasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);

            $manager->persist($user);

            // Création d'un utilisateur
            $user = new User();
            $user->setUsername('testuser')
                ->setRoles(['ROLE_USER']);
            $hashedPassword = $this->hasher->hashPassword($user, 'password');
            $user->setPassword($hashedPassword);
            $manager->persist($user);

            // Ajout de notes pour chaque personnage
            foreach ($characters as $character) {
                $rating = new Rating();
                $rating->setUser($user)
                    ->setCharacter($character)
                    ->setScore(rand(1, 5))
                    ->setCreatedAt(new \DateTime());
                $manager->persist($rating);
            }

            $manager->flush();
        }
    }
}
