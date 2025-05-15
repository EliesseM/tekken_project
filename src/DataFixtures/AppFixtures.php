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
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans le premier opus Tekken.
                Personnage emblématique et principal antagoniste, Kazuya joue un rôle central dans les intrigues de Tekken. Ses qualités de combattants et sa capacité à se métamorphoser en Devil en font un adversaire redoutable.
                Fils de Heihachi et Kazumi Mishima, Kazuya a hérité du gène démoniaque de sa mère. Le découvrant, son père le jette du haut d'une falaise. Kazuya y survit et nourrit depuis une haine viscérale pour Heihachi. Il parvient à se venger en remportant le combat final du premier tournoi et en réalisant un coup d'État sur la Mishima Zaibatsu. Brutal et oppressant, Kazuya baigne dans de nombreuses affaires illégales. Jun Kazama participe au deuxième tournoi pour l'arrêter, mais leur rencontre débouche sur la naissance de leur fils : Jin Kazama. Kazuya perd face à Heihachi en finale du tournoi et est jeté dans un volcan.
                Ayant survécu grâce à la G Corporation, Kazuya prend la tête de l'entreprise et cherche depuis à se venger de Heihachi. Il souhaite également éliminer Jin pour récupérer l'intégralité de son pouvoir démoniaque.",
            ],
            [
                'name' => 'Paul Phoenix',
                'games' => [$tekken1, $tekken2],
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans le premier opus Tekken. Il revient dans tous les jeux suivants.
                De nationalité américaine, Paul est un motard au sang chaud qui aime combattre. Souvent motivé par les gains en jeu et déterminé à être reconnu comme le plus fort du monde et de l'univers, il participe à tous les King of Iron Fist Tournament.

Paul est véritablement passionné par les arts martiaux, il s'entraîne avec acharnement et souhaite vaincre ses rivaux : Kuma et Kazuya Mishima. C'est un combattant aguerri, qui est parvenu à se hisser jusque la finale du troisième tournoi, mais à jouer de malchance.

Avec Marshall Law, son ami de longue date, ils s'entraident et s'associent à plusieurs reprises pour maximiser leurs chances de remporter les tournois, et ainsi la somme promise au vainqueur.

Paul pratique un style de combat complet basé sur le judo.",
            ],
            [
                'name' => 'Nina Williams',
                'games' => [$tekken1, $tekken2],
                'description' => "Elle apparaît pour la première fois en tant que personnage jouable dans le premier opus Tekken. Elle revient dans tous les jeux suivants.
                Froide et peu regardante en ce qui concerne ses clients, Nina est une assassin redoutable. Les grandes entreprises n'hésitent d'ailleurs pas à faire appel à ses services. De nature détachée, Nina est en rivalité avec sa sœur cadette, Anna Williams, et cette mésentente durable trouve ses origines dans l'enfance des deux femmes.

Si cette rivalité a motivé Nina à participer à deux tournois, c'est la plupart du temps dans le cadre de contrats d'assassinat qu'elle s'y inscrit. Exception faite au troisième tournoi durant lequel, après avoir été placée dans la Cold Sleep Machine contre son gré, elle est devenue amnésique et s'est retrouvée sous l'emprise d'Ogre.

Nina pratique des arts martiaux de l'assassinat basés sur le koppōjutsu et l'aïkido. En combat, elle utilise également des armes à feu.",
            ],
            [
                'name' => 'Marshall Law',
                'games' => [$tekken1, $tekken2],
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans le premier opus Tekken. Il revient dans tous les opus.
                Immigrant chinois ayant la nationalité américaine, Marshall est marié et a un fils appelé Forest à qui il a enseigné son style de combat. Vivant dans la pauvreté et jouant de malchance, la plupart de ses participations aux différents tournois sont motivées par les gains en jeu.

Si dans un premier temps, il cherche à réaliser ses rêves, Marshall va se retrouver endetté et dans l'obligation de gagner de l'argent. Avec Paul Phoenix, son ami de longue date, ils s'entraident et s'associent à plusieurs reprises pour maximiser leurs chances de remporter les tournois, et ainsi la somme promise au vainqueur.

Inspiré de Bruce Lee, Marshall pratique des arts martiaux basés sur le Jeet Kune Do.",
            ],
            [
                'name' => 'Michelle Chang',
                'games' => [$tekken1, $tekken2],
                'description' => "Elle apparaît pour la première fois en tant que personnage jouable dans le premier opus Tekken et revient dans Tekken 2.
                Issue de l'union d'un père hongkongais et d'une mère amérindienne, Michelle voit sa vie basculer lorsqu'elle apprend que son père a été assassiné par Heihachi Mishima et que quelque temps plus tard, sa mère se fait kidnapper par Kazuya Mishima, intéressé par le pendentif de la jeune femme. Déterminée à se venger, elle participe aux deux premiers tournois.

Quelques années passent et Michelle adopte Julia Chang, à qui elle enseigne les arts martiaux qu'elle maîtrise et lui transmet également son amour de la nature. Toutefois, lorsque les rumeurs concernant Ogre s'intensifient, Michelle se rend au Japon pour interroger Heihachi et ainsi en savoir plus sur le réveil de la créature. Ne revenant jamais, sa fille participe au troisième tournoi pour la retrouver.

Michelle pratique divers arts martiaux chinois, basés sur le Xin Yi Liu He Quan et le Baji Quan. ",
            ],
            [
                'name' => 'Yoshimitsu',
                'games' => [$tekken1, $tekken2],
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans le premier opus Tekken. Il revient dans tous les jeux suivants.
                Yoshimitsu est le chef du clan Manji, une confrérie de voleurs au grand cœur qui aide les plus démunis. Il manie une épée maudite assoiffée de sang.

Lors du premier King of Iron Fist Tournament, Yoshimitsu sert de leurre pour permettre à ses subordonnés de dérober des secrets à la Mishima Zaibatsu. Toutefois, il est capturé et subit une mutilation, perdant son bras. Sauvé par le Dr.Bosconovitch, il reçoit un bras mécanique à énergie perpétuelle. En reconnaissance, Yoshimitsu participe au deuxième tournoi pour libérer son bienfaiteur, retenu captif par Kazuya Mishima. Leur amitié se perpétue au fil des ans, et lorsque le docteur a besoin du sang d'Ogre pour se soigner, Yoshimitsu s'engage dans la troisième compétition pour l'obtenir.

Un jour, Yoshimitsu retrouve le corps sans vie de Bryan Fury et le dépose au laboratoire de Bosconovitch, gardé par des gardes du clan Manji. Le scientifique sauve Bryan, mais celui-ci l'attaque, détruit l'installation et tue les gardes. Dès lors, Yoshimitsu cherche à se venger en participant au cinquième tournoi.

Au cours de ses aventures, il découvre que son épée maudite menace de prendre le contrôle de son esprit. Pour contenir son pouvoir destructeur, il se procure le Fumaken, un sabre capable de tempérer la soif de sang de l'épée maudite. Néanmoins, Yoshimitsu sent l'épée devenir de plus en plus instable, et apprend une technique de scellement pour contenir son influence maléfique. Malgré ses efforts, il reste hanté par une voix malveillante émanant de l'arme.

En combat, Yoshimitsu pratique le ninjutsu Manji avancé.",
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
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans la version console du premier opus Tekken.
                D'origine chinoise, Lee obtient la nationalité japonaise lors de son adoption par Heihachi Mishima. Ce faisant, il devient le frère adoptif de Kazuya Mishima, mais une rivalité se noue entre les deux hommes. Lee est un homme extravagant qui soigne toujours son apparence.
                D'abord au service de Kazuya lors de deux premiers tournois, Lee cherche à le vaincre sans succès. Il devient PDG de Violet Systems, une célèbre entreprise de construction d'humanoïdes, et fait son retour lors du quatrième tournoi en utilisant son alter ego : Violet. Réanimé par une rancune tenace, il cherche à se venger de Kazuya.
                Lee pratique le karaté de combat de style Mishima qu'il mixe avec d'autres arts martiaux, avant d'adopter son propre style de combat à partir du quatrième tournoi.",
            ],
            [
                'name' => 'King',
                'games' => [$tekken1, $tekken2],
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans le premier opus Tekken. Sa présence dans Tekken 2 marque la fin de ses apparitions canoniques.
                D'origine mexicaine, King cache son visage derrière un masque de jaguar. De sa jeunesse orpheline, il tire sa grande générosité et participe au premier tournoi afin d'ouvrir un orphelinat. Toutefois, le manque d'argent pour l'établissement va provoquer le début de son alcoolisme et de sa descente en enfer. Fort de son amitié avec Armor King, il remonte la pente et participe au deuxième tournoi.

Quinze ans plus tard, King est attaqué et tué par Ogre. Son successeur, à qui il a tout appris, repend son masque et son nom. Son assassinat pousse alors les deux jaguars restants à essayer de se venger de la créature au cours du troisième tournoi.

Par l'intermédiaire d'un pasteur qui l'incite à se lancer, King devient lutteur professionnel.",
            ],
            [
                'name' => 'Kuma',
                'games' => [$tekken1, $tekken2],
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans la version console du premier opus Tekken. Sa présence dans Tekken 2 marque la fin de ses apparitions canoniques.
                Doué d'intelligence et capable de comprendre le langage humain, Kuma est l'animal de compagnie et le garde du corps de Heihachi Mishima. Ensemble, ils passent leur temps à s'entraîner et partagent le désir commun de devenir les plus forts. Il meurt de vieillesse onze ans après le deuxième tournoi, mais laisse derrière lui un fils qui occupe les mêmes fonctions que lui.
                En combat, l'ours utilise le Kuma Shin Ken style Heihachi. Il s'agit d'un art martial conçu et enseigné par son maître. Son fils utilisera également ce style de combat",
            ],
            [
                'name' => 'Kunimitsu',
                'games' => [$tekken1, $tekken2],
                'description' => "Elle apparaît pour la première fois en tant que personnage jouable dans la version console du premier opus Tekken. Sa présence dans Tekken 2 marque la fin de ses apparitions canoniques.
                Dissimulant son visage derrière un masque de renard, Kunimitsu est une kunoichi qui faisait partie du clan Manji avant de s'en faire exclure pour avoir volé pour son propre compte. Depuis, elle est en rivalité avec Yoshimitsu, le chef de ce clan et participe aux deux premiers tournois dans le but de commettre des vols.

Sa fille porte le même nom qu'elle et dissimule également son visage derrière un masque de renard.

Pratiquant le Ninjutsu Manji, à l'origine Kunimitsu partageait la majeure partie du gameplay de Yoshimitsu. Elle s'est ensuite démarquée d'opus en opus, jusqu'à posséder son propre style de combat.",
            ],
            [
                'name' => 'Panda',
                'games' => [$tekken1, $tekken2],
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans la version console du premier opus Tekken. Sa présence dans Tekken 2 marque la fin de ses apparitions canoniques.
                Panda est un panda géant et l'animal de compagnie de Xiaoyu Ling. Il est le gardien du dojo de cette dernière et participe au tournoi pour la protéger. Il est également le rival de Kuma, l'ours de Heihachi Mishima.

                Panda utilise le style de combat du Kung Fu.",
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
                'description' => "l apparaît pour la première fois en tant que personnage jouable dans la version console du premier opus Tekken. Il revient dans quelques opus.
                Se distinguant par son âge très avancé, Wang, en plus d'être un artiste martial accompli, entretient une certaine proximité avec les différents membres de la famille Mishima, à commencer par Jinpachi Mishima, son ami proche. Wang est un maître chinois très respecté par de nombreux combattants.

Ses participations aux tournois sont toujours liées aux Mishima. En effet, Wang, ayant appris que cette lignée est maudite, pour préserver la paix, souhaite les soustraire du pouvoir en les éliminant.

À l'origine, Wang partageait la majeure partie du gameplay de Michelle Chang avant de se démarquer à partir de Tekken 5. Ainsi, il pratique le Xin Yi Liu He Quan.",
            ],
            [
                'name' => 'Prototype Jack',
                'games' => [$tekken1, $tekken2],
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans la version console du premier opus Tekken. Sa présence dans Tekken 2 marque la fin de ses apparitions canoniques.
                Conçu en Russie par le Dr.Bosconovitch, P.Jack est le prototype du premier Jack. À l'inverse de ses rivaux, Jack et Jack-2, il ne fait pas partie de la même série d'androïdes qu'eux et a des caractéristiques physiques différentes.

Il est envoyé au premier King of Iron Fist Tournament par Heihachi Mishima afin de traquer Jack. Suite à cela, il obtiendra une mise à jour sollicitée auprès de Kazuya Mishima, mais souffrira de troubles de la mémoire.

Comme tous les autres androïdes Jack, P.Jack utilise la force brute en combat. Toutefois, certains de ses coups diffèrent dû au fait que ses composants soient différents.",
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
                'description' => "Il apparaît pour la première fois dans le premier jeu Tekken où il est un costume caché de Kazuya Mishima.

Par la suite, il sera le boss final de Tekken 2.

Dans Tekken Tag Tournament 2 et Tekken 7, il fait partie intégrante du gameplay de Kazuya qui peut ainsi prendre sa forme.

Il est l'un des principaux antagonistes de la série.",
            ],
            [
                'name' => 'Jun Kazama',
                'games' => [$tekken2],
                'description' => "Elle fait sa première apparition canonique en tant que personnage jouable dans Tekken 2 et revient également dans Tekken 8. Jun est également jouable dans les opus non-canoniques Tekken Tag Tournament et Tekken Tag Tournament 2, et est le boss de fin de ce dernier.

Originaire de Yakushima, Jun est dotée d'un pouvoir psychique lui permettant notamment de communiquer avec les animaux. Passionnée par la nature, elle travaille pour un groupe qui en assure la protection. Opposée au trafic d'animaux orchestré par Kazuya Mishima, elle participe au deuxième tournoi afin de le libérer de son gène démoniaque et de lui faire cesser ses activités illégales.

De sa relation avec Kazuya est né Jin Kazama, son fils qu'elle a élevé seule avant de se faire attaquer par Ogre et de disparaître. Jin la pense décédée et la venge en éliminant la créature. Toutefois, Jun parvient à échapper de justesse à la mort en se réfugiant dans le sanctuaire Kazama. Plongeant dans un profond sommeil, elle se réveille sept ans plus tard et se lance à la recherche de Kazuya et Jin qu'elle veut sauver.

Jun pratique les arts martiaux traditionnels de style Kazama, transmis de génération en génération au sein de sa famille. Elle y incorpore ses propres capacités liées au pouvoir des Kazama.",
            ],
            [
                'name' => 'Lei Wulong',
                'games' => [$tekken2],
                'description' => "Il fait sa première apparition en tant que personnage jouable dans Tekken 2. Il revient dans tous les opus à l’exception de Tekken 8, et est également jouable dans les opus non-canoniques Tekken Tag Tournament et Tekken Tag Tournament 2.

Officier de police travaillant pour Interpol à Hong Kong, Lei participe aux différents tournois dans le cadre de son travail. De ce fait, il connaît de nombreux autres combattants et enquête souvent sur les différentes organisations. Cependant, Lei se retrouve souvent dans des situations loufoques et a un goût certain pour l'oisiveté.

Inspiré de l'acteur et maître en arts martiaux, Jackie Chan, Lei pratique les arts martiaux chinois aux cinq styles et le Zui quan. Ainsi, il possède une grande panoplie de coups et utilise de nombreuses postures différentes.",
            ],
            [
                'name' => 'Baek Doo San',
                'games' => [$tekken2],
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans Tekken 2. Il revient dans quelques opus, mais est absent dans Tekken 3, Tekken 4, Tekken 7 et enfin Tekken 8. Il est jouable dans les opus non-canoniques Tekken Tag Tournament et Tekken Tag Tournament 2.

Originaire de Corée du Sud, Baek a connu une enfance difficile marquée par l'alcoolisme de son père. Après l'avoir tué accidentellement lors d'un entraînement, Baek est profondément traumatisé. Pour expier sa culpabilité, il se consacre entièrement au taekwondo, devenant un maître respecté.

D'abord contrait par un chantage d'attaquer le dojo de Marshall Law, il participe au deuxième King of Iron Fist Tournament pensant qu'un affrontement est inévitable. Dans le même temps, il est forcé de devenir le subordonné de Kazuya Mishima, organisateur du tournoi et cherchant à dominer le monde. Après la compétition, Baek ouvre son propre dojo où il forme Hwoarang, un jeune prodige du taekwondo. Cependant, Baek est attaqué par Ogre et reste dans le coma pendant plusieurs années.

À son réveil, il rejoint l'armée sud-coréenne et reprend l'entraînement avec Hwoarang. Toutefois, lors du cinquième tournoi, Baek abandonne la compétition pour veiller sur son élève, grièvement blessé par Jin Kazama. Il se sent responsable de ne pas l'avoir suffisamment préparé à ce combat, et s'engage dans un entraînement encore plus intense avec lui, en vue du sixième tournoi.

Durant la guerre mondiale déclenchée par Jin, Baek rejoint la Résistance pour s'opposer à la Mishima Zaibatsu. Avec Hwoarang, il se bat pour venger ses camarades tombés au combat et pour libérer le monde de la domination des Mishima.

Fils d'un champion de taekwondo, Baek pratique cette discipline apprise auprès de son père.",
            ],
            [
                'name' => 'Bruce Irvin',
                'games' => [$tekken2],
                'description' => "Il apparaît pour la première fois en tant que personnage jouable dans Tekken 2. Il revient dans quelques opus, mais est absent dans Tekken 3, Tekken 4, Tekken 7 et enfin Tekken 8. Il est jouable dans les opus non-canoniques Tekken Tag Tournament et Tekken Tag Tournament 2.

D'origine américaine, Bruce a grandi dans la pauvreté et la violence après avoir perdu sa famille. Déterminé à s'en sortir, il devient un combattant redoutable et participe à un tournoi en Thaïlande, où il bat le champion national. Cela lui vaut d'être ciblé par une organisation criminelle.

Lors d'une tentative d'assassinat en avion, Bruce survit à un crash et est secouru par les hommes de main de Kazuya Mishima, qu'il rejoint ensuite au sein de la Mishima Zaibatsu. Après la défaite de Kazuya au deuxième King of Iron Fist Tournament, Bruce quitte son unité et devient instructeur en techniques de survie.

Des années plus tard, Bruce découvre que Kazuya est toujours vivant lorsque ce dernier participe au quatrième tournoi. Bruce le rejoint, l'aidant à prendre le contrôle de la G Corporation et devient chef de son armée privée. Dans ce cadre, il rejoint la sixième compétition pour capturer Jin Kazama.

En combat, Bruce pratique le kick-boxing.",
            ],
            [
                'name' => 'Jack-2',
                'games' => [$tekken2],
                'description' => "Il fait sa seule apparition canonique en tant que personnage jouable dans Tekken 2. Il est également jouable dans l'opus non-canonique Tekken Tag Tournament.

Créé par le Dr.Bosconovitch, Jack-2 est une version améliorée de son prédécesseur. Ayant conservé la mémoire de son ancien modèle, il possède des circuits d'intelligence artificielle. Aussi, lorsqu'il est envoyé par ses supérieurs dans une guerre bactériologique, Jack-2 sauve Jane, une petite fille de huit ans, et prend la fuite.

Voulant devenir humain, il participe au deuxième King of Iron Fist Tournament pour sauver son créateur retenu prisonnier par Kazuya Mishima, et lui demander d'accéder à sa requête. Il est finalement détruit par une arme satellite.

Tout comme les autres androïdes de sa lignée, Jack-2 utilise la force brute en combat.",
            ],
            [
                'name' => 'Angel',
                'games' => [$tekken2],
                'description' => "Elle apparaît uniquement en tant que personnage jouable dans Tekken 2. Elle est également jouable dans les opus non-canoniques Tekken Tag Tournament et Tekken Tag Tournament 2, premier jeu où elle n'est plus une palette swap de Devil.

D'origine inconnue, Angel est l'exact opposée de Devil. Toutefois, sous son apparence angélique et bienveillante se cache un monstre impitoyable.

Bien que son style de combat soit décrit comme inconnu, Angel utilise le karaté de combat de style Mishima auquel viennent s'ajouter ses capacités surnaturelles.",
            ],
            [
                'name' => 'Alex',
                'games' => [$tekken2],
                'description' => "Il apparaît uniquement en tant que personnage jouable dans Tekken 2. Il est également jouable dans les opus non-canoniques Tekken Tag Tournament et Tekken Tag Tournament 2, premier jeu où il n'est plus une palette swap de Roger.

Créé par le Dr.Bosconovitch afin d'alimenter l'armée privée voulue par Kazuya Mishima, Alex est conçu au sein des laboratoires de la Mishima Zaibatsu. La créature est issue de l'ADN de dinosaure prélevé sur des insectes, mélangé à celui de Roger.

Lorsque le deuxième tournoi est lancé par Kazuya, Alex n'est pas encore adulte, mais possède à peu près la même force que Roger et a le potentiel pour devenir extrêmement puissant.

Formé à la lutte commando par des militaires, Alex partageait son style de combat avec Roger, avant de récupérer celui de Roger Jr. auquel s'ajoute quelques variations qui lui sont propres.",
            ],
            [
                'name' => 'Roger',
                'games' => [$tekken2],
                'description' => "Il apparaît uniquement en tant que personnage jouable dans Tekken 2. Il est également jouable dans l'opus non-canonique Tekken Tag Tournament, puis il est remplacé par son fils et son ex-femme.

Créé par le Dr.Bosconovitch afin d'alimenter l'armée privée voulue par Kazuya Mishima, Roger est conçu au sein des laboratoires de la Mishima Zaibatsu. Il est doté d'une étonnante mobilité obtenue par le dopage et le séquençage de son ADN.

Après sa participation au deuxième tournoi visant à tuer les participants, il s'est marié et a eu un enfant appelé Roger Jr. Toutefois, il abandonne sa famille et son épouse qui finit par demander le divorce.

Entraîné pour un usage miliaire, Roger pratique la lutte commando.",
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
