<?php

return [
    'guest'=>[
        '',
        'types/type\d{1,}',
        'login',
        'registration',
        'training\d{1,}',
        'api/login',
        'api/registration',
        'admin/migrate/fresh',
        'admin/migrate/freshAndSeed',
        'admin/migrate',
        'admin/migrateAndSeed'
    ],
    'user'=>[
        '',
        'lk',
        'types/type\d{1,}',
        'api/logout',
        'trainings',
        'my_trainings',
        'trainings/create',
        'trainings/edit',
        'api/trainings/insertMy',
        'api/trainings/deleteMy',
        'api/user/update',
        'api/user/changePassword',
        'api/trainings/insert',
        'api/trainings/update',
        'api/trainings/delete',
        'admin/migrate/fresh',
        'admin/migrate/freshAndSeed',
        'admin/migrate',
        'admin/migrateAndSeed'
    ],
    'admin'=>[
        '',
        'lk',
        'types/type\d{1,}',
        'training\d{1,}',
        'trainings',
        'my_trainings',
        'api/trainings/insertMy',
        'api/trainings/deleteMy',
        'admin',
        'admin/trainings/create',
        'admin/trainings/edit',
        'admin/users/create',
        'admin/users/edit',
        'admin/users/delete',
        'api/trainings/insert',
        'api/trainings/update',
        'api/trainings/delete',
        'api/types/training/insert',
        'api/types/training/update',
        'api/types/training/delete',
        'api/types/exercise/insert',
        'api/types/exercise/update',
        'api/types/exercise/delete',
        'api/user/create',
        'api/user/update',
        'api/user/changePassword',
        'api/user/delete',
        'api/logout',
        'admin/migrate/fresh',
        'admin/migrate/freshAndSeed',
        'admin/migrate',
        'admin/migrateAndSeed'
    ]
];