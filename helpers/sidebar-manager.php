<?php
use Illuminate\Support\Facades\Auth;
if(!function_exists("sidebarManager")){
    function sidebarManager(){
        return [
            'manager'=>[
                'helper'=>[
                    'name'=>'Người giúp việc',
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
    }
}
