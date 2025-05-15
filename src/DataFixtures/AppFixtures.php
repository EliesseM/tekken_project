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
                'description' => "D'origine amérindienne et chinoise, Michelle entre dans le tournoi pour venger la mort de son père, tué par la Mishima Zaibatsu.",
            ],
            [
                'name' => 'Yoshimitsu',
                'games' => [$tekken1, $tekken2],
                'description' => 'Ninja cybernétique et chef du clan Manji, Yoshimitsu vole aux riches pour donner aux pauvres, utilisant un style de combat unique.',
            ],
            [
                'name' => 'Jack',
                'games' => [$tekken1],
                'description' => "Il fait sa seule apparition canonique en tant que personnage jouable dans le premier opus Tekken.

Il est le premier robot de la série Jack et a été créé par le Dr.Bosconovitch pour les besoins de l'armée russe. En découvrant l'intention qu'avait Kazuya Mishima de réaliser un coup d'État, l'ex Union soviétique envoie Jack au tournoi pour l'éliminer.

En combat, Jack utilise la force brute.",
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
                'description' => 'Femme fatale, Anna ne recule devant rien pour affronter sa sœur et rivale de toujours : Nina Williams. Leur rivalité trouve ses origines dans leur enfance, alors que Richard, leur père, favorisait Nina au détriment de sa soeur Anna',
            ],
            [
                'name' => 'Armor King',
                'games' => [$tekken1, $tekken2],
                'description' => 'l apparaît pour la première fois en tant que personnage jouable dans la version console du premier opus Tekken. Sa présence dans Tekken 2 marque la fin de ses apparitions canoniques.
                Catcheur masqué portant une armure et un masque de jaguar noir, Armor King est le rival du premier King. Lors de son combat contre king, il perd un œil à cause de ce dernier, ce qui le pousse vers le catch underground. Malgré leur rivalité, une amitié les unit, et Armor King participe aux deux premiers King of Iron Fist Tournament pour le défier.',
            ],
            [
                'name' => 'Ganryu',
                'games' => [$tekken1, $tekken2],
                'description' => "Autrefois le plus jeune lutteur sumo à avoir été promu ōzeki, Ganryu n'a pas pu obtenir le rang de yokozuna à cause de son comportement inapproprié. Suite à cela, il est entré dans la clandestinité puis a travaillé en tant que garde du corps de Kazuya Mishima. Quelques années plus tard, Ganryu a ouvert sa propre écurie de sumo, puis un restaurant appelé le Chanko Paradise et est devenu streamer.
                Ses participations aux différents tournois sont souvent liées à ses projets professionnels qu'il cherche à promouvoir. Toutefois, il participe au deuxième tournoi pour conquérir le cœur de Michelle Chang dont il est amoureux.",
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
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans la version console du premier opus Tekken. Il revient dans tous les opus suivants.
                Personnage emblématique jouant un rôle de premier plan dans les intrigues de Tekken, Heihachi est un combattant redoutable doué de capacités hors du commun. En sa qualité de chef de la Mishima Zaibatsu, il a créé les tournois King of Iron Fist qui sont pour lui l'occasion de mener à bien ses ambitions.

                Fils de Jinpachi Mishima, en l'emprisonnant, il est devenu le patriarche de sa famille. Découvrant que sa femme, Kazumi, est possédée par le diable, il décide de l'éliminer avant de se rendre compte que son jeune fils Kazuya l'est lui aussi. Heihachi prend donc la décision de le jeter du haut d'une falaise, provoquant la haine viscérale qu'éprouve Kazuya à son encontre. Depuis, les deux hommes cherchent à s'entre-tuer. Réalisant que son petit-fils Jin Kazama est à son tour possédé, Heihachi le trahit pour mener à bien ses projets. Dès lors, leur relation se détériore menant à une haine réciproque. Père adoptif de Lee Chaolan, il a également un fils illégitime, Lars Alexandersson, et est supposément le père de Reina. Heihachi possède également un ours de compagnie nommé Kuma pour qui il éprouve de l'affection.

                Ne reculant devant rien pour assouvir sa soif de pouvoir, Heihachi a de nombreux méfaits à son actif. Néanmoins, s'il est l'antagoniste de plusieurs jeux, il lui arrive parfois de faire preuve de légèreté. Après avoir combattu à plusieurs reprises des détenteurs du gène démoniaque, il y voit par la suite l'occasion de renforcer son pouvoir avec toujours comme objectif : la domination du monde.

                À l'origine, Heihachi partageait la majeure partie du gameplay de Kazuya avant de fortement se démarquer et de posséder sa propre variante du karaté de combat de style Mishima.",
            ],
            [
                'name' => 'Devil',
                'games' => [$tekken2],
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
            foreach ($data['games'] as $game) {
                $character = new Character();
                $character->setName($data['name'])
                    ->setDescription($data['description'])
                    ->setCreatedAt(new \DateTimeImmutable());

                // Détermination du nom d'image selon le jeu
                $gamePrefix = str_replace(' ', '_', $game->getTitle()); // Tekken_1 ou Tekken2
                $charName = str_replace([' ', '.', '\'', '-'], '_', $data['name']);
                $filename = $gamePrefix . '_' . $charName . '.webp';

                // Affectation unique du jeu
                $character->addGame($game);

                // Définir le champ image
                $character->setImage($filename);

                $manager->persist($character);
                $characters[] = $character;
            }
        }


        // Ajout d’un utilisateur admin
        $admin = new User();
        $admin->setUsername('admin')
            ->setEmail('admin@tekken.com')
            ->setRoles(['ROLE_ADMIN']);
        $adminPassword = $this->hasher->hashPassword($admin, 'adminpass');
        $admin->setPassword($adminPassword);
        $manager->persist($admin);


        // Ajout de plusieurs utilisateurs avec Faker
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($this->faker->userName())
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER']);

            $password = $this->faker->password();
            $hashedPassword = $this->hasher->hashPassword($user, $password);
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
        }
        // Utilisateur de test fixe
        $user = new User();
        $user->setUsername('testuser')
            ->setEmail('test@tekken.com') // <-- email ajouté ici
            ->setRoles(['ROLE_USER']);
        $hashedPassword = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $manager->flush();
    }
}
