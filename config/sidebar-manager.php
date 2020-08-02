<?php
return [
    'manager'=>[
        'helper'=>[
            'name'=>'Người giúp việc',
            'child'=>[
                [
                    'name'=>'Danh sách',
                    'route'=>'manager/helper'
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
                    'route'=>'manager/helper'
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
