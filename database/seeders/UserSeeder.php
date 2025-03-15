<?php

namespace Database\Seeders;

use App\Models\Annee;
use App\Models\Fonction;
use App\Models\Personnel;
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
                "statut"=>0
            ]
        );

        Fonction::create(
            [
                "libelle"=>"Directeur",
            ]
        );

        Annee::create(
            [
                "annee"=> 2025,
                "Date_debut"=> 01/01/2025,
                "Date_fin"=> 31/12/2025,
                "active"=> 1,
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
    }
}
