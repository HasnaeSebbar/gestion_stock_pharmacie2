<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class produitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Exemple : produit Paracétamol
        Produit::firstOrCreate( [
                'nom' => 'Film radiologique numérique Agfa 8*10',
                'type' => 'dispositif médical',
                'forme' => 'boite',
                'unite' => 'boite/100films',
                'prix' => 8, // Vous pouvez ajouter le prix si disponible
            ],

        );

        Produit::firstOrCreate(
            ['nom' => 'Film radiologique numérique Agfa 10*12'],
            [
                'type' => 'dispositif médical',
                'forme' => 'boite',
                'unite' => 'boite/100films',
                'prix' => 8,
            ]
        );
        Produit::firstOrCreate(
            ['nom' => 'Film radiologique numérique Fujifilm 8*10'],
            [
                'type' => 'dispositif médical',
                'forme' => 'boite',
                'unite' => 'boite/100films',
                'prix' => 8,
            ]
        );
        Produit::firstOrCreate(
            ['nom' => 'Film radiologique numérique Fujifilm 10*12'],
            [
                'type' => 'dispositif médical',
                'forme' => 'boite',
                'unite' => 'boite/100films',
                'prix' => 8,
            ]
        );
        Produit::firstOrCreate(  [
                'nom' => 'Film scanner Fujifilm 36*43',
                'type' => 'dispositif médical',
                'forme' => 'boite',
                'unite' => null,
                'prix' => 12,
            ],

            
        );
        Produit::firstOrCreate( [
                'nom' => 'Gel échographie',
                'type' => 'dispositif médical',
                'forme' => 'boite',
                'unite' => 'boite',
                'prix' => 2,
            ],


        );
        Produit::firstOrCreate(
            [
                'nom' => 'Papier échographie',
                'type' => 'dispositif médical',
                'forme' => 'rouleau',
                'unite' => 'rouleau',
                'prix' => 4,
            ],

        );
        
        Produit::firstOrCreate(
            [
                'nom' => 'Serviette ',
                'type' => 'dispositif médical',
                'forme' => 'unité',
                'unite' => 'unité',
                'prix' => 3.5,
            ],

        );
        Produit::firstOrCreate([
                'nom' => 'Hydrocortisone injectable 100mg',
                'type' => 'médicament',
                'forme' => 'ampoule',
                'unite' => 'ampoule',
                'prix' => 6,
            ],

        );
        Produit::firstOrCreate( [
                'nom' => 'Seringue 50cc',
                'type' => 'dispositif médical',
                'forme' => 'unité',
                'unite' => 'unité',
                'prix' => 4,
            ],
        );
        Produit::firstOrCreate([
                'nom' => 'Gants taille M',
                'type' => 'dispositif médical',
                'forme' => 'boite',
                'unite' => 'boite',
                'prix' => 7,
            ],

        );
        Produit::firstOrCreate([
                'nom' => 'Gants taille L',
                'type' => 'dispositif médical',
                'forme' => 'boite',
                'unite' => 'boite',
                'prix' => 7,
            ],

        );
        Produit::firstOrCreate([
                'nom' => 'Bavettes chirurgicales',
                'type' => 'dispositif médical',
                'forme' => 'boite',
                'unite' => 'boite',
                'prix' => 1.5,
            ],
        );
        Produit::firstOrCreate([
                'nom' => 'Seringue 5cc',
                'type' => 'dispositif médical',
                'forme' => 'unité',
                'unite' => 'unité',
                'prix' => 3,
            ],
        );
        Produit::firstOrCreate( [
                'nom' => 'Gel hydroalcoolique',
                'type' => 'dispositif médical',
                'forme' => 'litre',
                'unite' => 'litre',
                'prix' => 7,
            ],

        );
        Produit::firstOrCreate([
                'nom' => 'Sérum salé',
                'type' => 'médicament',
                'forme' => 'unité',
                'unite' => 'unité',
                'prix' => 4,
            ],

        );
        Produit::firstOrCreate( [
                'nom' => 'Gel hydroalcoolique',
                'type' => 'dispositif médical',
                'forme' => 'litre',
                'unite' => 'litre',
                'prix' => 4,
            ],

        );
        Produit::firstOrCreate( [
                'nom' => 'Sparadrap',
                'type' => 'dispositif médical',
                'forme' => 'unité',
                'unite' => 'unité',
                'prix' => 9,
            ],

        );
        Produit::firstOrCreate(  [
                'nom' => 'Coton',
                'type' => 'dispositif médical',
                'forme' => 'unité',
                'unite' => 'unité',
                'prix' => 2,
            ],

        );
        Produit::firstOrCreate(  [
                'nom' => 'Serir que 20cc',
                'type' => 'médicament',
                'forme' => 'apport',
                'unite' => 'apport',
                'prix' => 6,
            ],


        );
        



        // Tu peux ajouter d'autres produits de la même façon
    }
}
