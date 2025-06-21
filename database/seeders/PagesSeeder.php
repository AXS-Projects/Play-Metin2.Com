<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesSeeder extends Seeder
{
    public function run()
    {
        Page::updateOrCreate(['title' => 'Privacy Policy'], [
            'content' => <<<EOT
Play-Metin2.com respectă confidențialitatea utilizatorilor. Informațiile furnizate la înregistrare sunt folosite doar pentru administrarea contului de joc de pe serverul **New World**.

1. Datele personale nu vor fi partajate cu terți decât dacă legea impune acest lucru.
2. Folosim cookie-uri pentru a îmbunătăți funcționarea site-ului și pentru statistici anonime.
3. Puteți solicita oricând ștergerea contului și a datelor asociate, contactând echipa noastră.
EOT
        ]);

        Page::updateOrCreate(['title' => 'Terms of Service'], [
            'content' => <<<EOT
Prin accesarea site-ului Play-Metin2.com și a serverului **New World**, sunteți de acord cu următorii termeni:

1. Conturile sunt personale; securitatea lor este responsabilitatea utilizatorului.
2. Este interzisă utilizarea oricăror programe sau exploatarea erorilor de joc.
3. Echipa își rezervă dreptul de a modifica regulile și conținutul serverului fără notificare prealabilă.
4. Încălcarea acestor termeni poate conduce la suspendarea permanentă a contului.
EOT
        ]);
    }
}

