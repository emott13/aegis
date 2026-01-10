<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use App\Models\User;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User    ::  factory ()  ->  admin       ()  ->  create  ([
            'fname'     =>  'System'                                ,
            'lname'     =>  'Administrator'                         ,
            'email'     =>  '<fname>.<lname>@aegishealth.com>'      ,
            'role_id'   =>  1                                       ,   // admin #1
        ]);

        User    ::  factory ()  ->  supervisor  ()  ->  create  (
            [
                'fname'     =>  'Sup'                               ,  
                'lname'     =>  'Supervisor'                        ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  2                                   ,   // supervisor #1
            ],
            [
                'fname'     =>  'Ove'                               ,
                'lname'     =>  'Overseer'                          ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  2                                   ,   // supervisor #2
            ],
            [
                'fname'     =>  'Man'                               ,
                'lname'     =>  'Manager'                           ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  2                                   ,   // supervisor #3
            ]
        );

        User    ::  factory ()  ->  doctor      ()  ->  create  (
            [
                'fname'     =>  'Doc'                               ,
                'lname'     =>  'Doctor'                            ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  3                                   ,   // doctor #1
            ],
            [
                'fname'     =>  'Phy'                              ,
                'lname'     =>  'Physician'                         ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  3                                   ,   //  doctor #2
            ],
            [
                'fname'     =>  'Med'                               ,
                'lname'     =>  'Medic'                             ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  3                                   ,   //  doctor #3
            ],
            [
                'fname'     =>  'Sur'                               ,
                'lname'     =>  'Surgeon'                           ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  3                                   ,   // doctor #4
            ]
        );

        User    ::  factory ()  ->  caregiver   ()  ->  create  (
            [
                'fname'     =>  'Car'                               ,
                'lname'     =>  'Caregiver'                         ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  4                                   ,   //  caregiver #1
            ],
            [
                'fname'     =>  'Nur'                             ,
                'lname'     =>  'Nursing'                           ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  4                                   ,   //  caregiver #2
            ],
            [
                'fname'     =>  'Att'                               ,
                'lname'     =>  'Attendant'                         ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  4                                   ,   //  caregiver #3
            ],
            [
                'fname'     =>  'Aid'                               ,
                'lname'     =>  'Aide'                              ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  4                                   ,   //  caregiver #4
            ],
            [
                'fname'     =>  'Hel'                               ,
                'lname'     =>  'Helper'                            ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  4                                   ,   //  caregiver #5
            ],
            [
                'fname'     =>  'Sup'                               ,
                'lname'     =>  'Support'                           ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  4                                   ,   //  caregiver #6
            ]
        );

        User    ::  factory ()  ->  patient     ()  ->  create  (
            [
                'fname'     =>  'Pat'                               ,
                'lname'     =>  'Patient'                           ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  5                                   ,   //  patient #1
            ],
            [
                'fname'     =>  'Cli'                               ,
                'lname'     =>  'Client'                            ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  5                                   ,   //  patient #2
            ],
            [
                'fname'     =>  'Rec'                               ,
                'lname'     =>  'Recipient'                         ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  5                                   ,   //  patient #3
            ],
            [
                'fname'     =>  'Hos'                               ,
                'lname'     =>  'Hospitalized'                      ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  5                                   ,   //  patient #4
            ],
            [
                'fname'     =>  'Sic'                              ,
                'lname'     =>  'Sickly'                            ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  5                                   ,   //  patient #5
            ],
            [
                'fname'     =>  'Ill'                               ,
                'lname'     =>  'Illness'                           ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  5                                   ,   //  patient #6
            ],
            [
                'fname'     =>  'Med'                               ,
                'lname'     =>  'Medication'                        ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  5                                   ,   //  patient #7
            ]
        );

        User    ::  factory ()  ->  family      ()  ->  create  (
            [
                'fname'     =>  'Fam'                               ,
                'lname'     =>  'Family'                            ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  6                                   ,   // family #1
            ],
            [
                'fname'     =>  'Rel'                               ,
                'lname'     =>  'Relative'                          ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  6                                   ,   // family #2
            ],
            [
                'fname'     =>  'Kin'                               ,
                'lname'     =>  'Kinfolk'                           ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  6                                   ,   // family #3
            ],
            [
                'fname'     =>  'Con'                               ,
                'lname'     =>  'Connection'                        ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  6                                   ,   // family #4
            ],
            [
                'fname'     =>  'Sup'                               ,
                'lname'     =>  'Supporter'                         ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  6                                   ,   // family #5
            ],
            [
                'fname'     =>  'Fam'                               ,
                'lname'     =>  'Familial'                          ,
                'email'     =>  '<fname>.<lname>@aegishealth.com>'  ,
                'role_id'   =>  6                                   ,   // family #6
            ]
        );

    }
}
