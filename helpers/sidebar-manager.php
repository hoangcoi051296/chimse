<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists("sidebarManager")) {
    function sidebarManager()
    {
        return [
            'manager' => [
                'employee' => [
                    'name' => 'Người giúp việc',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('manager.employee.index')
                        ],
                        [
                            'name' => 'Tạo mới',
                            'route' => route('manager.employee.create')
                        ],
                    ],
                ],
                'customer' => [
                    'name' => 'Người thuê',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('manager.customer.index')
                        ],
                        [
                            'name' => 'Tạo mới',
                            'route' => route('manager.customer.create')
                        ],
                    ],
                ],
                'post' => [
                    'name' => 'Bài đăng',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => '#'
                        ],
                        [
                            'name' => 'Tạo mới',
                            'route' => '#'
                        ],
                    ],
                ]
            ],
            'report' => [

            ]
        ];
    }

}
if (!function_exists("sidebarEmployee")) {
    function sidebarEmployee()
    {
        return [
            'employee' => [
                'post' => [
                    'name' => 'Quản lý công việc',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => '#'
                        ],
                    ],
                ],
                'feedback' => [
                    'name' => 'Đánh giá',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => "#"
                        ],
                    ],
                ],
            ],

            'report' => [

            ]
        ];
    }

}
