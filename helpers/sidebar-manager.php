<?php
use Illuminate\Support\Facades\Auth;
if(!function_exists("sidebarManager")){
    function sidebarManager(){
        return [
            'manager'=>[
                'helper'=>[
                    'name'=>'Người giúp việc',
                    'route'=>route('manager.helper.index'),
                    'child'=>[
                        [
                            'name'=>'Danh sách',
                            'route'=>route('manager.helper.index')
                        ],
                        [
                            'name'=>'Tạo mới',
                            'route'=>route('manager.helper.create')
                        ],
                    ],
                ],
                'customer'=>[
                    'name'=>'Người thuê',
                    'route'=>'#',
                    'child'=>[
                        [
                            'name'=>'Danh sách',
                            'route'=>'#'
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
    }
}
