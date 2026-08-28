<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $produit1 = new Product();
        $produit1->setName('Shot Tropical');
        $produit1->setShortDescription('Fruits frais, pressés à froid');
        $produit1->setFullDescription("Offrez-vous un concentré d\'énergie naturelle avec notre shot tropical pressé à froid, élaboré à partir de fruits frais issus de l'agriculture responsable. Mangue, ananas, passion et citron vert sont pressés à froid pour préserver un maximum de nutriments sans recourir à la chaleur ni à aucun additif. Conditionné dans un flacon en verre recyclable, ce shot s'inscrit dans une démarche durable et zéro plastique. Idéal pour soutenir votre système immunitaire tout en réduisant votre impact environnemental, il allie plaisir gustatif et conscience écologique.");
        $produit1->setPrice(4.50);
        $produit1->setPicture('Image shot tropical.png');
        $manager->persist($produit1);
        
        $produit2 = new Product();
        $produit2->setName('Bougie Lavande & Patchouli');
        $produit2->setShortDescription('Cire naturelle');
        $produit2->setFullDescription("Laissez-vous envelopper par l'harmonie apaisante de la lavande et la profondeur boisée du patchouli avec cette bougie naturelle, coulée à la main. Composée de cire végétale 100 % naturelle (soja ou colza), d'une mèche en coton non traité et d'huiles essentielles biologiques, elle ne dégage aucune substance toxique. Son contenant en verre recyclable ou réutilisable renforce sa dimension écoresponsable. Idéale pour créer une ambiance relaxante, cette bougie s'inscrit dans une consommation douce, durable et respectueuse de l'environnement. ");
        $produit2->setPrice(32.00);
        $produit2->setPicture('Image bougie.png');
        $manager->persist($produit2);
        
        $produit3 = new Product();
        $produit3->setName('Brosse à dent');
        $produit3->setShortDescription('Bois de hêtre rouge issu de forêts gérées durablement');
        $produit3->setFullDescription("Remplacez le plastique de votre salle de bain avec cette brosse à dents en bois naturelle, conçue pour limiter votre impact environnemental sans compromettre votre hygiène bucco-dentaire. Son manche est fabriqué en bois de bambou 100 % biodégradable, issu de forêts gérées durablement, et ses poils doux sans BPA assurent un brossage efficace tout en respectant vos gencives. Une alternative simple et responsable pour réduire vos déchets au quotidien.");
        $produit3->setPrice(59.99);
        $produit3->setPicture('Image brosse a dent.png');
        $manager->persist($produit3);
        
        $produit4 = new Product();
        $produit4->setName('Nécessaire, déodorant Bio');
        $produit4->setShortDescription("50ml déodorant à l'eucalyptus");
        $produit4->setFullDescription("Ce déodorant bio à l'eucalyptus offre une protection efficace tout en respectant votre peau. Sa formule naturelle, sans sels d'aluminium ni parabènes, garantit une sensation de fraîcheur durable. Enrichi en huiles essentielles, il laisse un parfum agréable et subtil. Son format de 50ml est idéal pour une utilisation quotidienne et se glisse facilement dans votre trousse de toilette. Optez pour une hygiène responsable avec ce déodorant respectueux de l'environnement.");
        $produit4->setPrice(8.50);
        $produit4->setPicture('Image deodorant bio.png');
        $manager->persist($produit4);
        
        $produit5 = new Product();
        $produit5->setName('Disques Démaquillants x3');
        $produit5->setShortDescription('Solution efficace pour vous démaquiller en douceur');
        $produit5->setFullDescription('Fini les cotons jetables ! Optez pour une routine beauté plus responsable avec ces disques démaquillants lavables et réutilisables. Fabriqués en coton bio ou en bambou certifié, ils sont ultra-doux pour la peau, même la plus sensible, tout en respectant l’environnement. Lavables en machine, ils remplacent des centaines de cotons à usage unique et s\’inscrivent parfaitement dans une démarche zéro déchet. Un petit geste au quotidien, pour un grand impact sur la planète.
        ');
        $produit5->setPrice(19.90);
        $produit5->setPicture('Image disques.png');
        $manager->persist($produit5);

        $produit6 = new Product();
        $produit6->setName('Gourde en bois');
        $produit6->setShortDescription("50cl, bois d'olivier");
        $produit6->setFullDescription("Alliez élégance et conscience écologique avec cette gourde en bois durable. Fabriquée à partir de bois issu de forêts gérées durablement, elle est doublée d'un contenant inox pour garantir une parfaite étanchéité et une conservation optimale des boissons chaudes ou froides. Sa conception sans plastique, réutilisable à l'infini, en fait une alternative idéale aux bouteilles jetables. Solide, stylée et responsable, cette gourde s'adresse à celles et ceux qui veulent consommer autrement, avec respect pour la nature à chaque gorgée. 
        ");
        $produit6->setPrice(16.90);
        $produit6->setPicture('Image gourde.png');
        $manager->persist($produit6);

        $produit7 = new Product();
        $produit7->setName('Kit couvert en bois');
        $produit7->setShortDescription("Revêtement Bio en olivier & sac de transport");
        $produit7->setFullDescription("Emportez vos couverts partout avec ce kit en bois d'olivier, comprenant une fourchette, un couteau et une cuillère, le tout présenté dans un élégant sac de transport. Idéal pour les pique-niques, les repas en extérieur ou au bureau, ce kit est une alternative durable aux couverts jetables. Chaque pièce est soigneusement fabriquée à partir de bois d'olivier, connu pour sa durabilité et sa résistance à l'eau. Un choix écoresponsable pour réduire vos déchets au quotidien. 
        ");
        $produit7->setPrice(12.30);
        $produit7->setPicture('Image kit en bois.png');
        $manager->persist($produit7);
        
        $produit8 = new Product();
        $produit8->setName("Kit d'hygiène recyclable");
        $produit8->setShortDescription("Pour une salle de bain éco-friendly");
        $produit8->setFullDescription("Ce kit d'hygiène recyclable est conçu pour celles et ceux qui souhaitent allier bien-être et respect de l'environnement. Il contient l'essentiel pour une routine quotidienne complète, sans compromis sur la qualité ni sur la planète. Chaque élément du kit est fabriqué à partir de matériaux durables, recyclables ou biodégradables, afin de limiter au maximum l'empreinte écologique. Que ce soit pour une utilisation personnelle, en voyage ou en cadeau responsable, ce kit est idéal pour amorcer une transition vers une consommation plus consciente. Il s'inscrit parfaitement dans une démarche zéro déchet, en remplaçant les produits jetables par des alternatives durables et réutilisables.
        ");
        $produit8->setPrice(24.99);
        $produit8->setPicture('Image kit hygiene.png');
        $manager->persist($produit8);

        $produit9 = new Product();
        $produit9->setName("Savon Bio");
        $produit9->setShortDescription("Thé, Orange & Girofle");
        $produit9->setFullDescription("Savon bio artisanal, fabriqué à partir d'ingrédients naturels et d'huiles essentielles. Ce savon doux et parfumé nettoie la peau en profondeur tout en respectant son équilibre naturel. Idéal pour tous les types de peau, il laisse une sensation de fraîcheur et de bien-être. Un choix écoresponsable pour votre routine de soins.");
        $produit9->setPrice(18.90);
        $produit9->setPicture('Image savon bio.png');
        $manager->persist($produit9);

        $manager->flush();
    }
}
