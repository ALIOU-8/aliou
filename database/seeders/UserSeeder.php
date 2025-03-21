<?php

namespace Database\Seeders;

use App\Models\Annee;
use App\Models\Fonction;
use App\Models\Personnel;
use App\Models\TypeBien;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                "matricule"=>"220413",
                "nom"=>"super",
                "prenom"=>"admin",
                "password"=>bcrypt("1234"),
                "droit"=>"admin",
                "email"=>"sanoismael51@gmail.com",
                "telephone"=> 628013477,
                "statut"=>0
            ]
        );

        Fonction::create(
            [
                "libelle"=>"Directeur",
            ]
        );
        TypeBien::create(
            [
                "libelle"=>"boutique",
            ]
        );
        Personnel::create(
            [
                "matricule"=>"220413",
                "nom"=>"Sano",
                "prenom"=>"Ismael",
                "telephone"=>"628013477",
                "fonction_id"=>1,
                "hierachie"=>"A1",
                "delete"=>0,
            ]
        );
        Annee::create(
            [
            'annee' => '2025',
            'Date_debut' => '2025-01-01',  // Date en dur
            'Date_fin' => '2025-12-31',    // Date en dur
            'active' => 1,
            ]
        );
    }
}
