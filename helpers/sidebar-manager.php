<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists("sidebarManager")) {
    function sidebarManager()
    {
        $sidebar=[
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
                    'icon' => 'nav-icon fab fa-etsy'
                ],
                'customer' => [
                    'name' => 'Người thuê',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('manager.customer.index'),
                        ],
                        [
                            'name' => 'Tạo mới',
                            'route' => route('manager.customer.create')
                        ]
                    ],
                    'icon' => 'nav-icon fab fa-cuttlefish'

                ],

                'post' => [
                    'name' => 'Bài đăng',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('manager.post.index')
                        ],
                        [
                            'name' => 'Tạo mới',
                            'route' => route('manager.post.create')
                        ],
                    ],
                    'icon' => 'nav-icon fab fa-product-hunt'
                ],
                'category' => [
                    'name' => 'Danh mục',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('manager.category.index')
                        ],
                        [
                            'name' => 'Tạo mới',
                            'route' => route('manager.category.create')
                        ],
                    ],
                    'icon' => 'nav-icon fas fa-bible'
                ],
                'attribute' => [
                    'name' => 'Thuộc tính',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('manager.attribute.index')
                        ],
                        [
                            'name' => 'Tạo mới',
                            'route' => route('manager.attribute.create')
                        ],
                    ],
                    'icon'=>'nav-icon fab fa-asymmetrik'
                ],

                'role' => [
                    'name' => 'Phân quyền',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('manager.role.index')
                        ],
                        [
                            'name' => 'Tạo mới',
                            'route' => route('manager.role.create')
                        ],
                    ],
                    'icon'=>'nav-icon fas fa-tachometer-alt'
                ],
                'account' => [
                    'name' => 'Tài khoản',
                    'child' => [
                        [
                            'name' => 'Cập nhật tài khoản',
                            'route' => route('manager.account.edit'),
                        ],
                        [
                            'name' => 'Đăng xuất',
                            'route' => route('manager.logout')
                        ]
                    ],
                    'icon' => 'nav-icon far fa-plus-square'
                ]
            ],
            'report' => [
            ]
        ];
        if(Gate::forUser(Auth::guard('manager')->user())->denies('post_manager')){
            unset($sidebar['manager']['post']);
        }
        if(Gate::forUser(Auth::guard('manager')->user())->denies('employee_manager')){
            unset($sidebar['manager']['employee']);
        }
        if(Gate::forUser(Auth::guard('manager')->user())->denies('customer_manager')){
            unset($sidebar['manager']['customer']);
        }
        if(Gate::forUser(Auth::guard('manager')->user())->denies('category_manager')){
            unset($sidebar['manager']['category']);
        }
        if(Gate::forUser(Auth::guard('manager')->user())->denies('attribute_manager')){
            unset($sidebar['manager']['attribute']);
        }
        return $sidebar;
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
                            'route' => route('employee.post.index')
                        ],
                    ],
                    'icon' => 'nav-icon fas fa-tachometer-alt'
                ],
                'feedback' => [
                    'name' => 'Đánh giá',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('employee.feedback')
                        ],
                    ],
                    'icon' => 'nav-icon fas fa-tachometer-alt'
                ],
                'account' => [
                    'name' => 'Tài khoản',
                    'child' => [
                        [
                            'name' => 'Cập nhật tài khoản',
                            'route' => route('employee.account.edit'),
                        ],
                        [
                            'name' => 'Đăng xuất',
                            'route' => route('employee.logout')
                        ]
                    ],
                    'icon' => 'nav-icon far fa-plus-square'

                ]
            ],

            'report' => [

            ]
        ];
    }

}

if (!function_exists("sidebarCustomer")) {
    function sidebarCustomer()
    {
        return [
            'customer' => [
                'feedback' => [
                    'name' => 'Đánh giá',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('customer.feedback.index')
                        ],
                    ],
                    'icon' => 'nav-icon fas fa-tachometer-alt'
                ],
                'post' => [
                    'name' => 'Bài đăng',
                    'child' => [
                        [
                            'name' => 'Danh sách',
                            'route' => route('customer.post.index')
                        ],
                    ],
                    'icon' => 'nav-icon fas fa-tachometer-alt'
                ],
                'account' => [
                    'name' => 'Tài khoản',
                    'child' => [
                        [
                            'name' => 'Cập nhật tài khoản',
                            'route' => route('customer.profile.edit', ['id' => (Auth::guard('customer')->user() !== null) ? Auth::guard('customer')->user()->id : ""])
                        ],
                        [
                            'name' => 'Đăng xuất',
                            'route' => route('customer.logout')
                        ]
                    ],
                    'icon' => 'nav-icon far fa-plus-square'

                ]
            ],

            'report' => [

            ]
        ];
    }

}

if (!function_exists("getUrlEdit")) {
    function getUrlEdit($url)
    {
        $url = explode('/', $url);
        $url = array_splice($url, 0, count($url) - 2);
        return $url = implode('/', $url);
    }

}
if (!function_exists("incomeEmployeeInMonth")) {
    function incomeEmployeeInMonth($employee_id)
    {
        $now=\Carbon\Carbon::now();
        $postInmonth=\App\Models\Post::where('employee_id',$employee_id)->where('status',7)
        ->whereTime('time_end','>=',$now->firstOfMonth())->whereTime('time_end','<=',$now->toDateString())->get()
        ;
        return $postInmonth->sum('price');
    }

}
