<?php
return [
    'manager'=>[
        'employee'=>[
            'name'=>'Người giúp việc',
            'child'=>[
                [
                    'name'=>'Danh sách',
                    'route'=>'manager/employee'
                ],
                [
                    'name'=>'Tạo mới',
                    'route'=>'#'
                ],
            ],
        ],
        'customer'=>[
            'name'=>'Người thuê',
            'child'=>[
                [
                    'name'=>'Danh sách',
                    'route'=>'manager/employee'
                ],
                [
                    'name'=>'Tạo mới',
                    'route'=>'#'
                ],
            ],
        ]
    ],
    'report'=>[

    ]
];
